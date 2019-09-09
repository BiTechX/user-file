<?php
require('common-config.php'); 
if(empty($_GET["id"]))
{
    wp_redirect( home_url() ); exit;
}
$course_id = $_GET["id"];

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

   
global $wpdb;
global $post;

// echo $wpdb->prefix;
$val = $wpdb->prefix . "posts";
$courses =  $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$_GET['id']."' ", ARRAY_A );
$course = $courses[0];
if($flag == 0)
{
    if(!user_access_of_course($course_id,$user_ID))
    {
        $flag = 2;
    }
    else
    {
        if(!is_course_added_to_list($_GET['id'],$user_ID)) $flag = 1;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $course['post_title']?></title>

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
    <link rel="stylesheet" href="../resources/css/progressbar.css">
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    
    

     
</head>


<style>



</style>
<body>
    <?php
    if($flag != 3)
            require('navbar-mobile.php');
    else if($flag == 3)
        require('../admin/navbar-mobile.php');
    ?>
    <div class="wrapper">
        <?php
        if($flag != 3)
            require('sidebar.php');
        else if($flag == 3)
            require('../admin/sidebar.php');
        ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
                require('navbar-top.php');
            ?>
        

           
            

            
        

                <div class="row d-flex flex-wrap no-margin">
                   
                <!--    <div class="col-xl-4 order-1 order-xl-0">
                        <div class="drop-shadow card-holder white-background" >
                            <div class="row no-margin ">
                                <div class="col-6 vertical-middle horizontal-middle-flex ">
                                    <i class="flt flaticon-write-board" style="font-size:70px;"></i>
                                    
                                </div>
                                <div class="col-6 vertical-middle horizontal-middle-flex">
                                    <div>
                                        <p class="primary-color1 dashboard-title3-bold text-center small-text">Total courses subscribed</p>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center ">25</h1>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
 

                    </div>
                   
                    <div class="col-xl-4 order-2 order-xl-1">
                        <div class="drop-shadow card-holder white-background" >
                            <div class="row no-margin ">
                                <div class="col-6 vertical-middle horizontal-middle-flex ">
                                    <i class="flt flaticon-basket" style="font-size:70px;"></i>
                                    
                                </div>
                                <div class="col-6 vertical-middle horizontal-middle-flex">
                                    <div>
                                        <p class="primary-color1 dashboard-title3-bold text-center small-text">Total products sold</p>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center ">18</h1>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
 

                    </div>
                    
                    <div class="col-xl-4 order-3 order-xl-2">
                        <div class="drop-shadow card-holder white-background" >
                            <div class="row no-margin ">
                                <div class="col-6 vertical-middle horizontal-middle-flex ">
                                    <i class="flt flaticon-money-1" style="font-size:70px;"></i>
                                    
                                </div>
                                <div class="col-6 vertical-middle horizontal-middle-flex">
                                    <div>
                                        <p class="primary-color1 dashboard-title3-bold text-center small-text">Total revenue generated</p>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center ">$1018<sup>.99</sup></h1>
                                        
                                    </div>
                                </div>
                            </div>
                            

                        </div>
 

                    </div>-->
                    
                    <div class="col-xl-8 module-card-div order-3 order-xl-4 scrollbar-change secondary-color1-scrollbar  backend-overflow-div" >

                        <div class=" r text-xl-left" style="display:flex;width:95%;margin:auto;">
                           
                           <div>
                               <h1 class="dashboard-title primary-color1" style="display:inline-block;"><a href="<?php if($flag == 3) echo get_site_url()."/admin/course_list.php"; else echo "courses_page.php"; ?>"><i class="flt flaticon-back primary-color1" style="margin-right:20px;"></i></a><?php echo $course['post_title']?></h1>
                               <h5 class="primary-color1 " style="margin-bottom:30px;"><?php echo $course['post_content']; ?></h5>
                           </div>
                        </div>
                        <?php if($flag == 2): ?>
                        <a href = "<?php echo get_site_url()."/user/subscription.php"; ?>" >

                            <div style="width:96%;margin:0 auto 20px;">
                                <button class="horizontal-middle-md drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
                                transparent-background-hover margin-bottom-10px-mobile" style="">PURCHASE</button>
                            </div>
                        </a>
                        <?php elseif($flag==1): ?>
                            <div style="width:96%;margin:0 auto 20px;">
                                <button class="horizontal-middle-md drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
                                transparent-background-hover margin-bottom-10px-mobile" id="add" value="<?php echo $_GET['id'];?>">ADD TO LIST</button>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                        $post_id = $course["ID"];
                        $modules = $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE course_id = '".$post_id."' ORDER BY id", ARRAY_A );
                        $i = 0;
                        foreach($modules as $module):?>
                        <?php
                        $res = $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$module["module_id"]."' ", ARRAY_A );
                        if($res[0]["post_status"] == "draft") continue;
                        $image = get_post_meta($res[0]["ID"],'fitpro_th_module_image'); ?>
                        <!-- This spot -->
                        <div class="drop-shadow white-background drop-shadow-all" style="width:96%;margin:auto;padding-bottom:20px;padding-top:20px;margin-bottom:25px;<?php if($flag!=0 && $flag !=3) echo"opacity:0.5"; ?>;">
                            <div class="row" style="width:85%;margin:auto;">
                                <div class="padding-15px-vertical  text-lg-left text-center col-12 no-padding"style="height:120px;">
                                      <img src = "<?php echo $image[0]; ?>" style="height:100px;">
                                </div>
                                <div class="col-xl-9 col-lg-8 col-12 vertical-middle horizontal-middle-lg padding-15px-vertical text-lg-left text-center no-padding">
                                    
                                    <div class="padding-15px-mobile horizontal-middle-lg">
                                        <h5 class=" primary-color1 dashboard-title3-bold horizontal-middle-lg" style="margin-bottom:20px;"><?php echo $res[0]['post_title']; ?></h5>
                                    </div>
                                </div>
                                <?php 
                                $videos = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE module_id = '".$module["module_id"]."' ORDER BY id ASC", ARRAY_A ); ?>
                                <!--<a href = ><div class="col-xl-3 col-lg-4 col-12 vertical-middle  text-center padding-15px-vertical no-padding">-->
                                <!--    <div style="margin-left:auto;" class="horizontal-middle-md">-->
                                <!--  <p class="primary-color1 dashboard-title3-bold text-center small-text">Total</p>-->
                                <!--        <p class="primary-color1 dashboard-title3-bold text-center small-text">subscribed</p>-->
                                <!--        <h1 class="secondary-color1 dashboard-title3-bold" style="margin-bottom:0px;">12</h1>-->
                                <!--         <div class="row no-margin">-->
                                <!--            <button class="horizontal-middle-md drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover -->
                                <!--            transparent-background-hover margin-bottom-10px-mobile" style="">PLAY</button>-->
                                <!--        </div>-->
                                <!--    </div></a>-->
                                <!--</div>-->
                            </div>
                            <?php 
                            $i = 0;
                            foreach($videos as $video):?>
                            <?php $res2 = $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$video["video_id"]."' ", ARRAY_A );?>
                            <?php if($res2[0]['post_status'] == "draft") continue; ?>
                            <?php if(($flag == 0 || $flag == 3)): ?>
                            <a href = "<?php echo get_site_url()."/user/video.php?id=".$video['video_id']; ?>" >
                                <div class="drop-shadow white-background horizontal-middle drop-shadow-all hover-light" style="margin-bottom:20px;width:85%;">
                                    <div class="row" style="padding:15px 30px;">
    
                                        <div class="col-xl-9 col-lg-9 col-12 text-center vertical-middle horizontal-middle-lg  ">
                                             <h6 class=" primary-color1 dashboard-title3-bold horizontal-middle-lg" style="text-transform:none;"><?php echo $res2[0]['post_title']; ?></h6>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-12 padding-15px-vertical horizontal-middle-flex text-lg-left text-center col-12">
                                             <i  style="margin-left:auto;font-size:20px;margin-right:10px;" class="flt flaticon-play-button secondary-color1 horizontal-middle-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>  
                            <?php else: ?>
                            <div class="drop-shadow white-background horizontal-middle drop-shadow-all" style="margin-bottom:20px;width:85%;">
                                <div class="row" style="padding:15px 30px;">

                                    <div class="col-xl-9 col-lg-9 col-12 text-center vertical-middle horizontal-middle-lg  ">
                                         <h6 class=" primary-color1 dashboard-title3-bold horizontal-middle-lg" style="text-transform:none;"><?php echo $res2[0]['post_title']; ?></h6>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-12 padding-15px-vertical horizontal-middle-flex text-lg-left text-center col-12">
                                        <i  style="margin-left:auto;font-size:20px;margin-right:10px;" class="flt flaticon-play-button secondary-color1 horizontal-middle-lg"></i>
                                    </div>
                                </div>
                            </div> 
                            <?php endif; ?>
                            <? endforeach; ?>
                            <!--<div class="drop-shadow white-background horizontal-middle drop-shadow-all hover-light" style="margin-bottom:20px;width:85%;">-->
                            <!--    <div class="row" style="padding:15px 30px;">-->
                            <!--        <div class="col-xl-1 col-lg-1 col-12 horizontal-middle-flex ">-->
                            <!--             <i class="flt flaticon-care primary-color1 " style="font-size:40px;text-align:center;"></i>-->
                            <!--        </div>-->
                            <!--        <div class="col-xl-8 col-lg-8 col-12 text-center vertical-middle horizontal-middle-lg ">-->
                            <!--             <h6 class=" primary-color1 dashboard-title3-bold horizontal-middle-lg" style="text-transform:none;">Recap and Responsibility</h6>-->
                            <!--        </div>-->
                            <!--        <div class="col-xl-3 col-lg-3 col-12 padding-15px-vertical horizontal-middle-flex text-lg-left text-center col-12">-->
                            <!--             <i style="margin-left:auto;font-size:20px;margin-right:10px;" class="flt flaticon-play-button secondary-color1 horizontal-middle-lg"></i>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>  -->
                        </div>
                        <?php endforeach; ?>
                        
                        <!--    <div class="drop-shadow white-background drop-shadow-all" style="width:96%;margin:auto;padding-bottom:20px;margin-bottom:25px;">-->
                        <!--    <div class="row" style="width:85%;margin:auto;">-->
                        <!--        <div class="padding-15px-vertical  text-lg-left text-center col-12"style="height:150px;">-->
                        <!--              <i class="flt flaticon-care secondary-color1" style="font-size:100px;"><br></i>-->
                        <!--            </div>-->
                        <!--        <div class="col-xl-9 col-lg-9 col-12 vertical-middle horizontal-middle-lg padding-15px-vertical text-lg-left text-center">-->
                                    
                        <!--            <div class="padding-15px-mobile horizontal-middle-lg">-->
                        <!--                <h5 class=" primary-color1 dashboard-title3-bold horizontal-middle-lg" style="margin-bottom:20px;">MODULE 1:CLIENT<br> CONNECTION</h5>-->
                                       
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-xl-3 col-lg-4 col-12 vertical-middle  text-center padding-15px-vertical no-padding">-->
                        <!--            <div style="margin-left:auto;" class="horizontal-middle-md">-->
                                      <!--  <p class="primary-color1 dashboard-title3-bold text-center small-text">Total</p>
                        <!--                <p class="primary-color1 dashboard-title3-bold text-center small-text">subscribed</p>-->
                        <!--                <h1 class="secondary-color1 dashboard-title3-bold" style="margin-bottom:0px;">12</h1>-->
                        <!--                 <div class="row no-margin">-->
                        <!--                    <button class="horizontal-middle-md drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover -->
                        <!--                    transparent-background-hover margin-bottom-10px-mobile " type="submit" style="">PLAY</button>-->
                                           
                                            
                                            
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
    
                                
    
                        <!--    </div>-->
                        <!--    <div class="drop-shadow white-background horizontal-middle drop-shadow-all hover-light" style="margin-bottom:20px;width:85%;">-->
                        <!--        <div class="row" style="padding:15px 30px;">-->
                        <!--            <div class="col-xl-1 col-lg-1 col-12 horizontal-middle-flex ">-->
                        <!--                 <i class="flt flaticon-care primary-color1 " style="font-size:40px;text-align:center;"></i>-->
                        <!--            </div>-->
                        <!--            <div class="col-xl-8 col-lg-8 col-12 text-center vertical-middle horizontal-middle-lg ">-->
                        <!--                 <h6 class=" primary-color1 dashboard-title3-bold horizontal-middle-lg" style="text-transform:none;">Client Connection</h6>-->
                        <!--            </div>-->
                        <!--            <div class="col-xl-3 col-lg-3 col-12 padding-15px-vertical horizontal-middle-flex text-lg-left text-center col-12">-->
                        <!--                 <i style="margin-left:auto;font-size:20px;margin-right:10px;" class="flt flaticon-play-button secondary-color1 horizontal-middle-lg"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>  -->
                        <!--    <div class="drop-shadow white-background horizontal-middle drop-shadow-all hover-light" style="margin-bottom:20px;width:85%;">-->
                        <!--        <div class="row" style="padding:15px 30px;">-->
                        <!--            <div class="col-xl-1 col-lg-1 col-12 horizontal-middle-flex ">-->
                        <!--                 <i class="flt flaticon-care primary-color1 " style="font-size:40px;text-align:center;"></i>-->
                        <!--            </div>-->
                        <!--            <div class="col-xl-8 col-lg-8 col-12 text-center vertical-middle horizontal-middle-lg ">-->
                        <!--                 <h6 class=" primary-color1 dashboard-title3-bold horizontal-middle-lg" style="text-transform:none;">Recap and Responsibility</h6>-->
                        <!--            </div>-->
                        <!--            <div class="col-xl-3 col-lg-3 col-12 padding-15px-vertical horizontal-middle-flex text-lg-left text-center col-12">-->
                        <!--                 <i style="margin-left:auto;font-size:20px;margin-right:10px;" class="flt flaticon-play-button secondary-color1 horizontal-middle-lg"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>  -->
                            

                        <!--</div>-->
                        
                         
                           
                  
                        
                              
                    </div>
                    
                    <div class="col-xl-4 module-card-div order-0 order-xl-5">
                        <?php if($flag != 3): ?>
                    
                        <div style="background: linear-gradient(rgba(209,84,91,0.9), rgba(209,84,91,0.9) ),url(<?php  echo $courseprogress_image_link ; ?>);background-size:cover;background-repeat:no-repeat;
                                     padding-top:50px;padding-bottom:50px;margin-bottom:20px;" class="drop-shadow secondary-color1-overlay" id="progress-card">
                           <?php
                            $complete = $wpdb->get_results( "SELECT * FROM ".table_user_progress()." WHERE course_id = '".$_GET['id']."' AND user_id = '".$user_ID."'", ARRAY_A );
                            $module = $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE course_id = '".$_GET['id']."' ", ARRAY_A );
                            $res = 0;
                            if(count($complete)!= 0 && count($module) != 0)
                            {
                                $res = count($complete)/count($module);
                                $res = $res*100;
                                $res = (int)$res;
                            }
                            ?>
                            <h4 class="white text-center dashboard-title3-bold" style="text-transform:uppercase;margin-bottom:30px;">YOUR PROGRESS</h4>
                            <div class="progress white-progress-border" style="height: 25px;width:80%;margin:auto;">
                              <div class="progress-bar white-progressbar" role="progressbar" style="width: <?php echo $res; ?>%;" aria-valuenow="<?php echo $res; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row" style="width:80%;margin:auto;">    
                          <!--  <p class="white dashboard-title3-bold " style="text-align:left;padding:10px;display:inline-block;width:60%; ">COURSE COMPLETED  <!--<span style="float:right">25%</span>--></p>
                           <!-- <p class="white dashboard-title3-bold " style="text-align:right;width:39%;display:inline-block; ">25%</p> -->
                               <div class="col-xl-8 col-lg-8 col-12">
                               <p class="white dashboard-title3-bold text-center text-lg-left" style="padding:10px 0px ; ">COURSE COMPLETED</p>
                               </div>
                               <div class="col-xl-4 col-lg-4 col-12">
                               <p class="white dashboard-title3-bold text-center text-lg-right " style="padding:10px; "><?php echo $res; ?>%</div>
                            </div>
                           
                          <!-- </div>-->
                           
                         <!--  </div> -->                             

                    
                        </div> 
                        <?php endif; ?>
                        <div class="drop-shadow primary-color1-background" style="padding-top:50px;padding-bottom:50px;margin-bottom:20px;">
                            
                            <h2 class="primary-color2 text-center padding-15px" style="text-transform:uppercase;margin-bottom:30px;">ABOUT THE AUTHOR</h2>
                            <p class="text-center">
                                
                                <?php
                                    //$value = get_post_field( 'post_author', $_GET["id"] );
                                    //$value = get_post(  $_GET["id"] );
                                    //the_author_meta( 3541 );
                                    //print_r ($value);
                                  $user_Info_admin = get_userdata( 9 );
                                  $val = get_user_meta( 9, 'profile_photo', true );
                                  if($val){
                                      $url_profile = get_site_url()."/wp-content/uploads/ultimatemember/"."9"."/".$val.'?'.rand(15587000000,1568712237);
                                  } 
                                  else{
                                      $url_profile = get_avatar_url(9) ;
                                  }
                                  ?>

                               <img src="<?php echo $url_profile; ?>" class="primary-color2-border profile-image-small"> 
                                
                                
                                </p>
                            
                
                       <!--     <p class="small-text secondary-color1 text-center dashboard-title3-bold" style="margin-bottom:30px;">EDIT<i class="flt flaticon-edit secondary-color1" style="font-size:15px;margin-left:10px;"></i></p>-->
                                <h5 class="small-text  text-center dashboard-title3-bold" style="color:#fff"><?php echo $user_Info_admin->display_name ;?></h5>
                                <p class="small-text primary-color2 text-center " style=""><?php echo $user_Info_admin->user_short_title  ;?></p>
                                <p class="small-text  text-center " style="color:#fff;max-width:400px;padding:15px;margin:auto;"><?php echo $user_Info_admin->description ;?></p>
                           
                           
                               <div class="row no-margin" style="align-items:center;justify-content: center;padding-top:3%;">
                                   <?php 
                                        if($user_Info_admin->facebook){
                                            echo '<a href="'.$user_Info_admin->facebook.'"  target="_blank"> <i class="flt flaticon-facebook primary-color2" style="font-size:25px;padding:10px"></i> </a>';
                                        }
                                        if($user_Info_admin->twitter ){
                                            echo '<a href="'.$user_Info_admin->twitter.'"  target="_blank">  <i class="flt flaticon-twitter primary-color2" style="font-size:25px;padding:10px"></i> </a>';
                                        }
                                        if($user_Info_admin->linkedin ){
                                            echo '<a href="'.$user_Info_admin->linkedin.'"  target="_blank">  <i class="flt flaticon-linkedin primary-color2" style="font-size:25px;padding:10px"></i> </a>';
                                        }
                                        if($user_Info_admin->instagram ){
                                            echo '<a href="'.$user_Info_admin->instagram.'"  target="_blank">  <i class="flt flaticon-instagram primary-color2" style="font-size:25px;padding:10px"></i> </a>';
                                        }
                                   ?>
                                   
                                    
                                  
                             </div>
                            
                                


                    
                        </div>
 

                    </div>
                    
                </div>
                

                            
    
                         

        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script src="../resources/js/progressbar.js"></script>
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
                    location.reload();
        		},
        	});
        });
    </script>

</body>

</html>