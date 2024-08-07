<?php 
include 'header.php';
if(isset($_SESSION[comp_id]))
{
	echo "<script>window.location='admin/index.php';</script>";
}
if($_POST[btnsubmit])
{
	$sql ="SELECT * FROM seller WHERE loginid='$_POST[sellerloginid]' AND password='$_POST[sellerloginpassword]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
        $_SESSION['sellername'] = $rs['compname'];
		$_SESSION['comp_id'] = $rs['comp_id'];
		$_SESSION['emptype'] = "Seller";
		echo "<script>alert('Logged in successfully.');</script>";
		echo "<script>window.location='admin/index.php';</script>";
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials...');</script>";
	}
}
?>
<!-- ANWAR CSS starts-->
<style type="text/css">
  #registerbox{
    background-color: rgba(193,222,47,0.7);
    background-image:none;
  }
  .form-group label{
    font-weight: bold;
  }
  .errmsg{
    color: red;
  }
</style>
<!-- ANWAR CSS ends-->
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Seller Login</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"> Login </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Welcome</h2>
                        <p>please enter your Login ID and Password to Login</p>
                        <!--<form id="contactForm">-->
                        <form action="" method="post"  name="frmform1" onsubmit="return validateform1()">    
                            <div class="row">
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Login ID <span class="errmsg" id="idsellerloginid"></span></label>
                                        <input type="text"  placeholder="Enter your Login ID" name="sellerloginid" id="sellerloginid" class="form-control">
                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Password <span class="errmsg" id="idsellerloginpassword"></span></label>
                                        <input type="password" placeholder="Enter your Password" name="sellerloginpassword" class="form-control">
                                    </div>
                                    <div class="submit-button text-center">                                        
                                        <input class="btn hvr-hover" type="submit" value="Sign in" name="btnsubmit">
                                        <!--<a class="btn hvr-hover" data-fancybox-close="" href="recoverpassword.php" style="color: red;background-color: transparent;">Click here to Recover Password..</a>-->
                                        <!--<div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>-->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
				<div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left" id="registerbox">
                        <h2>Don't have an Seller account&#63;</h2>
                        <p>Create your Seller Account. It's free and only takes a minnute.</p>
                        <a class="btn hvr-hover" data-fancybox-close="" href="sellerregister.php" style="color: white;">Register Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

<?php
include 'ourpartners.php';
include 'footer.php';
?>
     <script>	
		     function validateform1()
{ 
	/*Regular Expressions starts*/
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaspaceExp = /^[a-zA-Z\s]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,8}$/;
	/*Regular Expressions ends*/
	 
	$(".errmsg").html('');
	//alert("test test");
	var errcondition = "true";
	if(document.frmform1.sellerloginid.value=="")
	{
		document.getElementById("idsellerloginid").innerHTML="Login ID should not be empty..";
        errcondition ="false";
	}
	if(document.frmform1.sellerloginpassword.value=="")
	{
		document.getElementById("idsellerloginpassword").innerHTML = "Password should not be empty...";
		errcondition ="false";		
	}
		if(errcondition == "true")
	{
		return true;
	}
	else
	{
		return false;
	}
}
    </script>	