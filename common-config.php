<?php

require('../wp-load.php');
//require('../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
$user_ID = null;
$user_Info = null ;
$user_meta = null;
$url_user = get_site_url()."/user/";
$url_dashboard = get_site_url()."/admin/";


if(is_user_logged_in()){
    $user_ID = get_current_user_id();
    $user = wp_get_current_user();
    $user_Info = get_userdata( $user_ID );
    $user_meta = get_user_meta( $user_ID );
    $updated = update_user_meta( $user_ID, 'user_chat_status', 0 );
    $user_roles = $user_Info->roles;
    // print_r($user_roles);
    $flag = 0; 
    
    if ( in_array( 'administrator', $user_roles, true ) ) {
        $flag = 3; 
    }
}
else{
    wp_redirect( home_url() ); exit; 
}