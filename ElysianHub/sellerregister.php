<?php 
include 'header.php';
if(isset($_POST[submit])) 
{  
    $emsg = "";
    $sql2 ="SELECT * FROM seller WHERE (emailid='$_POST[emailid]' OR contactno='$_POST[contactno]') AND (status='Active' OR status='Pending')";
    $qsql2 = mysqli_query($con,$sql2);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql2) >= 1)
    {
        $emsg.="Provided Email or Contact Number already registerd. Try with another one. ";
    }
    $sql3 ="SELECT * FROM seller WHERE loginid='$_POST[loginid]' AND (status='Active' OR status='Pending')";
    $qsql3 = mysqli_query($con,$sql3);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql3) >= 1)
    {
        $emsg.="Provided Login ID already registerd. Try with another one.";
    }
    if($emsg!="")
    {
        echo "<SCRIPT>alert('$emsg');</SCRIPT>";
    }
   else
    {
    //coding to upload image starts here
    $imgname= rand(). $_FILES[companylogo][name];
    move_uploaded_file($_FILES["companylogo"]["tmp_name"],"imgcompany/".$imgname);
    //coding to upload image ends here..

$companydetail = mysqli_real_escape_string($con,$_POST[companydetail]);

    $sql ="INSERT INTO seller(compname,emailid,contactno,address,state,city,pincode,landmark,loginid,password,companydetail,companylogo,status,pancardno) VALUES('$_POST[compname]','$_POST[emailid]','$_POST[contactno]','$_POST[address]','$_POST[state]','$_POST[city]','$_POST[pincode]','$_POST[landmark]','$_POST[loginid]','$_POST[password]','$companydetail','$imgname','Pending','$_POST[panno]')";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<SCRIPT>alert('Seller Registration completed successfully, Wait untill Meatzone Approve it...');</SCRIPT>";
        echo "<script>window.location='index.php';</script>";
    }
}
}
if($_SESSION[emptype]=='Seller')
{
    echo "<script>window.location='index.php';</script>";
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
                    <h2>Seller Registration</h2>
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
                        <p>Hey! Register here.We make easy to sell your products</p>
                        <!--<form id="contactForm">-->                         
                        <form action="" method="post" name="frmform" enctype="multipart/form-data" onsubmit="return validateform()">   
                            <div class="row">
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Company name <span class="errmsg" id="idcompname"></span></label>
                                        <input type="text" name="compname" placeholder="Enter Company name" class="form-control" value="<?php echo $_POST[compname]; ?>">
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
                                        <label class="control-label">Contact No. <span class="errmsg" id="idcontactno"></span></label>
                                        <input type="number" name="contactno" placeholder="Enter your Contact No." class="form-control" value="<?php echo $_POST[contactno]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Address <span class="errmsg" id="idaddress"></span></label>
                                        <input type="text" name="address" placeholder="Enter your Address" class="form-control" value="<?php echo $_POST[address]; ?>">
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
                                       <label class="control-label">City <span class="errmsg" id="idcity"></span></label>
                                        <input type="text" name="city" placeholder="Enter your City" class="form-control" value="<?php echo $_POST[city]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Pincode <span class="errmsg" id="idpincode"></span></label>
                                        <input type="number" name="pincode" placeholder="Enter Pin Code" class="form-control"  value="<?php echo $_POST[pincode]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Landmark <span class="errmsg" id="idlandmark"></span></label>
                                        <input type="text" name="landmark" placeholder="Enter your Landmark" class="form-control" value="<?php echo $_POST[landmark]; ?>">
                                    </div>
                                </div>

                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">PAN Number <span class="errmsg" id="idpanno"></span></label>
                                        <input type="text" name="panno" placeholder="Enter Company PAN number EX:ABCSD4354H" class="form-control" value="<?php echo $_POST[panno]; ?>">
                                    </div>
                                </div>

                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Login ID <span class="errmsg" id="idloginid"></span></label>
                                       <input type="text" name="loginid" placeholder="Enter your Login ID" class="form-control" value="<?php echo $_POST[loginid]; ?>">
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
                                       <label class="control-label"> Confirm Password <span class="errmsg" id="idcpassword"></span></label>
                                       <input type="password" name="cpassword" placeholder="Enter your Confirm Password" value="<?php echo $_POST[cpassword]; ?>" class="form-control">
                                    </div>
                                </div>

                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Company detail(Something about you) <span class="errmsg" id="idcompanydetail"></span></label>
                                       <textarea name="companydetail" placeholder="Enter Company detail" class="form-control"><?php echo $_POST[companydetail]; ?></textarea>
                                    </div>
                                </div>

                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Company Logo <span class="errmsg" id="idcompanylogo"></span></label>
                                       <input type="file" name="companylogo" placeholder="Enter Company logo" class="form-control">
                <?php
                if(isset($_GET[editid]))
                {
                    echo "<img src='imgcompany/$rsedit[companylogo]' style='height:250px;'>";
                }
                ?>
                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn hvr-hover" name="submit" type="submit" value="Submit">
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
            var panexp =  /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
            /*Regular Expressions ends*/

            $(".errmsg").html('');
            //alert("test test");
            var errcondition = "true";
            if(!document.frmform.compname.value.match(alphaspaceExp))
            {
                document.getElementById("idcompname").innerHTML="Entered Company Name should contain alphabets...";
                errcondition ="false";
            }
            if(document.frmform.compname.value=="")
            {
                document.getElementById("idcompname").innerHTML = "Company Name should not be empty...";
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
            if(document.frmform.address.value=="")
            {
                document.getElementById("idaddress").innerHTML = "Address should not be empty...";
                errcondition ="false";      
            }
            if(document.frmform.state.value=="")
            {
                document.getElementById("idstate").innerHTML = "State should not be empty...";
                errcondition ="false";      
            }
            if(document.frmform.city.value=="")
            {
                document.getElementById("idcity").innerHTML = "City  should not be empty...";
                errcondition ="false";      
            }
            if(document.frmform.pincode.value.length != 6)
                {
                    document.getElementById("idpincode").innerHTML = "Pincode should contain 6 digits...";
                    errcondition ="false";  
                }
            if(document.frmform.pincode.value=="")
            {
                document.getElementById("idpincode").innerHTML = "Pincode should not be empty...";
                errcondition ="false";      
            }
            if(document.frmform.landmark.value=="")
            {
                document.getElementById("idlandmark").innerHTML = "Landmark should not be empty...";
                errcondition ="false";      
            }
            if(document.frmform.loginid.value=="")
            {
                document.getElementById("idloginid").innerHTML = "Login ID should not be empty...";
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
            if(!document.frmform.panno.value.match(panexp))
                {
                   document.getElementById("idpanno").innerHTML="PAN Number is Not valid";
                   errcondition ="false";
                }
            
            if(document.frmform.panno.value.length != 10)
                {
                    document.getElementById("idpanno").innerHTML = "Entered PAN Number should be 10 characters....";
                    errcondition ="false";  
                }
            if(document.frmform.panno.value=="")
                {
                    document.getElementById("idpanno").innerHTML = "PAN Number should not be empty...";
                    errcondition ="false";      
                }
            if(document.frmform.companydetail.value=="")
                {
                    document.getElementById("idcompanydetail").innerHTML = "Company details should not be empty...";
                    errcondition ="false";      
                }
            if(document.frmform.companylogo.value=="")
                {
                    document.getElementById("idcompanylogo").innerHTML = "Company Logo should not be empty...";
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