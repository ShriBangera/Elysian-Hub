<?php
include('includes/header.php'); 
include('includes/navbar.php');
if(isset($_POST[submitdelivstatus]))
{
  /*dont nesseesary code i think
  $sql = "UPDATE billing SET deliverystatus='$_POST[deliverystatus]' WHERE billingid='$_GET[billingid]'";
  $qsql = mysqli_query($con,$sql);
  echo "<script>alert('Delivery status updated successfully...');</script>";
  */
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
<h1 class="h3 mb-0 text-gray-800">Billing</h1>
</div>

<!-- Content Row -->
<div class="row">
<div class="col-md-12" style="margin: auto;overflow-x: auto;"> 
<iframe style="width: 100%;height: 1000px;" src="billingreceipt.php?purchaseid=<?php echo $_GET[purchaseid]; ?>" frameBorder="0"></iframe>
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
        if(document.frmform.deliverystatus.value=="")
        {
          document.getElementById("iddeliverystatus").innerHTML = "Delivery Status should not be empty...";
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