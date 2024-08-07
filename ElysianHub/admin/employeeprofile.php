<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_POST[submit]))
{
    $emsg="";
    $sql2 ="SELECT * FROM employee WHERE (emailid='$_POST[emailid]' OR contactno='$_POST[contactno]') AND (status='Active') AND employeeid!='$_SESSION[employeeid]'";
    $qsql2 = mysqli_query($con,$sql2);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql2) >= 1)
    {
        $emsg.="Provided Email or Contact Number already registerd. Try with another one. ";
    }
    $sql3 ="SELECT * FROM employee WHERE loginid='$_POST[loginid]' AND status='Active' AND employeeid!='$_SESSION[employeeid]'";
    $qsql3 = mysqli_query($con,$sql3);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql3) >= 1)
    {
        $emsg.="Provided Login ID already registerd. Try with another one.";
    }
    if($emsg!="")
    {
        echo "<SCRIPT>alert('$emsg');</SCRIPT>";
        echo "<script>window.location='employeeprofile.php';</script>";
    }else
    {
    
    $sql="UPDATE employee SET empname='$_POST[empname]',loginid='$_POST[loginid]',emailid='$_POST[emailid]',address='$_POST[address]',pincode='$_POST[pincode]',city='$_POST[city]',state='$_POST[state]',adharno='$_POST[adharno]',contactno='$_POST[contactno]' where employeeid='$_SESSION[employeeid]'";
      $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
      mysqli_error($con);
      if(mysqli_affected_rows($con) == 1)
      {
        $_SESSION['employeename'] = $_POST[empname];
    echo "<SCRIPT>alert('Employee profile updated successfully...');</SCRIPT>";
    echo "<script>window.location='index.php';</script>";
      }
  }
    //Step 4 : Update statement ends here   
}
//Step 1 : Link from viewemployee.php
//Step 2 : Select record from database starts here
if(isset($_SESSION[employeeid]))
{
  $sqledit = "SELECT * FROM employee WHERE employeeid='$_SESSION[employeeid]'";
  $qsqledit = mysqli_query($con,$sqledit);
  $rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2 : Select record from database ends here
//Step 3 : Display record in the form
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
  .form-group textarea{
    color: black;
  }
</style>
<!-- ANWAR CSS ends-->

<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Employee Profile</h1>
</div>
<!-- Content Row -->
<div class="row">

  


 <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="contact-form-right">
                        <p>You can update your profile here..</p>
                        <!--<form id="contactForm">-->                         
                        <form action="" method="post" name="frmform" onsubmit="return validateform()">   
                            <div class="row">
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Employee Name <span class="errmsg" id="idempname"></span></label>
                                        <input type="text" placeholder="Enter your full name" class="form-control" name="empname" value="<?php echo $rsedit[empname]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Email ID <span class="errmsg" id="idemailid"></span></label>
                                        <input type="email" name="emailid" placeholder="Enter your Email ID" class="form-control" value="<?php echo $rsedit[emailid]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Address <span class="errmsg" id="idaddress"></span></label>
                                        <textarea name="address" placeholder="Enter Address" class="form-control"><?php echo $rsedit[address]; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Pincode <span class="errmsg" id="idpincode"></span></label>
                                        <input type="number" name="pincode" placeholder="Enter Pincode" class="form-control" value="<?php echo $rsedit[pincode]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">City <span class="errmsg" id="idcity"></span></label>
                                        <input type="text" name="city" placeholder="Enter City" class="form-control" value="<?php echo $rsedit[city]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">State <span class="errmsg" id="idstate"></span></label>
                                        <select name="state">
    <option value="">Select State</option>
    <?php
    $arr = array("Andaman and Nicobar Islands","Andhra Pradesh","Arunachal Pradesh","Assam","Bihar","Chandigarh","Chhattisgarh","Dadra and Nagar Haveli","Daman and Diu","Delhi","Goa","Gujarat","Haryana","Himachal Pradesh","Jammu and Kashmir","Jharkhand","Karnataka","Kerala","Lakshadweep","Madhya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Orissa","Pondicherry","Punjab","Rajasthan","Sikkim","Tamil Nadu","Tripura","Tripura","Uttaranchal","Uttar Pradesh","West Bengal");
    foreach($arr as $val)
    {
         if($rsedit[state]==$val)
         {echo "<option value='$val' selected>$val</option>";}
        else{
        echo "<option value='$val'>$val</option>";
          }
    }
    ?>
</select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Adhar card No. <span class="errmsg" id="idadharno"></span></label>
                                        <input type="number" name="adharno" placeholder="Enter Adhar Card No." class="form-control" value="<?php echo $rsedit[adharno]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Contact No. <span class="errmsg" id="idcontactno"></span></label>
                                        <input type="number" name="contactno" placeholder="Enter your Contact No." class="form-control" value="<?php echo $rsedit[contactno]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Login ID <span class="errmsg" id="idloginid"></span></label>
                                        <input type="text" name="loginid" placeholder="Enter Login ID" class="form-control" value="<?php echo $rsedit[loginid]; ?>">
                                    </div>
                                </div>

                                
                              
                                <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn btn-primary btn-icon-split btn-lg" name="submit" type="submit" value="Submit">                                                                      
                                        
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
<script type="text/javascript">
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
    if(!document.frmform.empname.value.match(alphaspaceExp))
    {
        document.getElementById("idempname").innerHTML="Entered Employee Name should contain only alphabets...";
         errcondition ="false"; 
    }
    if(document.frmform.empname.value=="")
    {
        document.getElementById("idempname").innerHTML = "Employee Name should not be empty...";
        errcondition ="false";      
    }
    if(!document.frmform.emailid.value.match(emailExp))
    {
        document.getElementById("idemailid").innerHTML="Entered Email ID is not valid...";
        errcondition ="false";
    }
    if(document.frmform.emailid.value=="")
    {
        document.getElementById("idemailid").innerHTML = "Email ID  should not be empty...";
        errcondition ="false";      
    }
    if(document.frmform.address.value=="")
                {
                    document.getElementById("idaddress").innerHTML = "Address should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.pincode.value.length != 6)
                {
                    document.getElementById("idpincode").innerHTML = "Pincode should contain 6 digits numeric value...";
                    errcondition ="false";  
                }
                if(document.frmform.pincode.value=="")
                {
                    document.getElementById("idpincode").innerHTML = "Pincode should not be empty...";
                    errcondition ="false";      
                }
                if(!document.frmform.city.value.match(alphaspaceExp))
                {
                    document.getElementById("idcity").innerHTML = "City name should contain alphabets";
                    errcondition ="false";      
                }
                if(document.frmform.city.value=="")
                {
                    document.getElementById("idcity").innerHTML = "City should not be empty...";
                    errcondition ="false";      
                }                
                if(document.frmform.state.value=="")
                {
                    document.getElementById("idstate").innerHTML = "State should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.adharno.value.length != 12)
    {
        document.getElementById("idadharno").innerHTML = "Adhar Number should contain 12 digits numeric value...";
        errcondition ="false";  
    }
    if(document.frmform.adharno.value=="")
    {
        document.getElementById("idadharno").innerHTML = "Adhar Number should not be empty...";
        errcondition ="false";      
    }
    if(document.frmform.contactno.value.length != 10)
    {
        document.getElementById("idcontactno").innerHTML = "Contact Number should contain 10 digits numeric value...";
        errcondition ="false";  
    }
    if(document.frmform.contactno.value=="")
    {
        document.getElementById("idcontactno").innerHTML = "Contact Number should not be empty...";
        errcondition ="false";      
    }
    if(document.frmform.loginid.value=="")
    {
        document.getElementById("idloginid").innerHTML = "Login ID should not be empty...";
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