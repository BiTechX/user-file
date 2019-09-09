<?php
//this is used for get ajax url
require('common-config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Settings - Subscription</title>

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
                <a href="settings_3_subscription.php"><button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button current-page-button" >Subscription</button></a>
                
                <a href="settings_4_billing.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Billing</button></a>
              <!--  <a href="settings_5_shipping.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Shipping</button></a>   -->
           
                
                            
            </div>
            <form action="javascript:void(0)" id="UserInfoUpdate" method=POST enctype=multipart/form-data >
                
                
                <div class="row no-margin d-flex flex-wrap">
                    
                    <div class="col-xl-3 col-lg-4 order-1 order-lg-0">
                            
                         
                            
                    </div>
                    
                    
                    
                </div>
                
                <div class="row no-margin">
                    <div class="col-xl-8 col-lg-8">   
                    <?php 
                        if( is_user_have_subscription_plan($user_ID) ):
                            if(!is_user_have_subscription_plan_isFREE($user_ID)):
                                $val = get_user_current_subscription_info($user_ID);
                                $plan_info = unserialize($val['current_user_plan_info']);
                                $plan_pay_info = unserialize($val['current_user_plan_pay_info']);
                                $plan_user_status_info = unserialize($val['current_user_plan_status_info']);
                                //print_r($plan_pay_info);
                    ?>
                    
                             <div class="row no-margin drop-shadow" style="min-height:200px">
                                
                                        <div class="col-xl-8 col-lg-6 text-center text-lg-left" style="display:flex;align-items:center;">
                                            <h5 class="secondary-color1 text-center text-lg-left" style="margin:auto">YOU ARE CURRENTLY ENJOYING "<?php echo strtoupper( $plan_info->plan_title ) ;?>" </h5>
                                        </div>  
                                        <div class="col-xl-1 col-lg-1 ">
                                           <input type="hidden" name="user_plan_status_id" value="<?php echo $plan_pay_info['ID']  ;?>">
                                           <input type="hidden" name="user_plan_payment_id" value="<?php echo $plan_user_status_info['ID']  ;?>">
                                        </div> 
                                        <div class="col-xl-2 col-lg-3 vertical-middle horizontal-middle-flex">
                                            <?php  if($plan_info->plane_type != 'MONTHLY' ): ?>
                                          <!-- <button id="ActionButton" data-plantypeId = "<?php echo $plan_info->ID  ;?>" class="drop-shadow btn theme-rounded-button white-background secondary-color1 secondary-color1-border secondary-color1-border-hover white-hover secondary-color1-background-hover" style="margin:auto" type="submit">CANCEL PLAN</button> -->
                                            <?php  elseif($plan_info->plane_type == 'MONTHLY' ): ?>
                                             <a href="<?php echo site_url()."/user/subscription_uprade.php";?>">
                                                <button data-plantypeId = "<?php echo $plan_info->ID  ;?>" class="drop-shadow btn theme-rounded-button white-background secondary-color1 secondary-color1-border secondary-color1-border-hover white-hover secondary-color1-background-hover" style="margin:auto" type="button">UPGRADE PLAN</button>
                                            </a>
                                            <?endif;?>
                                        </div> 
                                         <div class="col-xl-1 col-lg-1 ">
                                           
                                        </div> 
                                       
                                        
                                </div>
                                <?php else:?>
                                <div class="row no-margin drop-shadow" style="min-height:200px">
                                
                                        <div class="col-xl-8 col-lg-6 text-center text-lg-left" style="display:flex;align-items:center;">
                                            <h5 class="secondary-color1 text-center text-lg-left" style="margin:auto">YOU CURRENTLY HAVE FREE PLAN</h5>
                                        </div>  
                                        <div class="col-xl-1 col-lg-1 ">
                                           
                                        </div> 
                                        
                                            <div class="col-xl-2 col-lg-3  vertical-middle horizontal-middle-flex">
                                              <a href="<?php echo site_url()."/user/subscription.php";?>">
                                                <button class="drop-shadow btn theme-rounded-button white-background secondary-color1 secondary-color1-border secondary-color1-border-hover white-hover secondary-color1-background-hover" style="margin:auto" type="button">VIEW ALL PLANS</button>
                                              </a>
                                            </div> 
                                       
                                         <div class="col-xl-1 col-lg-1 ">
                                           
                                        </div> 
                                       
                                        
                                </div>
                                <?php endif;?>
                            <?php else:?>      
                                <div class="row no-margin drop-shadow" style="min-height:200px">
                                
                                        <div class="col-xl-8 col-lg-6 text-center text-lg-left" style="display:flex;align-items:center;">
                                            <h5 class="secondary-color1 text-center text-lg-left" style="margin:auto">YOU CURRENTLY HAVE NO PLAN</h5>
                                        </div>  
                                        <div class="col-xl-1 col-lg-1 ">
                                           
                                        </div> 
                                        
                                            <div class="col-xl-2 col-lg-3  vertical-middle horizontal-middle-flex">
                                              <a href="<?php echo site_url()."/user/subscription.php";?>">
                                                <button class="drop-shadow btn theme-rounded-button white-background secondary-color1 secondary-color1-border secondary-color1-border-hover white-hover secondary-color1-background-hover" style="margin:auto" type="button">VIEW ALL PLANS</button>
                                              </a>
                                            </div> 
                                       
                                         <div class="col-xl-1 col-lg-1 ">
                                           
                                        </div> 
                                       
                                        
                                </div>
                             <?php endif;?>     
                       
                       
                    </div>
                </div>
                
                
                <div class="row no-margin">
                 
                   
                    <div class="col-xl-3 col-lg-4">                            
                        
                    </div>
                    <div class="col-xl-3 col-lg-4">                            
                     
                    </div>
                </div>                
                
                
                
            </form>
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    

</body>

<script>
       
    $(document).on('submit', "#UserInfoUpdate", function(e) {
      
               
                var postvalue =  jQuery("#UserInfoUpdate").serialize();
                var url = "<?php echo FITPRO_THEME_BTX_fun_plan_cancel_user_url();?><?php echo $user_ID;?>";
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        jQuery("#ActionButton").prop("disabled",true);
                    },
                    success: function(result){
                        console.log(result);
                       //jQuery("#ActionButton").prop("disabled",false);
                       var data = jQuery.parseJSON(result);
                       if(data.status == 1){
                           window.location.href ="";
                       }
                       else if(data.status == 0){
                           alert(data.message);
                       }
                       
                    },
                    error: function(e) 
                    {
                       //window.location.href = "";
                    }   
                    
                });
                
                
    });
        
</script>   


</html>