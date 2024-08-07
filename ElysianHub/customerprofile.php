<?php 
include 'header.php';
if(isset($_POST[submit]))
{ 
    $sql1 ="SELECT * FROM customer WHERE (emailid='$_POST[emailid]' OR contactno='$_POST[contactno]') AND customerid!='$_SESSION[customerid]'";
    $qsql1 = mysqli_query($con,$sql1);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql1) >= 1)
    {
    echo "<SCRIPT>alert('Provided Email or Contact Number already registerd with this site. Try with another one.');</SCRIPT>";
    }else
    {
        //Step 4 : Update statement starts here
        $sql ="UPDATE customer SET customername='$_POST[customername]',emailid='$_POST[emailid]',address='$_POST[address]',pincode='$_POST[pincode]',city='$_POST[city]',state='$_POST[state]',contactno='$_POST[contactno]' where customerid='$_SESSION[customerid]'";
        $qsql = mysqli_query($con,$sql);
        mysqli_error($con);
        if(mysqli_affected_rows($con) == 1)
            {
            echo "<SCRIPT>alert('customer profile updated successfully...');</SCRIPT>";
            echo "<script>window.location='customerprofile.php';</script>";
            }
        //Step 4 : Update statement ends here
    }
}
if(isset($_SESSION[customerid]))
{
    $sqledit = "SELECT * FROM customer WHERE customerid='$_SESSION[customerid]'";
    $qsqledit = mysqli_query($con,$sqledit);
    $rsedit = mysqli_fetch_array($qsqledit);
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
                    <h2>My Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"> Profile </li>
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
                        <p>It is easy to Update your Data..</p>
                        <!--<form id="contactForm">-->                         
                        <form action="" method="post" name="frmform" onsubmit="return validateform()">   
                            <div class="row">
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Customer Name <span class="errmsg" id="idcustomername"></span></label>
                                        <input type="text" name="customername" placeholder="Enter Customer Name" class="form-control" value="<?php echo $rsedit[customername]; ?>" >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Email ID <span class="errmsg" id="idemailid"></span></label>
                                        <input type="email" name="emailid" placeholder="Enter Email ID" class="form-control" value="<?php echo $rsedit[emailid]; ?>">
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
                                        <input type="number" name="pincode" placeholder="Enter Pincode" class="form-control"
                                             value="<?php echo $rsedit[pincode]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">City <span class="errmsg" id="idcity"></span></label>
                                        <input type="text" name="city" placeholder="Enter City" class="form-control"
                                             value="<?php echo $rsedit[city]; ?>">
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
                                    if($val == $rsedit['state'])
                                    {
                                        echo "<option value='$val' selected>$val</option>";
                                    }
                                    else
                                    {
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
                                        <input type="number" name="contactno" placeholder="Enter Contact Number" class="form-control"  value="<?php echo $rsedit[contactno]; ?>">
                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn hvr-hover" name="submit" type="submit" value="Update Profile">
                                        <input class="btn hvr-hover" name="reset" type="reset" value="Reset">          <!--<div id="msgSubmit" class="h3 text-center hidden"></div>
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
                                                document.getElementById("idcustomername").innerHTML="Entered Customer Name should contain alphabets...";
                                                errcondition ="false";
                                            }
                                            if(document.frmform.customername.value=="")
                                            {
                                                document.getElementById("idcustomername").innerHTML = "Customer Name should not be empty...";
                                                errcondition ="false";      
                                            }
                                            if(document.frmform.emailid.value=="")
                                            {
                                                document.getElementById("idemailid").innerHTML = "Email id should not be empty...";
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