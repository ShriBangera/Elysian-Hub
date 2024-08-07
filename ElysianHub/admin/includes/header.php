<?php
session_start();
error_reporting(0);
include 'dbconnection.php';
$dt = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> ElysianHub | Admin Panel</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!--ANWAR code starts-->
  <!--for datatable-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<style>
#load{
    width:100%;
    height:100%;
    position:fixed;
    top:0px;
    left:0px;
    z-index:9999;
    background:url("loader1.gif") no-repeat 50% 50% rgba(255,255,255,0.9);
}
#load2{
    width:100%;
    height:100%;
    position:fixed;
    top:0px;
    left:0px;
    z-index:9999;
    background:url("loader1.gif") no-repeat 50% 50% rgba(255,255,255,0.9);
    display: none;
    visibility: hidden;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

document.onreadystatechange = function() { 
    if (document.readyState !== "complete") { 
        document.querySelector("body").style.visibility = "hidden"; 
        document.querySelector("#load").style.visibility = "visible"; 
    } else { 
        document.querySelector("#load").style.display = "none"; 
        document.querySelector("body").style.visibility = "visible"; 
    } 
};</script>
  <!--Anwar code ends-->

</head>
<body id="page-top">
  <div id="load"></div>

  <!-- Page Wrapper -->
  <div id="wrapper">