
<?php
require('common-config.php');
$user_product_wishlist = get_user_meta( $user_ID , "fitpro_user_product_wishlist" , true);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Wishlist</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../resources/css/sidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
     <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    

    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">
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
     
         <div id="content">
            <?php
               require('navbar-top.php'); 
            ?>
       
                <div class="row d-flex flex-wrap no-margin" style="width:100%;">
                   
               <h1 class="dashboard-title primary-color1 padding-15px" style="width:100%"><a href="homepage.php"><i class="flaticon-back"></i></a>  Wishlist</h1>

                    
                    <div class="col-xl-10 module-card-div  scrollbar-change secondary-color1-scrollbar  backend-overflow-div" >
                        <div class=" text-center text-xl-left">
                            <h1 class="dashboard-title primary-color1" style="display:inline-block;"></h1>
                           
                        </div>
                     
                     <?php if(!empty($user_product_wishlist)):
                            $id= -1;
                            foreach($user_product_wishlist as $wishlist):
                                $id++;
                                $product_info = wc_get_product($wishlist);
                                $thumbnail_url = get_the_post_thumbnail_url($wishlist);
                     ?>
                     
                        <div class="drop-shadow white-background" style="margin-bottom:20px;border: 1px solid rgba(0,0,0,0.1);">
                            <div class="row" style="align-items:center;">
                                <div class="col-xl-2 col-lg-2">
                                    <img src="<?php echo $thumbnail_url;?>" class="course-image">
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                    <p class="primary-color1 text-lg-left text-center  margin-top-10px-mobile" style="font-style:italic;margin-bottom:0px"></p>
                                   <h5 class="primary-color1 dashboard-title3-bold text-lg-left text-center " style="text-transform:none;"><?php echo $product_info->name; ?></h5> 
                                   <h5 class="primary-color1 text-lg-left text-center"></h5>
                                </div>
                               
                                <div class="col-xl-3 col-lg-2">
                                   
                                </div>
                                <div class="col-xl-2 col-lg-2 text-center">
                                    <h4 class="secondary-color1 text-center dashboard-title3-bold margin-top-10px-mobile text-center text-lg-right"><?php echo $product_info->get_price_html(); ?></h4>
                                </div>
                                <div class="col-xl-2 col-lg-2 vertical-middle  padding-15px-vertical  text-lg-left text-center" style="justify-content:center;">
                                    <div class="padding-15px-mobile horizontal-middle-md">
                                       
                                        <div class="row no-margin">
                                            <a href = "<?php echo site_url()."/user/single_product.php?product_id=".$wishlist; ?>" ><button class="horizontal-middle-md drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
                                            transparent-background-hover margin-bottom-10px-mobile" style="text-transform:uppercase">Buy</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-2 no-padding-desktop">
                                    <input type="hidden" value="<?php echo $wishlist; ?>" id="product_id" name="product_id" >
                                    <input type="hidden" value="<?php echo $id; ?>" id="product_index" name="product_index" >
                                    <i id="delete_wishlist" data-product_id="<?php echo $wishlist; ?>" data-product_index="<?php echo $id; ?>" class="flaticon-heart-shape-silhouette  margin-bottom-10px-mobile secondary-color1 grey-hover text-xl-left d-flex text-center justify-content-xl-start justify-content-lg-center justify-content-center" style="font-size:30px"></i>
                                </div>
                                
                                
    
                            </div>    

                        </div>
                            <?php endforeach;?>
                        <?php else:?>
                        
                        NO WISHLIST FOUND 
                        
                       <?php endif;?>
                        
                    
                       
                        
                        
                        
                       
                    </div>

                  
                
        </div> 
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script src="../resources/js/progressbar.js"></script>
  

</body>
<script>
    
     $(document).on('click', "#delete_wishlist", function(e) {
         
          var product_id = jQuery(this).data("product_id");
          var product_index = jQuery(this).data("product_index");
        
         
        
      var postvalue =  {
          'product_id' : ""+product_id,
           'product_index' : ""+product_index,
           'user_id' : "<?php echo $user_ID; ?>",
      };
      
      var url = "<?php echo FITPRO_THEME_BTX_fun_user_product_delete_wishlist_url();?>";
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        jQuery("#delete_wishlist").prop("disabled" , true);
                    },
                    success: function(result){
                        console.log(result);
                       jQuery("#delete_wishlist").prop("disabled",false);
                        location.reload();
                    },
                    error: function(e) 
                    {
                        console.log(e);
                      
                    }   
                    
                });
                
    
                
    });
    
</script>
</html>