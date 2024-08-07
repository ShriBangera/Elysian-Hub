<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_POST[submit]))
{
    $sql ="UPDATE employee set password='$_POST[npassword]' WHERE password='$_POST[opassword]' AND employeeid='$_SESSION[employeeid]'";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<SCRIPT>alert('Password updated successfully...');</SCRIPT>";
        echo "<script>window.location='index.php';</script>";
    }
    else
    {
        echo "<SCRIPT>alert('Failed to update password...Give Correct details');</SCRIPT>";
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
  .form-group input{
    color: black;
  }
</style>
<!-- ANWAR CSS ends-->

<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Change Password</h1>
</div>
<!-- Content Row -->
<div class="row">

  


 
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="contact-form-right">
                        <p>It is easy to change password</p>
                        <!--<form id="contactForm">-->                         
                        <form action="" method="post" name="frmform" onsubmit="return validateform()">   
                            <div class="row">
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Old password <span class="errmsg" id="idopassword"></span></label>
                                        <input type="password" name="opassword" placeholder="Enter Old Password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">New password <span class="errmsg" id="idnpassword"></span></label>
                                        <input type="password" name="npassword" placeholder="Enter New Password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Confirm password <span class="errmsg" id="idcpassword"></span></label>
                                        <input type="password" name="cpassword" placeholder="Enter Confirm Password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn btn-primary btn-icon-split btn-lg" name="submit" type="submit" value="Change Password">                                                                      
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>                
            </div>
        </div>
    </div>
         
</div>
<!-- Content Row -->








<?php
include('includes/scripts.php');
include('includes/footer.php');
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
                document.getElementById("idnpassword").innerHTML = "Password should contain atleat 6 charecters";
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
            if(document.frmform.opassword.value=="")
            {
                document.getElementById("idopassword").innerHTML = "Old Password should not be empty...";
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
        