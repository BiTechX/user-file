<?php
require('common-config.php');
$video_ID = null ;
if(isset($_GET['id'])){
    $video_ID = $_GET['id'];
}
else{
    wp_redirect( home_url() ); exit;
}

global $wpdb;
global $post;

// echo $wpdb->prefix;
$val = $wpdb->prefix . "posts";
$videos =  $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$_GET['id']."' ", ARRAY_A );
$video = $videos[0];
$module_id = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE video_id = '".$video['ID']."' ", ARRAY_A );
$module_id = $module_id[0]['module_id'];
$courses =  $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE module_id = '".$module_id."' ", ARRAY_A );
$course = $courses[0];
$modules =  $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$module_id."' ", ARRAY_A );
$module = $modules[0];
if($flag == 0)
{
    if(!is_course_added_to_list($course['course_id'],$user_ID)) $flag = 1;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $video['post_title']; ?></title>

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
    
    

     
</head>


<style>
@media(min-width:768px)
{
    .padding-top-20px
    {
        padding-top:20px;
    }
}
    
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
        <div id="content" class="no-padding-tablet" style="padding-top:0px;">

        

           
            
       

                <div class="row no-margin">
                
                    <!-- Desktop left side where video is -->
                    
                    <div class="col-xl-9 module-card-div  no-padding-tablet padding-top-20px" > <!-- padding top 20px more for shadow -->
                        
                        <?php
                            require('navbar-top.php');
                        ?>       

                        <?php
                            $db_name = video_db_name();
                            $res = $wpdb->get_results( "SELECT * FROM ".$db_name." WHERE video_id = '".$video['ID']."' ", ARRAY_A );
                            $res_mod = $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$res[0]["module_id"]."' ", ARRAY_A );
                            $image = get_post_meta($res_mod[0]["ID"],'fitpro_th_module_image');; 
                            $PostImage = wp_get_attachment_image_src( get_post_thumbnail_id( $video['ID'] ), 'single-post-thumbnail' ); 
                        ?>
                        
                       
                        
                        <!-- Title and video -->

                        <div  class="padding-15px no-padding-tablet">
                            <h1 class="dashboard-title primary-color1 d-none d-xl-block"><a href = "<?php echo get_site_url()."/user/modules_page.php?id=".$course['course_id']; ?>" ><i class="flaticon-back"></i></a>  <?php echo $module['post_title']; ?></h1>
                            
                                <?php  

                                
                                if( get_post_meta( $video['ID'], 'fitpro_th_videos_url', true ) ){
                                   ?>
                                    <div class="row no-margin watch-video padding-15px">      
                                        <iframe src="<?php echo get_post_meta( $video['ID'], 'fitpro_th_videos_url', true ) ; ?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                    </div>        
                                   <?php
                                }
                                else{
                                    ?>
                                    
                                    <div class="row no-margin padding-15px">    
                                        <img src="<?php echo $image[0] ; ?>" style="max-width:100%;">
                                    </div>
                                    
                                
                                    <?php
                                
                                    
                                }
                                //get_post_meta( $video['ID'], 'fitpro_th_videos_url', true ) ; 
                                
                                ?>
                                
                        </div>    

                       
                        
                        <!-- Tablet and smaller devices course files download part, which replaces desktop sidebar  -->
                        <div class=" d-flex d-xl-none row no-margin primary-color1-background padding-15px-vertical">
                            <div class="col-9">
                                <h5 class="dashboard-title white" style="text-transform:uppercase;margin-bottom:0px;"><?php echo $module['post_title']; ?></h5>
                            </div>
                            <div class="col-3 text-right collapsible-div-button"  data-toggle="collapse" href="#mobile-sidebar-contents" >
                                <i class="flt flaticon-move-to-the-next-page-symbol white" style="top:0px;"></i>
                            </div>
                        </div>
                        <div class="primary-color1-background d-xl-none collapse" id="mobile-sidebar-contents" style="padding:50px 0px"> <!-- padding top 20px more for shadow -->
                            

                            <div class="row no-margin " style="margin-bottom:10px;padding:15px;">
                                <p  class="white small-text dashboard-title3-bold" >VIDEOS</p>

                            </div>
                            <!--here starts the loop to show all the video-->
                            <?php 
                            $exvideos = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE module_id = '".$module_id."' ORDER BY id ASC", ARRAY_A );
                            $i = 0;
                            foreach($exvideos as $exvideo):?>
                            <?php $res2 = $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$exvideo["video_id"]."'", ARRAY_A );
                            if($res2[0]['post_status'] == "draft") continue;?>
                            <?php if($exvideo["video_id"] != $_GET['id']):?>
                            <a href="<?php echo get_site_url()."/user/video.php?id=".$res2[0]['ID']; ?>">
                            <div class="row no-margin" style="padding:15px;cursor:pointer;">
                                <div class="col-3 no-padding" style="max-width:25px;">
                                    <i class="flt flaticon-play-button white" style="font-size:20px;"></i>
                                </div>
                                <div class="col-9">
                                    <p class="white small-text" style="margin-bottom:0px;"><?php echo $res2[0]['post_title']; ?></p>
                                </div>
                            </div>  </a>  
                            <?php else: ?>
                            <a href="<?php echo get_site_url()."/user/video.php?id=".$res2[0]['ID']; ?>">
                            <div class="row no-margin" style="background-color:rgba(255,255,255,0.05);padding:15px;cursor:pointer;">
                                <div class="col-3 no-padding" style="max-width:25px;">
                                    <i class="flt flaticon-play-button primary-color2" style="font-size:20px;"></i>
                                </div>
                                <div class="col-9">
                                    <p class="primary-color2 small-text" style="margin-bottom:0px;"><?php echo $res2[0]['post_title']; ?></p>
                                </div>

                            </div>  </a>
                            <?php endif; ?>
                            <?php endforeach; ?>  
                            <!--the loop ends here-->

                            <!--<div class="row no-margin" style="background-color:rgba(255,255,255,0.05);padding:15px;cursor:pointer;">-->
                            <!--    <div class="col-3 no-padding" style="max-width:25px;">-->
                            <!--        <i class="flt flaticon-play-button primary-color2" style="font-size:20px;"></i>-->
                            <!--    </div>-->
                            <!--    <div class="col-9">-->
                            <!--        <p class="primary-color2 small-text" style="margin-bottom:0px;">Client Communication</p>-->
                            <!--    </div>-->

                            <!--</div>                                   -->

                            <div class="row no-margin vertical-middle" style="margin-bottom:10px;padding:15px;">
                                <p style="margin-top:60px;" class="white small-text dashboard-title3-bold" >HOMEWORK & USEFUL RESOURCES</p>

                            </div>  
                            
                            <!--here starts the loop for showing files-->
                            <?php $files = $wpdb->get_results( "SELECT * FROM ".TableName_module_file()." WHERE Module_ID = '".$module_id."' ", ARRAY_A );
                            $i = 0;
                            
                            
                            foreach($files as $file): ?>    
                                <a href="<?php echo $file['File_Location']; ?>" download>
                                <div class="row no-margin padding-15px" style="margin-bottom:10px;">
                                    <div class="col-2 no-padding" style="max-width:25px;">
                                        <i class="flt flaticon-document white" style="font-size:20px;"></i>
                                    </div>
                                    <div class="col-6"  style="overflow: hidden;">
                                        <p class="white small-text" style="margin-bottom:0px;"><?php echo $file['File_Name']; ?></p>
                                    </div>
                                    <div class="col-4 no-padding text-right">
                                        <i class="flt flaticon-download-to-storage-drive primary-color2" style="font-size:20px;"></i>
                                    </div>
                                </div>   </a>
                            <?php endforeach; ?>
                            <!--the loop ends here-->
                        

                            <!--<div class="row no-margin padding-15px" >-->
                            <!--    <div class="col-1 no-padding" style="max-width:25px;">-->
                            <!--        <i class="flt flaticon-document white" style="font-size:20px;"></i>-->
                            <!--    </div>-->
                            <!--    <div class="col-7">-->
                            <!--        <p class="white small-text" style="margin-bottom:0px;">Client Communication</p>-->
                            <!--    </div>-->
                            <!--    <div class="col-4 no-padding text-right">-->
                            <!--        <i class="flt flaticon-download-to-storage-drive primary-color2" style="font-size:20px;"></i>-->
                            <!--    </div>-->
                            <!--</div>   -->

                        </div> 
                        <div class="row no-margin primary-color1-background d-block d-xl-none " >
                            <!--here is the code to show completed-->
                        <?php $progress = $wpdb->get_results( "SELECT * FROM ".table_user_progress()." WHERE module_id = '".$module_id."' AND user_id = '".$user_ID."'", ARRAY_A );
                            if(count($progress) == 1): ?>
                            <div class="text-center complete-div" style="width:100%;margin-bottom:20px;">
                                <i class="flt flaticon-check-box primary-color2 " style="font-size:20px;margin-right: 10px;"></i><p class="primary-color2 small-text dashboard-title3-bold" style="display:inline-block;"> COMPLETED</p>
                            </div>
                        <?php else: ?>
                            <div class="text-center complete-div" style="width:100%;margin-bottom:20px;">
                                <button class="complete-button drop-shadow btn theme-rounded-button primary-color1-hover primary-color2-background-hover primary-color2-border primary-color2-border-hover 
                                primary-color2 primary-color1-background">MARK AS COMPLETE</button>
                            </div>
                        <?php endif; ?>
                        <!--code ends here-->
                            <div class="text-center" style="width:100%;">
                                <?php 
                                    $start = $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE module_id = '".$module_id."' ", ARRAY_A );
                                    $previous = $start[0]['id'];
                                    $result = $wpdb->get_results( "SELECT * FROM ".module_db_name().", ".$val." WHERE ".module_db_name().".course_id = '".$start[0]['course_id']."' AND ".$val.".ID = ".module_db_name().".module_id AND ".module_db_name().".id > ".$previous." AND ".$val.".post_status = 'publish' ORDER BY ".module_db_name().".id ASC LIMIT 1", ARRAY_A );
                                    if(count($result) != 0)
                                    {
                                        $exvideos = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE module_id = '".$result[0]['module_id']."' ORDER BY id ASC", ARRAY_A );
                                        echo '<a href = "'.get_site_url().'/user/video.php?id='.$exvideos[0]['video_id'].'"<button class="drop-shadow btn theme-rounded-button primary-color1 primary-color2-background primary-color2-border primary-color2-border-hover 
                                        primary-color2-hover primary-color1-background-hover"  style="margin-bottom:20px">NEXT MODULE</button></a>';
                                    }
                                    else
                                    {
                                        echo '';
                                    }
                                ?>
                                
                            </div>
                        </div>   
                        <!-- End of tablet and mobile course files download part -->
                        
                        <!-- Video name and comments -->
                        <h2 class="dashboard-title primary-color1 padding-15px"  style="text-transform:uppercase;margin-top:30px;"><?php echo $video['post_title'] ; ?></h2>
                        <p class="padding-15px small-text primary-color1" ><?php echo html_entity_decode($video['post_content']) ; ?></p>
                        <iframe src="<?php echo get_permalink( $video['ID'] ); ?>" style="border:none;height:500px;width:100%;"></iframe>   


                    </div>

                    <!-- Desktop right side sidebar hidden in tablets and smaller devices -->
                    <div class="col-xl-3 d-none d-xl-block" style="position:fixed;right: 0;padding-right: 0px;padding-left: 55px;">
                        <div class="scrollbar-change primary-color2-scrollbar primary-color1-background padding-15px" style="padding-top:30px;padding-bottom:50px;height:calc(100vh - 109px);overflow:auto;"> <!-- padding top 20px more for shadow -->
                            

                            <div class="row no-margin vertical-middle" style="margin-bottom:10px;padding:15px;">
                                <p style="margin-top:60px;" class="white small-text dashboard-title3-bold" >VIDEOS</p>

                            </div>
                            <!--here starts the loop to show all the video-->
                            <?php 
                            $exvideos = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE module_id = '".$module_id."' ORDER BY id ASC", ARRAY_A );
                            $i = 0;
                            foreach($exvideos as $exvideo):?>
                            <?php $res2 = $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$exvideo["video_id"]."'", ARRAY_A );
                            if($res2[0]['post_status'] == "draft") continue;?>?>
                            <?php if($exvideo["video_id"] != $_GET['id']):?>
                            <a href="<?php echo get_site_url()."/user/video.php?id=".$res2[0]['ID']; ?>">
                            <div class="row no-margin" style="padding:15px;cursor:pointer;">
                                <div class="col-3 no-padding" style="max-width:25px;">
                                    <i class="flt flaticon-play-button white" style="font-size:20px;"></i>
                                </div>
                                <div class="col-9">
                                    <p class="white small-text" style="margin-bottom:0px;"><?php echo $res2[0]['post_title']; ?></p>
                                </div>
                            </div> </a>   
                            <?php else: ?>
                            <a href="<?php echo get_site_url()."/user/video.php?id=".$res2[0]['ID']; ?>">
                                <div class="row no-margin" style="background-color:rgba(255,255,255,0.05);padding:15px;cursor:pointer;">
                                <div class="col-3 no-padding" style="max-width:25px;">
                                    <i class="flt flaticon-play-button primary-color2" style="font-size:20px;"></i>
                                </div>
                                <div class="col-9">
                                    <p class="primary-color2 small-text" style="margin-bottom:0px;"><?php echo $res2[0]['post_title']; ?></p>
                                </div>

                            </div>  </a>
                            <?php endif; ?>
                            <?php endforeach; ?>  
                            <!--the loop ends here-->
                        
                        <!--    <div class="row no-margin" style="background-color:rgba(255,255,255,0.05);padding:15px;cursor:pointer;">-->
                        <!--        <div class="col-3 no-padding" style="max-width:25px;">-->
                        <!--            <i class="flt flaticon-play-button primary-color2" style="font-size:20px;"></i>-->
                        <!--        </div>-->
                        <!--        <div class="col-9">-->
                        <!--            <p class="primary-color2 small-text" style="margin-bottom:0px;">Client Communication</p>-->
                        <!--        </div>-->

                        <!--    </div>                                   -->
                        
                            <div class="row no-margin vertical-middle" style="margin-bottom:10px;padding:15px;">
                                <p style="margin-top:60px;" class="white small-text dashboard-title3-bold" >HOMEWORK & USEFUL RESOURCES</p>

                            </div>                        
                        <!--here starts the loop for showing files-->
                        <?php $files = $wpdb->get_results( "SELECT * FROM ".TableName_module_file()." WHERE Module_ID = '".$module_id."' ", ARRAY_A );
                        $i = 0;
                        
                        
                        foreach($files as $file): ?>    
                        <a href="<?php echo $file['File_Location']; ?>" download>
                            <div class="row no-margin padding-15px" style="margin-bottom:10px;">
                                <div class="col-2 no-padding" style="max-width:25px;">
                                    <i class="flt flaticon-document white" style="font-size:20px;"></i>
                                </div>
                                <div class="col-6"  style="overflow: hidden;">
                                    <p class="white small-text" style="margin-bottom:0px;"><?php echo $file['File_Name']; ?></p>
                                </div>
                                <div class="col-4 no-padding text-right">
                                    <i class="flt flaticon-download-to-storage-drive primary-color2" style="font-size:20px;"></i>
                                </div>
                            </div>  
                        </a>
                        <?php endforeach; ?>
                        <!--the loop ends here-->
                        <!--</div>    -->
                        
                        </div>
                        <div class="row no-margin primary-color1-background" >
                            <!--here is the code to show completed-->
                        <?php $progress = $wpdb->get_results( "SELECT * FROM ".table_user_progress()." WHERE module_id = '".$module_id."' AND user_id = '".$user_ID."'", ARRAY_A );
                            if(count($progress) == 1): ?>
                            <div class="text-center complete-div" style="width:100%;margin-bottom:20px;">
                                <i class="flt flaticon-check-box primary-color2 " style="font-size:20px;margin-right: 10px;"></i><p class="primary-color2 small-text dashboard-title3-bold" style="display:inline-block;"> COMPLETED</p>
                            </div>
                        <?php else: ?>
                            <div class="text-center complete-div" style="width:100%;margin-bottom:20px;">
                                <button class="complete-button drop-shadow btn theme-rounded-button primary-color1-hover primary-color2-background-hover primary-color2-border primary-color2-border-hover 
                                primary-color2 primary-color1-background">MARK AS COMPLETE</button>
                            </div>
                        <?php endif; ?>
                        <!--code ends here-->
                            <div class="text-center" style="width:100%;">
                                <?php 
                                    $start = $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE module_id = '".$module_id."' ", ARRAY_A );
                                    $previous = $start[0]['id'];
                                    $result = $wpdb->get_results( "SELECT * FROM ".module_db_name().", ".$val." WHERE ".module_db_name().".course_id = '".$start[0]['course_id']."' AND ".$val.".ID = ".module_db_name().".module_id AND ".module_db_name().".id > ".$previous." AND ".$val.".post_status = 'publish' ORDER BY ".module_db_name().".id ASC LIMIT 1", ARRAY_A );
                                    if(count($result) != 0)
                                    {
                                        $exvideos = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE module_id = '".$result[0]['module_id']."' ORDER BY id ASC", ARRAY_A );
                                        echo '<a href = "'.get_site_url().'/user/video.php?id='.$exvideos[0]['video_id'].'"<button class="drop-shadow btn theme-rounded-button primary-color1 primary-color2-background primary-color2-border primary-color2-border-hover 
                                        primary-color2-hover primary-color1-background-hover" style="margin-bottom:20px">NEXT MODULE</button></a>';
                                    }
                                    else
                                    {
                                        echo '<div class="primary-color1-background" style="height:59px;"></div>';
                                    }
                                ?>
                            </div>
                        </div>                        
                        



                    </div>
                    
                </div> 
                
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script>
        $(document).on("click" , ".complete-button" , function(e)
        {
           var value = $(this).val();
           var sendData = new FormData();
           sendData.append('module_id' , '<?php echo $module_id;?>');
           $.ajax({
        		url : 'module_complete.php',
        		data : sendData,
        		async: false,
                contentType: false,
                processData: false,
                cache: false,
        		type : 'POST',
                success : function(data) {
                $(".complete-div").html('<i class="flt flaticon-check-box primary-color2 " style="font-size:20px;margin-right: 10px;"></i><p class="primary-color2 small-text dashboard-title3-bold" style="display:inline-block;"> COMPLETED</p>');
        		},
        	});
        });
    </script>
</body>

</html>