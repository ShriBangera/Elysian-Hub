<?php
include('includes/header.php'); 
include('includes/navbar.php');
//echo "<script>alert('Right now this page is disabled')</script>";
//echo "<script>window.location.href='index.php'</script>";
/*if(isset($_GET[delid]))
{
	$sql = "DELETE FROM product where productid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Product record deleted successfully...');</script>";
		echo "<script>window.location='viewproductstock.php';</script>";
	}
}*/
?>
<style type="text/css">
	td,th{color: black;}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Products In Stock</h1>
</div>

<!-- Content Row -->
<div class="row" style="overflow-x: auto;">
<div class="col-lg-12">
<table id="mydataTable"  class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Sl No.</th>
									<?php if ($_SESSION['emptype']=='Admin' or $_SESSION['emptype']=='Employee') { echo "<th>Company</th>";}?>
									<th>Title</th>
									<th>Product ID</th>
									<th>Date</th>
									<th>Quantity</th>
								</tr>
							</thead> 
							<tbody>
							<?php
							if ($_SESSION['emptype']=='Admin' or $_SESSION['emptype']=='Employee')
							 {
				$sql = "SELECT stock.*,product.productid,product.title,seller.compname FROM stock LEFT JOIN product ON stock.productid=product.productid LEFT JOIN seller ON seller.comp_id=stock.comp_id WHERE stock.comp_id IS NOT NULL AND stock.productid IS NOT NULL";
				$qsql = mysqli_query($con,$sql);
				$c=0;
							while($rs = mysqli_fetch_array($qsql))
							{$c++;
								echo "<tr><td>$c</td>
								<td>$rs[compname]</td>
									<td>$rs[title]</td>
									<td>$rs[productid]</td>
									<td>$rs[stockaddeddate]</td>
									<td>$rs[4]</td>
									</tr>";
								}
			                 }
			                 elseif ($_SESSION['emptype']=='Seller') 
			                 {
                             $sql = "SELECT stock.*,product.productid,product.title FROM stock LEFT JOIN product ON stock.productid=product.productid WHERE stock.comp_id=$_SESSION[comp_id] AND stock.comp_id IS NOT NULL AND stock.productid IS NOT NULL";
			                 

							$qsql = mysqli_query($con,$sql);
							$c=0;
							while($rs = mysqli_fetch_array($qsql))
							{$c++;
								echo "<tr><td>$c</td>
									<td>$rs[title]</td>
									<td>$rs[productid]</td>
									<td>$rs[stockaddeddate]</td>
									<td>$rs[4]</td>
									</tr>"; 
							}
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
/*function confirmdelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}*/
</script>