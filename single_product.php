<?php
require('common-config.php');
ob_start();
$product_id_get = 100;
$product_info ;


if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
    
   
    
    $product_id_get = (int) $_GET['product_id'];
    if(is_int($product_id_get) && $product_id_get > 0){
        
        // if(isset($_POST) && !empty($_POST['quantity'])){
  
        //     $quantity = $_POST['quantity'];
        //     global $woocommerce;
        //     $woocommerce->cart->add_to_cart($product_id_get , $quantity);
        //     wp_redirect( '?product_id='.$product_id_get); 
        // }
        
        
        $product_info = wc_get_product($_GET['product_id']);
       // echo "<pre>";
        //print_r($product_info);
        //echo "</pre>";
        
    }else{
        
        $url = site_url()."/user/store_product.php";
        wp_redirect( 'https://fitpro.bitechx.com/user/store_product.php'); 
        ob_end_flush(); 
        exit; 
        
    }
  
    
}else{
    $url = site_url()."/user/store_product.php";
    wp_redirect( 'https://fitpro.bitechx.com/user/store_product.php'); 
    ob_end_flush(); 
    exit; 
    
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Individual Product</title>

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
	.btn-outline-secondary:hover {
	 background-color: #7d7d7d !important;
	 border-color: #7d7d7d !important;
	 color:#fff !important;
	}
	.input-group  {
	    width:160px !important;
	}
	.btn-outline-secondary{
	     border-color: #7d7d7d !important;
	     color: #7d7d7d !important;
	}
	.custom html,.custom body{

		width:100%;
		height:100%;

	}
   .form-control:focus{
       width:70px;
       margin:0px !important;
       
   }
/*    .custom	html,.custom body,.custom ul,.custom li{

		padding:0;
		margin:0;
		border:0;

		text-decoration:none;

	} */

	ul.custom{

		width:100%;
		height:100%; 

		overflow-x:auto; 
		overflow-y: hidden;

        padding:0;
		margin:0;
		border:0;

		text-decoration:none;
		white-space: nowrap;
		line-height: 0;
		font-size: 0;

	}


	.custom ul,.custom li{

		display:inline;

		height:100%;

	}

    .custom ul,.custom li,.custom img{

		max-height:100%;
		height:100%; 
		width:auto ;

	}
	
    ]	html.custom {
		overflow:   scroll;
	} 
	@media only and (max-width:767px)
	{
    	::-webkit-scrollbar {
    		
    		background: transparent; 
    	}
	}
	.w-100{
		max-height: 470px;
	}


	


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
       
                <div class="row d-flex flex-wrap no-margin" style="">
                   	<?php   
            					  
            			$attachment_ids = $product_info->get_gallery_attachment_ids(); 
            		
            					
            		?>
                     <h1 class="dashboard-title primary-color1 padding-15px" style="width:100%"><a href="homepage.php"><i class="flaticon-back"></i></a>  Products</h1>
                        <div class = 'col-xl-6 col-lg-6 ' style= ' height:50% ;padding-right: 2%;'>
            				<div class="container" style= 'height:50% ;padding: 0px;'>
            					<div id="carouselExampleControls" style = '' class="carousel slide" data-ride="carousel">
            						<div class="carousel-inner" style="">
            						 <?php
            						    $index = 0;
            						    foreach( $attachment_ids as $attachment_id ) :
                                  
                                       $Original_image_url = wp_get_attachment_url( $attachment_id );
                                    ?>
            					           <div class="carousel-item <?php if($index == 0){echo "active";} ?>" data-slide-to="<?php echo $index;?>">
            								        <img class="d-block img-fluid w-100" style ='object-fit: cover !important;'src="<?php echo $Original_image_url; ?>" alt="First slide">
            							 </div>
                                    <?php 
            						   $index++;
            						   endforeach;
                                    ?>    
            					                    
            					                
            					              
            						    
            						</div>
            						<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
            							<span class="sr-only">Previous</span>
            						</a>
            						<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            							<span class="carousel-control-next-icon" aria-hidden="true"></span>
            							<span class="sr-only">Next</span>
            						</a>
            					</div>
            				</div>
			
            				<div class ='row custom scrollbar-change' style="margin-left: 0px;margin-right: 0px; height: 125px;">
            					<ul class='custom'>
            					    
            					    
            					    <?php 
            					    $index = 0;
            					    foreach( $attachment_ids as $attachment_id ) :
                                  
                                       $Original_image_url = wp_get_attachment_url( $attachment_id );
                                    ?>
            					                <li class='custom' id="Slide_id_<?php echo $index; ?>" slide-value ="<?php echo $index; ?>">
            							            <img src="<?php echo $Original_image_url; ?>" style= 'object-fit: cover; padding: 1%;padding-left: 0px;'>
            						            </li>
            						       
            					                
            					                <script>
                
                                                    jQuery(document).ready(function($) {
                                                         $("#Slide_id_<?php echo $index; ?>").click(function(){
                                                                var clickedValue = $(this).attr("slide-value"); 
                                                                $('#carouselExampleControls').carousel(parseInt(clickedValue, 10))
                                                         });
                                                    });
                
                                            </script>
            					                
            					     <?php 
            						   $index++;
            						   endforeach;
                                    ?>             
            					    
            
            					</ul>
            				</div>	
			
			</div>
			
			
                <div class="col-xl-4 col-lg-4 d-flex ">
                    <form action="" method="post" style="width:100%">
                        <div class="align-items-center">
                            <h4 class="primary-color1 dashboard-title3-bold margin-top-10px-mobile text-lg-left text-center"><?php echo $product_info->name; ?></h4>
                            <h6 class="primary-color1 text-center  my-4 text-lg-left text-center"><?php echo $product_info->get_price_html() ?></h6>
                            <div class="d-flex justify-content-lg-start justify-content-center">
                                <p class="primary-color1 text-center  " style="margin:0 20px 0 0 ">Quantity</p>
                                <input style="" type="number" name="quantity" id="product_quantity" value="1" min="1" max="1000" step="1"/>
                            </div>
                         
                            <div class="padding-15px-mobile horizontal-middle-md my-4" >
                                           
                                            <div class="row no-margin justify-content-lg-start justify-content-center" style="margin-top:10px">
                                               
                                                <button type="button"  id="add_to_cart" class=" drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
                                                transparent-background-hover margin-bottom-10px-mobile mr-2 mt-2" style="text-transform:uppercase;">Add To cart </button>
                                                
                                                <button type="button" id="add_wishlist" class="mt-2 drop-shadow btn theme-rounded-button white-background secondary-color1 secondary-color1-border secondary-color1-border-hover white-hover secondary-color1-background-hover 
                                                 margin-bottom-10px-mobile" style="text-transform:uppercase"> Add to Wishlist </button>
                                            </div>
                             </div>
                             <div id="user-message">
                                 <h5 class="dashboard-title3-bold small-text secondary-color1"></h5>
                                <!-- <h5 class="dashboard-title3-bold small-text secondary-color1"></h5> -->
                             </div>
                             
                            <p class="primary-color1 mt-5 text-center text-lg-left"><strong>
                               <?php echo $product_info->description; ?>
                           </strong>
                            </p>
                        </div>  
                    </form>
                </div>
            

                 </div>
                        
                
        </div> 
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script src="../resources/js/progressbar.js"></script>
    <script src="../resources/js/bootstrap-input-spinner.js"></script>
   <script>
    $("input[type='number']").inputSpinner()
  </script>

</body>

<script>
       
    $(document).on('click', "#add_to_cart", function(e) {
        
      var quantity = jQuery("#product_quantity").val();
      var postvalue =  {
          'product_id' : "<?php echo $product_id_get; ?>",
          'quantity'   : quantity+"",
      };
      var url = "<?php echo site_url()."/user/ajax_call/product_add_to_cart.php";?>";
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                         jQuery("#user-message h5").html("");
                        jQuery("#add_to_cart").prop("disabled" , true);
                    },
                    success: function(result){
                        //console.log(result);
                         jQuery("#user-message h5").html("Added to Cart successfully!");
                       jQuery("#add_to_cart").prop("disabled",false);
                        //window.location.href ="";
                    },
                    error: function(e) 
                    {
                        console.log(e);
                      
                    }   
                    
                });
    
                
    });
    
    $(document).on('click', "#add_wishlist", function(e) {
        
      var postvalue =  {
          'product_id' : "<?php echo $product_id_get; ?>",
           'user_id' : "<?php echo $user_ID; ?>",
      };
      var url = "<?php echo FITPRO_THEME_BTX_fun_user_product_add_wishlist_url();?>";
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        jQuery("#user-message h5").html("");
                        jQuery("#add_wishlist").prop("disabled" , true);
                    },
                    success: function(result){
                        //console.log(result);
                         jQuery("#user-message h5").html("Added to Wishlist successfully!");
                       jQuery("#add_wishlist").prop("disabled",false);
                        //window.location.href ="";
                    },
                    error: function(e) 
                    {
                        console.log(e);
                      
                    }   
                    
                });
    
                
    });
        
</script>   

</html>
