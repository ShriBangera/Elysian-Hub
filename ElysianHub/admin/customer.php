<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_GET[editid]))
        {
        $sqledit = "SELECT * FROM customer WHERE customerid='$_GET[editid]'"; 
        $qsqledit = mysqli_query($con,$sqledit);
        $rsedit = mysqli_fetch_array($qsqledit);
        }
if(isset($_POST[submit]))
{
  if(isset($_GET[editid]))
  {
     $sql ="UPDATE customer SET status='$_POST[status]' where customerid='$_GET[editid]'";
     $qsql = mysqli_query($con,$sql);
     echo mysqli_error($con);
    if(mysqli_affected_rows($con) == 1)
    {
    echo "<SCRIPT>alert('customer record updated successfully...');</SCRIPT>";
                //mailing information to customer 
                $to = $rsedit['emailid'];
                $subject = "MeatZone Profile Updated";
                $txt = "<b>Hello $rsedit[customername],</b> <br><br> Your Account status has been updated to <b>$_POST[status]</b>";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: meatzone.online";
                mail($to,$subject,$txt,$headers);
    echo "<script>window.location='viewcustomer.php';</script>";
      }
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
<h1 class="h3 mb-0 text-gray-800">Customer Data</h1>
</div>

<!-- Content Row -->
<div class="row">
<div class="col-md-12" style="margin: auto;overflow-x: auto;"> 
  <form action="" method="post" name="frmform" onsubmit="return validateform()">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Customer Name <span class="errmsg" id="idcustomername"></span></label>
      <div class="controls">
        <input type="text" name="customername" placeholder="Enter customer Name" readonly="readonly" class="form-control" value="<?php echo $rsedit[customername]; ?>" >
      </div>
    </div>
    
    <div class="form-group">
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
    <hr>
                                 <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn btn-primary btn-icon-split btn-lg" name="submit" type="submit" value="submit">                                                                      
                                        
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
        $(".errmsg").html('');
        //alert("test test");
        var errcondition = "true";
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