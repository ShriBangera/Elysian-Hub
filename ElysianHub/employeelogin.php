<?php 
include 'header.php';
if(isset($_SESSION[employeeid]))
{
    echo "<script>window.location='admin/index.php';</script>";
}
if($_POST[btnsubmit])
{
    $sql ="SELECT * FROM employee WHERE loginid='$_POST[loginid]' AND password='$_POST[loginpassword]' AND status='Active'";
    $qsql = mysqli_query($con,$sql);
    if(mysqli_num_rows($qsql) == 1)
    {
        $rs = mysqli_fetch_array($qsql);
        $_SESSION['employeename'] = $rs[empname];
        $_SESSION['employeeid'] = $rs[employeeid];
        $_SESSION['emptype'] = $rs[emptype];
        echo "<script>alert('Logged in successfully.');</script>";
        echo "<script>window.location='admin/index.php';</script>";
    }
    else
    {
        echo "<script>alert('You have entered invalid login credentials.');</script>";
    }
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
                    <h2>Admin / Employee login</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"> login </li>
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
                        <h2>Welcome</h2>
                        <p>please enter your Login ID and Password to Login</p>
                        <!--<form id="contactForm">-->                         
                        <form action="" method="post" name="frmform" onsubmit="return validateform()">   
                            <div class="row">
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Login ID <span class="errmsg" id="idloginid"></span></label>
                                         <input type="text"  placeholder="Enter Login ID" name="loginid" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Password <span class="errmsg" id="idloginpassword"></span></label>
                                        <input type="password" placeholder="Enter your password" name="loginpassword" class="form-control">
                                    </div>
                                </div>                               
                                <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn hvr-hover" name="btnsubmit" type="submit" value="Login">
                                        <!--<a class="btn hvr-hover" data-fancybox-close="" href="login.php" style="color: red;background-color: transparent;">Already a member?Click here to Login</a>-->
                                        <!--<div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>-->
                                    </div>
                                </div>
                            </div>
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
                    if(document.frmform.loginid.value=="")
                    {
                        document.getElementById("idloginid").innerHTML="Login ID should not be empty...";
                        errcondition ="false";
                    }
                    if(document.frmform.loginpassword.value=="")
                    {
                        document.getElementById("idloginpassword").innerHTML = "Password should not be empty...";
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