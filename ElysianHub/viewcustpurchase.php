<?php
include 'header.php';
if(isset($_GET[delid]))
{
    $sql = "DELETE FROM purchase where purchaseid='$_GET[delid]'";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<script>alert('Purchase record deleted successfully...');</script>";
        echo "<script>window.location='viewpurchase.php';</script>";
    }
}
?>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Orders</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">My Orders</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start My Account  -->
    <div class="my-account-box-main">
        <div class="container">
            <div class="my-account-page" style="overflow-x: auto;">
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
              <table id="mydataTable"  class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Purchase ID</th>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Cost</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody id="viewcustpurchasetbody">
                                    <?php
                                    if(isset($_SESSION[customerid])){
                                $sql =  "SELECT purchase.*,customername,title FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid WHERE purchase.customerid='$_SESSION[customerid]' AND purchase.status!='Pending'";
if(isset($_POST[all]))
{
 $sql.=" AND (purchase.status='Active' OR purchase.status='Cancellation Request' OR purchase.deliverystatus='Cancelled' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
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
  $sql.=" AND (purchase.status='Active' OR purchase.status='Cancellation Request' OR purchase.deliverystatus='Cancelled' OR purchase.deliverystatus='In Transit' OR purchase.deliverystatus='Shipped' OR purchase.deliverystatus='Delivered')";
}
}

                            $qsql = mysqli_query($con,$sql);
                            while($rs = mysqli_fetch_array($qsql))
                            {
                                echo "<tr>
                                    <td>$rs[0]</td>
                                    <td>$rs[purchasedate]</td>                                    
                                    <td>$rs[title]</td>
                                    <td>₹$rs[cost]</td>
                                    <td>$rs[qty]</td>
                                    <td>₹" . $rs[cost] * $rs[qty] . "</td>
                                     <td>";
    if(($rs[deliverystatus] == "Pending" or $rs[deliverystatus] == "In Transit" or $rs[deliverystatus] == "Shipped") AND ($rs['5']=='Active'))
    {       
        echo "<center><b><a href='cancellation.php?purchaseid=$rs[0]' class='btn btn-danger'>Cancel</a></b></center>";
    }
    else if($rs['5'] == "Cancellation Request")
    {
        echo $rs['5'] ." sent";
    }
    else if($rs[deliverystatus] == "Delivered")
    {
     echo "Delivered";
    }
    else{
        echo $rs['5']; 
    }
                                    echo "</td>
                                    </tr>";
                            }
                            ?>
                            </tbody>
                            </table>  
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

  

