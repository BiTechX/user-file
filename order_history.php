<?php
require('common-config.php');

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    site_url(), // Your store URL
    'ck_6d9ccb7c073d847e292d60be042cb445e78640a8', // Your consumer key
    'cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9', // Your consumer secret
    [
        'wp_api' => true, // Enable the WP REST API integration
        'version' => 'wc/v3' // WooCommerce WP REST API version
    ]
);
//print_r($woocommerce->get('orders')); 

//$user_all_order = $woocommerce->get('customers/'.$user_ID);
//$user_all_order = $woocommerce->get('orders');
$all_orders = wc_get_orders( array(
    'post_status' => 'any',
    'meta_key' => '_customer_user',
    'meta_value' => $user_ID,
) );


//echo "<pre>";
//print_r($product);
//echo "</pre>";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Order History</title>

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
                   
               <h1 class="dashboard-title primary-color1 padding-15px"><a href="homepage.php"><i class="flaticon-back"></i></a> Product Order History</h1>

                    
                    <div class="col-xl-10 module-card-div  scrollbar-change secondary-color1-scrollbar  backend-overflow-div" >
                        <div class=" text-center text-xl-left">
                            <h1 class="dashboard-title primary-color1" style="display:inline-block;"></h1>
                           
                        </div>
                     
                     <?php foreach($all_orders as $order ) : 
                        foreach($order->get_items() as $item_id => $item):
                            $item_data = $item->get_data();
                            $product_id = method_exists( $item, 'get_product_id' ) ? $item->get_product_id() : $item['product_id'];
                            if ($item['quantity'] > 0) {
                               
                               $product = wc_get_product($item['product_id']);
                               $price = get_woocommerce_currency_symbol()."".number_format((float) $item['total'] , 2, '.', '');
                               $status = "none";
                               if($product){
                                    $status = $order->status;
                               }
                               
                     ?>
                        <div class="drop-shadow white-background" style="margin-bottom:20px;border: 1px solid rgba(0,0,0,0.1);">
                            <div class="row" style="align-items:center;">
                                <div class="col-xl-2 col-lg-2">
                                    <img src="<?php echo get_the_post_thumbnail_url($product->id); ?>" class="course-image">
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                   <h5 class="primary-color1 dashboard-title3-bold text-lg-left text-center margin-top-10px-mobile" style="text-transform:none;"><?php echo $item['name'] ?></h5> 
                                   <h5 class="primary-color1 text-lg-left text-center"></h5>
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                    <h5 class="primary-color1 text-center margin-top-10px-mobile" style="margin:0px;text-transform:uppercase;"><?php echo $status; ?></h5>
                                </div>
                                <div class="col-xl-1 col-lg-1">
                                    <h4 class="primary-color1 text-center dashboard-title3-bold margin-top-10px-mobile"><?php echo $item['quantity']."x"; ?></h4>
                                </div>
                                <div class="col-xl-2 col-lg-2 text-center">
                                    <h4 class="secondary-color1 text-center dashboard-title3-bold margin-top-10px-mobile"><?php echo $price ; ?></h4>
                                </div>
                                <div class="col-xl-3 col-lg-3 vertical-middle  padding-15px-vertical  text-lg-left text-center" style="justify-content:center;">
                                    <div class="padding-15px-mobile horizontal-middle-md">
                                       
                                        <div class="row no-margin">
                                            <a href = "" ><button class="horizontal-middle-md drop-shadow btn theme-rounded-button white secondary-color1-hover 
                                            secondary-color1-background-hover grey-background white-hover margin-bottom-10px-mobile margin-top-10px-mobile" style="text-transform:uppercase">Order Again</button></a>
                                        </div>
                                    </div>
                                </div>
                                
                                
    
                            </div>    

                        </div>
                        
                       <?php 
                            }
                            endforeach;
                       endforeach; ?>
                        
                    
                       
                        
                
                        
                       
                    </div>
        </div> 
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script src="../resources/js/progressbar.js"></script>
  

</body>

</html>