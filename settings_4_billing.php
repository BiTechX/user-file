<?php
require('common-config.php');
//print_r($_REQUEST);
if(
    isset($_POST['name']) 
&&  isset($_POST['address_city']) 
&&  isset($_POST['address_country']) 
&&  isset($_POST['address_line1']) 
&&  isset($_POST['address_zip']) 
&&  isset($_POST['number']) 
&&  isset($_POST['exp_month']) 
&&  isset($_POST['exp_year']) 
&&  isset($_POST['cvc']) 
){
   $user_id = $user_ID;
   $name = $_POST['name'];
   $address_city = $_POST['address_city'];
   $address_country = $_POST['address_country'];
   $address_line1 = $_POST['address_line1'];
   $address_zip = $_POST['address_zip'];
   $card_number = $_POST['number'];
   $exp_month = $_POST['exp_month'];
   $exp_year = $_POST['exp_year'];
   $cvc = $_POST['cvc'];
   
     $card = get_user_meta( $user_id, 'user_credit_card_info' , true );
                            if(!$card){
                                $card_Info =  array(
                                    array(
                                        "name"=> $user_Info->display_name,
                                        "address_city"=> '',
                                        "address_country"=> '',
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
                            
                            $card = get_user_meta( $user_id, 'user_credit_card_info' , true );
                            
                            $card_Info =  array(
                               "name"=> $name,
                                "address_city"=> $address_city,
                                "address_country"=> $address_country,
                                "address_line1" =>$address_line1 ,
                                "address_zip"=>$address_zip,
                                "number" => $card_number,
                                "exp_month" => $exp_month,
                                "exp_year" => $exp_year,
                                "cvc" => $cvc,
                                );
                           
                            if(!in_array($card_Info, $card)){
                                 array_push($card,$card_Info);
                                 update_user_meta($user_id,'user_credit_card_info',$card);
                            }  
                            
   wp_redirect(site_url().'/user/settings_4_billing.php');
   
}
$country =  json_decode(file_get_contents("country_list.json"),true);
$user_id = $user_ID ;
$card_info = get_user_meta( $user_id, 'user_credit_card_info' , true );
    if(!$card_info){
         $card_Info =  array(
             array(
                "name"=> $user_Info->display_name,
                "address_city"=> '',
                "address_country"=> '',
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
$card_infos = get_user_meta( $user_id, 'user_credit_card_info' , true );

$card_info = $card_infos[count($card_infos) - 1];
//print_r($card_info);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Settings - Billing</title>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">
    
    
    <script src="<?php echo site_url(); ?>/user/extra/js/cleave.min.js"></script>
     
</head>

<script>
    
    $(document).ready(function(){
        $('#input-file-now-custom-1').change(function(){
            var total_file=document.getElementById("input-file-now-custom-1");
            
            $('#file-preview').html("<div style='text-align:right;'><i class='fas fa-times' id='cross-button'></i></div><img src="+URL.createObjectURL(event.target.files[0]) + "> </img>");
            $('#file-preview').addClass(" drop-shadow card-holder");
        });
        
        $(document).on ("click", "#cross-button" ,function(){
            
            document.getElementById("input-file-now-custom-1").value = "";
            $('#file-preview').html("");
            $('#file-preview').removeClass(" drop-shadow card-holder");
        });
        
    });
    
</script>

<script>
       

        
    </script>   

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
        

            <h1 class="dashboard-title primary-color1 padding-15px"><a href="homepage.php"><i class="flaticon-back"></i></a>  Settings</h1>
            <div class="padding-15px" style="margin-bottom:20px;">
                <a href="settings_1_profile.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Profile</button></a>
                <a href="settings_2_account.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Account</button></a>
                <a href="settings_3_subscription.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Subscription</button></a>
                
                <a href="settings_4_billing.php"><button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button current-page-button" >Billing</button></a>
       <!--         <a href="settings_5_shipping.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Shipping</button></a>   -->
           
                
                            
            </div>
            <form action="" id="UserInfoUpdate" method='POST' >
                 <div class="row no-margin " >
                       
                     <div class="col-xl-6 col-lg-8">
                         <!--
                          <div class="row no-margin drop-shadow" style="min-height:200px">
                                        <div class="col-xl-12 col-lg-12 text-center text-lg-left" style="display:flex;align-items:center;">
                                            <h5 class="secondary-color1 text-center text-lg-left" style="margin:auto">You were charged <span class="primary-color1">$9.99</span> on <span class="primary-color1">April 18, 2019</span> at 20:58 from <span class="primary-color1">XXXX-XXXX-XXXX-2343</span> card. you'll be billed from selected card in next billing date <span class="primary-color1">May 18, 2019</span> If you have any problems regarding the payment or ask for refund - 
                                            </h5>
                                        </div>  
                                        
                                            <div class="col-xl-12 col-lg-12 " style="display:flex">
                                            <button id="ActionButton" class="drop-shadow btn theme-rounded-button white-background secondary-color1 secondary-color1-border secondary-color1-border-hover white-hover secondary-color1-background-hover" style="margin:20px auto" type="submit">CONTACT SUPPORT HERE</button>
                                        </div> 
                                        </div> 
                                       
                                 -->        
                                           
                                        </div> 
                                       
                                        
                </div>
                <h6 class="secondary-color1 dashboard-title3 no-margin" style="padding:12px;margin-bottom:0px !important;">CHANGE YOUR BILLING ADDRESS</h6>
                    <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="title-line" style="">
                          
                        </div>  
                    </div>
                 </div>
                <div class="row no-margin d-flex flex-wrap">
                    
                    <div class="col-xl-3 col-lg-4 ">
                            
                     

                            <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;"> Name </h6>
                                <input type="text" required class="form-control" name = "name" value="<?php echo $card_info['name'];?>" placeholder="Please provide your name">
                            </div>    
                               
                            
                    </div>
                    
                    
                    
                </div>
                
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">                            
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Country</h6>
                            <div id="category" >
                                
                                <select class="input-lg form-control" name = "address_country" required>
                                   <?php 
                                    foreach ($country as $value)
                                    
                                        if($value['country'] == $card_info['address_country']){
                                             echo '<option value = "'.$value['country'].'" selected>'.$value['country'].'</option>';
                                        }else{
                                             echo '<option value = "'.$value['country'].'">'.$value['country'].'</option>';
                                        }
                                       
                                    ?>
                                    
                                    
                                </select>
                                <i class="flt flaticon-back rotated-90 grey"></i> 
                             
                                
                            </div>
                        </div>  
                        
                 
                        <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">City</h6>
                                <input type="text" required class="form-control" name = "address_city" value="<?php echo $card_info['address_city'] ;?>" placeholder="Please provide your city">
                        </div>    
                        <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Address</h6>
                                <input type="text" required class="form-control" name = "address_line1" value="<?php echo $card_info['address_line1'] ;?>" placeholder="Please provide your Address">
                        </div>    
                        <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Street Address</h6>
                                <input type="text" required class="form-control" name = "address_zip" value="<?php echo $card_info['address_zip'] ;?>" placeholder="Please provide your area zip code">
                        </div>
                        <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Card Number</h6>
                                <input type="text" required class="form-control input-credit-card" name = "number" value="<?php echo $card_info['number'] ;?>" placeholder="Please provide your credit card number">
                        </div>
                        
                        <div class="col-8">
                                            <div class="row">
                                                <h6 class="dashboard-title3 small-text secondary-color1" style="margin-bottom:10px;">EXPIRY DATE:</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 no-padding" >
                                                    
                                                    <div>
                                                        <select class="input-lg form-control grey"  name="exp_month" style="margin-bottom:0px;background-color:transparent;" required>
                                                                                                
                                                                                                  
                                                            
                                                            <?php 
                                                            for($i = 1; $i<=12;$i++){
                                                                 if( $card_info['exp_month'] == $i ){
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
                                                        <select class="input-lg form-control grey" name="exp_year" style="margin-bottom:0px;background-color:transparent;" required>
                                                                                                
                                                                                                  
                                                           <?php 
                                                            for($i = 19; $i<=99;$i++){
                                                                 if( $card_info['exp_year'] == $i ){
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
                            <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">CVC</h6>
                                <input type="text" required class="form-control input-credit-card" name = "cvc" value="<?php echo $card_info['cvc'] ;?>" placeholder="Please provide your cvc number">
                        </div>
                        
                    </div>
                </div>
                
                
                <div class="row no-margin">
                 
                   
                    <div class="col-xl-3 col-lg-4">                            
                        
                        
                        
                    </div>
                    <div class="col-xl-3 col-lg-4">                            
                        
                        
                    </div>
                </div>                
                
                
                <div class="padding-15px text-lg-left text-center">
                  
                    <button id="ActionButton" class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" style="margin-bottom:20px" type="submit">SAVE CHANGES</button>
                    
                </div>
                
                <!--
                 <div class="row no-margin d-flex flex-wrap">
                   <div class="col-xl-6 col-lg-8 ">
                     <div class="row no-margin">
                         
                       <div class="col-xl-8 col-lg-8 ">
                          <div class="row no-margin drop-shadow" style="min-height:200px;display:flex;justify-content:center;">
                                    <div  class="row no-margin">
                                        <div class="col-xl-4 col-lg-6  " style="display:flex;align-items:center;justify-content:center;" >
                                        <i class="flt flaticon-check secondary-color1" style="font-size:70px;"></i>
                                        
                                        </div>
                                        <div class="col-xl-8 col-lg-6  text-center text-lg-left" style="display:flex;align-items:center;">
                                            <h5 class="secondary-color1 text-center text-lg-left" style="margin:auto">Card No: <span class="primary-color1">XXXX-XXXX-XXXX-2343</span> 
                                            </h5>
                                        </div>  
                                    </div>
                                    <div class="row no-margin">
                                            <div class="col-xl-6 col-lg-6 " style="display:flex;justify-content:center;">
                                            <button id="ActionButton" class="drop-shadow btn theme-rounded-button white-background secondary-color1 secondary-color1-border secondary-color1-border-hover white-hover secondary-color1-background-hover" style="margin:20px auto;padding:1em 2.5em!important;" type="submit">REMOVE CARD</button>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 " style="display:flex;align-items:center;justify-content:center;">
                                                <h5 class="primary-color1 " >SELECTED</h5>
                                            </div>    
                                    </div>
                            </div>    
                             
                         
                            
                    </div>
                    
                    
                    
                    
                    <div class="col-xl-4 col-lg-4 ">
                     
                             <div class="drop-shadow secondary-color1-border-hover " style="min-height:200px;display:flex;">
                                <h5 class="secondary-color1 text-center" style="margin:auto;padding:5px;"><strong>+ ADD CARD</strong></h5>
                            </div> 
                         
                    </div> 
                    
                 </div>
            
                <div class="row no-margin">
                       <div class="col-xl-8 col-lg-8 ">
                    <div class="row no-margin drop-shadow" style="min-height:200px;display:flex;justify-content:center;margin-top:25px">
                                    <div  class="row no-margin">
                                        <div class="col-xl-4 col-lg-6  " style="display:flex;align-items:center;justify-content:center;" >
                                        <i class="flt flaticon-check secondary-color1" style="font-size:70px;"></i>
                                        
                                        </div>
                                        <div class="col-xl-8 col-lg-6  text-center text-lg-left" style="display:flex;align-items:center;">
                                            <h5 class="secondary-color1 text-center text-lg-left" style="margin:auto">Card No: <span class="primary-color1">XXXX-XXXX-XXXX-2343</span> 
                                            </h5>
                                        </div>  
                                    </div>
                                        <div class="row no-margin">
                                            <div class="col-xl-6 col-lg-12 " style="display:flex;justify-content:center;">
                                            <button id="ActionButton" class="drop-shadow btn theme-rounded-button secondary-color1-background white secondary-color1-border secondary-color1-border-hover secondary-color1-hover white-background-hover" style="margin:20px auto;padding:1em 2.5em!important;" type="submit">SELECT CARD</button>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 " style="display:flex;align-items:center;justify-content:center;">
                                                <button id="ActionButton" class="drop-shadow btn theme-rounded-button white-background secondary-color1 secondary-color1-border secondary-color1-border-hover white-hover secondary-color1-background-hover" style="margin:20px auto;padding:1em 2.5em!important;" type="submit">REMOVE CARD</button>
                                            </div>    
                                        </div>
                            </div> 
                            </div>
                    </div>
                
                </div> 
               </div>
               
               -->
            </form>
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    

</body>

<script>
       var cleaveCreditCard = new Cleave('.input-credit-card', {
        creditCard: true
    });
    $(document).on('submit', "#UserInfoUpdate", function(e) {
      
                var postvalue =  jQuery("#UserInfoUpdate").serialize();
                var url = "<?php echo FITPRO_THEME_BTX_fun_user_info_update_url();?><?php echo $user_ID;?>";
                console.log(postvalue);
              
               /* $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        jQuery("#ActionButton").prop("disabled",true);
                    },
                    success: function(result){
                        console.log(result);
                       jQuery("#ActionButton").prop("disabled",false);
                       window.location.href ="";
                    },
                    error: function(e) 
                    {
                       window.location.href = "";
                    }   
                    
                });
                */
                
    });
        
</script>   


</html>