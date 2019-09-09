<?php
require('../../wp-load.php');
global $wpdb;
//print_r($_REQUEST);
//print_r($_POST);
//print_r($_FILES);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    
    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    
    $uploadedfile = $_FILES['ChatFile'];
    
    
    $val = array();
    $files = $_FILES['ChatFile'];
   
    foreach ($files['name'] as $key => $value ) {
          if ($files['name'][$key]) {
            $file = array(
              'name'     => $files['name'][$key],
              'type'     => $files['type'][$key],
              'tmp_name' => $files['tmp_name'][$key],
              'error'    => $files['error'][$key],
              'size'     => $files['size'][$key]
            );
            $upload_overrides = array( 'test_form' => false );
            
          $file_add = wp_handle_upload($file  ,$upload_overrides);
          $with_html = "<div class='chat-file-send ' id='fileDiv' ><a class='primary-color2-background primary-color1' style='padding:5px;' href='".$file_add['url']."' target='_blank' download>".$file['name']."</a></div>";
          array_push($val , $with_html);
        }
        
    }
    
    if($val){
          echo json_encode( array("status"=>1 ,"return" => implode(" ",$val) )  );
    }
    else{
        echo json_encode( array("status"=>0 ,"message" => " You are not allow to add this file ." )  );
    }
    
}
