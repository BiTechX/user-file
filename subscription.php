<?php  
require('common-config.php');  

global $wpdb;

$tableName = plan_db_info();
$tableName2 = plan_type_db_info();

$results = $wpdb->get_results ( "
   SELECT * FROM `".$tableName."` 
   INNER JOIN `".$tableName2."`
   ON `".$tableName."`.`plan_type` = `".$tableName2."`.`ID`
   WHERE `d43_fitPro_all_plan_info`.`plan_status` = 'publish'
",ARRAY_A);

//$result = get_user_current_subscription_info($user_ID);


//print_r($result);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Subscription</title>

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

        <!-- Page Content  -->
        <div id="content" style="overflow: hidden;">
            <?php
                require('navbar-top.php');
            ?>
        

           
            
            <form>
            
        
                <h1 class="dashboard-title primary-color1 padding-15px" style="width:100%;"><a href="homepage.php"><i class="flaticon-back" style="margin-right:20px;"></i></a>Choose a plan: </h1>
                <div class="row d-flex flex-wrap no-margin">
                   
                    <?php if(!is_user_have_subscription_plan($user_ID)   ):?>
                    
                        <?php foreach($results as $result): 
                              
                         ?>            
                            <div class="col-xl-4 order-1 order-xl-0">
                                <div class="drop-shadow card-holder white-background" style="margin-bottom:0px;" >
                                    <div style="padding:30px;">
                                        <h3 class="dashboard-title3-bold text-center primary-color1" style="margin-bottom:10px;height:66px;"><?php echo $result['plane_name'];?></h3>
                                        <p class="secondary-color1 dashboard-title3-bold text-center small-text" style="height:46px;"><?php echo $result['plan_title'];?></p>
                                        <div class="primary-color1-background horizontal-middle" style="height:5px;width:20px;margin:20px auto;"></div>
                                        <?php if($result['plan_type'] == 2): ?>
                                        <p class="secondary-color1 dashboard-title3-bold text-center small-text" style="height:46px;">pay <?php echo $result['plan_number_payment']; ?> monthly installments</p>
                                        <?php else: ?>
                                        <p class="secondary-color1 dashboard-title3-bold text-center small-text" style="height:46px;"></p>
                                        <?php endif ?>
                                        <?php if($result['plan_type'] != 4): ?>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center " style="margin-bottom:40px;"><?php echo $result['plan_total_cost'];?>$</h1>
                                        <?php else: ?>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center " style="margin-bottom:40px;"><?php echo $result['plan_total_cost'];?>$</h1>
                                        <?php endif ?>
                                        <p class="primary-color1 dashboard-title3-bold text-center very-small-text" style="text-transform:none;height:51px;"><?php echo $result['plan_description'];?></p>
                                    </div>
                                </div>
                               
                                <a href="<?php echo site_url()."/user/checkout_plan.php?plan_id=".$result['Id']."&plan_add=new"; ?>">
                                    <div class="big-animatable-button primary-color2-background primary-color2 " style="margin-bottom:20px;" >
                                        <div class="big-animatable-button-inner primary-color1-background"></div>
                                        <div class="big-animatable-button-arrow"></div>
                                        <p class="big-animatable-button-text"> <span class="arrow_triangle-right primary-color2">CHOOSE THIS PLAN</span></p>
                                    </div>  
                                </a>
                            </div>
                     
                        <? endforeach ?>
                        
                        <?php 
                        else: 
                            
                            if(is_user_have_subscription_plan_isFREE($user_ID)):
                        ?>      
                               <?php foreach($results as $result): 
                                   if($result['plane_type'] != 'FREE'):
                              
                         ?>            
                            <div class="col-xl-4 order-1 order-xl-0">
                                <div class="drop-shadow card-holder white-background" style="margin-bottom:0px;" >
                                    <div style="padding:30px;">
                                        <h3 class="dashboard-title3-bold text-center primary-color1" style="margin-bottom:10px;height:66px;"><?php echo $result['plane_name'];?></h3>
                                        <p class="secondary-color1 dashboard-title3-bold text-center small-text" style="height:46px;"><?php echo $result['plan_title'];?></p>
                                        <div class="primary-color1-background horizontal-middle" style="height:5px;width:20px;margin:20px auto;"></div>
                                        <?php if($result['plan_type'] == 2): ?>
                                        <p class="secondary-color1 dashboard-title3-bold text-center small-text" style="height:46px;">pay <?php echo $result['plan_number_payment']; ?> monthly installments</p>
                                        <?php else: ?>
                                        <p class="secondary-color1 dashboard-title3-bold text-center small-text" style="height:46px;"></p>
                                        <?php endif ?>
                                        <?php if($result['plan_type'] != 4): ?>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center " style="margin-bottom:40px;"><?php echo $result['plan_total_cost'];?>$</h1>
                                        <?php else: ?>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center " style="margin-bottom:40px;"><?php echo $result['plan_total_cost'];?>$</h1>
                                        <?php endif ?>
                                        <p class="primary-color1 dashboard-title3-bold text-center very-small-text" style="text-transform:none;height:51px;"><?php echo $result['plan_description'];?></p>
                                    </div>
                                </div>
                               
                                <a href="<?php echo site_url()."/user/checkout_plan.php?plan_id=".$result['Id']."&plan_add=upgrade"; ?>">
                                    <div class="big-animatable-button primary-color2-background primary-color2 " style="margin-bottom:20px;" >
                                        <div class="big-animatable-button-inner primary-color1-background"></div>
                                        <div class="big-animatable-button-arrow"></div>
                                        <p class="big-animatable-button-text"> <span class="arrow_triangle-right primary-color2">CHOOSE THIS PLAN</span></p>
                                    </div>  
                                </a>
                            </div>
                            <?php endif; ?>
                        <? endforeach; ?>
                       <?php         
                            else:
                            $plan_info_id = get_user_meta( $user_ID, 'user_current_subscription_plan' , true );
                            $results = $wpdb->get_results ("
                                               SELECT * FROM `".$tableName."`
                                               INNER JOIN `".$tableName2."`
                                               ON `".$tableName."`.`plan_type` = `".$tableName2."`.`ID`
                                               WHERE `".$tableName."`.`Id` = ".$plan_info_id."
                                            ",ARRAY_A);
                            
                            $result = $results[0];
                        ?>
                        
                        <div class="col-xl-4 ">
                            <h2 class="dashboard-title primary-color1" style="width:100%;">Current plan: </h2>
                            <div class="drop-shadow card-holder white-background" style="margin-bottom:0px;" >
                                <div style="padding:30px;">
                                    <h3 class="dashboard-title3-bold text-center primary-color1" style="margin-bottom:10px;height:66px;"><?php echo $result['plane_name'];?></h3>
                                    <p class="secondary-color1 dashboard-title3-bold text-center small-text" style="height:46px;"><?php echo $result['plan_title'];?></p>
                                    <div class="primary-color1-background horizontal-middle" style="height:5px;width:20px;margin:20px auto;"></div>
                                    <?php if($result['plan_type'] == 2): ?>
                                    <p class="secondary-color1 dashboard-title3-bold text-center small-text" style="height:46px;">pay <?php echo $result['plan_number_payment']; ?> monthly installments</p>
                                    <?php else: ?>
                                    <p class="secondary-color1 dashboard-title3-bold text-center small-text" style="height:46px;"></p>
                                    <?php endif; ?>
                                    <?php if($result['plan_type'] != 4): ?>
                                    <h1 class="secondary-color1 dashboard-title3-bold text-center " style="margin-bottom:40px;"><?php echo $result['plan_total_cost'];?>$</h1>
                                    <?php else: ?>
                                    <h1 class="secondary-color1 dashboard-title3-bold text-center " style="margin-bottom:40px;"><?php echo $result['plan_total_cost']."" ;?>$</h1>
                                    <?php endif ?>
                                    <p class="primary-color1 dashboard-title3-bold text-center very-small-text" style="text-transform:none;height:51px;"><?php echo $result['plan_description'];?></p>
                                </div>
                            </div>
                           
                           
                        </div>
                        <?php endif;?>
                   <?php endif;?>
                   
                   <?php if(is_user_subscription_plan_is_instalment($user_ID)):
                       $val = get_user_current_subscription_info($user_ID);
                       if($val['status'] == 1):
                          
                           $plan_info = unserialize($val['current_user_plan_info']);
                           $plan_pay_info = unserialize($val['current_user_plan_pay_info']);
                           $plan_user_status_info = unserialize($val['current_user_plan_status_info']);
                           echo "<pre>";
                           //print_r($plan_user_status_info);
                           echo "</pre>";
                           ?>
                           <div class="col-xl-8 ">
                               <div style="margin-top:78px;">
                                   <h3 class="dashboard-title3-bold primary-color1">TOTAL INSTALMENTS : <span class="secondary-color1"><?php echo  $plan_info->plan_number_payment ; ?></span></h3>
                               </div>
                                <div>
                                   <h3 class="dashboard-title3-bold primary-color1">INSTALMENTS PAID : <span class="secondary-color1"><?php echo  $plan_user_status_info['current_installment_pay_running']; ?></span></h3>
                               </div>
                                <div>
                                   <h3 class="dashboard-title3-bold primary-color1">REMAINING INSTALMENTS : <span class="secondary-color1"><?php echo  $plan_info->plan_number_payment - $plan_user_status_info['current_installment_pay_running']; ?></span></h3>
                               </div>
                           </div>
                           <?
                       endif;
                   ?>
                   
                   <?php endif;?>
                </div>
            </form>
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>

</body>

</html>