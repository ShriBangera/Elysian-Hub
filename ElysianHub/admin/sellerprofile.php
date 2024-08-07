<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_POST['submit']))
{
    
    
   if ($_SESSION[emptype]=='Seller') 
   {
     $emsg = "";
    $sql2 ="SELECT * FROM seller WHERE (emailid='$_POST[emailid]' OR contactno='$_POST[contactno]') AND (status='Active' OR status='Pending') AND comp_id != '$_SESSION[comp_id]'";
    $qsql2 = mysqli_query($con,$sql2);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql2) >= 1)
    {
        $emsg.="Provided Email or Contact Number already registerd. ";
    }
    $sql3 ="SELECT * FROM seller WHERE loginid='$_POST[loginid]' AND (status='Active' OR status='Pending') AND comp_id != '$_SESSION[comp_id]'";
    $qsql3 = mysqli_query($con,$sql3);
    echo mysqli_error($con);
    if(mysqli_num_rows($qsql3) >= 1)
    {
        $emsg.="Provided Login ID already registerd. Try with another one.";
    }
    if($emsg!="")
    {
        echo "<SCRIPT>alert('$emsg');</SCRIPT>";
    }else{

     //coding to upload image starts here
  if ($_FILES[companylogo][name]!='') {
  $imgname= rand(). $_FILES[companylogo][name];
  move_uploaded_file($_FILES["companylogo"]["tmp_name"],"../imgcompany/".$imgname);
     }
  //coding to upload image ends here..

$companydetail = mysqli_real_escape_string($con,$_POST[companydetail]);

  //Step 4 : Update statement starts here
  $sql ="UPDATE seller  SET compname='$_POST[compname]',address='$_POST[address]',state='$_POST[state]',city='$_POST[city]',pincode='$_POST[pincode]',landmark='$_POST[landmark]',loginid='$_POST[loginid]',companydetail='$companydetail',pancardno='$_POST[panno]',emailid='$_POST[emailid]',contactno='$_POST[contactno]'";
  if($_FILES["companylogo"]["name"] != "")
  {
    $sql = $sql . ",companylogo = '$imgname'";
  }
  $sql = $sql . " where comp_id = '$_SESSION[comp_id]'";
  //echo $sql;
  $qsql = mysqli_query($con,$sql);
  echo mysqli_error($con);
  if(mysqli_affected_rows($con) == 1)
  {
    $_SESSION['sellername'] = $_POST['compname'];
  echo "<SCRIPT>alert('Seller Profile updated successfully...');</SCRIPT>";
  echo "<script>window.location='index.php';</script>";
  }
  else{
    echo "<SCRIPT>alert('you didnt made any change');</SCRIPT>";
  }
    }
  }

    elseif(isset($_GET[editid]))
{
  
      $sql = "UPDATE seller  SET status='$_POST[status]' WHERE comp_id='$_GET[editid]'";
      $qsql = mysqli_query($con,$sql);
      echo mysqli_error($con);
      if(mysqli_affected_rows($con) == 1)
      {
      echo "<SCRIPT>alert('Seller Profile updated successfully...');</SCRIPT>";
                //mailing information to customer 
                $sqlseller1 ="SELECT * FROM seller WHERE comp_id='$_GET[editid]'";
                $qsqlseller1 = mysqli_query($con,$sqlseller1);
                $rsseller1 = mysqli_fetch_array($qsqlseller1); 
                $to = $rsseller1['emailid'];
                $subject = "MeatZone Profile Updated";
                $txt = "<b>Hello $rsseller1[compname],</b> <br><br> Your Account Status is updated to <b>$_POST[status]</b>";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: meatzone.online";
                mail($to,$subject,$txt,$headers);
      echo "<script>window.location='viewseller.php';</script>";
  }
  else{
    echo "<SCRIPT>alert('you didnt made any change');</SCRIPT>";
  }
          
}
}

      if($_SESSION[emptype]=='Seller')
        {
        $sqledit = "SELECT * FROM seller WHERE comp_id='$_SESSION[comp_id]'";
        $qsqledit = mysqli_query($con,$sqledit);
        $rsedit = mysqli_fetch_array($qsqledit);
        }
        else {
          $sqledit = "SELECT * FROM seller WHERE comp_id='$_GET[editid]'";
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
  .form-group input{
    color: black;
  }
  .form-group textarea{
    color: black;
  }
  td,th{
    color: black;
  }
</style>
<!-- ANWAR CSS ends-->
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Seller Data</h1>
</div>
<!-- Content Row -->
<div class="row">

           <div class="col-md-8" style="margin: auto;overflow-x: auto;">          
        <form action="" method="post" enctype="multipart/form-data" name="frmform" onsubmit="return validateform()">
<input type="hidden" name="editid" id="editid" value="<?php echo $_GET['editid']; ?>" >
  <fieldset>
    
    <div class="form-group">
      <label class="control-label">Company name <span class="errmsg" id="idcompname"></span></label>
      <div class="controls">
        <input type="text" name="compname" placeholder="Enter Company name" class="form-control"value="<?php echo $rsedit[compname]; ?>" <?php if ($_SESSION[emptype]!='Seller') { echo "readonly";} ?> >
      </div>
    </div>


    <div <?php if ($_SESSION[emptype]!='Seller') {echo "style='display:none;'";} ?> >
                               
             <div class="form-group" >
            <label class="control-label">Email ID <span class="errmsg" id="idemailid"></span></label>
            <div class="controls">
              <input type="email" name="emailid" placeholder="Enter your Email ID" class="form-control" value="<?php echo $rsedit[emailid]; ?>">
            </div>
          </div>
                             
            <div class="form-group" >
              <label class="control-label">Contact No. <span class="errmsg" id="idcontactno"></span></label>
            <div class="controls">
             <input type="number" name="contactno" placeholder="Enter your Contact No." class="form-control" value="<?php echo $rsedit[contactno]; ?>">
            </div>
          </div>
    <div class="form-group" >
            <label class="control-label">Address <span class="errmsg" id="idaddress"></span></label>
            <div class="controls">
              <input type="text" name="address" placeholder="Enter your Address" class="form-control" value="<?php echo $rsedit[address]; ?>">
            </div>
          </div>

<div class="form-group">
            <label class="control-label">State<span class="errmsg" id="idstate"></span></label>
            <div class="controls">
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


     <div class="form-group">
            <label class="control-label">City <span class="errmsg" id="idcity"></span></label>
            <div class="controls">
              <input type="text" name="city" placeholder="Enter your City" class="form-control" value="<?php echo $rsedit[city]; ?>">
            </div>
          </div>

       <div class="form-group">
            <label class="control-label">Pincode <span class="errmsg" id="idpincode"></span></label>
            <div class="controls">
              <input type="number" name="pincode" placeholder="Enter Pin Code" class="form-control"  value="<?php echo $rsedit[pincode]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label">Landmark <span class="errmsg" id="idlandmark"></span></label>
            <div class="controls">
              <input type="text" name="landmark" placeholder="Enter your Landmark" class="form-control" value="<?php echo $rsedit[landmark]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label">PAN Number <span class="errmsg" id="idpanno"></span></label>
            <div class="controls">
              <input type="text" name="panno" placeholder="Enter Company PAN number" class="form-control" value="<?php echo $rsedit[pancardno]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label">Login ID <span class="errmsg" id="idloginid"></span></label>
            <div class="controls">
              <input type="text" name="loginid" placeholder="Enter your Login ID" class="form-control" value="<?php echo $rsedit[loginid]; ?>">
            </div>
          </div>
          <div class="form-group">
      <label class="control-label">Company detail <span class="errmsg" id="idcompanydetail"></span></label>
      <div class="controls">
        <textarea name="companydetail" placeholder="Enter Company detail" class="form-control"><?php echo $rsedit[companydetail]; ?></textarea>
      </div>
    </div>
<div class="form-group">
  <label class="control-label">Logo <span class="errmsg" id="idyourlogo"></span></label>
<div class="controls">
      <input type="file" name="companylogo"  class="form-control"></div></div>
</div>

<div <?php if ($_SESSION[emptype]=='Seller') {echo "style='display:none;'";} ?> >
  <div class="control-group">
      <label class="control-label">Status <span class="errmsg" id="idstatus"></span></label>
      <div class="controls" class="form-control">
        <select  class="form-control" name="status">
        <option value="">Select Status</option>
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
</div>  

    <hr>
                                <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn btn-primary btn-icon-split btn-lg" name="submit" type="submit" value="Submit">                                                                      
                                        
                                    </div>
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
      var panexp =  /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
      /*Regular Expressions ends*/

      $(".errmsg").html('');
      //alert("test test");
      var errcondition = "true";
if(document.frmform.editid.value=="")
{
      if(!document.frmform.compname.value.match(alphaspaceExp))
      {
        document.getElementById("idcompname").innerHTML="Entered Seller Name should contain alphabets...";
        errcondition ="false"; 
      }
      if(document.frmform.compname.value=="")
      {
        document.getElementById("idcompname").innerHTML = "Seller Name should not be empty...";
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
          document.getElementById("idcompanydetail").innerHTML = "Company Detail should not be empty...";
          errcondition ="false";    
        }
}
        if(!document.frmform.editid.value=="")
        {
          if(document.frmform.status.value=="")
        {
          document.getElementById("idstatus").innerHTML = "Status should not be empty...";
          errcondition ="false";    
        }    
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