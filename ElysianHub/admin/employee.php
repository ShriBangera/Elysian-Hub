<?php
include('includes/header.php'); 
include('includes/navbar.php');
if(isset($_GET[editid]))
        {
          $sqledit = "SELECT * FROM employee WHERE employeeid='$_GET[editid]'";
          $qsqledit = mysqli_query($con,$sqledit);
          $rsedit = mysqli_fetch_array($qsqledit);
        } 
if(isset($_POST[submit]))
{ 
    if(isset($_GET[editid]))
    {
         if($rsedit[emptype]!='Admin')
         {
            $bs = $_POST[basicsalary];
         }
        else
            {
                $bs = 0.00;
            }
        //Step 4 : Update statement starts here
        $sql ="UPDATE employee SET basicsalary='$bs',status='$_POST[status]' where employeeid ='$_GET[editid]'";
        $qsql = mysqli_query($con,$sql);
        echo mysqli_error($con);
        if(mysqli_affected_rows($con) == 1)
        {       if($rsedit[emptype]=='Admin')
                {
                    $message = "Your Status is updated to <b>$_POST[status]</b>";
                }else
                {
                    $message = "Your current Status is <b>$_POST[status]</b> <br>Your current Basic Pay is <b>$bs</b>";
                }
                //mailing information to customer 
                $sqlseller1 ="SELECT * FROM employee where employeeid ='$_GET[editid]'";
                $qsqlseller1 = mysqli_query($con,$sqlseller1);
                $rsseller1 = mysqli_fetch_array($qsqlseller1); 
                $to = $rsseller1['emailid'];
                $subject = "MeatZone Profile Updated";
                $txt = "<b>Hello $rsseller1[empname],</b> <br><br> $message";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: meatzone.online";
                mail($to,$subject,$txt,$headers);
        echo "<SCRIPT>alert('employee record updated successfully...');</SCRIPT>";
        echo "<script>window.location='viewemployee.php';</script>";
        }
        //Step 4 : Update statement ends here
    }
    else
    {
        if ($_POST[emptype]=='Employee') 
        {
            $bs = $_POST[basicsalary];
        }
        else
        {
            $bs = 0.00;
        } 
        $date = date("Y-m-d");
        $emsg = "";
    $sql2 ="SELECT * FROM employee WHERE (emailid='$_POST[emailid]' OR contactno='$_POST[contactno]') AND (status='Active')";
    $qsql2 = mysqli_query($con,$sql2);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql2) >= 1)
    {
        $emsg.="Provided Email or Contact Number already registerd. Try with another one. ";
    }
    $sql3 ="SELECT * FROM employee WHERE loginid='$_POST[loginid]' AND status='Active'";
    $qsql3 = mysqli_query($con,$sql3);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql3) >= 1)
    {
        $emsg.="Provided Login ID already registerd. Try with another one.";
    }
    if($emsg!="")
    {
        echo "<SCRIPT>alert('$emsg');</SCRIPT>";
        echo "<script>window.location='employee.php';</script>";
    }
    else
       {
        $sql ="INSERT INTO employee(empname,emptype,loginid,password,status,joindate,basicsalary,emailid,address,pincode,city,state,adharno,contactno) VALUES('$_POST[empname]','$_POST[emptype]','$_POST[loginid]','$_POST[password]','$_POST[status]','$date','$bs','$_POST[emailid]','$_POST[address]','$_POST[pincode]','$_POST[city]','$_POST[state]','$_POST[adharno]','$_POST[contactno]')";
       $qsql = mysqli_query($con,$sql);
       echo mysqli_error($con);
            if(mysqli_affected_rows($con) == 1)
            {
            echo "<SCRIPT>alert('Employee record inserted successfully...');</SCRIPT>";
                //mailing information to employee 
                $currenturl = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/../employeelogin.php";
                $to = $_POST[emailid];
                $subject = "MeatZone Employee login Credentials";
                $txt = "<b>Welcome $_POST[empname],</b> <br><br> Please <a href='$currenturl'><b>Login</b></a> using given data and Reset your password.<br>Your Login ID - <b>$_POST[loginid]</b><br>Your present Password - <b>$_POST[password]</b>";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: meatzone.online";
                mail($to,$subject,$txt,$headers);
            echo "<script>window.location='employee.php';</script>";
            }
        }
    
    }       
}
//Step 1 : Link from viewemployee.php
    //Step 2 : Select record from database starts here
     
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
<h1 class="h3 mb-0 text-gray-800">
<?php
if(isset($_GET[editid]))
{echo $rsedit[empname];}else {echo "Employee Registration";}
?>    
</h1>
</div>
<!-- Content Row -->
<div class="row">
  

            
      <div class="col-md-8" style="margin: auto;">                           
                     
<form action="" method="post" name="frmform" onsubmit="return <?php if(isset($_GET[editid])){echo"validateform2";}else{echo"validateform";}?>()" >
    <fieldset>
        <?php if(!isset($_GET[editid])) { ?>
        <div class="form-group">
            <label class="control-label">Employee Name <span class="errmsg" id="idempname"></span></label>
            <div class="controls">
                <input type="text" name="empname" placeholder="Enter Employee Name" class="form-control" value="<?php echo $rsedit[empname]; ?>">
            </div>
        </div>
    <?php } ?>
    <?php if(!isset($_GET[editid])) { ?>
        <div class="form-group" >
            <label class="control-label">Employee type <span class="errmsg" id="idemptype"></span></label>
            <div class="controls">
                <select name="emptype" onchange="employeeoradmin()" >
                    <option value="">Select Employee type </option>
                    <?php
                            if("Employee" == $rsedit[emptype])
                            {
                            echo "<option id='Employee' value='Employee' selected>Employee</option>";
                            //echo "<option id='Admin' value='Admin'>Admin</option>";
                            }
                            elseif ("Admin" == $rsedit[emptype]) {
                            echo "<option id='Admin' value='Admin' selected>Admin</option>";
                            //echo "<option id='Employee' value='Employee'>Employee</option>";
                            }
                            else
                            {
                            echo "<option id='Employee' value='Employee'>Employee</option>";
                            echo "<option id='Admin' value='Admin'>Admin</option>";
                            }
                        
                    ?>
                </select>
            </div>
        </div>
    <?php } ?>
<?php //if($rsedit[emptype]=='Admin') { echo "readonly"; } ?>
<?php if($rsedit[emptype]!='Admin') { ?>
<div class="form-group" id="basicsalarycontrol">
            <label class="control-label">Basic Salary <span class="errmsg" id="idbasicsalary"></span></label> 
            <div class="controls">
                <input type="number" name="basicsalary" id="customidbs" placeholder="Enter Basic Salary" class="form-control" value="<?php echo $rsedit[basicsalary]; ?>" >
            </div>
        </div>
    <?php } ?>

    <?php if(!isset($_GET[editid])) { ?>

                                    <div class="form-group">
                                        <label class="control-label">Email ID <span class="errmsg" id="idemailid"></span></label>
                                        <input type="email" name="emailid" placeholder="Enter your Email ID" class="form-control" value="<?php echo $rsedit[emailid]; ?>">
                                    </div>
                                

                                
                                    <div class="form-group">
                                        <label class="control-label">Address <span class="errmsg" id="idaddress"></span></label>
                                        <textarea name="address" placeholder="Enter Address" class="form-control"><?php echo $rsedit[address]; ?></textarea>
                                    </div>
                                

                                
                                    <div class="form-group">
                                       <label class="control-label">Pincode <span class="errmsg" id="idpincode"></span></label>
                                        <input type="number" name="pincode" placeholder="Enter Pincode" class="form-control" value="<?php echo $rsedit[pincode]; ?>">
                                    </div>

                                    <div class="form-group">
                                       <label class="control-label">City <span class="errmsg" id="idcity"></span></label>
                                        <input type="text" name="city" placeholder="Enter City" class="form-control" value="<?php echo $rsedit[city]; ?>">
                                    </div>
                                

                                
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
                                

                                
                                    <div class="form-group">
                                       <label class="control-label">Adhar card No. <span class="errmsg" id="idadharno"></span></label>
                                        <input type="number" name="adharno" placeholder="Enter Adhar Card No." class="form-control" value="<?php echo $rsedit[adharno]; ?>">
                                    </div>
                                

                                
                                    <div class="form-group">
                                       <label class="control-label">Contact No. <span class="errmsg" id="idcontactno"></span></label>
                                        <input type="number" name="contactno" placeholder="Enter your Contact No." class="form-control" value="<?php echo $rsedit[contactno]; ?>">
                                    </div>
                                


        <div class="form-group">
            <label class="control-label">Login ID <span class="errmsg" id="idloginid"></span></label> 
            <div class="controls">
                <input type="text" name="loginid" placeholder="Enter Login ID" class="form-control" value="<?php echo $rsedit[loginid]; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Password <span class="errmsg" id="idpassword"></span></label>
            <div class="controls">
                <input type="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo $rsedit[password]; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Confirm Password <span class="errmsg" id="idcpassword"></span></label>
            <div class="controls">
                <input type="password" name="cpassword" placeholder="Enter Confirm Password" class="form-control" value="<?php echo $rsedit[cpassword]; ?>">
            </div>
        </div>
        <?php } ?>
        <div class="form-group">
            <label class="control-label">Status <span class="errmsg" id="idstatus"></span></label>
            <div class="controls" class="form-control">
                <select  class="form-control" name="status">
                <option value="">Select status</option>
                <?php
                $arr = array("Active","Inactive");
                foreach($arr as $val)
                {
                    if($val == $rsedit[status])
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
        <hr>
                                <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                    <input class="btn btn-primary btn-icon-split btn-lg" name="submit" type="submit" value="Submit">
                                    <input class="btn btn-warning btn-icon-split btn-lg" name="reset" type="reset" value="Reset">   </div>
                                </div>

    </fieldset>
</form>                 
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
            
                if(!document.frmform.empname.value.match(alphaspaceExp))
               {
               document.getElementById("idempname").innerHTML="Entered Employee Name should contain alphabets...";
               errcondition ="false";
               } 
                if(document.frmform.empname.value=="")
                {
                    document.getElementById("idempname").innerHTML = "Employee Name should not be empty...";
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
                if(document.frmform.emptype.value=="")
                {
                    document.getElementById("idemptype").innerHTML = "Employee type should not be empty...";
                    errcondition ="false";      
                }

                
                if(document.frmform.status.value=="")
                {
                    document.getElementById("idstatus").innerHTML = "Status should not be empty...";
                    errcondition ="false";      
                }
                if (document.getElementById("Employee").selected) {
                if(document.frmform.basicsalary.value=="")
                {
                    document.getElementById("idbasicsalary").innerHTML = "Basic Salary should not be empty...";
                     errcondition ='false'; }   
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

<script>
        function validateform2()
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
            if(document.frmform.contains(document.getElementById('customidbs'))){
            if(document.frmform.basicsalary.value=="")
                {
                    document.getElementById("idbasicsalary").innerHTML = "Basic Salary should not be empty...";
                     errcondition ='false';   
                }
               } 
                if(document.frmform.status.value=="")
                {
                    document.getElementById("idstatus").innerHTML = "Status should not be empty...";
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
    <script>
    function employeeoradmin() {
        if (document.getElementById("Employee").selected) {
            document.getElementById("basicsalarycontrol").style.display = "block";
        }
         else{
            document.getElementById("basicsalarycontrol").style.display = "none";
        }
    }
    </script>  
    <script>
    window.onload = employeeoradmin();
    </script>