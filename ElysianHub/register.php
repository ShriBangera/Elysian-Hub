<?php 
include 'header.php';
if(isset($_POST[submit]))
{
    $sql1 ="SELECT * FROM customer WHERE emailid='$_POST[emailid]' OR contactno='$_POST[contactno]'";
    $qsql1 = mysqli_query($con,$sql1);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql1) >= 1)
{
  echo "<SCRIPT>alert('Provided Email or Contact Number already registerd with this site. Try with another one.');</SCRIPT>";
}else{
    $sql ="INSERT INTO customer(customername,emailid,address,pincode,city,state,password,contactno,status) VALUES('$_POST[customername]','$_POST[emailid]','$_POST[address]','$_POST[pincode]','$_POST[city]','$_POST[state]','$_POST[password]','$_POST[contactno]','Active')";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    if(mysqli_affected_rows($con) == 1)
    {       
        echo "<SCRIPT>alert('Customer Registration done successfully...');</SCRIPT>";
        if(isset($_GET[productid]))
        {
        echo "<script>window.location='register.php?productid=$_GET[productid]';</script>";
        }
        else
        {
        echo "<script>window.location='register.php';</script>";
        }
    }
}
}
if(isset($_SESSION[customerid]))
{
    echo "<script>window.location='index.php';</script>";
}
/*if($_POST[btnsubmit])
{
    $sql ="SELECT * FROM customer WHERE (emailid='$_POST[loginusername]' OR contactno='$_POST[loginusername]') AND password='$_POST[loginpassword]' AND status='Active'";
    $qsql = mysqli_query($con,$sql);
    if(mysqli_num_rows($qsql) == 1)
    {
        $rs = mysqli_fetch_array($qsql);
        $_SESSION[customerid] = $rs[customerid];
        echo "<script>alert('Logged in successfully.');</script>";
        if(isset($_GET[productid]))
        {
        echo "<script>window.location='product-detail.php?productid=$_GET[productid]';</script>";
        }
        else
        {
        echo "<script>window.location='index.php';</script>";
        }
    }
    else
    {
        echo "<script>alert('You have entered invalid login credentials.');</script>";
    }
}*/
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
                    <h2>Register</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"> Register </li>
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
                        <p>please enter your correct details to register</p>
                        <!--<form id="contactForm">-->                         
                        <form action="" method="post" name="frmform" onsubmit="return validateform()">   
                            <div class="row">
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Customer Name <span class="errmsg" id="idcustomername"></span></label>
                                        <input type="text" placeholder="Enter your full name" class="form-control" name="customername" value="<?php echo $_POST[customername]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Email ID <span class="errmsg" id="idemailid"></span></label>
                                        <input type="email" name="emailid" placeholder="Enter your Email ID" class="form-control" value="<?php echo $_POST[emailid]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Address <span class="errmsg" id="idaddress"></span></label>
                                        <textarea name="address" placeholder="Enter Address" class="form-control"><?php echo $_POST[address]; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Pincode <span class="errmsg" id="idpincode"></span></label>
                                        <input type="number" name="pincode" placeholder="Enter Pincode" class="form-control" value="<?php echo $_POST[pincode]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">City <span class="errmsg" id="idcity"></span></label>
                                        <input type="text" name="city" placeholder="Enter City" class="form-control" value="<?php echo $_POST[city]; ?>">
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
         if($_POST[state]==$val)
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
                                       <label class="control-label">Contact No. <span class="errmsg" id="idcontactno"></span></label>
                                        <input type="number" name="contactno" placeholder="Enter your Contact No." class="form-control" value="<?php echo $_POST[contactno]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Password <span class="errmsg" id="idpassword"></span></label>
                                        <input type="password" name="password" placeholder="Enter your Password" class="form-control" value="<?php echo $_POST[password]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Confirm Password <span class="errmsg" id="idcpassword"></span></label>
                                        <input type="password" name="cpassword" placeholder="Re-Enter Password" class="form-control" value="<?php echo $_POST[cpassword]; ?>">
                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn hvr-hover" name="submit" type="submit" value="Create your Account">
                                        <a class="btn hvr-hover" data-fancybox-close="" href="login.php" style="color: red;background-color: transparent;">Already a member?Click here to Login</a>
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
    if(!document.frmform.customername.value.match(alphaspaceExp))
    {
        document.getElementById("idcustomername").innerHTML="Entered customer Name should contain only alphabets...";
        errcondition ="false";
    }
    if(document.frmform.customername.value=="")
    {
        document.getElementById("idcustomername").innerHTML = "Customer Name should not be empty...";
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
    if(document.frmform.password.value.length < 6)
    {
        document.getElementById("idpassword").innerHTML = "Entered Password should be atleast 6 characters....";
        errcondition ="false";  
    }
    if(document.frmform.password.value=="")
    {
        document.getElementById("idpassword").innerHTML = "Password should not be empty...";
        errcondition ="false";      
    }
        if(document.frmform.password.value!=document.frmform.cpassword.value)
    {
        document.getElementById("idcpassword").innerHTML = "Password and Confirm Password not matching.....";
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