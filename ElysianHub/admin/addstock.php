<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_POST[submit]))
{
  $dt =date("Y-m-d");
      $sql ="INSERT INTO stock(comp_id,stockaddeddate,productid,quantity) VALUES('$_SESSION[comp_id]','$dt','$_POST[productid]','$_POST[qty]')";
      $qsql = mysqli_query($con,$sql);
      echo mysqli_error($con);
      if(mysqli_affected_rows($con) == 1)
      {
    echo "<SCRIPT>alert('Stock Record inserted successfully....');</SCRIPT>";
    echo "<script>window.location='addstock.php';</script>";
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
<h1 class="h3 mb-0 text-gray-800">Stock Entry</h1>
</div>

<!-- Content Row -->
<div class="row">
<div class="col-md-8" style="margin: auto;overflow-x: auto;"> 
<form action="" method="post" name="frmform" onsubmit="return validateform()">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Product <span class="errmsg" id="idproductid"></span></label>
      <div class="controls" id="divstock">
       <select name="productid" placeholder="Enter Product" class="form-control">
          <option value="">Select Product</option>
          <?php
        $sqlproduct = "SELECT * FROM product WHERE status='Active' AND comp_id='$_SESSION[comp_id]'";
        $qsqlproduct=mysqli_query($con,$sqlproduct);
        while($rsproduct = mysqli_fetch_array($qsqlproduct))
        {
          //if($rsproduct[productid] == $rsedit[productid])
          //{
            echo "<option value='$rsproduct[productid]'>$rsproduct[title]</option>";
          //}
        }
        ?>
        </select>
      </div>
    </div> 
  
    <div class="form-group">
      <label class="control-label">Number of Packs to be Added <span class="errmsg" id="idqty"></span></label>
      <div class="controls">
        <input type="number" name="qty" ID="qty" placeholder="Enter Quantity" class="form-control" value="<?php echo $rsedit[qty]; ?>"  >
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
    /*Regular Expressions ends*/
    
    $(".errmsg").html('');
    //alert("test test");
    var errcondition = "true";
    
    if(document.frmform.productid.value=="")
    {
      document.getElementById("idproductid").innerHTML = "Product should not be empty...";
      errcondition ="false";    
    }
    if(!document.frmform.qty.value.match(numericExpression))
      {
      document.getElementById("idqty").innerHTML="Entered Quantity should contain only numeric values...";
      errcondition ="false";
      }
    if(document.frmform.qty.value=="")
    {
      document.getElementById("idqty").innerHTML = "Quantity should not be empty...";
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