<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
/*if(isset($_GET[delid]))
{
  $sql = "DELETE FROM billing where billingid='$_GET[delid]'";
  $qsql = mysqli_query($con,$sql);
  echo mysqli_error($con);
  if(mysqli_affected_rows($con) == 1)
  {
    echo "<script>alert('Billing record deleted successfully...');</script>";
    echo "<script>window.location='viewbilling.php';</script>";
  }
}*/
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
<h1 class="h3 mb-0 text-gray-800">Billing Report</h1>
</div>

<!-- Content Row -->
<div class="row">
<div class="col-md-12" style="margin: auto;overflow-x: auto;"> 
            <center> 
            <form method="post" action="" id="myForm">
            <input class="btn btn-primary" type="submit" name="all" value="ALL" onclick="submitfilter()">
            <input class="btn btn-danger" type="submit" name="pending" value="Pending" onclick="submitfilter()">
            <input class="btn btn-info" type="submit" name="intransit" value="In Transit" onclick="submitfilter()">
            <input class="btn btn-success" type="submit" name="shipped" value="Shipped" onclick="submitfilter()">
            <input class="btn btn-warning" type="submit" name="delivered" value="Delivered" onclick="submitfilter()">
            </form>
            </center>
            <hr>
<table id="mydataTable"  class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Purchase ID</th>
                  <th>Customer</th>
                  <th>Purchase date</th>
                  <th>Address</th>
                  <th>Mobile No.</th>
                  <th>Total cost</th>
                  <th>Delivery status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="viewbillingtbody">
                <?php
if($_SESSION['emptype'] == "Admin" or $_SESSION['emptype'] == "Employee")
{            
$sql =  "SELECT purchase.*,customer.customername FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid WHERE purchase.status!='Cancelled' AND purchase.status!='Pending' AND purchase.status!='Cancellation Request'";
   if(isset($_POST[all]))
   {
   $sql.=" AND (purchase.status='Active' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
   }elseif(isset($_POST[pending]))  
  {
  $sql.=" AND purchase.status='Active' AND purchase.deliverystatus!='Cancelled' AND purchase.deliverystatus!='In Transit' AND purchase.deliverystatus!='Shipped' AND purchase.deliverystatus!='Delivered'";
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
    $sql.=" AND (purchase.status='Active' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
   }
}
if($_SESSION['emptype'] == "Seller") 
{
   $sql =  "SELECT purchase.*,customer.customername  FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid WHERE purchase.companyid='$_SESSION[comp_id]' AND purchase.status!='Cancelled' AND purchase.status!='Pending'  AND purchase.status!='Cancellation Request'";
   if(isset($_POST[all]))
   {
   $sql.=" AND (purchase.status='Active' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
   }elseif(isset($_POST[pending]))  
  {
  $sql.=" AND purchase.status='Active' AND purchase.deliverystatus!='Cancelled' AND purchase.deliverystatus!='In Transit' AND purchase.deliverystatus!='Shipped' AND purchase.deliverystatus!='Delivered'";
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
    $sql.=" AND (purchase.status='Active' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
   }
}
/*if(isset($_SESSION[customerid]))
{
  $sql = "SELECT purchase.*,customer.customername FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid WHERE purchase.status!='Cancelled' AND purchase.status!='Pending' AND purchase.customerid='$_SESSION[customerid]'  AND purchase.status!='Cancellation Request'";
   if(isset($_POST[all]))
   {
   $sql.=" AND (purchase.status='Active' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
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
    $sql.=" AND (purchase.status='Active' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
   }
}*/

              $qsql = mysqli_query($con,$sql);
              $c=0;
              while($rs = mysqli_fetch_array($qsql))
              {$c++;
                $totalcost=$rs[cost]*$rs[qty];
                echo "<tr>
                <td>$c</td>
                  <td>$rs[0]</td>
                  <td>$rs[customername]</td>
                  <td>$rs[purchasedate]</td>
                  <td>$rs[address]<br>$rs[city]<br>$rs[state]<br> <b>PIN -</b> $rs[pincode]</td>
                  <td>$rs[contactno]</td>
                  <td>₹$totalcost</td>
                  <td>$rs[deliverystatus]</td>
                  <td><center><b><a href='billing.php?purchaseid=$rs[0]' class='btn btn-info'>View</a></b></center></td>
                  </tr>";
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
  if(confirm("Are you sure want to delete this record?") == true)
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