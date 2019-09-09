<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
if(isset($_POST) && !empty($_POST['quantity']) && !empty($_POST['product_id'])){
        try{
         global $woocommerce;
         $quantity = $_POST['quantity'];
         $product_id = $_POST['product_id'];
       
        $woocommerce->cart->add_to_cart($product_id , $quantity);
        echo json_encode(array('status'=>"1", "message"=>"Added to cart"));
        }catch (Exception $e) {
            
            echo json_encode(array('status'=>"0", "message"=>$e->getMessage()));
        }
        exit(); 
}else{
     echo json_encode(array('status'=>"0", "message"=>"not access this page"));
     exit(); 
}
        