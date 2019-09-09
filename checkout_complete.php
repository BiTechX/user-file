<?php 
session_start();
require('../wp-load.php');


$USER_PAYMENT ="";

if($_GET['paymentType'] == 'subscriptionPlan'){
    
    
    
    if($_GET['payment'] == 'paypal'){
        if($_GET['success'] == 'true'){
           print_r ($_SESSION['USER_PAYMENT_SESSION']);
            if(isset($_GET['paymentId']) && isset($_GET['token'])  && isset($_GET['PayerID']) && isset($_SESSION['USER_PAYMENT_SESSION']) ){
                $USER_PAYMENT = json_decode($_SESSION['USER_PAYMENT_SESSION'],true);
                session_destroy();
                
               //print_r($USER_PAYMENT);
                
                $user_plan_add =  $USER_PAYMENT['user_plan_add'];
                if($user_plan_add == 'upgrade'){
                     $value = json_decode( user_canceled_subscription_plan($USER_PAYMENT['user_id']),true );
                    
                    if($value['status'] == 0){
                         echo "Not Canceled Plan Please Contact us";
                         exit;
                    }
                }
                
                
                $api_key = get_option('fitpro_paypal_api');
                $apiContext = null;
                
                if(isset($api_key['mode'])){
                    
                    if($api_key['mode'] == 'live'){
                        
                        $apiContext = new \PayPal\Rest\ApiContext(
                        new \PayPal\Auth\OAuthTokenCredential(
                               $api_key['paypal_client_live']."" ,     // ClientID
                               $api_key['paypal_secret_live'].""       // ClientSecret
                            )
                        );
                
                         $apiContext->setConfig(
                                array(
                                    'mode' => 'live',
                                    'log.LogEnabled' => true,
                                    'log.FileName' => 'PayPal.log',
                                    'log.LogLevel' => 'DEBUG'
                                    )
                                );
                    }
                    else{
                        
                        $apiContext = new \PayPal\Rest\ApiContext(
                        new \PayPal\Auth\OAuthTokenCredential(
                               $api_key['paypal_client_sandbox'].'' ,     // ClientID
                               $api_key['paypal_secret_sandbox'].''      // ClientSecret
                            )
                        );
                
                         $apiContext->setConfig(
                                array(
                                    'mode' => 'sandbox',
                                    'log.LogEnabled' => true,
                                    'log.FileName' => 'PayPal.log',
                                    'log.LogLevel' => 'DEBUG'
                                    )
                                );
                        
                    }
                    
                    $paymentId = $_GET['paymentId'];
                    $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
                    
                    $execution = new \PayPal\Api\PaymentExecution();
                    $execution->setPayerId($_GET['PayerID']);
                    
                    
                    $transaction = new \PayPal\Api\Transaction();
                    $amount = new \PayPal\Api\Amount();
                    //$details = new Details();
                    
                    //$details->setShipping(2.2)
                    //    ->setTax(1.3)
                    //    ->setSubtotal(17.50);
                        
                    
                    $amount->setCurrency('USD');
                    $amount->setTotal($USER_PAYMENT['total_amount']);
                    //$amount->setDetails($details);
                    $transaction->setAmount($amount);
                    
                    $execution->addTransaction($transaction);
                    try {
                        $result = $payment->execute($execution, $apiContext);
                        
                        try {
                            $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
                            
                            $obj = json_decode($payment,true);
                            
                            global $wpdb;
                           
                            $user_id = $USER_PAYMENT['user_id'];
                            $plan_id = $USER_PAYMENT['plan_info']['Id'];
                            $plan_type_id = $USER_PAYMENT['plan_info']['plan_type'];
                            $total_amount = $USER_PAYMENT['total_amount'];
                            $payment_method = 'PAYPAL';
                            $currency = "USD";
                            $payment_return_value = serialize($obj);
                            $transaction_ID = $obj['transactions'][0]['related_resources'][0]['sale']['id'];
                            $user_Info = get_userdata( $user_id );
                            $user_email = $user_Info->user_email;
                            
                            
                            $user_payment_id = set_user_subscription_plan_payment($user_id , $plan_id, $plan_type_id , $total_amount , $currency ,$payment_return_value , $payment_method ,$transaction_ID);
                        
                            $this_insert = $user_payment_id;  
            
                            $status_id = set_user_status_subscription_plan($user_id , $plan_id, $plan_type_id , $user_payment_id );
                            /*
                             $Db_insert = array(
                                'user_id'=>$user_id,
                    		    'plan_id'=>$plan_id,
                    		    'plan_type_id'=>$plan_type_id,
                    		    'payment_method'=>$payment_method,
                    		    'total_amount'=>$total_amount,
                    		    'currency'=>$currency,
                    		    'payment_return_value'=>$payment_return_value,
                    		    'transaction_ID'=>$transaction_ID,
                    		   
                            );
                            $db =  $wpdb->insert( user_plan_payment_info_db_name(), $Db_insert);
                            $this_insert = $wpdb->insert_id;
                            
                            update_user_meta($user_id,'user_current_subscription_plan',$plan_id);
                            update_user_meta($user_id,'user_current_subscription_plan_payment_info',$this_insert);
                            
                            
                            $is_installment = false;
                            $previous_installment_user_plan_id = -1;
                            $current_installment_pay_running = -1;
                            $is_installment_pay_finish = false;
                            $is_payment_complete = true;
                            $current_status = "active";
                            $starting_date = strtotime("now");
                            $expiry_date = strtotime("+183 day");
                            
                            if($plan_type_id == 2){
                                $previous_plan_user_status_id = get_user_meta( $user_id, 'user_current_subscription_plan_user_status_info' , true );
                                if(!$previous_plan_user_status_id){
                                    $is_installment = true;
                                    $previous_installment_user_plan_id = -1;
                                    $current_installment_pay_running = 1;
                                    $is_installment_pay_finish = false;
                                    $is_payment_complete = false;
                                    if($USER_PAYMENT['plan_info']['plan_number_payment'] == $current_installment_pay_running){
                                        $is_installment_pay_finish = true;
                                        $is_payment_complete = true;
                                    }
                                    $current_status = "active";
                                    $starting_date = strtotime("now");
                                    $expiry_date = strtotime("+30 day");
                                }
                                else{
                                    
                                    $results = $wpdb->get_results( 
                                                "SELECT * FROM `".user_plan_status_info_db_name()."` WHERE `ID` = ".$previous_plan_user_status_id 
                                             );
                                    $value = $results[0];
                                    $is_installment = true;
                                    $previous_installment_user_plan_id = $value->ID;
                                    $current_installment_pay_running = $value->current_installment_pay_running + 1;
                                    $is_installment_pay_finish = false;
                                    $is_payment_complete = false;
                                    if($USER_PAYMENT['plan_info']['plan_number_payment'] == $current_installment_pay_running){
                                        $is_installment_pay_finish = true;
                                        $is_payment_complete = true;
                                    }
                                    $current_status = "active";
                                    $starting_date = strtotime("now");
                                    $expiry_date = strtotime("+30 day");
                                }
                            }
                            
                            if($plan_type_id == 3){
                                $is_installment = false;
                                $previous_installment_user_plan_id = -1;
                                $current_installment_pay_running = -1;
                                $is_installment_pay_finish = false;
                                $is_payment_complete = true;
                                $current_status = "active";
                                $starting_date = strtotime("now");
                                $expiry_date = strtotime("+30 day");
                            }
                            
                           $Db_insert = array(
                                'user_id'=>$user_id,                                                            //user id
                    		    'plan_id'=>$plan_id,                                                            //plan all info db id
                    		    'plan_type_id'=>$plan_type_id,
                    		    'last_payment_id'=>$this_insert,                                                //relation with user payment id
                    		    'is_installment'=>$is_installment,                                              //check is installment
                    		    'previous_installment_user_plan_id'=>$previous_installment_user_plan_id,         //parent installment id from user plan status table
                    		    'is_installment_pay_finish'=>$is_installment_pay_finish,                        // installment is complete
                    		    'current_installment_pay_running'=>$current_installment_pay_running,            // current installment is number
                    		    'current_status'=>$current_status,                                               // user plan status which is active or deactivate
                    		    'is_payment_complete'=>$is_payment_complete,                                    // user is payment complete
                    		    'starting_date'=>$starting_date,
                    		    'expiry_date'=>$expiry_date,
                            );
                            $db =  $wpdb->insert( user_plan_status_info_db_name(), $Db_insert);
                            $this_insert = $wpdb->insert_id;
                            update_user_meta($user_id,'user_current_subscription_plan_user_status_info',$this_insert);
                            */
                            
                            
                            $mail = WP_Mail::init()
                            ->headers([
                                    "From: Brandon Hofer <brandon.hofer@gmail.com>",
                                    "Content-type: text/html; charset=iso-8859-1",
                                ])
                            ->to($user_email)
                            ->subject('{{name}} subscription plan fit fro')
                            ->template(FITPRO_CONTROLLER_DIR_PATH.'/lib/email_temp/after_give_payment.php', [
                                'name' => $user_Info->display_name,
                                'email' => $user_email,
                                'payment_method' => 'PAYPAL',
                                'transaction_ID' => $transaction_ID,
                            ])
                            ->send();
                            if($mail){
                                 wp_redirect( site_url()."/user/subscription.php" ); exit; 
                                echo "OK MAIL IS SENT Rafat Haque account";
                            }
                            
                        } catch (Exception $ex) {
                           echo $ex;
                        }
                    } catch (Exception $ex) {
                        echo $ex;
                    }
                
                
                }else{
                    echo "Sorry , You can not pay please contact brandon.hofer@gmail.com ";
                }
                     
            }
            else{
                //wp_redirect( site_url()."/user/subscription.php" ); exit; 
                echo "We already get this payment ";
            }
        }else{
            session_destroy();
             wp_redirect( site_url()."/user/subscription.php" ); exit; 
        }
    }
    else if($_GET['payment'] == 'stripe'){
        if($_GET['success'] == 'true'){
        
        
        
        }else{
             session_destroy();
             wp_redirect( site_url()."/user/subscription.php" ); exit; 
        }
    }
}

                          