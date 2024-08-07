<?php
include("includes/dbconnection.php"); 
session_start();
error_reporting(0);


if(isset($_GET['sellerid']))
{
	$sellerid = $_GET['sellerid'];
	$total = $_GET['total'];
	$admin_per = $_GET['admin_per'];
	//$final_amt = $_GET['amt'];
	$final_amt = $total - (($total*$admin_per)/100);
	$paid_date = date('Y-m-d');
	$limit = $_GET['noitems'];
	if($total  > 0)
	{
	$qry = mysqli_query($con, "insert into sellerpayment(sellerid,total_amt,paidamount,admin_per,paid_date) values($sellerid,'$total','$final_amt','$admin_per','$paid_date')");
		if($qry)
		{
			//make sellerpayment field in purchase table to paid
			$qry2 = "SELECT purchase.purchaseid,purchase.productid,purchase.status,purchase.sellerpayment,purchase.deliverystatus FROM purchase inner join product on purchase.productid = product.productid WHERE purchase.sellerpayment !='paid' and product.comp_id='$sellerid' and purchase.status!='Pending' AND purchase.deliverystatus='Delivered' ORDER BY purchase.purchaseid ASC limit $limit";
			$rs = mysqli_query($con, $qry2);
			while($row1 = mysqli_fetch_array($rs))
			{
				$qry3 = "UPDATE purchase SET sellerpayment='paid' WHERE purchaseid='$row1[purchaseid]'";
				$rs3 = mysqli_query($con, $qry3);
			}

			    //mailing information to seller
                $sqlseller1 ="SELECT * FROM seller where comp_id ='$sellerid'";
                $qsqlseller1 = mysqli_query($con,$sqlseller1);
                $rsseller1 = mysqli_fetch_array($qsqlseller1); 
                $to = $rsseller1['emailid'];
                $subject = "MeatZone Seller Payment Credited";
                $txt = "<b>Hello $rsseller1[compname],</b> <br><br> Your Payment is credited to your bank account.<br>Total amount - RS.$total<br>Admin commission - $admin_per%<br>Credited amount - <b>$final_amt</b>";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: meatzone.online";
                mail($to,$subject,$txt,$headers);
			echo "success";
		}
		else 
		{
			echo "error"; 
	    }
	}
	else
	{
		echo "Payment can not be done now!!";
	}
}


?>