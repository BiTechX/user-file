<?php
require('../../wp-load.php');
global $wpdb;
$user_id = get_current_user_id();

$LIMIT = '10';
if( isset($_GET['limit']) && !empty($_GET['limit'])){
    $LIMIT = $_GET['limit'];
}
$results = $wpdb->get_results ( "
SELECT * FROM (
    SELECT * FROM `".chat_message_db_name()."` WHERE (`sender_id` = $user_id OR `recever_id` = $user_id ) AND `trash_sender` = 0  ORDER BY id DESC LIMIT $LIMIT
    )var1 ORDER BY id ASC
");

/*
$results = $wpdb->get_results ( "

    SELECT * FROM `".chat_message_db_name()."` WHERE (`sender_id` = $user_id OR `recever_id` = $user_id ) AND `trash_sender` = 0  
   
");
*/
$user_ID = get_current_user_id();
//print_r($results);

?>
<?php foreach ($results as $result) : ?>
<?php if($result->sender_id ==  $user_ID): ?>

 
                    <div class =" row no-margin" style="width:100%;">
                                <div class="col-2"></div>
                                <div class="col-xl-2 no-padding-desktop order-xl-0 order-1" style="display:flex;" >
                                    <p class="small-text grey text-right " style="text-transform:none;margin-top:auto;margin-left:auto;"> 
                                    <?php 
                                    
                                    $datetime1 = new DateTime();
                                    $datetime2 = new DateTime(date('d-m-Y H:i:s',($result->sent_time)));
                                    $interval = $datetime2->diff($datetime1);
                                    $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                                    
                                     $elapsed = $interval->format('%a');
                                            if($elapsed == 0){
                                                $hour = $interval->format('%H');
                                                $min = $interval->format('%i');
                                                $sec = $interval->format('%s');
                                                $elapsed = $hour." hours ago";
                                                if($hour == 0){
                                                    $elapsed = $min." minutes ago";
                                                    if($min == 0){
                                                        $elapsed = "now" ;
                                                    }
                                                }
                                                
                                            }else{
                                                $elapsed = date('d-m-Y H:i:s',($result->sent_time));
                                            }
                                    echo $elapsed;
                                    
                                    
                                    
                                    ?>
                                    
                                    </p>
                                </div>
                                <div class= "col-xl-8 col-10 order-0 order-xl-1">
                                    <div style="background-color:#f6f6f6;border-radius:10px;padding:20px;margin:20px 0px">
                                       <p class="small-text" style="color:#000;font-weight:500" >
                                            <?php echo $result->message ;  ?>
                                       </p>
                                    </div>
                                </div>
                                
                                </div>
                         
                    
                    
                    
                    
                    <?php  elseif($result->recever_id ==  $user_ID) : ?>
                            <div class =" row no-margin" style="width:100%">
                            <div class= "col-xl-8 col-10">
                                        <div class="secondary-color1-background white" style="border-radius:10px;padding:20px;margin:20px 0px">
                                           <?php echo $result->message ;  ?>
                                        </div>
                                        </div>
                                        <div class="col-xl-2 no-padding-desktop" style="display:flex;" >
                                            <p class="small-text grey text-right" style="text-transform:none;margin-top:auto;"> <?php 
                                            
                                            $datetime1 = new DateTime();
                                            $datetime2 = new DateTime(date('d-m-Y H:i:s',($result->sent_time)));
                                            $interval = $datetime2->diff($datetime1);
                                            $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                                            
                                            $elapsed = $interval->format('%a');
                                            if($elapsed == 0){
                                                $hour = $interval->format('%H');
                                                $min = $interval->format('%i');
                                                $sec = $interval->format('%s');
                                                $elapsed = $hour." hours ago";
                                                if($hour == 0){
                                                    $elapsed = $min." minutes ago";
                                                    if($min == 0){
                                                        $elapsed = "now" ;
                                                    }
                                                }
                                            }else{
                                                $elapsed = date('d-m-Y H:i:s',($result->sent_time));
                                            }
                                            
                                            echo $elapsed;
                                            
                                            
                                            
                                            ?>
                                            
                                            </p>
                                            
                                        </div>
                                        
                            
                    </div>
                    
                    
                    
                    
                <?php  endif;?>
        <?php endforeach;?>