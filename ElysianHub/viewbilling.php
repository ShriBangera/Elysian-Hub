<?php
include 'header.php';
?>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Bills</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">My Bills</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start My Account  -->
    <div class="my-account-box-main">
        <div class="container">
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
<table id="mydataTable"  class="table table-striped table-bordered">
              <thead>
                <tr>
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

if(isset($_SESSION[customerid]))
{
  $sql = "SELECT purchase.*,customer.customername FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid WHERE purchase.status!='Cancelled' AND purchase.status!='Pending' AND purchase.customerid='$_SESSION[customerid]'  AND purchase.status!='Cancellation Request'";
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

              $qsql = mysqli_query($con,$sql);
              while($rs = mysqli_fetch_array($qsql))
              {
                $totalcost=$rs[cost]*$rs[qty];
                echo "<tr>
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
        </div>
    </div>
    <!-- End My Account -->

<?php
include 'ourpartners.php';
include 'footer.php';
?>
<script>
      $(document).ready( function () {
    $('#mydataTable').DataTable();
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

  

 