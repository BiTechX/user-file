<?php
//this is used for get ajax url
require('common-config.php');


$country =  json_decode(file_get_contents("country_list.json"),true);

//print_r( $user_Info );
//echo "<br><br><br>";
//print_r($user_meta);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Settings - Profile</title>

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
    
    function validate_url(Fburl ,twurl, linurl,insturl )
    {
        if(!(/^(https?:\/\/)?((w{3}\.)?)facebook\.com\/(#!\/)?[A-Za-z0-9_.]+$/i.test(Fburl))   ){
             alert("Please use the format: https://www.facebook.com/XXXXXXXX") ;
             return false;
        }
        else if (!(/^(https?:\/\/)?((w{3}\.)?)twitter\.com\/(#!\/)?[a-z0-9_]+$/i.test(twurl))){
             alert("Please use the format: https://twitter.com/XXXXXXXXX") ;
             return false; 
        }
        
        else if(!(/^(https?:\/\/)?((w{3}\.)?)linkedin\.com\/.*/i.test(linurl))      ){
             alert("Please use the format: https://www.linkedin.com/in/XXXXXXXX") ;
             return false;
        }
        else if(!(/^(https?:\/\/)?((w{3}\.)?)instagram\.com\/.*/i.test(insturl))      ){
             alert("Please use the format: https://www.instagram.com/XXXXXXXX") ;
             return false;
        }
        else{
           return true;
        }
       

}

    
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
                <a href="settings_1_profile.php"><button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button current-page-button" >Profile</button></a>
                <a href="settings_2_account.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Account</button></a>
                <a href="settings_3_subscription.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Subscription</button></a>
                
                <a href="settings_4_billing.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Billing</button></a>
             <!--   <a href="settings_5_shipping.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Shipping</button></a>   -->
           
                
                            
            </div>
            <form action="javascript:void(0)" id="UserInfoUpdate" method=POST enctype=multipart/form-data >
                
                <div class="row no-margin d-flex flex-wrap">
                    <div class="col-xl-3 col-lg-4 order-1 order-lg-0">
                            
                            <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Username</h6>
                                <input type="text" required class="form-control" name = "user_nicename" value="<?php echo $user_Info->user_nicename ;?>">
                            </div>    

                             <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">First Name</h6>
                                <input type="text" required class="form-control" name = "first_name" value="<?php echo $user_Info->first_name ;?>" placeholder="Please provide your first name">
                            </div>    
                            
                             <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Last Name</h6>
                                <input type="text" required class="form-control" name = "last_name" value="<?php echo $user_Info->last_name ;?>" placeholder="Please provide your last name">
                            </div>    
                            
                            <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Phone Number</h6>
                                <input type="text" required class="form-control" name = "mobile_number" value="<?php echo $user_Info->mobile_number ;?>" placeholder="Please provide your phone number">
                            </div> 
                            <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Weight (lbs)</h6>
                                <input type="number" required class="form-control" name = "user_weight" value="<?php echo $user_Info->user_weight ;?>" placeholder="Please provide your weight in lbs">
                            </div>
                            <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;"> Height (cm)</h6>
                                <input type="number" required class="form-control" name = "user_height" value="<?php echo $user_Info->user_height ;?>" placeholder="Please provide your height in cm">
                            </div>
                            
                            <div class="form-group">
                                 <!-- <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;"> Facebook </h6> -->
                                <input type="hidden" required class="form-control" id="facebook" name = "facebook" value="<?php echo "" ;?>" placeholder="Please provide your facebook url">
                            </div>
                            
                            
                             <div class="form-group">
                               <!-- <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;"> Twitter </h6> -->
                                <input type="hidden" required class="form-control" id="twitter" name = "twitter" value="<?php echo "" ;?>" placeholder="Please provide your Twitter url">
                            </div>
                             <div class="form-group">
                                <!--  <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;"> LinkedIn </h6> -->
                                <input type="hidden" required class="form-control" id="linkedIn" name = "linkedIn" value="<?php echo "" ;?>" placeholder="Please provide your LinkedIn url">
                            </div>
                            
                             <div class="form-group">
                                 <!-- <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;"> Instagram </h6> -->
                                <input type="hidden" required class="form-control" id="instagram" name = "instagram" value="<?php echo "" ;?>" placeholder="Please provide your Instagram url">
                            </div>
                             <div class="form-group">
                                <!--  <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;"> About You (Short) </h6> -->
                                <input type="hidden" required class="form-control" name = "title" value="<?php echo "" ;?>" placeholder="Please provide your role">
                            </div>
                             
                            
                    </div>
                    
                    
                    
                    
                    <div class="col-xl-3 col-lg-4 order-0 order-lg-1">

                        <div style="width:100%;margin-bottom:50px;" class="text-center">
                            <?php 
                               
                                  $val = get_user_meta( $user_ID, 'profile_photo', true );
                                  if($val){
                                      $url_profile = get_site_url()."/wp-content/uploads/ultimatemember/".$user_ID."/".$val.'?'.rand(15587000000,1568712237);
                                  } 
                                  else{
                                      $url_profile = get_avatar_url($user_ID) ;
                                  }
                                    
                                ?>
                               <img src="<?php echo $url_profile; ?>" class="secondary-color1-border profile-image-big">  
                        </div>
                         <a href="<?php echo get_site_url()?>/users-profile-pic/?profiletab=main&um_action=edit" >
                            <div style="width:100%;margin-bottom: 30px;" class="text-center">
                                <button class="drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background" type = "button">CHANGE AVATAR</button>
                            </div> 
                         </a> 

                    </div>
                </div>
                
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">                            
                        <div class="form-group">
                            <h6 class="dashboard-title3 secondary-color1" style="text-transform:none;">Short Bio</h6>
                            <textarea class="form-control" placeholder="write a few words about you"cols="5" name="description"><?php echo $user_Info->description ;?></textarea>
                        </div>
                    </div>
                </div>
                
                
                <div class="row no-margin">
                 
                   
                    <div class="col-xl-3 col-lg-4">                            
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Country</h6>
                            <div id="category" >
                                
                                <select class="input-lg form-control" name = "country_name" required>
                                   <?php 
                                    foreach ($country as $value)
                                    
                                        if($value['country'] == $user_Info->country){
                                             echo '<option value = "'.$value['country'].'" selected>'.$value['country'].'</option>';
                                        }else{
                                             echo '<option value = "'.$value['country'].'">'.$value['country'].'</option>';
                                        }
                                       
                                    ?>
                                    
                                    
                                </select>
                                <i class="flt flaticon-back rotated-90 grey"></i>
                                
                                
                            </div>
                        </div>  
                        
                    </div>
                </div>                
                
                
                <div class="padding-15px text-lg-left text-center">
                    <button id="ActionButton" class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" style="margin-bottom:20px" type="submit">SAVE CHANGES</button>
                </div>
            </form>
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    

</body>

<script>
       
    $(document).on('submit', "#UserInfoUpdate", function(e) {
        
      var fb = jQuery("#facebook").val();
      var tw = jQuery("#twitter").val();
      var lin = jQuery("#linkedIn").val();
      var inst = jQuery("#instagram").val();
      //validate_url(fb,tw,lin,inst) 
      if( true){
           var postvalue =  jQuery("#UserInfoUpdate").serialize();
                var url = "<?php echo FITPRO_THEME_BTX_fun_user_info_update_url();?><?php echo $user_ID;?>";
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
                       jQuery("#ActionButton").prop("disabled",false);
                       window.location.href ="";
                    },
                    error: function(e) 
                    {
                       window.location.href = "";
                    }   
                    
                });
      }
    
                
    });
        
</script>   


</html>