<?php
include('includes/header.php'); 
include('includes/navbar.php');
if(isset($_GET[delid]))
	{
		$sql = "DELETE FROM product where productid='$_GET[delid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Product record deleted successfully...');</script>";
			echo "<script>window.location='viewproduct.php';</script>";
		}
	} 
?>
<!--ANWAR style starts-->
<style>
	td,th{
		color: black;
	}
</style>
<!--Anwar style ends -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Products</h1>
</div>

<!-- Content Row -->
<div class="row" style="overflow-x: auto;">
<div class="col-lg-12">
<table id="mydataTable"  class="table table-striped table-bordered">
<thead>
<tr><th>Sl No.</th>
<th>Product Title</th>
<?php if(($_SESSION['emptype'] == "Admin") or ($_SESSION['emptype'] == "Employee")){ echo "<th>Image</th>";} ?>
<th>Category</th>
<th>Sub Category</th>
			<?php if(($_SESSION['emptype'] == "Admin") or ($_SESSION['emptype'] == "Employee")){ echo "<th>Company</th>";} ?>
			<th>Cost Before Discount</th>
			<th>Cost After Discount</th>
			<th>Quantity</th>
			<th>Status</th>
			<?php if((isset($_SESSION[comp_id])) and ($_SESSION['emptype'] == "Seller")){ echo "<th>Image</th>";} ?>
			<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
								if ($_SESSION['emptype']=='Admin' || $_SESSION['emptype']=='Employee') {
									$sql = "SELECT product.*,category.categorytype,sub_category.subcategorytype,seller.compname FROM product LEFT JOIN category ON product.categoryid=category.categoryid LEFT JOIN seller on seller.comp_id=product.comp_id LEFT JOIN sub_category on product.subcategoryid=sub_category.subcategoryid";
								}
								elseif ($_SESSION['emptype']=='Seller') {
									$sql = "SELECT product.*,category.categorytype,seller.compname,sub_category.subcategorytype FROM product LEFT JOIN category ON product.categoryid=category.categoryid LEFT JOIN seller on seller.comp_id=product.comp_id LEFT JOIN sub_category on product.subcategoryid=sub_category.subcategoryid where product.comp_id=$_SESSION[comp_id]";
									}
					
								$qsql = mysqli_query($con,$sql);
								$c=0;
								while($rs = mysqli_fetch_array($qsql))
								{$c++;
									$sqlproduct_image = "SELECT * FROM product_image where productid='$rs[0]' and status='Active'";
									$qsqlproduct_image = mysqli_query($con,$sqlproduct_image);
									$rsproduct_image = mysqli_fetch_array($qsqlproduct_image);
									if(file_exists("../imgproduct/$rsproduct_image[imgpath]"))
                                    {
                                      $imgname="../imgproduct/$rsproduct_image[imgpath]";
                                    }
                                    else
                                    {
                                      $imgname="../images/No-image-found.jpg";
                                    }
									echo "<tr><td>$c</td>
										<td>$rs[title]</td>";
                       if(($_SESSION['emptype'] == "Admin") or ($_SESSION['emptype'] == "Employee"))
	                                    { echo "<td><img src='$imgname' style='width:75px;height:75px;object-fit: cover;'></td>";}
									echo "<td>$rs[categorytype]</td>
										<td>$rs[subcategorytype]</td>";
if(($_SESSION['emptype'] == "Admin") or ($_SESSION['emptype'] == "Employee")){ echo "<td>$rs[compname]</td>";}
echo "<td>₹$rs[costbd]</td>
<td>₹$rs[costad]</td>
<td>$rs[quantity]</td>
<td>$rs[status]</td>";
if((isset($_SESSION[comp_id])) and ($_SESSION['emptype'] == "Seller")){ echo "<td><center><b><a href='product_image.php?productid=$rs[0]' class='btn btn-success'>Upload</a>(" . mysqli_num_rows($qsqlproduct_image) .")</b></center>
</td>";}
echo "<td><center><b><a href='product.php?editid=$rs[0]' class='btn btn-info'>Edit</a><hr><a href='viewproduct.php?delid=$rs[0]' onclick='return confirmdelete()' class='btn btn-danger'>Delete</a></center></b></td>
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
		if(confirm("Are you sure want to delete this record? Deliting is not recomeded! Better to Try Inactiving Product, Press Cancel") == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
