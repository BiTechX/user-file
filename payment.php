<?php
//this is used for get ajax url
require('common-config.php');

if(isset($_GET['paymentId']) && isset($_GET['token'])  && isset($_GET['PayerID']) && isset($_SESSION['PAYPAL_TOTAL_PRICE']) ){
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
            /*
            $details->setShipping(2.2)
                ->setTax(1.3)
                ->setSubtotal(17.50);
                
            */
            $amount->setCurrency('USD');
            $amount->setTotal($_SESSION['PAYPAL_TOTAL_PRICE']);
            //$amount->setDetails($details);
            $transaction->setAmount($amount);
            
            $execution->addTransaction($transaction);
            try {
                $result = $payment->execute($execution, $apiContext);
                
                try {
                    $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
                } catch (Exception $ex) {
                   
                   
                }
            } catch (Exception $ex) {
               
            }
           
            //return $payment;
            echo "<br>";
            
            print_r($payment);
            echo "<br>";
            echo "<br>";
            print_r($result);
            session_destroy();
        }else{
            
        }
     
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Home</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../resources/css/sidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    

    <link rel="stylesheet" href="../resources/css/colors.css">
    <link rel="stylesheet" href="../resources/css/dashboard.css">
    <link rel="stylesheet" href="../resources/css/progressbar.css">
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    
    

     
</head>


<style>

</style>
<body>
    <?php
        require('navbar-mobile.php');
    ?>
    <div class="wrapper">
        <?php
            require('sidebar.php');
        ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
                require('navbar-top.php');
            ?>
            
            <form>
            
        

                <div class="row d-flex flex-wrap no-margin">
                   
              
                    
                   

                    <div class="padding-15px text-lg-left text-center">
                        <button id="paypalButton" class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" style="margin-bottom:20px" type="button">Paypal</button>
                    </div>
                    
                </div>
                
            </form>
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script src="../resources/js/progressbar.js"></script>
  

</body>

<script>
       
    $(document).on('click', "#paypalButton", function(e) {
      
      
                var postvalue =  {
                        "cancel_url" : "https://example.com/your_cancel_url.html",
                        'return_url' : "https://example.com/your_redirect_url.html"
            
                };
                var url = "<?php echo FITPRO_THEME_BTX_fun_paypal_payment_url();?>";
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        jQuery(this).prop("disabled",true);
                    },
                    success: function(result){
                       console.log(result);
                       jQuery(this).prop("disabled",false);
                       
                       var data = jQuery.parseJSON(result);
                        
                        if(data.status == 1){
                            console.log(data);
                            window.location.href = data.url+"";
                        }
                       
                    },
                    error: function(e) 
                    {
                       console.log(e);
                       jQuery(this).prop("disabled",false);
                    }   
                    
                });
                
                
    });
        
</script>   

</html>