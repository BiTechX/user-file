<?php
    require('common-config.php');
    global $wpdb;
    $course_id = $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE module_id = '".$_POST['module_id']."' ", ARRAY_A );
    $course_id = $course_id[0]['course_id'];
    
    $wpdb->insert( 
	    table_user_progress(), 
    	array( 
    		'user_id' => $user_ID, 
    		'course_id' => $course_id,
    		'module_id' => $_POST['module_id']
    	), 
    	array( 
    		'%d', 
    		'%d',
    		'%d'
    	) 
    );
?>