<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_POST[submit]))
{
	$title = mysqli_real_escape_string($con,$_POST[title]);
	$description = mysqli_real_escape_string($con,$_POST[description]);
	if(isset($_GET[editid]))
	{
		if ($_SESSION['emptype']=='Admin') 
		{ $sql1 = "UPDATE purchase SET cost='$_POST[costad]' WHERE productid ='$_GET[editid]' AND status='Pending'";
		  $qsql1 = mysqli_query($con,$sql1);	
          echo mysqli_error($con);
		$sql ="UPDATE product SET categoryid='$_POST[categoryid]',subcategoryid='$_POST[selectcategory2]',comp_id='$_SESSION[comp_id]',title='$title',description='$description',costbeforetax='$_POST[costperproduct]',cgsttaxpercentage='$_POST[cgsttaxpercentage]',sgsttaxpercentage='$_POST[sgsttaxpercentage]',igsttaxpercentage='$_POST[igsttaxpercentage]',discount='$_POST[discount]',costbd='$_POST[totamtpercostwithtax]',costad='$_POST[costad]',quantity='$_POST[qty]' where productid ='$_GET[editid]'";
		 $qsql = mysqli_query($con,$sql);
	    echo mysqli_error($con);
	    if(mysqli_affected_rows($con) == 1)
	    {
		echo "<SCRIPT>alert('product record updated successfully...');</SCRIPT>";
		echo "<script>window.location='viewproduct.php';</script>";
	    }
	}
	if ($_SESSION['emptype']=='Admin' || $_SESSION['emptype']=='Employee') 
		{
		$sql ="UPDATE product SET status='$_POST[status]' where productid ='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
	    echo mysqli_error($con);
	    if(mysqli_affected_rows($con) == 1)
	    {
		echo "<SCRIPT>alert('product record updated successfully...');</SCRIPT>";
		//mailing information to seller 
		$sqlseller1 ="SELECT * FROM product WHERE productid='$_GET[editid]'";
        $qsqlseller1 = mysqli_query($con,$sqlseller1);
        $rsseller1 = mysqli_fetch_array($qsqlseller1);
        $sqlseller2 ="SELECT * FROM seller WHERE comp_id='$rsseller1[comp_id]'";
        $qsqlseller2 = mysqli_query($con,$sqlseller2);
        $rsseller2 = mysqli_fetch_array($qsqlseller2);

        $to = $rsseller2['emailid'];
        $subject = "Status of Your product";
        $txt = "<b>Hello $rsseller2[compname],</b> <br><br> Status of Your product $rsseller1[title] of Product ID $_GET[editid] has been updated to <b>$_POST[status]</b>";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: meatzone.online";
        mail($to,$subject,$txt,$headers);
		echo "<script>window.location='viewproduct.php';</script>";
	    }
		
	}

	}
	else
	{
		$sql ="INSERT INTO product(categoryid,subcategoryid,comp_id,title,description,costbeforetax,cgsttaxpercentage,sgsttaxpercentage,igsttaxpercentage,discount,costbd,costad,quantity,status) VALUES('$_POST[categoryid]','$_POST[selectcategory2]','$_SESSION[comp_id]','$title','$description','$_POST[costperproduct]','$_POST[cgsttaxpercentage]','$_POST[sgsttaxpercentage]','$_POST[igsttaxpercentage]','$_POST[discount]','$_POST[totamtpercostwithtax]','$_POST[costad]','$_POST[qty]','Active')";
	  $qsql = mysqli_query($con,$sql);
	  echo mysqli_error($con);
	  if(mysqli_affected_rows($con) == 1)
	  {
	  	//echo "<SCRIPT>alert('Product record inserted successfully...');</SCRIPT>";
		//echo "<script>window.location='product.php';</script>";
		$insid= mysqli_insert_id($con);
	  	$imgname= rand(). $_FILES[imgpath][name];
	    move_uploaded_file($_FILES["imgpath"]["tmp_name"],"../imgproduct/".$imgname);
	    $description = "1st picture";
	    $status = "Active";

	   $sql2 ="INSERT INTO product_image(productid,imgpath,description,status) VALUES('$insid','$imgname','$description','$status')";
	   $qsql2 = mysqli_query($con,$sql2);
	   echo mysqli_error($con);
	      if(mysqli_affected_rows($con) == 1)
	      {
		    echo "<SCRIPT>alert('Product record inserted successfully...');</SCRIPT>";
		    echo "<script>window.location='product.php';</script>";
	      }
		

	  }

	}  
}
//Step 1 : Link from viewproductphp
//Step 2 : Select record from database starts here
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM product WHERE productid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	
}
//Step 2 : Select record from database ends here

//Step 3 : Display record in the form
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
<h1 class="h3 mb-0 text-gray-800">Product</h1>
</div>
<!-- Content Row -->
<div class="row">

<div class="col-md-8" style="margin: auto;">
<form action="" method="post" name="frmform" enctype="multipart/form-data" onsubmit="return validateform()">
<input type="hidden" name="editid" id="editid" value="<?php echo (int)$_GET['editid']; ?>" >
<fieldset>
<?php
if ($_SESSION[emptype]=='Admin') { ?>
		<div class="form-group">
			<label class="control-label">Category <span class="errmsg" id="idcategoryid"></span></label>
			<div class="controls">
				<select  class="form-control" name="categoryid" onchange="fillsubcategory(this.value,0)">
				<option value="">Select Category </option>
				<?php
				$sqlcategory = "SELECT * FROM category WHERE status='Active'";
				$qsqlcategory=mysqli_query($con,$sqlcategory);
				while($rscategory = mysqli_fetch_array($qsqlcategory))
				{
					if($rscategory[categoryid] == $rsedit[categoryid])
					{
						echo "<option value='$rscategory[categoryid]' selected>$rscategory[categorytype]</option>";
					}
					else
					{
						echo "<option value='$rscategory[categoryid]'>$rscategory[categorytype]</option>";
					}
				}
				?>
				</select>
			</div>		
		</div>    


		<div class="form-group">
								 
								<label class="control-label">Select Sub Category <span class="errmsg" id="idsubcategoryid"></span></label>
								<select name="selectcategory2" id="selectcategory2" class="form-control">
								  <option value=''>-- Select --</option> 
								  <?php
								  if(isset($_GET[editid]))
								  {
									$sqledit = "SELECT * FROM product WHERE productid='$_GET[editid]'";
									$qsqledit = mysqli_query($con,$sqledit);
									$rsedit = mysqli_fetch_array($qsqledit);

								 
				$sqlcategory = "SELECT * FROM sub_category WHERE status='Active' AND categoryid='$rsedit[categoryid]'";
				$qsqlcategory=mysqli_query($con,$sqlcategory);
				while($rssubcategory = mysqli_fetch_array($qsqlcategory))
				{
					if($rssubcategory[subcategoryid] == $rsedit[subcategoryid])
					{
						echo "<option value='$rssubcategory[subcategoryid]' selected>$rssubcategory[subcategorytype]</option>";
					}
					else
					{
						echo "<option value='$rssubcategory[subcategoryid]'>$rssubcategory[subcategorytype]</option>";
					}
				}
			                    }
				?>
								</select>
							</div> 
		
		<div class="form-group">
			<label class="control-label">Title <span class="errmsg" id="idtitle"></span></label>
			<div class="controls">
				<input type="text" name="title" placeholder="Enter Title" class="form-control" value="<?php echo $rsedit[title]; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label">Description <span class="errmsg" id="iddescription"></span></label>
			<div class="controls">
				<textarea name="description" placeholder="Enter Description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="control-label">Cost per Product <span class="errmsg" id="idcostperproduct"></span></label>
			<div class="controls">
				<input type="text" name="costperproduct" id="costperproduct" placeholder="Enter Cost" class="form-control" value="<?php echo $rsedit[costbeforetax]; ?>" onchange="calculatetax()" onkeyup="calculatetax()">
			</div>
		</div>
	
	
	
		<div class="form-group">
			<label class="control-label">CGST Tax (in Percentage) <span class="errmsg" id="idcgsttaxpercentage"></span></label>
			<div class="controls">
				<input type="number" min="0" max="100" name="cgsttaxpercentage" id="cgsttaxpercentage" placeholder="Enter CGST Tax" class="form-control" value="<?php echo $rsedit[cgsttaxpercentage]; ?>" onchange="calculatetax()" onkeyup="calculatetax()" >
			</div>
		</div>
	
	
		<div class="form-group">
			<label class="control-label">CGST Tax Amount <span class="errmsg" id="idcgsttaxpercentage"></span></label>
			<div class="controls">
				<input type="number" name="cgsttaxamount" id="cgsttaxamount" placeholder="CGST Tax Amount" class="form-control"  readonly>
			</div>
		</div>
	
	
	
		<div class="form-group">
			<label class="control-label">SGST Tax (in Percentage) <span class="errmsg" id="idsgsttaxpercentage"></span></label>
			<div class="controls">
				<input type="number" min="0" max="100" name="sgsttaxpercentage" id="sgsttaxpercentage" placeholder="Enter SGST Tax " class="form-control" value="<?php echo $rsedit[sgsttaxpercentage]; ?>"  onchange="calculatetax()" onkeyup="calculatetax()">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label">SGST Tax Amount <span class="errmsg" id="idsgsttaxpercentage"></span></label>
			<div class="controls">
				<input type="number" name="sgsttaxamount" id="sgsttaxamount" placeholder="SGST Tax Amount" class="form-control" readonly >
			</div>
		</div>
	
	
		<div class="form-group">
		<label class="control-label">IGST Tax (in Percentage) <span class="errmsg" id="idigsttaxpercentage"></span></label>
			<div class="controls">
				<input type="number" min="0" max="100" name="igsttaxpercentage" id="igsttaxpercentage" placeholder="Enter IGST Tax" class="form-control" value="<?php echo $rsedit[igsttaxpercentage]; ?>"  onchange="calculatetax()" onkeyup="calculatetax()">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label">IGST Tax Amount <span class="errmsg" id="idigsttaxpercentage"></span></label>
			<div class="controls">
				<input type="number" name="igsttaxamount" id="igsttaxamount" placeholder="IGST Tax Amount" class="form-control" readonly>
			</div>
		</div>
	


	
	
		<div class="form-group">
			<label class="control-label">Total Amount per cost Including Tax(Cost Before Discount) <span class="errmsg" id="idtotamtpercostwithtax"></span></label>
			<div class="controls">
				<input type="number" name="totamtpercostwithtax" ID="totamtpercostwithtax" placeholder="Total Amount Including Tax" class="form-control" readonly value="<?php echo $rsedit[costbd]; ?>">
			</div>
		</div>
	
	
	
		<div class="form-group">
			<label class="control-label">Discount(in Amount) <span class="errmsg" id="iddiscount"></span></label>
			<div class="controls">
				<input type="text" name="discount" ID="discount"  placeholder="Enter Discount" class="form-control" value="<?php echo $rsedit[discount]; ?>"  onchange="calculatetax()" onkeyup="calculatetax()">
			</div>
		
		<div class="form-group">
			<label class="control-label">Cost After Discount <span class="errmsg" id="idcostad"></span></label>
			<div class="controls">
				<input type="number" name="costad" readonly id="costad" placeholder="After Discount" class="form-control" value="<?php echo $rsedit[costad]; ?>">
			</div>
		</div>
		<div class="form-group  span6">
			
		</div>
	</div>
	<!--<?php /*?>
		<div class="control-group">
			<label class="control-label">Cost Before Discount <span class="errmsg" id="idcostbd"></span></label>
			<div class="controls">
				<input type="number" name="costbd" placeholder="Enter Cost Before Discount" class="form-control" value="<?php echo $rsedit[costbd];?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Cost After Discount <span class="errmsg" id="idcostad"></span></label>
			<div class="controls">
				<input type="number" name="costad" placeholder="Enter Cost After Discount" class="form-control" value="<?php echo $rsedit[costad];?>">
			</div>
		</div>
		<?php */ ?>-->
		<div class="form-group">
			<label class="control-label">Quantity in 1 Pack <span class="errmsg" id="idqty"></span></label>
			<div class="controls">
				<input type="text" name="qty" placeholder="Enter Quantity" class="form-control" value="<?php echo $rsedit[quantity]; ?>">
			</div>
		</div>	
<?php } ?>

<?php if (($_SESSION['emptype']=='Admin') AND (!isset($_GET[editid]))){ ?>
		<div class="form-group">
			<label class="control-label">Product Image <span class="errmsg" id="idimgpath"></span></label>
			<div class="controls">
				<input type="file" name="imgpath" placeholder="Enter Product Image" class="form-control">
			</div>
		</div>
<?php } ?>

	<?php if ($_SESSION['emptype']=='Admin' || $_SESSION['emptype']=='Employee') { ?>

		<div class="form-group">
			<label class="control-label">Status <span class="errmsg" id="idstatus"></span></label>
			<div class="controls" class="form-control">
				<select  class="form-control" name="status">
				<!--<option value="">Select status</option>-->
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
	<?php } ?>
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
	var twodecexp = /^\d+(\.\d{1,2})?$/;
	/*Regular Expressions ends*/
	
	$(".errmsg").html('');
	//alert("test test");
	var errcondition = "true";
	if(document.frmform.categoryid.value=="")
	{
		document.getElementById("idcategoryid").innerHTML = "Category should not be empty...";
		errcondition ="false";		
	}
	if(document.frmform.selectcategory2.value=="")
	{
		document.getElementById("idsubcategoryid").innerHTML = "Sub Category should not be empty...";
		errcondition ="false";		
	}
	if(document.frmform.title.value=="")
	{
		document.getElementById("idtitle").innerHTML = "Title should not be empty...";
		errcondition ="false";		
	}
	if(document.frmform.description.value=="")
	{
		document.getElementById("iddescription").innerHTML = "Description should not be empty...";
		errcondition ="false";		
	}
	if(!document.frmform.costperproduct.value.match(twodecexp))
			{
			document.getElementById("idcostperproduct").innerHTML="Cost should contain only numeric values with 2 optional decimal places";
			errcondition ="false";
			}
    if(document.frmform.costperproduct.value=="")
	{
		document.getElementById("idcostperproduct").innerHTML = "Cost per Product should not be empty...";
		errcondition ="false";		
	}
	if(!document.frmform.cgsttaxpercentage.value.match(numericExpression))
			{
			document.getElementById("idcgsttaxpercentage").innerHTML="Entered CGST Tax should contain only numeric values...";
			}
		if(document.frmform.cgsttaxpercentage.value=="")
		{
			document.getElementById("idcgsttaxpercentage").innerHTML = "CGST Tax should not be empty...";
			errcondition ="false";		
		}
		if(!document.frmform.sgsttaxpercentage.value.match(numericExpression))
			{
			document.getElementById("idsgsttaxpercentage").innerHTML="Entered SGST Tax should contain only numeric values...";
			}
		if(document.frmform.sgsttaxpercentage.value=="")
		{
			document.getElementById("idsgsttaxpercentage").innerHTML = "SGST Tax should not be empty...";
			errcondition ="false";		
		}
		if(!document.frmform.igsttaxpercentage.value.match(numericExpression))
			{
            document.getElementById("idigsttaxpercentage").innerHTML= "Entered IGST Tax should contain only numeric values...";
			}
		if(document.frmform.igsttaxpercentage.value=="")
		{
			document.getElementById("idigsttaxpercentage").innerHTML = "IGST Tax should not be empty...";
			errcondition ="false";		
		}
		if(!document.frmform.discount.value.match(twodecexp))
			{
			document.getElementById("iddiscount").innerHTML="Discount should contain only numeric values with 2 optional decimal places";
			errcondition ="false";
			}
		if(document.frmform.discount.value=="")
		{
			document.getElementById("iddiscount").innerHTML = "Discount should not be empty...";
			errcondition ="false";		
		}
		if(document.frmform.qty.value=="")
		{
			document.getElementById("idqty").innerHTML = "Quantity should not be empty...";
			errcondition ="false";		
		}
		<?php if ($_SESSION['emptype']=='Admin' || $_SESSION['emptype']=='Employee') { ?>
	if(document.frmform.status.value=="")
	{
		document.getElementById("idstatus").innerHTML = "Status should not be empty...";
		errcondition ="false";		
	}
<?php } ?>
	if(document.frmform.editid.value== 0)
		{
			if(document.frmform.imgpath.value=="")
			{
				document.getElementById("idimgpath").innerHTML = "Image Path should not be empty...";
				errcondition ="false";		
			}
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

function calculatetax()
	{
		//costperproduct cgsttaxpercentage cgsttaxamount sgsttaxpercentage sgsttaxamount 		igsttaxpercentage igsttaxamount discount costad
		document.getElementById("cgsttaxamount").value= parseFloat(document.getElementById("costperproduct").value) * parseFloat(document.getElementById("cgsttaxpercentage").value) / 100;
		document.getElementById("sgsttaxamount").value= parseFloat(document.getElementById("costperproduct").value) * parseFloat(document.getElementById("sgsttaxpercentage").value) / 100;
		document.getElementById("igsttaxamount").value= parseFloat(document.getElementById("costperproduct").value) * parseFloat(document.getElementById("igsttaxpercentage").value) / 100;
		document.getElementById("totamtpercostwithtax").value  = parseFloat(document.getElementById("costperproduct").value) + parseFloat(document.getElementById("cgsttaxamount").value) + parseFloat(document.getElementById("sgsttaxamount").value) + parseFloat(document.getElementById("igsttaxamount").value);
		document.getElementById("costad").value= parseFloat(document.getElementById("totamtpercostwithtax").value) - parseFloat(document.getElementById("discount").value);
	}
	
		window.onload = calculatetax;
		
</script>

<script>
function fillsubcategory(catid,subcatid)
{
	if(window.XMLHttpRequest)
	{
		xmlhttp= new XMLHttpRequest();
	}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			//alert(xmlhttp.responseText);
			document.getElementById("selectcategory2").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajaxsubcat.php?q="+catid+"&p="+subcatid, true);
	xmlhttp.send();
}
</script>