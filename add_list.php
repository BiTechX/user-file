<?php
    require('common-config.php');
    global $wpdb;
    $courses = $wpdb->get_results("SELECT * FROM ".course_db_name()." WHERE course_id = '".$_POST["course_id"] ."'" , ARRAY_A);
    $course = $courses[0]['view_count'];
    $wpdb->update( 
    	course_db_name(), 
    	array( 
    		'view_count' => $course+1,	// string
    	), 
    	array( 'course_id' => $_POST["course_id"] ), 
    	array( 
    		'%d'
    	), 
    	array( '%d' ) 
    );
    $wpdb->insert( 
	    table_subscription_info(), 
    	array( 
    		'id' => $user_ID, 
    		'course_id' => $_POST["course_id"] 
    	), 
    	array( 
    		'%d', 
    		'%d' 
    	) 
    );
?>