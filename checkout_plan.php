<?php  
require('common-config.php');  
//include_once "../wp-config.php";
//https://fitprobizlaunch.com/user/checkout_plan.php?plan_id=16&plan_add=upgrade
$plan_ID = null ;
$plan_ADD = null ;
if(isset( $_GET['plan_id']) && isset( $_GET['plan_add'])  ){
    $plan_ID = $_GET['plan_id'];
    $plan_ADD = $_GET['plan_add'] ;
}
else{
     wp_redirect( home_url().'/user/subscription.php' ); exit;
}

$result = get_a_plan($plan_ID);

if(count($result) <= 0 ){
    wp_redirect( home_url().'/user/subscription.php' ); exit;
}
$user_id = $user_ID ;
$card_info = get_user_meta( $user_id, 'user_credit_card_info' , true );
    if(!$card_info){
         $card_Info =  array(
             array(
                "name"=> $user_Info->display_name,
                "address_city"=> '',
                "address_country"=> '',
                "address_state"=> "",
                "address_line1" =>"" ,
                "address_zip"=>'',
                "number" => '',
                 "exp_month" => '',
                "exp_year" => '',
                "cvc" => '',
            ),
        );
        update_user_meta($user_id,'user_credit_card_info',$card_Info);
}
$card_info = get_user_meta( $user_id, 'user_credit_card_info' , true );

$card_info_user= $card_info[count($card_info)-1];

$country =  json_decode(file_get_contents("country_list.json"),true);
//print_r($card_info);

 $current_user_payment_complete = $wpdb->get_results( 
                       "SELECT * FROM `".user_plan_status_info_db_name()."` WHERE `user_id` = $user_id AND `current_status` = \"active\" AND `is_payment_complete` = 1 ",
                       ARRAY_A
              );
              if(count($current_user_payment_complete)>=1 && $_GET['plan_add'] != 'upgrade'){
                  echo "You already buy a plan";
                  exit;
              }
              
              
$res = get_a_plan($plan_ID);
if($res[0]->plane_type == "FREE"){
    if($plan_ADD == 'upgrade'){
               
        $value = json_decode( user_canceled_subscription_plan($user_id) , true );
                    
        if($value['status'] == 0){
                echo "Not Canceled Plan Please Contact us";
                 exit;
        }
    }
    
    $lastvalue = set_user_subscription_plan_payment($user_id , $plan_ID, $res[0]->ID , "0.0" , "USD" ,'' , "NONE" , '');
    set_user_status_subscription_plan( $user_id , $plan_ID,  $res[0]->ID ,  $lastvalue);
    wp_redirect( home_url().'/user/subscription.php' ); exit;
    
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Checkout</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../resources/css/sidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

       <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    

    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    
    
    <script src="<?php echo site_url(); ?>/user/extra/js/cleave.min.js"></script>
     
</head>


<style>
.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
  
    
}
    
</style>
<body >

    <?php
        require('navbar-mobile.php');
    ?>
        
    <div class="wrapper" id="mydiv">
        <?php
            require('sidebar.php');
        ?>


        <!-- Page Content  -->
        <div id="content" style="padding-top:0px;">

        <div class="text-center">


           
            
            
            
       

             <div class="row">
                
                    
                    <div class="col-xl-8 module-card-div" style="padding-top:20px;"> <!-- padding top 20px more for shadow -->
                        
                        <?php
                            require('navbar-top.php');
                        ?>   
                       
                       
                        <h1 class="dashboard-title primary-color1 text-left padding-15px" style="width:100%;"><a href="subscription.php"><i class="flaticon-back" style="margin-right:20px;"></i></a>CHECKOUT</h1>
                           
                           
                       

                        <div class="row  no-margin  d-none d-xl-flex" style="margin-bottom:10px;">

                   

                            <div class="col-xl-6 order-1 order-xl-0">
                                <div class="drop-shadow card-holder white-background" style="padding:30px;height:auto;">
                                    
                                    <h3 class="dashboard-title3-bold text-center primary-color1" style="margin-bottom:10px;"><?php echo $result[0]->plane_name;?></h3>
                                    <p class="secondary-color1 dashboard-title3-bold text-center small-text"><?php echo $result[0]->plan_title;?></p>
                                    <div class="primary-color1-background horizontal-middle" style="height:5px;width:20px;margin:20px auto;"></div>
                                    <?php if($result[0]->plan_type == 2): ?>
                                    <p class="secondary-color1 dashboard-title3-bold text-center small-text">pay <?php echo $result[0]->plan_number_payment; ?> monthly installments</p>
                                    <?php endif ?>
                                    <?php if($result[0]->plan_type != 4): ?>
                                    <h1 class="secondary-color1 dashboard-title3-bold text-center " style="margin-bottom:40px;">$<?php echo $result[0]->plan_total_cost;?></h1>
                                    <?php else: ?>
                                    <h1 class="secondary-color1 dashboard-title3-bold text-center " style="margin-bottom:40px;"></h1>
                                    <?php endif ?>
                                    <p class="primary-color1 dashboard-title3-bold text-center very-small-text" style="text-transform:none;"><?php echo $result[0]->plan_description;?></p>
                                
                                </div>
                               <!--
                               <div class="big-animatable-button primary-color2-background primary-color2 " style="margin-bottom:20px;" >
                                    <div class="big-animatable-button-inner primary-color1-background"></div>
                                    <div class="big-animatable-button-arrow"></div>
                                    <p class="big-animatable-button-text"> <span class="arrow_triangle-right primary-color2">CHOOSE THIS PLAN</span></p>
                                </div>  
                                -->
                            </div>

                        </div>

                    </div>
                    
                    <div class="col-xl-4  col-xl-4-right-sidebar" >
                            <div class="primary-color1-background padding-15px scrollbar-change primary-color2-scrollbar mobile-overlapping-sidebar" style="overflow:auto;padding-top:15px;"> <!-- padding top 20px more for shadow -->
                                
    
                                <div class="row no-margin vertical-middle" style="margin-bottom:10px;padding:15px;">
                                    <h1 style="margin-top:60px;margin-bottom:10px;" class="white dashboard-title" >CARD DETAILS</h1>
                                </div>
                                <div class="row no-margin vertical-middle" style="margin-bottom:10px;padding:15px;">
                                    <p class="primary-color2 small-text dashboard-title3-bold" style="margin-bottom:0px;">Select payment method</p>
    
                                </div>
                                <div class="row no-margin" style="padding:15px;cursor:pointer;">
                                    
                                        <i class="flt flaticon-credit-card primary-color2  primary-color2-hover" style="font-size:40px;margin-right:15px;"></i>
                                        <div id="PayPalButton"> 
                                            <i class="flt flaticon-paypal-logo grey  primary-color2-hover" style="font-size:90px;margin-left:15px;margin-top:-35px;"></i>
                                        </div>
    
                                </div>
                                
                            <form action="javascript:void(0)" method="post" id="CraditCardPayment">    
                                <div class="row no-margin vertical-middle" style="margin-bottom:10px;padding:15px;">
                                    
                                    <h6 class="primary-color2 small-text" style="margin-bottom:10px;">NAME :</h6>
                                    <input type="text" class="new-module-input dashboard-title3-bold white" style="margin-bottom:20px;" name="name" value="<?php echo $card_info_user['name']; ?>" required>
                                    
                                  

                                  
                                    

                                    <h6 class="primary-color2 small-text" style="margin-bottom:10px;">ADDRESS :</h6>
                                    <input type="text" class="new-module-input dashboard-title3-bold white" style="margin-bottom:20px;" value="<?php echo $card_info_user['address_line1']; ?>" name="address_line1" required>
                                    <h6 class="primary-color2 small-text" style="margin-bottom:10px;">CITY :</h6>
                                    <input type="text" class="new-module-input dashboard-title3-bold white" style="margin-bottom:20px;" value="<?php echo $card_info_user['address_city']; ?>" name="address_city" required>
                                    <h6 class="primary-color2 small-text" style="margin-bottom:10px;">ZIP/POSTAL CODE :</h6>
                                    <input type="text" class="new-module-input dashboard-title3-bold white" style="margin-bottom:20px;" value="<?php echo $card_info_user['address_zip']; ?>" name="address_zip" required>
                                    <h6 class="primary-color2 small-text" style="margin-bottom:10px;">STATE/PROVINCE/REGION :</h6>
                                    <input type="text" class="new-module-input dashboard-title3-bold white" style="margin-bottom:20px;" value="<?php echo $card_info_user['address_state']; ?>" name="address_state" required>
                                    <h6 class="primary-color2 small-text" style="margin-bottom:10px;">COUNTRY :</h6>
                                    <div style="width: 100%;margin-bottom: 20px;">
                                        <select class="input-lg form-control grey" name="address_country" style="margin-bottom:0px;background-color:transparent;border-bottom:1px solid #7d7d7d!important;" required>
                                            <?php 
                                               foreach ($country as $value):
                                                    if($value['country'] == $card_info_user['address_country']){
                                                         echo '<option value = "'.$value['country'].'" selected>'.$value['country'].'</option>';
                                                    }else{
                                                         echo '<option value = "'.$value['country'].'">'.$value['country'].'</option>';
                                                    }
                                                endforeach;
                                       
                                            ?>
                                        </select>
                                        <i class="flaticon-move-to-the-next-page-symbol flt grey" style="margin-top:-30px;transform: rotate(90deg);background-color:transparent;"></i>
                                    </div>
                                    <h6 class="primary-color2 small-text" style="margin-bottom:10px;">CARD NUMBER:</h6>
                                    <input type="text" class="new-module-input dashboard-title3-bold white input-credit-card" style="margin-bottom:20px;" value="<?php echo $card_info_user['number']; ?>" name="card_number" required>
        
        
                                    <div class="row no-margin" style="width:100%;margin-bottom:30px;"> 
                                        
                                        <div class="col-8 no-padding">
                                            <div class="row no-margin">
                                                <h6 class="primary-color2 small-text" style="margin-bottom:10px;">EXPIRY DATE:</h6>
                                            </div>
                                            <div class="row no-margin">
                                                <div class="col-6 no-padding" >
                                                    
                                                    <div>
                                                        <select class="input-lg form-control grey"  name="exp_month" style="margin-bottom:0px;background-color:transparent;border-bottom:1px solid #7d7d7d!important;" required>
                                                                                                
                                                                                                  
                                                            
                                                            <?php 
                                                            for($i = 1; $i<=12;$i++){
                                                                 if( $card_info_user['exp_month'] == $i ){
                                                                        $num_padded = sprintf("%02d",  $i);
                                                                        echo "<option value=\"$num_padded\" selected>$num_padded</option>";
                                                                }else{
                                                                        $num_padded = sprintf("%02d",  $i);
                                                                        echo "<option value=\"$num_padded\" >$num_padded</option>";
                                                                }
                                                                
                                                            }
                                                            ?>
                                                           
                
                                                        </select>
                                                        <i class="flaticon-move-to-the-next-page-symbol flt grey" style="margin-top:-30px;transform: rotate(90deg);background-color:transparent;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6 no-padding" >
                                                    
                                                    <div>
                                                        <select class="input-lg form-control grey" name="exp_year" style="margin-bottom:0px;background-color:transparent;border-bottom:1px solid #7d7d7d!important;" required>
                                                                                                
                                                                                                  
                                                           <?php 
                                                            for($i = 19; $i<=99;$i++){
                                                                 if( $card_info_user['exp_year'] == $i ){
                                                                        echo "<option value=\"$i\" selected>$i</option>";
                                                                }else{
                                                                      echo "<option value=\"$i\">$i</option>";
                                                                }
                                                            }
                                                            ?>
                                                           
                
                                                        </select>
                                                        <i class="flaticon-move-to-the-next-page-symbol flt grey" style="margin-top:-30px;transform: rotate(90deg);background-color:transparent;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1 no-padding"></div>
                                        <div class="col-3 no-padding">
                                            <div class="row no-margin">
                                                <h6 class="primary-color2 small-text" style="margin-bottom:10px;">CVC:</h6>
                                            </div>
                                            <div class="row no-margin">
                                                <div class="col-12 no-padding" >
                                                    <div>
                                                        <input type="text" class="new-module-input dashboard-title3-bold white" style="height:38px;" value="<?php echo $card_info_user['cvc']; ?>" name="cvc" required>
                                                    </div>
                                                </div>
    
                                            </div>
                                        </div>  
                                    </div> 
                                    
                                    <!--
                                    <div class="custom-control custom-checkbox  primary-color2-checkbox" style="margin-bottom:50px;">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1" >
                                          
                                          <label class="custom-control-label dashboard-title3 white" style="text-transform:none;" for="customCheck1" >Save information for future purchases</label>
                                    </div>
                                    -->
                                    <div>
                                        <input type="hidden" value="<?php echo $_GET['plan_id'];?>" name="plan_id"> 
                                        <input type="hidden" value="<?php echo $user_ID;?>" name="user_id"> 
                                        <input type="hidden" value="<?php echo $plan_ADD;?>" name="user_plan_add"> 
                                        
                                        <button class="drop-shadow btn theme-rounded-button primary-color1 primary-color2-background primary-color2-border primary-color2-border-hover 
                                        primary-color2-hover primary-color1-background-hover" type="submit" style="margin-bottom:20px;width:100%;">CHECKOUT</button>
                                    </div>
                                </div>
    
                            </form>        
    
    
                        </div> 
                            
                        
                            
    
    
    
                        </div>
                   
                </div> 
                
       
                            
    
                         
            
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>

</body>
<script>
       var cleaveCreditCard = new Cleave('.input-credit-card', {
        creditCard: true
    });
       
       
    $(document).on('click', "#PayPalButton", function(e) {
      
      
                var postvalue =  {
                       'plan_id' : "<?php echo $_GET['plan_id'];?>",
                        'user_id' : "<?php echo get_current_user_id();?>",
                        'user_plan_add' : "<?php echo $plan_ADD;?>"
                };
                var url = "<?php echo FITPRO_THEME_BTX_fun_plan_paypal_payment_user_url();?>";
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        $("#mydiv").addClass("disabledbutton");
                        jQuery(this).prop("disabled",true);
                    },
                    success: function(result){
                       //$("#mydiv").removeClass("disabledbutton");
        
                        var data = jQuery.parseJSON(result);
                        jQuery(this).prop("disabled",false);
                        if(data.status == 1){
                            window.location.href = data.url+"";
                        }else if(data.status == 0){
                            alert(data.message);
                        }
                        
                       
                    },
                    error: function(e) 
                    {
                        $("#mydiv").removeClass("disabledbutton");
                       console.log(e);
                       jQuery(this).prop("disabled",false);
                    }   
                    
                });
                
                
    });
        
        
    $(document).on('submit', "#CraditCardPayment", function(e) {
      
      
                var postvalue = jQuery(this).serialize(); 
                var url = "<?php echo FITPRO_THEME_BTX_fun_plan_stripe_payment_user_url();?>";
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        $("#mydiv").addClass("disabledbutton");
                        jQuery(this).prop("disabled",true);
                    },
                    success: function(result){
                       $("#mydiv").removeClass("disabledbutton");
                        console.log(result);
                        var data = jQuery.parseJSON(result);
                        console.log(data);
                       
                        
                        if(data.status == 1){
                            window.location.href = data.url+"";
                        }
                        else if(data.status == 0){
                            alert(data.message);
                        }
                         jQuery(this).prop("disabled",false);
                    },
                    error: function(e) 
                    {
                        $("#mydiv").removeClass("disabledbutton");
                       console.log(e);
                       jQuery(this).prop("disabled",false);
                    }   
                    
                });
                
                
    });    
        
</script>   
</html>