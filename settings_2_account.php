<?php 
    require('common-config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Settings - Account</title>

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
                <a href="settings_2_account.php"><button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button current-page-button" >Account</button></a>
                <a href="settings_3_subscription.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Subscription</button></a>
                
                <a href="settings_4_billing.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Billing</button></a>
              <!--  <a href="settings_5_shipping.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Shipping</button></a>  -->
           
                
                            
            </div>
            <form action="javascript:void(0)" id="UserChangePassWord" method=POST enctype=multipart/form-data >
                
           
                
                <h4 class="secondary-color1 dashboard-title3 no-margin" style="padding:12px;margin-bottom:0px !important;" >CHANGE YOUR PASSWORD</h4>
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="title-line" style="">
                          
                        </div>  
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Old Password</h6>
                            <input type="text" class="form-control" name = "old_password" placeholder="Type in your old password" required>
                        </div>  
                    </div>
                </div>
                
                
                 <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">New Password</h6>
                            <input type="text" class="form-control" id= "New_Password" name = "new_password" placeholder="Type in new password" required>
                        </div>  
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Confirm New Password</h6>
                            <input type="text" class="form-control" name = "Confirm_Password" id="Confirm_Password" placeholder="Confirm New Password" required>
                        </div>  
                    </div>
                </div>

                <h5 class="secondary-color1 dashboard-title3 no-margin" style="padding:12px;margin-bottom:0px !important;" id="ErrorMessage">
                </h5>
                <div class="padding-15px text-lg-left text-center">
                    
                    <button id="ActionButton" class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" type="submit" style="margin-bottom:20px">SAVE CHANGES</button>
                </div>
            </form>
        </div>
    </div>
    
    
    <script src="../resources/js/dashboard.js"></script>
    


<script>
       
    $(document).on('input', "#Confirm_Password", function(e) {
        var  New_Password = jQuery('#New_Password').val();
        var Confirm_Password =  jQuery(this).val();
        if(New_Password != Confirm_Password){
            console.log("Not OK Pass");
            jQuery("#ActionButton").prop("disabled",true).css("cursor",'not-allowed');
        }
        else{
            console.log("OK Pass");
            jQuery("#ActionButton").prop("disabled",false).css("cursor",'default');
        }
            
    });
       
    $(document).on('submit', "#UserChangePassWord", function(e) {
      
                var postvalue =  jQuery("#UserChangePassWord").serialize();
                var url = "<?php echo FITPRO_THEME_BTX_fun_user_info_update_password_url();?><?php echo $user_ID;?>";
                console.log(url);
                
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
                        var data = jQuery.parseJSON(result);
                        
                        if(data.status == 0){
                            jQuery("#ErrorMessage").html(data.message);
                        }
                        else{
                            window.location.href ="";
                        }
                    },
                    error: function(e) 
                    {
                       window.location.href = "";
                    }   
                    
                });
                
                
    });
        
</script>   
</body>

</html>