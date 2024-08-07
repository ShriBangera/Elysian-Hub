<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_POST[submit]))
{
	//coding to upload image starts here
	$imgname= rand(). $_FILES[imgpath][name];
	move_uploaded_file($_FILES["imgpath"]["tmp_name"],"../imgproduct/".$imgname);
	//coding to upload image ends here..
	
	if(isset($_GET[editid]))
	{
		//Step 4 : Update statement starts here
		$sql ="UPDATE product_image SET status='$_POST[status]'";
		if($_FILES[imgpath][name] != "")
		{
		$sql = $sql . ",imgpath='$imgname'";
		}
		$sql = $sql ." ,description='$_POST[description]' where product_image_id='$_GET[editid]'";
	    $qsql = mysqli_query($con,$sql);
	   echo mysqli_error($con);
	    if(mysqli_affected_rows($con) == 1)
	    {
		echo "<SCRIPT>alert('product image record updated successfully...');</SCRIPT>";
		echo "<script>window.location='product_image.php?productid=$_GET[productid]';</script>";
	    }
		//Step 4 : Update statement ends here
	}
	else
	{
	   $sql ="INSERT INTO product_image(productid,imgpath,description,status) VALUES('$_GET[productid]','$imgname','$_POST[description]','$_POST[status]')";
	   $qsql = mysqli_query($con,$sql);
	   echo mysqli_error($con);
	      if(mysqli_affected_rows($con) == 1)
	      {
		  echo "<SCRIPT>alert('product image record inserted successfully...');</SCRIPT>";
          //echo "<script>window.location='viewproduct.php';</script>";
	      }
    }
}	
 //Step 1 : Link from viewproduct_image.php
//Step 2 : Select record from database starts here
      if(isset($_GET[editid]))
        {
	      $sqledit = "SELECT * FROM product_image WHERE product_image_id='$_GET[editid]'";
	      $qsqledit = mysqli_query($con,$sqledit);
	      $rsedit = mysqli_fetch_array($qsqledit);
        }
	//Step 2 : Select record from database ends here
//Step 3 : Display record in the form
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM product_image where product_image_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Product_image record deleted successfully...');</script>";
		echo "<script>window.location='viewproduct.php';</script>";
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
  input .form-control{
    color: #ffffff;
  }
</style>
<!-- ANWAR CSS ends-->
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Product Image</h1>
</div>
<!-- Content Row -->
<div class="row">

<div class="col-lg-6">
<form action="" method="post" enctype="multipart/form-data" name="frmform" onsubmit="return validateform()">
<input type="hidden" name="editid" id="editid" value="<?php echo (int)$_GET['editid']; ?>" >
	<fieldset>

		<div class="control-group">
			<label class="control-label">Image Path <span class="errmsg" id="idimgpath"></span></label>
			<div class="controls">
				<input type="file" name="imgpath" placeholder="Enter Image Path" class="form-control" >
				<?php
				if(isset($_GET[editid]))
				{
					echo "<br><img src='../imgproduct/$rsedit[imgpath]' style='width:75px;height:75px;object-fit: cover;'>";
				}
				?>
			</div>
		</div>
		  
		<div class="control-group">
			<label class="control-label">Description <span class="errmsg" id="iddescription"></span></label>
			<div class="controls">
				<textarea name="description" placeholder="Enter Description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Status <span class="errmsg" id="idstatus"></span></label>
			<div class="controls" class="form-control">
				<select  class="form-control" name="status">
				<option value="">Select status</option>
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
		<input class="btn btn-primary btn-icon-split btn-lg" name="submit" type="submit" value="Submit">                                                                      
                                        
	</fieldset>
</form>	
</div>

<div class="col-lg-6">
  	<table id="mydataTable"  class="table table-striped table-bordered">
		<thead>
		    <tr>
		        <th>Image path</th>
		        <th>Description</th>
		        <th>Status</th>
		         <th>Action</th>
		    </tr>
		</thead>
				<tbody>
		<?php
		$sql = "SELECT *  FROM product_image WHERE productid='$_GET[productid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
				<td><img src='../imgproduct/$rs[imgpath]' style='width:75px;height:75px;object-fit: cover;' ></td>
				<td>$rs[description]</td>
				<td>$rs[status]</td>
				<td><a href='product_image.php?editid=$rs[0]&productid=$_GET[productid]' class='btn btn-info'>Edit</a>  <a href='product_image.php?delid=$rs[0]&productid=$_GET[productid]' onclick='return confirmdelete()' class='btn btn-danger'>Delete</a></td>
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
		if(document.frmform.editid.value== 0)
		{
			if(document.frmform.imgpath.value=="")
			{
				document.getElementById("idimgpath").innerHTML = "Image Path should not be empty...";
				errcondition ="false";		
			}
		}
		if(document.frmform.description.value=="")
		{
			document.getElementById("iddescription").innerHTML = "Description should not be empty...";
			errcondition ="false";		
		}
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