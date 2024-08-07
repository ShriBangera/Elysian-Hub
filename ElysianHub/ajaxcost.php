<?php
//purchaseid qty cost
session_start();
include("dbconnection.php");
$sql ="UPDATE purchase SET qty='$_GET[tqty]' where purchaseid='$_GET[purchaseid]'";
$qsql = mysqli_query($con,$sql);
$total=0;
/*$sql =  "SELECT purchase.*,billing.bill_type,customername,product.title,product_image.imgpath FROM purchase LEFT JOIN billing ON purchase.billingid=billing.billingid LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid LEFT JOIN product_image ON product_image.productid=product.productid  WHERE purchase.customerid='$_SESSION[customerid]' AND purchase.status='Pending' GROUP BY purchase.purchaseid";*/
$sql="SELECT purchase.*,customername,product.title,product_image.imgpath FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid LEFT JOIN product_image ON product_image.productid=product.productid  WHERE purchase.customerid='$_SESSION[customerid]' AND purchase.status='Pending' GROUP BY purchase.purchaseid";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	$sqlpurchase = "SELECT ifnull(sum(quantity),0) FROM stock where productid='$rs[2]'"; //$rs[3]=productid
    $qsqlpurchase =mysqli_query($con,$sqlpurchase);
    $rspurchase = mysqli_fetch_array($qsqlpurchase);
    $sqlsales = "SELECT ifnull(sum(qty),0) FROM purchase where purchase.productid='$rs[2]' AND purchase.status!='Pending'";
    $qsqlsales =mysqli_query($con,$sqlsales);
    $rssales = mysqli_fetch_array($qsqlsales);      
    $totqty =$rspurchase[0] - $rssales[0];
    if($totqty>0){
	               $total = $total + ($rs[3] * $rs[4]);
                 }
}
echo $total
?>