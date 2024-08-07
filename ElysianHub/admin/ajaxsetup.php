<?php
include("includes/dbconnection.php");
error_reporting(0);
session_start();
if(isset($_GET['month']))
{
	$daysinmonth = cal_days_in_month(CAL_GREGORIAN, $_GET['month'], $_GET['syear']);
	echo $daysinmonth;
}
if(isset($_GET['smonth']))
{
	$daysinmonth = cal_days_in_month(CAL_GREGORIAN, $_GET['smonth'], $_GET['year']);
	$st_date = $_GET['year']."-".$_GET['smonth']."-01";
	$end_date = $_GET['year']."-".$_GET['smonth']."-".$daysinmonth;
	
	$q = "SELECT COUNT(`attendance_type`) as tcount,(SELECT COUNT(`attendance_type`) FROM `attendance` WHERE `empid`='".$_GET['empid']."'and attendance_type = 'Half Day' and date between '$st_date' and '$end_date') as halfday FROM `attendance` WHERE `empid`='".$_GET['empid']."' and attendance_type = 'Present' and date between '$st_date' and '$end_date'";
	
	$res = mysqli_query($con, $q);
	$row = mysqli_fetch_array($res);
	
	$presentdays = $row['tcount'] + ($row['halfday']/2);
	
	echo $presentdays;
}




?>