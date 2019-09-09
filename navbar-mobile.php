<style>
    .active-point{
        height:20px;
        width:20px;
        border-radius:50%;
        position:relative;
        bottom:0px !important;
        font-size:small;
        text-align:center;
        right:5px;
    }
</style>

<nav class="navbar fixed-top navbar-expand-md mobile-navbar primary-color1-background" style="box-shadow:none;margin-bottom:0px;padding:0px 15px 0px 0px;">
    <div class="container-fluid">
    <button class="navbar-toggler primary-color2-background padding-15px" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarTogglerDemo03" aria-expanded="false" 
    aria-label="Toggle navigation" style="outline:none;height: 81px;border-radius:0px;">
    <i class="flaticon-menu-1  white"></i>
    </button>
     <div class="d-flex align-items-center">
        <div class="d-flex mr-2">
                <i class="flaticon-shopping-cart white" style="font-size:32px;margin-top:5px" ><a class="" href="https://fitpro.bitechx.com/cart"></a></i>
                <span class="active-point secondary-color1-background white">3</span>
        </div>
        <a class="navbar-brand padding-15px-vertical ml-auto" href="homepage.php" style="margin-right:0px;"><img src="https://fitprobizlaunch.com/wp-content/uploads/2019/04/logo.png" style="width:40px;"></a>
        
    </div> 
  <!--  <a class="navbar-brand padding-15px-vertical" href="homepage.php" style="margin-right:0px;"><img src="https://fitprobizlaunch.com/wp-content/uploads/2019/04/logo.png" style="width:40px;"></a> -->


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mr-auto">

    <?php $url = site_url('/user/','https'); ?>            
                <li class="nav-item white text-center">
                    <a class="nav-link" href="<?php echo $url.'homepage.php';?>">Dashboard</a>
                </li>
                <li class="nav-item white text-center">
                    <a class="nav-link" href="<?php echo $url.'store.php';?>">Store</a>
                </li>

                <li class="nav-item white text-center">
                    <a class="nav-link" href="<?php echo $url.'subscription.php';?>">Plan</a>
                </li>
                <li class="nav-item white text-center">
                    <a class="nav-link" href='<?php echo site_url();?>/all-blog'>Blogs</a>
                </li>
                <li class="nav-item white text-center">
                    <a class="nav-link" href='<?php echo $url.'user_chat.php';?>'>Message Admin</a>
                </li>
                <li class="nav-item white text-center">
                    <a class="nav-link" href="<?php echo $url.'settings_1_profile.php';?>">Settings</a>
                </li>
                <li class="nav-item white text-center">
                    <a class="nav-link" href="https://fitprobizlaunch.com/logout">Signout</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="#">Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Page</a>
                </li>
                -->
            </ul>
        </div>
    </div>
</nav>