<?php
session_start();
include("includes/dbconnection.php");
error_reporting(0);
//Step 2 : Select record from database starts here
if(isset($_GET['purchaseid']))
{
  $sqledit = "SELECT * FROM purchase LEFT JOIN customer on purchase.customerid=customer.customerid WHERE purchase.purchaseid='$_GET[purchaseid]'";
  $qsqledit = mysqli_query($con,$sqledit);
  $rsedit = mysqli_fetch_array($qsqledit);
}
if(isset($_POST[submitdelivstatus]))
{   $sqlpurchase = "UPDATE purchase SET deliverystatus='$_POST[deliverystatus]' WHERE purchaseid='$_GET[purchaseid]'";
     $qsqlpurchase = mysqli_query($con,$sqlpurchase); 
  //$sql = "UPDATE billing SET deliverystatus='$_POST[deliverystatus]' WHERE billingid='$_GET[billingid]'";
  //$qsql = mysqli_query($con,$sql);
        //mailing information to customer 
        $sqlseller1 ="SELECT * FROM purchase WHERE purchaseid='$_GET[purchaseid]'";
        $qsqlseller1 = mysqli_query($con,$sqlseller1);
        $rsseller1 = mysqli_fetch_array($qsqlseller1);
        $sqlseller2 ="SELECT * FROM customer WHERE customerid='$rsseller1[customerid]'";
        $qsqlseller2 = mysqli_query($con,$sqlseller2);
        $rsseller2 = mysqli_fetch_array($qsqlseller2);
        $sqlseller3 ="SELECT * FROM product WHERE productid='$rsseller1[productid]'";
        $qsqlseller3 = mysqli_query($con,$sqlseller3);
        $rsseller3 = mysqli_fetch_array($qsqlseller3);  
        $currenturl = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/../billing.php?purchaseid=$_GET[purchaseid]";
        $to = $rsseller2['emailid'];
        $subject = "Order Status";
        $txt = "<b>Hello $rsseller2[customername],</b> <br><br> Order status of your product - $rsseller3[title] has been updated to $_POST[deliverystatus]. To Print a bill go to <a href='$currenturl'><b>My bills</b></a>";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: meatzone.online";
        mail($to,$subject,$txt,$headers);
  echo "<script>alert('Delivery status updated successfully...');</script>";
  echo "<script>window.location='billingreceipt.php?purchaseid=$_GET[purchaseid]';</script>";
}
?>
 
 <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<style type="text/css">
  td,th,p{
    color: black;
  }
  th{
    background-color: rgba(0,0,0,0.5);
  }
</style>

<div  id="printableArea">
<div class="row">
 <div class="col-xl-6 col-md-6 mb-4">
  <img src="logo.png" class="logo" alt="">
 </div> 
 <div class="col-xl-6 col-md-6 mb-4">
        <p><i class="fa fa-location-arrow"></i> 2nd Floor, Moon light building, Giri Nagar, Konchadi road,  Mangalore</p>
        <p><i class="fa fa-phone"></i> +1-888 705 770</p>
        <p><i class="fa fa-envelope-o"></i> www.meatzone.com</p>
 </div> 
</div>

<div class="row">
 <div class="col-xl-6 col-md-6 mb-4">
      <h5><?php echo $rsedit[customername]; ?></h5>
      <p><b>Address :</b><br><?php echo $rsedit[11]; ?>,<?php echo $rsedit[12]; ?>,<br><?php echo $rsedit[13]; ?>, <b>PIN-</b><?php echo $rsedit[15]; ?></p>
      <p><b>Mobile :</b> +91 <?php echo $rsedit[14]; ?></p>
      <p><b>Email :</b> <?php echo $rsedit[emailid]; ?></p>
 </div> 
 <div class="col-xl-6 col-md-6 mb-4">
      <h1>INVOICE</h1>
      <p><b>Purchase ID :</b> <?php echo $rsedit[purchaseid]; ?></p>
      <p><b>Ordered Date :</b> <?php echo date("d-M-Y",strtotime($rsedit[purchasedate])); ?></p>
 </div> 
</div>

<div class="row">
        <div class="receipt-main col-xs-10 col-sm-10 col-md-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
           <!-- <div class="row">
          <div class="receipt-header">
          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="receipt-left">
              <img src="logo.png" class="logo" alt="">
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 text-right">
            <div class="receipt-right">
              <p>2nd Floor, Moon light building, Mangalore <i class="fa fa-location-arrow"></i></p>
              <p>+180045678995 <i class="fa fa-phone"></i></p>
              <p>www.meatzone.com <i class="fa fa-envelope-o"></i></p>
            </div>
          </div>
        </div>
            </div>-->
      
      <!--<?php/*<div class="row">
        <div class="receipt-header receipt-header-mid">
          <div class="col-xs-8 col-sm-8 col-md-8 text-left">
            <div class="receipt-right">
              <h5><?php echo $rsedit[customername]; ?></h5>
              <p><b>Address :</b><br><?php echo $rsedit[11]; ?>,<?php echo $rsedit[12]; ?>,<br><?php echo $rsedit[13]; ?>, <b>PIN-</b><?php echo $rsedit[15]; ?></p>
              <p><b>Mobile :</b> +91 <?php echo $rsedit[14]; ?></p>
              <p><b>Email :</b> <?php echo $rsedit[emailid]; ?></p>
            </div>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="receipt-right" >
            
              <h1>INVOICE</h1>
              <p><b>Purchase ID :</b> <?php echo $rsedit[purchaseid]; ?></p>
              <p><b>Date :</b> <?php echo date("d-M-Y",strtotime($rsedit[purchasedate])); ?></p>
            </div>
          </div>
        </div>
            </div>*/ ?>-->
      
            <div>
                <table class="table table-bordered" style="margin: auto;">
                    <thead>
                        <tr>
              <th>SL No.</th>
              <th>Product detail</th>
              <th>Unit Price</th>
              <th>Quantity</th>
              <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$total =0;
 //$sql =  "SELECT purchase.*,billing.bill_type,customername,product.title,product_image.imgpath FROM purchase LEFT JOIN billing ON purchase.billingid=billing.billingid LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid LEFT JOIN product_image ON product_image.productid=product.productid  WHERE    (purchase.status='Active' OR purchase.status='In Transit' OR purchase.status='Shipped' OR purchase.status='Delivered')  AND (purchase.billingid='$_GET[billingid]') GROUP BY purchase.purchaseid";
$sql =  "SELECT purchase.*,customername,product.title,product_image.imgpath FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid LEFT JOIN product_image ON product_image.productid=product.productid  WHERE    (purchase.deliverystatus='Active' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered' OR purchase.deliverystatus='Pending')  AND (purchase.purchaseid='$_GET[purchaseid]') GROUP BY purchase.purchaseid";
 $slno = 1;   
    $qsql = mysqli_query($con,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
                
      if($rs[imgpath] == "")
      {
        $imgproduct = "../themes/images/No-image-found.jpg";
      }
      else if(file_exists("../imgproduct/".$rs[imgpath]))
      {
        $imgproduct = "../imgproduct/".$rs[imgpath];
      }
      else
      {
        $imgproduct = "../themes/images/No-image-found.jpg";
      }
?>      
  <tr>
    <td><?php echo $slno; ?></td>
    <td><img alt="" src="<?php echo $imgproduct; ?>" align="left" style="width:75px;height:100px;padding-right:10px;object-fit: contain;"><?php echo $rs[title]; ?></td>
    <td>₹<?php echo $rs[cost]; ?></td>
    <td><?php echo $rs[qty]; ?></td>
    <td>₹<span id="totalcost<?php echo $rs[0]; ?>"><?php echo $rs[cost]*$rs[qty]; ?></span></td>
  </tr>
              
  <?php
  $total = $total + ($rs[cost]*$rs[qty]);
  $slno = $slno + 1;
  }
  $withoutgstamt = $total*100/110;
  ?>
                    <!--    <tr>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"><strong>Sub Total: </strong></td>
                            <td class="text-right text-danger" ><strong>₹<?php echo (int)$withoutgstamt; ?>/-</strong></td>
                        </tr>
                        <tr>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"><strong>CGST (4%): </strong></td>
                            <td class="text-right text-danger" ><strong>₹<?php echo (int)(4*$withoutgstamt/100); ?>/-</strong></td>
                        </tr>
            
                        <tr>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"><strong>SGST(4%): </strong></td>
                            <td class="text-right text-danger" ><strong>₹<?php echo (int)(4*$withoutgstamt/100); ?>/-</strong></td>
                        </tr>
            
                        <tr>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"><strong>IGST(2%): </strong></h2></td>
                            <td class="text-right text-danger" ><strong>₹<?php echo (int)(2*$withoutgstamt/100); ?>/-</strong></td>
                        </tr>
                    -->
                        <tr>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"><h2><strong>Grand Total: </strong></h2></td>
                            <td class="text-right text-danger" ><h4><strong>₹<?php echo $total; ?>/-</strong></h4></td>
                        </tr>
            
                    </tbody>
                </table>
            </div>
      
      <div class="row">
        <div class="receipt-header receipt-header-mid receipt-footer">
          <div class="col-xs-8 col-sm-8 col-md-8 text-left">
            <div class="receipt-right"> 
<?php
if($_SESSION[emptype]=="Seller")
{
?>
<form method="post" action="" name="frmform" onsubmit="return validateform()">
  <span class="errmsg" id="iddeliverystatus"></span>
  <select name="deliverystatus" class="form-control"> 
    <option value="Pending">Pending</option>
    <?php
    $arr = array("In Transit","Shipped","Delivered");
    foreach($arr as $val)
    {
      if($val == $rsedit[deliverystatus])
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
  <input type="submit" name="submitdelivstatus" value="Update Delivery status" class="btn btn-success">
  </form>
<?php
}
?>
            <?php
            if($rsedit[deliverystatus] == "Delivered")
            {
            ?>
<h5 style="color: green;">Delivery status - <?php echo $rsedit[deliverystatus]; ?></h5>
            <?php
            }
            else
            {
            ?>
<h5 style="color: red;">Delivery status - <?php echo $rsedit[deliverystatus]; ?></h5>         
  <?php
            }
            ?>
              <h5 style="color: rgb(140, 140, 140);">Thank you for shopping!</h5>
              
            </div>
          </div>
          <!--<div class="col-xs-4 col-sm-4 col-md-4">
            <div class="receipt-left" align="right">
              <h1 style="color: black;">Signature</h1>
              <img src='themes/images/signature.jpg' style="width: 150px;" >
            </div>
          </div>-->
        </div>
            </div>
      
        </div>    
  </div>
</div>  

  <center><input type="button" name="submit" class="form-control btn btn-primary btn-icon-split btn-lg" onclick="printDiv('printableArea')"  value="Print Receipt" style="width: 150px;"></center>

<script>
  function printDiv(divName)
  {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
    }
</script>