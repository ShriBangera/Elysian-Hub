<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");

  $sqlcustomer = "SELECT * FROM customer WHERE customerid='$_SESSION[customerid]'";
  $qsqlcustomer= mysqli_query($con,$sqlcustomer);
  $rscustomer = mysqli_fetch_array($qsqlcustomer);
?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Elysian Hub</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/apple-touch.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
<!--Anwar code starts-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<style>
#load{
    width:100%;
    height:100%;
    position:fixed;
    top:0px;
    left:0px;
    z-index:9999;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

document.onreadystatechange = function() { 
    if (document.readyState !== "complete") { 
        document.querySelector("body").style.visibility = "hidden"; 
        document.querySelector("#load").style.visibility = "visible"; 
    } else { 
        document.querySelector("#load").style.display = "none"; 
        document.querySelector("body").style.visibility = "visible"; 
    } 
};</script>
<!-- Anwar code ends-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="load"></div>
<style type="text/css">
       .cststl a:hover{color: white;}
</style>
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<!--<div class="custom-select-box">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
							<option>¥ JPY</option>
							<option>$ USD</option>
							<option>€ EUR</option>
						</select>
                    </div>-->
                    <div class="right-phone-box">
                        <p>Call US :- <a href="#">+91 9997768970</a></p>
                    </div>
                    <div class="our-link">
                        <ul>
                            <li>&nbsp;</li>
                            <li><a href="ourlocation.php"><i class="fas fa-location-arrow"></i> Our location</a></li>
                         <!--<li><a href="#"><i class="fa fa-user s_color"></i> My Account</a></li>
                            <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="login-box cststl">
<?php if(isset($_SESSION[customerid]))
        {
        ?>     
            <a class="btn hvr-hover" href="logout.php"><i style="font-size:24px" class="fa fa-sign-out"></i> Logout</a>
<?php } else{
            ?>
            <a class="btn hvr-hover" href="login.php"><i style="font-size:24px" class="fa fa-sign-in"></i> Login</a>
            <a class="btn hvr-hover" href="register.php"><i style="font-size:24px" class="fa fa-user-plus"></i> Register</a>
<?php } ?>
					</div>
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <i class="fa-solid fa-shop"></i></i> Since 1995
                                </li>
                                <li>
                                    <i class="fa-solid fa-house-chimney"></i> Beauty in every detail!
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Inspired living starts here.
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Where every detail tells your story.
                                </li>
                                <li>
                                    <i class="fa-solid fa-shop"></i> Artistry for your abode.
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Inspiration for your living space 
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Buy Now 
                                </li>
                                <!--<li>
                                    <i class="fas fa-fish"></i> Buy Fish
                                </li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="index.php"><img src="imgproduct\Logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <!--<li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">SHOP</a>
                            <ul class="dropdown-menu">
								<li><a href="products.php">Sidebar Shop</a></li>
								<li><a href="shop-detail.php">Shop Detail</a></li>
                                <li><a href="cart.php">Cart</a></li>
                                <li><a href="checkout.php">Checkout</a></li>
                                <li><a href="my-account.php">My Account</a></li>
                                <li><a href="wishlist.php">Wishlist</a></li>
                            </ul>
                        </li>-->
                        <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
<?php if(isset($_SESSION[customerid]))
        {
        ?>
                <div class="attr-nav">
                    <ul>                        
                        <li class="side-menu">
							<a href="#">
								<i class="fas fa-user s_color fa-lg"></i>
								<p style="color: green;font-weight: bold;"><?php echo $rscustomer['customername']; ?></p>
							</a>
						</li>
                    </ul>
                </div>
<?php } ?>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        <li>
                            <a href="#" class="photo"><i class="fas fa-user-alt fa-lg"></i></a>
                            <h6><a href="">
                                <p><?php echo $rscustomer['customername']; ?></p> </a></h6>
                        </li>
                        <li>
                            <a href="#" class="photo"><i class="fas fa-address-card fa-lg"></i></a>
                            <h6><a href="customerprofile.php">Update Profile</a></h6>
                        </li>
                        <li>
                            <a href="#" class="photo"><i class="fas fa-cog fa-spin fa-lg"></i></a>
                            <h6><a href="changepassword.php">Change Password</a></h6>
                        </li>
                        <li>
                            <?php $qsqlmo = mysqli_query($con, "SELECT * FROM purchase WHERE customerid='$_SESSION[customerid]' AND status!='Pending' AND deliverystatus!='Delivered' AND deliverystatus!='Cancelled'");
                            ?>
                            <a href="#" class="photo"><i class="fab fa-opencart fa-lg"></i></a>
                            <h6><a href="viewcustpurchase.php">My order( <?php echo mysqli_num_rows($qsqlmo); ?> )</a></h6>
                        </li>
                        <li>
                            <?php $qsqlwl = mysqli_query($con, "SELECT * FROM wishlist WHERE wishlist.custid='$_SESSION[customerid]'");
                            ?>
                            <a href="#" class="photo"><i class="fas fa-heart fa-lg"></i></a>
                            <h6><a href="wishlist.php">Wishlist( <?php echo mysqli_num_rows($qsqlwl); ?> )</a></h6>
                        </li>
                        <li>
                            <a href="#" class="photo"><i class="fas fa-file-invoice fa-lg"></i></a>
                            <h6><a href="viewbilling.php">My Bills</a></h6>
                        </li>
                        <li class="total">
                            <?php $qsqlc = mysqli_query($con, "SELECT * FROM purchase WHERE customerid='$_SESSION[customerid]' AND status='Pending'");
                            ?>
                            <a href="cart.php" class="btn btn-default hvr-hover btn-cart"><i class="fas fa-cart-plus"></i> Cart( <?php echo mysqli_num_rows($qsqlc); ?> )</a>
                            <a href="logout.php" class="btn btn-default hvr-hover btn-cart"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>                        
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->


    </header>
    <!-- End Main Top -->
