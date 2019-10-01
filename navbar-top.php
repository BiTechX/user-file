<style>
    .active-point{
        height:20px;
        width:20px;
        border-radius:50%;
        position:relative;
        bottom:5px;
        font-size:small;
        text-align:center;
        right:5px;
    }
</style>

<nav class="navbar navbar-expand-md desktop-tablet-navbar" style="box-shadow:none;background: transparent;">
    <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="homepage.php"><img src="https://intensefitnessacademy.com/wp-content/uploads/2019/09/logo.png"></a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">

                <!--    
                <li class="nav-item active">
                    <a class="nav-link" href="#">Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Page</a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link" href="#">Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Page</a>
                </li>
                -->
                <li class="nav-item">
                    
                   <div class="d-flex">
                       <a class="" href="<?php echo site_url()."/cart";?>"><i class="flaticon-shopping-cart primary-color1" style="font-size:26px;" ></i></a>
                       <span class="active-point secondary-color1-background white"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                   </div> 
                </li>
            </ul>
        </div>
    </div>
</nav>