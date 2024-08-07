<?php
include("header.php");
//if(isset($_POST[submit]))

	    $sqlproduct = "SELECT * FROM product WHERE productid='$_GET[productid]'";
	    $qsqlproduct = mysqli_query($con,$sqlproduct);
	    $rsproduct = mysqli_fetch_array($qsqlproduct);
	    //mine code
	    //$sqlproduct2 = "SELECT comp_id FROM product WHERE productid='$_GET[productid]'";
        //$qsqlproduct2 = mysqli_query($con,$sqlproduct2);
	    //$rsproduct2 = mysqli_fetch_array($qsqlproduct2);
        //$sql2 ="INSERT INTO purchase(companyid) VALUES('$rsproduct2[comp_id]')";	    
        //$qsql2 = mysqli_query($con,$sql2);
        //mine ends
        if(isset($_GET['btnaddtowishlist']))
        {
        $sql ="INSERT INTO wishlist(productid,custid) VALUES('$_GET[productid]','$_SESSION[customerid]')";
	    $qsql = mysqli_query($con,$sql);
     	echo mysqli_error($con);
     	echo "<script>alert('Item added to Wishlist');</script>";
        echo "<script>window.location='wishlist.php';</script>";	
        }else{
		
	    $sql ="INSERT INTO purchase(customerid,productid,qty,cost,status,companyid,sellerpayment) VALUES('$_SESSION[customerid]','$_GET[productid]','$_GET[cartqty]','$rsproduct[costad]','Pending','$rsproduct[comp_id]','notpaid')";
	    $qsql = mysqli_query($con,$sql);
     	echo mysqli_error($con);
     	if(mysqli_affected_rows($con) == 1)
    	{
			if(isset($_GET['btnbuynow']))
			{
				echo "<script>window.location='checkout.php';</script>";
			}
			if(isset($_GET['btnaddtocart']))
			{
		echo "<SCRIPT>alert('Product added to the cart...');</SCRIPT>";
				echo "<script>window.location='cart.php';</script>";
			}
	    }
}

           include("footer.php");
			?>
			