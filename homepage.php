<?php
require('common-config.php'); 
$url_dashboard = get_site_url()."/admin/";
$user_roles = $user_Info->roles;
if( in_array( 'administrator', $user_roles ,true ) ){
    wp_redirect( $url_dashboard."homepage.php" ); exit; 
}

 /**
     * 
     * hex2rgb() function use to change the hex to rgb colour convert
     * it have four parameter ($colour , $opacity ,$extra )
     * 
     * $colour is the hex code (required)
     * $opacity is use to add the opacity default value is 0.0  (optional)
     * $extra is use to extra attribute of css element default value (optional)
     * 
     * For example:
     *       echo hex2rgb('<?php echo $primary_color_1_HEX;  ?>' , '0.9'  , '!important' )  //input
     *       output is : <?php echo hex2rgb($primary_color_1_HEX , '0.9'); ?>!important
     * 
     * 
     * 
    */
    function hex2rgb( $colour , $opacity=0.0 , $extra = '' ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        
        return 'rgba('.$r.','.$g.','.$b.','.$opacity.')'.$extra;

    }
   
    $options = get_option( 'theme_setting_change' );
    $primary_color_1_HEX = $options['opt-primary-color-1'];
    $primary_color_2_HEX = $options['opt-primary-color-2'];
    $secondary_color_1_HEX = $options['opt-secondary-color-1'];
    $secondary_color_2_HEX = $options['opt-secondary-color-2']; 
    $homepage_image_link = $options['opt-text-homepage-image-link']; 
    $courseprogress_image_link = $options['opt-text-courseprogress-image-link']; 
    
    //echo $primary_color_1_HEX .'  '. hex2rgb($primary_color_1_HEX , '0.9','!important' );
$course_ids = $wpdb->get_results( "SELECT * FROM ".table_subscription_info()." WHERE id = '".$user_ID."' ", ARRAY_A );
if(count($course_ids))
{
    wp_redirect( get_site_url()."/user/courses_page.php");
}

global $wpdb;
global $post;

 $args = array(  
       'post_type' => 'courses',
       'post_status' => 'publish',
       //'posts_per_page' => 10000,
       'orderby' => 'title',
       'order' => 'ASC',
   );
   
   $loop = new WP_Query( $args );
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Home</title>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    

    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    <style>
        #sidebar
        {
            z-index:1;
        }
    </style>
    

     
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
        
        <!-- Page Content  -->
        <div id="content" class=" homepage-banner" >

            
                <?php
                    require('navbar-top.php');
                ?>        


                <!-- Landing page with search -->
                <div class="row no-margin" >
                
                    
                    <div class="col-xl-4 text-xl-right text-center order-1 order-xl-0"> <!-- padding top 20px more for shadow -->
                        <img src="<?php  echo $homepage_image_link ; ?>" style="height:600px;">
                    </div>    

                    <div class="col-xl-8 justify-content-center justify-content-xl-start order-0 order-xl-1" style="align-items:center;display:flex;"> <!-- padding top 20px more for shadow --> 
                      
                       <div class="text-center text-xl-left" style="margin-bottom:20px;display:inline-block;max-width:700px;">
                            <h1 class="dashboard-title primary-color1" style="margin-bottom:0px;">I'M <span class="secondary-color1">brandon</span></h1>
                            <h1 class="dashboard-title primary-color1" style="margin-bottom:20px;">& I'm your coach!</h1>
                            <p class="primary-color1 small-text" style="margin-bottom:20px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            <form action="<?php echo site_url()."/user/search_result.php" ; ?>">
                                <div class="row horizontal-middle-tablet" style="max-width:500px;">
                                    <div class="col-9 no-padding"  style="margin-left:15px;margin-right:-15px;" >
                                        <input type="text" name="s" class="form-control secondary-color1" style="border-radius:60px;max-width:700px;line-height: 25px;padding-right:40px;"> 
                                    </div>
                                    <div class="col-3 no-padding" style="margin-left:-15px;margin-right:15px;">
                                        <button id="ActionButton" class="drop-shadow btn theme-rounded-button white secondary-color1-background 
                                        secondary-color1-border secondary-color1-border-hover secondary-color1-hover white-background-hover no-padding-mobile" style="margin-bottom:20px;width:100%;" type="submit">SEARCH</button>
                       
                                    </div>
                                </div>
                            </form>
                               
                            
                       </div>
                    

                    </div>
    
                </div> 
                
                
                <!-- Courses -->
                
                <div>
                    
                    <h1 class="dashboard-title primary-color1 text-center" style="margin-bottom:20px;padding:60px 0px;">VIEW OUR COURSES</h1>                      
                </div>
                <div class="row" style="max-width:960px;margin:0 auto;">

                    <!-- Loop start -->
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <div class="col-xl-3 col-md-6 col-12 course-card" >
                        <div class="course-card-inner">
                            <div class="normal-state">
                                <img src="<?php echo get_post_meta($post->ID, 'fitpro_th_course_image', true);?>" style="height:150px;width:100%;object-fit:cover;">
                                <div class="grey-border" style="border-top:0px;height:90px;padding-top:13px;">
                                    <p class="small-text primary-color1 dashboard-title3-bold text-center" style="text-transform:none;height:44px;"><?php echo the_title(); ?></p>
                                    <p class="small-text secondary-color1 dashboard-title3-bold text-center">⠀</p>                                            
                                </div>
                            </div>
                            <div class="hover-state" style="background-image: linear-gradient(<?php echo hex2rgb($primary_color_1_HEX , '0.9'); ?>, <?php echo hex2rgb($primary_color_1_HEX , '0.9'); ?> ),url(<?php echo get_post_meta($post->ID, 'fitpro_th_course_image', true);?>);" >
                                <p class="primary-color2 text-left" style="font-size:10px;"><i><?php $category = get_the_category( $post->ID ); echo $category[0]->name;?></i></p>
                                <p class="small-text primary-color2 dashboard-title3-bold text-center" style="text-transform:none;height:44px;"><?php echo the_title(); ?></p>
                                <p class="small-text primary-color2 dashboard-title3 text-center" style="font-size:10px;">Modules: <?php 
                                            $results =  $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE course_id = '".get_the_ID()."' ", ARRAY_A );
                                            echo count($results);
                                            ?></p>
                                <p class="small-text primary-color2 dashboard-title3-bold text-center" style="font-size:20px;margin-bottom:24px;">⠀</p>
                                
                                <?php if(!user_access_of_course($id,$user_ID)) :?>
                                <div class="row no-margin">
                                    <div class="col-6 " style="padding:0px 5px 0px 0px;">
                                        <a href = "<?php echo get_site_url()."/user/subscription.php"?>" ><button class="btn theme-rounded-button primary-color1 primary-color2-background primary-color2-border primary-color2-border-hover transparent-background-hover primary-color2-hover" style="width:100%;padding: 1em 1.5em!important;box-shadow:none!important;" >PURCHASE</button></a>
                                    </div>
                                    <div class="col-6 " style="padding:0px 0px 0px 5px;">
                                            <a href = <?php echo get_site_url()."/user/modules_page.php?id=".get_the_ID(); ?>><button class="btn theme-rounded-button primary-color1-hover primary-color2-background-hover primary-color2-border primary-color2-border-hover  transparent-background primary-color2" style="width:100%;padding: 1em 1.5em!important;box-shadow:none!important;" >DETAILS</button></a>
                                        </div>
                                </div>
                                <?php else:?>
                                    <?php if(!is_course_added_to_list((int)get_the_ID(),$user_ID)): ?>
                                    <div class="row no-margin">
                                        <div class="col-6 " style="padding:0px 5px 0px 0px;">
                                            <button class="btn theme-rounded-button primary-color1 primary-color2-background primary-color2-border primary-color2-border-hover transparent-background-hover primary-color2-hover" style="width:100%;padding: 1em 1.5em!important;box-shadow:none!important;" id="add" value="<?php echo get_the_ID();?>">ADD</button>
                                        </div>
                                        <div class="col-6 " style="padding:0px 0px 0px 5px;">
                                            <a href = <?php echo get_site_url()."/user/modules_page.php?id=".get_the_ID(); ?>><button class="btn theme-rounded-button primary-color1-hover primary-color2-background-hover primary-color2-border primary-color2-border-hover  transparent-background primary-color2" style="width:100%;padding: 1em 1.5em!important;box-shadow:none!important;" >DETAILS</button></a>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="row no-margin">
                                        <div class="col-6 " style="padding:0px 5px 0px 0px;">
                                            <button class="btn theme-rounded-button primary-color1 primary-color2-background primary-color2-border primary-color2-border-hover transparent-background-hover primary-color2-hover" style="width:100%;padding: 1em 1.5em!important;box-shadow:none!important;" id="remove" value="<?php echo get_the_ID(); ?>">REMOVE</button>
                                        </div>
                                        <div class="col-6 " style="padding:0px 0px 0px 5px;">
                                            <a href = <?php echo get_site_url()."/user/modules_page.php?id=".get_the_ID(); ?>><button class="btn theme-rounded-button primary-color1-hover primary-color2-background-hover primary-color2-border primary-color2-border-hover  transparent-background primary-color2" style="width:100%;padding: 1em 1.5em!important;box-shadow:none!important;" >DETAILS</button></a>
                                        </div>
                                    </div>
                                    
                                    <?php endif; ?>
                                <!--</div>-->
                                <?php endif;?>
                                
                            </div>
                        </div>
                    </div>
                    <?php
                            endwhile;
                            wp_reset_postdata();?>
                    <!-- Loop end -->
                </div>    
        </div>
        
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script>
        $(document).on("click" , "#add" , function(e)
        {
           var value = $(this).val();
           var sendData = new FormData();
           sendData.append('course_id' , value);
           $.ajax({
        		url : 'add_list.php',
        		data : sendData,
        		async: false,
                contentType: false,
                processData: false,
                cache: false,
        		type : 'POST',
                success : function(data) {
                    window.location.replace("<?php echo get_site_url();?>/user/store.php");
        		},
        	});
        });
    </script>
    
    <script>
        $(document).on("click" , "#remove" , function(e)
        {
           var value = $(this).val();
           var sendData = new FormData();
           sendData.append('course_id' , value);
           $.ajax({
        		url : 'remove_list.php',
        		data : sendData,
        		async: false,
                contentType: false,
                processData: false,
                cache: false,
        		type : 'POST',
                success : function(data) {
                    location.reload();
        		},
        	});
        });
    </script>
</body>

</html>