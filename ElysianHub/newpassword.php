<?php 
include 'header.php';
if(isset($_SESSION['customerid']))
{
    echo "<script>window.location='index.php';</script>";
}
if(!isset($_SESSION['custnewpasswordid']))
{
    echo "<SCRIPT>alert('Please apply to get Password Reset link through mail.');</SCRIPT>";
    echo "<script>window.location='recoverpassword.php';</script>";
}
if(isset($_POST['submit']))
{
    $sql ="UPDATE customer set password='$_POST[npassword]' WHERE  customerid='$_SESSION[custnewpasswordid]'";
    
    
    if($qsql = mysqli_query($con,$sql))
    {
        echo "<SCRIPT>alert('Password updated successfully...');</SCRIPT>";
        echo "<script>window.location='login.php';</script>";
    }
    else
    {
        echo "<SCRIPT>alert('Failed to update password...');</SCRIPT>";
    }
    echo mysqli_error($con);
}
?>
<!-- ANWAR CSS starts-->
<style type="text/css">
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
                    <h2>Change Password</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"> Change password </li>
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
                <div class="col-lg-12 col-sm-12">
                    <div class="contact-form-right">
                        <p>Change your password easily by filling correct data</p>
                        <!--<form id="contactForm">-->                         
<form action="" method="post" name="frmform" onsubmit="return validateform()">
    <fieldset>
        <div class="form-group">
            <label class="control-label">New password <span class="errmsg" id="idnpassword"></span></label>
            <div class="controls">
                <input type="password" name="npassword" placeholder="Enter New Password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Confirm password <span class="errmsg" id="idcpassword"></span></label>
            <div class="controls">
                <input type="password" name="cpassword" placeholder="Enter Confirm Password" class="form-control">
            </div>
        </div>
        <hr>
       <div class="submit-button text-center">                                        
                                        <input class="btn hvr-hover" type="submit" value="Change Password" name="submit">
                                        <!--<a class="btn hvr-hover" data-fancybox-close="" href="recoverpassword.php" style="color: red;background-color: transparent;">Click here to Recover Password..</a>-->
                                        <!--<div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>-->
        </div>
    </fieldset>
</form> 
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
            function validateform()
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
            if(document.frmform.npassword.value.length < 6)
            {
                document.getElementById("idnpassword").innerHTML = "Entered Password should be atleast 6 characters....";
                errcondition ="false";  
            }
            if(document.frmform.npassword.value=="")
            {
                document.getElementById("idnpassword").innerHTML = "New Password should not be empty...";
                errcondition ="false";      
            }
            if(document.frmform.npassword.value!=document.frmform.cpassword.value)
            {
                document.getElementById("idcpassword").innerHTML = "Password and Confirm Password not matching...";
                errcondition ="false";      
            }
            if(document.frmform.cpassword.value=="")
            {
                document.getElementById("idcpassword").innerHTML = "Confirm Password should not be empty...";
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