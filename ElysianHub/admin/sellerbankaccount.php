<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_POST['btnreg']))
{
  if($_POST['accid'] != 0)
  {
    $qry = "UPDATE tblselleraccount set accountno='".$_POST['account']."',bankname='".$_POST['bankname']."',branch='".$_POST['branch']."' where sellerid='".$_SESSION["comp_id"]."'";
    
  }
  else{
    $qry = "insert into tblselleraccount(sellerid,accountno,bankname,branch) values('".$_SESSION["comp_id"]."','".$_POST['account']."','".$_POST['bankname']."','".$_POST['branch']."')";
  }
  
  if(mysqli_query($con,$qry))
  {
    echo "<script>alert('Account Details Updated!!!');window.location='index.php';</script>";
  }
}

$sql = mysqli_query($con, "select * from tblselleraccount where sellerid=".$_SESSION["comp_id"]);
$result = mysqli_fetch_array($sql);
if(mysqli_num_rows($sql) > 0)
{
  $actid = $result[0];
  $acc = $result['accountno'];
  $bank = $result['bankname'];
  $branch = $result['branch'];
}
else
{
  $actid = 0;
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
<h1 class="h3 mb-0 text-gray-800">Bank Account Details</h1>
</div>

<!-- Content Row -->
<div class="row">
<div class="col-md-8" style="margin: auto;overflow-x: auto;">
<form action="" method="post" name="frmform" onsubmit="return validateform()">
  <fieldset>
    
    <div class="form-group">
      <label class="control-label">Bank Name <span class="errmsg" id="idbankname"></span></label>
      <div class="controls">
        <input type="hidden" value="<?php echo $actid; ?>" name="accid" />
        <input type="text" name="bankname" placeholder="Enter Bank name" class="form-control" id="bankname" value="<?php echo $bank; ?>">
      </div>
    </div>
    <div class="form-group">
            <label class="control-label">Branch Name <span class="errmsg" id="idbranch"></span></label>
            <div class="controls">
              <input type="text" id="branch" name="branch" placeholder="Enter Branch Name" class="form-control" value="<?php echo $branch; ?>">
            </div>
          </div>



          <div class="form-group">
            <label class="control-label">Account Number <span class="errmsg" id="idaccountnumber"></span></label>
            <div class="controls">
              <input type="number" name="account" id="account" placeholder="Enter Account No." class="form-control" pattern="[0-9]{15,16}" title="Enter valid bank account number." value="<?php echo $acc; ?>">
            </div>
          </div>
          



    <hr>
                                   <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn btn-primary btn-icon-split btn-lg" name="btnreg" type="submit" value="Submit">                                                                      
                                        
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
      /*Regular Expressions ends*/

      $(".errmsg").html('');
      //alert("test test");
      var errcondition = "true";
      if(!document.frmform.bankname.value.match(alphaspaceExp))
      {
        document.getElementById("idbankname").innerHTML="Entered Bank Name should contain alphabets...";
        errcondition ="false";    
      }
      if(document.frmform.bankname.value=="")
      {
        document.getElementById("idbankname").innerHTML = "Bank Name should not be empty...";
        errcondition ="false";    
      }
      if(document.frmform.branch.value=="")
      {
        document.getElementById("idbranch").innerHTML = "Branch should not be empty...";
        errcondition ="false";    
      }
      if(document.frmform.account.value.length != 16)
      {
        document.getElementById("idaccountnumber").innerHTML = "Account Number is not valid one";
        errcondition ="false";   
      }
      if(document.frmform.account.value=="")
      {
        document.getElementById("idaccountnumber").innerHTML = "Account Number should not be empty...";
        errcondition ="false";    
      }
      if(!document.frmform.account.value.match(numericExpression))
      {
        document.getElementById("idaccountnumber").innerHTML = "Account number must contain Numbers...";
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