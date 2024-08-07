<?php 
include("includes/dbconnection.php");
session_start();
if(isset($_GET["q"]))
{
	
	$rst = mysqli_query($con, "Select * from sub_category where status='Active' AND categoryid=".$_GET['q']);
	echo "<option value=''>-- Select --</option>";
	while($row=mysqli_fetch_array($rst))
	{
		if(isset($_GET["p"]) && $_GET["p"] != "0")
		{
		 echo "<option value='".$row[0]."' selected>".$row[2]."</option>";
		}
		else
		{
			echo "<option value='".$row[subcategoryid]."'>".$row[subcategorytype]."</option>";
		}
	}
}

if(isset($_GET["e"]))
{
	
	$rst = mysqli_query($con, "Select basicsalary from employee where employeeid=".$_GET['e']);
	if(mysqli_num_rows($rst) >0)
	{
		$result = mysqli_fetch_array($rst);
		echo $result[0];
	}
}

/*if(isset($_GET["brandid"]))
{
	$rst = mysqli_query($con, "Delete from brand where brand_id=".$_GET['brandid']);
	if($rst)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
	
}

if(isset($_GET["brand"]))
{
	$rst = mysqli_query($con, "select * from brand where brand_name='".$_GET['brand']."'");
	if(mysqli_num_rows($rst) > 0)
	{
		echo "Already Exist";
	}
	else
	{
		echo "NA";
	}	
}

if(isset($_GET["catid"]))
{
	$rst = mysqli_query($con, "update beautycategory set status='Inactive' where cat_id=".$_GET['catid']);
	if($rst)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
	
}

if(isset($_GET["subcatid"]))
{
	$rst = mysqli_query($con, "delete from beautysubcat where subcat_id=".$_GET['subcatid']);
	if($rst)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
	
}
if(isset($_GET["prodid"]))
{
	
	
	$rst = mysqli_query($con, "insert into cart (prodid, qty, userid) values ('".$_GET['prodid']."',1,'".$_SESSION['uid']."')");
	if($rst)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
}

if(isset($_GET["boid"]))
{
	$rst = mysqli_query($con, "Delete from brandoffer where offer_id=".$_GET['boid']);
	if($rst)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
	
}
if(isset($_GET["sellerid"]))
{
	$rst = mysqli_query($con, "update seller set status='Blocked' where seller_id=".$_GET['sellerid']);
	if($rst)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
	
}
if(isset($_GET["user_id"]))
{
	$userid = mysqli_query($con, "update user where user_id=".$_GET['user_id']);
	if($userid)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
	
}

if(isset($_GET["pbrandid"]))
{
	$rst = mysqli_query($con, "Select * from product where brand_id=".$_GET['pbrandid']);
	echo "<option value='0'>-- Select --</option>";
	while($row=mysqli_fetch_array($rst))
	{
	echo "<option value='".$row[0]."'>".$row[1]."</option>";
	}
}
*/
?>