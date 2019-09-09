<?php
require('common-config.php');

$users_admin = get_users([ 
    'role__in'  => [ 'administrator' ] ,
    ]);
$updated = update_user_meta( $user_ID, 'user_chat_status', 1 );    
 //print_r($users_admin); 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Settings - Inbox Messages</title>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    <link rel="stylesheet" href="../resources/css/messages.css">
    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">

    
    

     
</head>


<style>

.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
  
    
}

</style>



<body >
        
    <?php
        require('navbar-mobile.php');
    ?>

    <div class="wrapper">
        <?php
            require('sidebar.php');
        ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
                require('navbar-top.php');
            ?>
        

           
            <div class="row no-margin" style="margin-bottom:15px">
                <div class ="col-xl-7 col-12">
                  
                  <!--
                   <h1 class="dashboard-title primary-color1 padding-15px" style="margin-bottom:0px"><a href=""><i class="flaticon-back"></i></a> Inbox <span class="secondary-color1 dashboard-title padding-15px" style="margin-bottom:0px;"><h2>3 NEW</h2></span></span> </h1>
                  -->
                <!--
                <div class="tb" style="align-items:center;">
                      <a href=""><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button">NOTIFICATIONS</button></a> 
                       <a href=""><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button">PRODUCT UPDATES</button></a> 
                      <a href=""><button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button current-page-button">MESSAGES</button></a>
                   </div>
                   -->
                   
                </div>
                <div class ="col-xl-5 hide-row" style="display:grid ;align-items:center;justify-content: end;">
                    <div class="padding-15px text-lg-left text-center" style="align-items:center;">
                  <!--  <button class="drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background" type="submit" style="">VIEW UNREAD</button> 
                    <button id="ClearMessage" class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" type="submit" style="">CLEAR ALL</button>
                    -->
                </div>
                </div>
            </div>
            
          
                
                <div class="row no-margin">
            
                    <div class="col-xl-6 order-0 order-xl-1 padding-0-sm" id = "details" style="margin-bottom:20px;">
                            <div class="row no-margin grey-border drop-shadow b comment msg-padding" style="width:100%;align-items:center;">
                             
                                 <div class="col-xl-1 col-2 no-padding ">
                                    <p class="text-center" style="margin-bottom:0px;">
                                         <?php 
                                           
                                          $val = get_user_meta(  $users_admin[0]->ID , 'profile_photo', true );
                                          if($val){
                                              $url_profile = get_site_url()."/wp-content/uploads/ultimatemember/".$users_admin[0]->ID ."/".$val.'?'.rand(15587000000,1568712237);
                                          } 
                                          else{
                                              $url_profile = get_avatar_url($users_admin[0]->ID ) ;
                                          }
                                        ?>
                               
                                      <img src="<?php echo $url_profile; ?>" class="profile-img-msg">  
                                     </p>
                                </div>
                                <div class=" col-6 col-xl-7 no-padding-desktop">
                                    <div style="padding:0px 25px;" class="">
                                        
                                        <h4 class=" primary-color1 dashboard-title3-bold" style="text-transform:none;margin-top:10px;display:inline" id="author">   <?php echo  $users_admin[0]->display_name ?> </h4>
                                       
                                    </div>
                                </div>
                                <div class="col-4">
                              
                                </div>
                                
                        <div id="chatMessageLoad" class="grey-border">
                           
                        </div>
                             
                             
                             <form id='ChatForm' action="javascript:void(0)" method="post"  enctype="multipart/form-data" style="width:100%;">

                                 <div class =" row no-margin" style="width:100%;margin-top:10px;">
                                   <div class ="col-10">
                                       <div style="border-radius:100px;border:1px solid rgba(0,0,0,0.1);display:flex;align-items:center;justify-content:flex-end">
                                         
                                            <div contentEditable="true" class="form-control send-text" id="MessageBox"></div>
                                          
                                            <input type="file" name="fileToUpload" id='fileid' hidden>
                                         
                                          
                                           <input type="hidden" name="Text" value="asdashdahsd" >
                                           <i class="flaticon-link grey icon-sm link-button" style="" id='buttonid'></i>
                                          
                                           
                                       </div> 
                                       
                                   </div>
                                  
                                   
                                
                                   <div class="col-2 no-padding" style="display:flex;align-items:center;">
                                      <button type="submit"  class="send-button secondary-color1-background" id="ActionButton" >
                                            <i class="flaticon-send white icon-sm" style=""></i>
                                      </button>    
                                   </div>
                                    
                                 </div>
                                    <div class="padding-15px" style="margin-top:20px;">
                                         <div id="textAddFile"></div>
                                         <div id="MessageBoxImage"></div>  
                                   </div>
                             </form>
                             
                             
                            </div>
                            
                    </div>
                </div>

             
           
          
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script>
        var isscroll = true;
        var Filecount = 0;
        var TotalChatMessage = 0;
        var limitMessage = 50;
        var fileData = {};
        
        function loadlink(){
           
            
                $('#chatMessageLoad').load('ajax_call/user_chat.php?limit='+limitMessage,function (response, status, xhr) {
                    console.log(status);
                   if(isscroll){
                        $("#chatMessageLoad").animate({ 
                            scrollTop: $('#chatMessageLoad').get(0).scrollHeight
                        }, "slow");
                        isscroll = false;
                   }
                   
                   
                });
                
        }
        function ChatMessageCounter(){
                        
            var postvalue =  {
                     'sender_id'  : '<?php echo $user_ID;?>',
                     'reciver_id'  : '<?php echo $users_admin[0]->ID ;?>',
                 };
            var url = "<?php echo FITPRO_THEME_BTX_fun_chat_message_count_user_url();?>";     
            $.ajax({
                        url: url,
                        data: postvalue,
                        type: 'POST',
                        beforeSend : function()
                        {
                           
                        },
                        success: function(result){
                            
                            console.log(result);
                            var data = jQuery.parseJSON(result);
                            if (data.status == 1) {
                                var newMessageCount = data.message;
                                if(TotalChatMessage < newMessageCount){
                                     loadlink();
                                     TotalChatMessage = newMessageCount;
                                }
                                setTimeout(ChatMessageCounter, 2000);
                            }
                          
                        },
                        error: function(e) 
                        {
                            console.log(e);
                        }   
                    
                });
                
        }
        ChatMessageCounter();
   
    /*
    setInterval(function(){
        loadlink() // this will run after every 5 seconds
    }, 1500);
      
    $(document).on ("click", "#buttonid" ,function(event){
            event.preventDefault();
            $('#fileid').click();
    });
    */
     $("#buttonid").click(function(event){
            event.preventDefault();
            $('#fileid').click();
    });  
    /*
    var callPrevious = null;
    $("#chatMessageLoad").on ("scroll",function(event){
        var div = $(this);
        
         if(div.scrollTop() == 0 && callPrevious == null)
        {
             $("body").addClass("disabledbutton");
            limitMessage += 10;
            var callPrevious = $('#chatMessageLoad').load('ajax_call/user_chat.php?limit='+limitMessage,function (response, status, xhr) {
                    console.log(status);
                   if(isscroll){
                        console.log(callPrevious);
                        $("#chatMessageLoad").animate({ 
                            scrollTop: $('#chatMessageLoad').get(0).scrollHeight
                        }, "slow");
                        isscroll = false;
                        callPrevious = null;
                        
                   }
                   $("*").removeClass("disabledbutton");
                   
            });
        
        }
    });
    */
    
     $(document).on ("change", "#fileid" ,function(file){
            Filecount ++;
            var input = file.target
            fileData[Filecount] = this.files[0]
            
           
            var fullPath = $(this).val();
            var filename = "";
            if (fullPath) {
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
            }
            var url = URL.createObjectURL(this.files[0]);
            //console.log(url);
            var reader = new FileReader();
            reader.onload = function(){
            var dataURL = reader.result;
                console.log(Filecount);
            
            
            
                if(Filecount >= 1){
                    $('#textAddFile').html('<p class="primary-color1 small-text">File Attachment(s)</p>');
                }else{
                    $('#textAddFile').text("");
                }
                 
                $('#MessageBoxImage').append("<div class='chat-file-send ' id='fileDiv' data-FileCount='"+  Filecount  +"'><a class='primary-color2-background primary-color1' style='padding:5px;' href='"+dataURL+"' target='_blank' download>"+filename+"</a><i class='flaticon-close deleteChatImage primary-color2-background primary-color1' style='padding: 2px 5px;cursor: pointer;'></i></div>");
                  //output.src = dataURL;
                 
            };
            reader.readAsDataURL(input.files[0]);
            
    });
    
     $(document).on("keypress", "#MessageBox" ,function(event){
         //console.log(event.which);
         if(event.which == 13){
             $('#ChatForm').submit();
         }
     });
     
    
     $(document).on ("click", ".deleteChatImage" ,function(event){
      
         var val = $(this).parent().attr("data-FileCount");
         delete fileData[val];
         $(this).parent().remove();
         Filecount--;
         if(Filecount >= 1){
                $('#textAddFile').html('<p class="primary-color1 small-text">File Attachment(s)</p>');
        }else{
            $('#textAddFile').html("");
        }
     });
     
    $(document).on ("submit", "#ChatForm" ,function(event){
            event.preventDefault();
            $("i").remove(".deleteChatImage");
            $('#MessageBox').attr("contentEditable","false");
           
            var form = $('#ChatForm');
            var data = $('#MessageBox').html();
            
            var fileDataempty =  Object.entries(fileData).length === 0 && fileData.constructor === Object   ;
            console.log(fileDataempty);
            if( fileDataempty == false  ){
                
                var formData = new FormData();
                jQuery.each(fileData, function(i, val) {
                    formData.append('ChatFile[]',val);
                });
                       
                 $.ajax({
                        url: "ajax_call/Chat_file_uplode.php",
                        data : formData ,
                        type : 'POST',
                        contentType : false,
                        processData : false,
                        
                        beforeSend : function()
                        {
                            jQuery("#ActionButton").prop("disabled",true);
                            jQuery("#ActionButton").html('<p class="white" style="margin-bottom:0px;">wait..</p>');
                        },
                        success: function(result){
                            console.log(result)
                            var data_return_file = JSON.parse(result);
                            if(data_return_file.status == 1){
                                $('#MessageBoxImage').html(data_return_file.return);
                            }
                            
                         
                            var data2 = $('#MessageBoxImage').html();
                
                            var Totaldata = data+data2

                           
                            if( Totaldata.length >= 1 && Totaldata.length <= 2000000 &&  !(/^\s*$/.test(Totaldata))  ){
                                 var postvalue =  {
                                     'message' : Totaldata,
                                     'sender_id'  : '<?php echo $user_ID;?>',
                                     'reciver_id'  : '<?php echo $users_admin[0]->ID ;?>',
                                 };
                                 var url = "<?php echo FITPRO_THEME_BTX_fun_chat_message_add_user_url();?>";
                                 console.log(postvalue);
                              
                                $.ajax({
                                    url: url,
                                    data: postvalue,
                                    type: 'POST',
                                    beforeSend : function()
                                    {
                                        jQuery("#ActionButton").prop("disabled",true);
                                        jQuery("#ActionButton").html('<p class="white" style="margin-bottom:0px;">wait..</p>');
                                    },
                                    success: function(result){
                                         isscroll = true;
                                         $('#MessageBox').html('');
                                         $('#MessageBoxImage').html('');
                                         $('#textAddFile').text("");
                                         $('#MessageBox').attr("contentEditable","true");
                                         fileData = {};
                                        jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                                        jQuery("#ActionButton").prop("disabled",false);
                                       
                                    },
                                    error: function(e) 
                                    {
                                        console.log(e);
                                        alert("your are not allow this type of message");
                                        $('#MessageBox').html('');
                                        $('#MessageBoxImage').html('');
                                        fileData = {};
                                        $('#textAddFile').text("");
                                        $('#MessageBox').attr("contentEditable","true");
                                        jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                                        jQuery("#ActionButton").prop("disabled",false);
                                    }   
                                    
                                });
                
                
                            }else{
                                 alert("your message is too large or small");
                            }
                        },
                        error: function(e) 
                        {
                            console.log(e);
                           
                           
                        }   
                        
                    });
                    
            }else{
                
                var data = $('#MessageBox').html();
                var data2 = $('#MessageBoxImage').html();
                
                var Totaldata = data+data2
                            
                           
                           
                if( Totaldata.length >= 1 && Totaldata.length <= 2000000 &&  !(/^\s*$/.test(Totaldata))  ){
                    var postvalue =  {
                        'message' : Totaldata,
                        'sender_id'  : '<?php echo $user_ID;?>',
                        'reciver_id'  : '<?php echo $users_admin[0]->ID ;?>',
                    };
                    var url = "<?php echo FITPRO_THEME_BTX_fun_chat_message_add_user_url();?>";
                    console.log(postvalue);
                              
                    $.ajax({
                        url: url,
                        data: postvalue,
                        type: 'POST',
                        beforeSend : function()
                        {
                            jQuery("#ActionButton").prop("disabled",true);
                            jQuery("#ActionButton").html('<p class="white" style="margin-bottom:0px;">wait..</p>');
                        },
                        success: function(result){
                            isscroll = true;
                            $('#MessageBox').html('');
                            $('#MessageBoxImage').html('');
                            fileData = {};
                            $('#textAddFile').text("");
                            $('#MessageBox').attr("contentEditable","true");
                            console.log(result);
                            jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                            jQuery("#ActionButton").prop("disabled",false);
                                       
                        },
                        error: function(e) 
                        {
                            console.log(e);
                            alert("your are not allow this type of message");
                            $('#MessageBox').html('');
                            $('#MessageBoxImage').html('');
                            fileData = {};
                            $('#textAddFile').text("");
                            $('#MessageBox').attr("contentEditable","true");
                            jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                            jQuery("#ActionButton").prop("disabled",false);
                        }   
                                    
                    });
                
                
                    }else{
                        alert("your message is too large or small");
                    }
                
                
            }
            
            
    });
             
             
             
       $(document).on ("click", "#ClearMessage" ,function(event){
                event.preventDefault();
                    
            
                var com = confirm("Are you sure ?");
 
                if(com){
                    
                     var postvalue =  {
                         'sender_id'  : '<?php echo $user_ID; ?>',
                     };
                     var url = "<?php echo FITPRO_THEME_BTX_fun_chat_message_trash_user_url();?>";
                     console.log(postvalue);
                  
                    $.ajax({
                        url: url,
                        data: postvalue,
                        type: 'POST',
                        beforeSend : function()
                        {
                            jQuery(this).prop("disabled",true);
                            jQuery("#ActionButton").prop("disabled",true);
                             jQuery("#ActionButton").html('wait..');
                        },
                        success: function(result){
                            isscroll = true;
                            $('#MessageBox').html('');
                            console.log(result);
                            jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                            jQuery("#ActionButton").prop("disabled",false);
                            jQuery(this).prop("disabled",false);
                          
                        },
                        error: function(e) 
                        {
                            console.log(e);
                            jQuery(this).prop("disabled",false);
                            alert("your are not allow this type of message");
                            $('#MessageBox').html('');
                            jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                            jQuery("#ActionButton").prop("disabled",false);
                            window.location.href ="";
                        }
                    });
                }
          
    });
      
             
    </script> 



</body>




</html>