<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_GET[st]))
{

  $sql = "UPDATE purchase SET status='$_GET[st]' where purchaseid='$_GET[purchaseid]'";
  $qsql = mysqli_query($con,$sql);
  echo mysqli_error($con);
  if(mysqli_affected_rows($con) == 1)
  {
    if ($_GET[st]=='Cancelled') 
       {
        $sql2 = "UPDATE purchase SET deliverystatus='$_GET[st]' where purchaseid='$_GET[purchaseid]'";
        $qsql2 = mysqli_query($con,$sql2);
        echo mysqli_error($con);
        } 
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
        if ($_GET[st]=='Cancelled')
        {
          $message = "You'r request for cancellation of product - $rsseller3[title] has been <b>Approved</b> and order has been cancelled by MeatZone.";
        }else
        {
          $message = "You'r request for cancellation of product - $rsseller3[title] has been <b>Rejected</b> and order will not be cancelled.";
        }
        $to = $rsseller2['emailid'];
        $subject = "Cancellation Product Result";
        $txt = "<b>Hello $rsseller2[customername],</b> <br><br> $message";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: meatzone.online";
        mail($to,$subject,$txt,$headers);
    echo "<script>alert('Customer cancellation request updated successfully...');</script>";
    //echo "<script>window.location='viewpurchase.php';</script>";
    //$sql2 = "SELECT * FROM purchase WHERE billingid='$_GET[bid]' AND (status='Active' OR status='In Transit' OR status='Shipped' OR status='Delivered')";
    //$qsql2 = mysqli_query($con,$sql2);
    //$rowcount=mysqli_num_rows($qsql2);
    //if (!$rowcount>0) {
      //$sql3 = "UPDATE billing SET deliverystatus='Cancelled' WHERE billingid='$_GET[bid]'";
      //$qsql3 = mysqli_query($con,$sql3);
      //echo mysqli_error($con);
    //}
  }
}
?>
<!-- ANWAR CSS starts-->
<style type="text/css">
  td,th{
    color: black;
  }
</style>
<!-- ANWAR CSS ends-->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Purchase Report</h1>
</div>

<!-- Content Row -->
<div class="row">
<div class="col-md-12" style="margin: auto;overflow-x: auto;"> 

            <center> 
            <form method="post" action="" id="myForm">
            <input class="btn btn-primary" type="submit" name="all" value="ALL" onclick="submitfilter()">
            <input class="btn btn-success" type="submit" name="pending" value="Pending" onclick="submitfilter()">
            <input class="btn btn-danger" type="submit" name="cancellationrequests" value="Cancellation Requests" onclick="submitfilter()">
            <input class="btn btn-warning" type="submit" name="cancelled" value="Cancelled" onclick="submitfilter()">
            <input class="btn btn-info" type="submit" name="intransit" value="In Transit" onclick="submitfilter()">
            <input class="btn btn-success" type="submit" name="shipped" value="Shipped" onclick="submitfilter()">
            <input class="btn btn-primary" type="submit" name="delivered" value="Delivered" onclick="submitfilter()">
            </form>
            </center>
            <hr>
            <table id="mydataTable"  class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Purchase Id</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Product</th>
                  <th>Cost</th>
                  <th>Quantity</th> 
                  <th>Total</th>
                  <?php if((isset($_SESSION[comp_id])) and ($_SESSION['emptype'] == "Seller")){ echo "<th>Action</th>";} ?>
                </tr>
              </thead>
              <tbody id="viewpurchasetbody">
                <?php
if($_SESSION['emptype'] == "Admin" or $_SESSION['emptype'] == "Employee")
{
  $sql =  "SELECT purchase.*,customername,title FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid WHERE purchase.status!='Pending'";
if(isset($_POST[all]))
{
 $sql.=" AND (purchase.status='Active' OR purchase.status='Cancellation Request' OR purchase.status='Cancelled' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
}elseif(isset($_POST[pending]))  
{
$sql.=" AND purchase.status='Active' AND purchase.deliverystatus!='Cancelled' AND purchase.deliverystatus!='In Transit' AND purchase.deliverystatus!='Shipped' AND purchase.deliverystatus!='Delivered'";
}elseif(isset($_POST[cancellationrequests]))  
{
$sql.=" AND purchase.status='Cancellation Request'";
}elseif(isset($_POST[cancelled]))  
{
$sql.= " AND purchase.status='Cancelled'";
}elseif(isset($_POST[intransit]))
{
$sql.= " AND purchase.deliverystatus='In Transit'";
}elseif(isset($_POST[shipped]))
{
$sql.=" AND purchase.deliverystatus='Shipped'";  
}elseif(isset($_POST[delivered]))
{
$sql.=" AND purchase.deliverystatus='Delivered'";  
}else
{
  $sql.=" AND (purchase.status='Active' OR purchase.status='Cancellation Request' OR purchase.status='Cancelled' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
}

}
else if($_SESSION['emptype'] == "Seller")
{
$sql =  "SELECT purchase.*,customername,title FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid WHERE purchase.companyid='$_SESSION[comp_id]' AND purchase.status!='Pending'";
if(isset($_POST[all]))
{
 $sql.=" AND (purchase.status='Active' OR purchase.status='Cancellation Request' OR purchase.status='Cancelled' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
}elseif(isset($_POST[pending]))  
{
$sql.=" AND purchase.status='Active' AND purchase.deliverystatus!='Cancelled' AND purchase.deliverystatus!='In Transit' AND purchase.deliverystatus!='Shipped' AND purchase.deliverystatus!='Delivered'";
}elseif(isset($_POST[cancellationrequests]))  
{
$sql.=" AND purchase.status='Cancellation Request'";
}elseif(isset($_POST[cancelled]))  
{
$sql.= " AND purchase.status='Cancelled'";
}elseif(isset($_POST[intransit]))
{
$sql.= " AND purchase.deliverystatus='In Transit'";
}elseif(isset($_POST[shipped]))
{
$sql.=" AND purchase.deliverystatus='Shipped'";  
}elseif(isset($_POST[delivered]))
{
$sql.=" AND purchase.deliverystatus='Delivered'";  
}else
{
  $sql.=" AND (purchase.status='Active' OR purchase.status='Cancellation Request' OR purchase.status='Cancelled' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
}
}
              $qsql = mysqli_query($con,$sql);
              $c=0;
              while($rs = mysqli_fetch_array($qsql))
              {$c++;
                echo "<tr>
                <td>$c</td>
                      <td>$rs[0]</td>
                      <td>$rs[purchasedate]</td>
                  <td>$rs[customername]</td>
                  <td>$rs[title]</td>
                  <td>₹$rs[cost]</td>
                  <td>$rs[qty]</td>
                  <td>₹" . $rs[cost] * $rs[qty] . "</td>";
                   
                    if((isset($_SESSION[comp_id])) and ($_SESSION['emptype'] == "Seller")){ 
                   echo "<td>";
  //if($rs[deliverystatus] == "Delivered")
  //{
    //echo "Paid";
  //}
  //else 
if($rs['5'] == "Cancellation Request")
  {
    
    echo "Cancellation Request<br><b><a style='width: 100px;' href='viewpurchase.php?purchaseid=$rs[0]&st=Cancelled' class='btn btn-info' onclick='return confirmdelete()'>Approve</a></b><br>
    $rs[cancellationreason]
    <br>";
    
    echo "<b><a style='width: 100px;'  href='viewpurchase.php?purchaseid=$rs[0]&st=Active' class='btn btn-danger' onclick='return confirmdelete()'>Reject</a></b>";
  }
  else 
  {
    echo $rs[deliverystatus];
  }
                  echo "</td>";
} 
                  echo "</tr>";
              }
              ?>
              </tbody>
            </table>          
</div>
</div>
  <!-- Content Row -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script>
$(document).ready(function() {
    $('#mydataTable').DataTable( {
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script>
function confirmdelete()
{
  if(confirm("Are you sure?") == true)
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
function submitfilter()
{
document.getElementById("myForm").submit();
}
</script>

