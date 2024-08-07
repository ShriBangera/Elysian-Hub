<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if (($_SESSION[emptype]!="Employee") && ($_SESSION[emptype]!="Admin") && ($_SESSION[emptype]!="Seller"))
 {
   echo "<script>window.location='../index.php';</script>";
 }
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a class="text-primary" href="viewcategory.php">Total Active Categories</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4><?php
            $sql ="SELECT * FROM category WHERE status='Active'";
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="text-success" href="viewsubcategory.php">Total Active Sub Categories</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4><?php
            $sql ="SELECT * FROM sub_category WHERE status='Active'";
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php if (($_SESSION[emptype]=="Employee") || ($_SESSION[emptype]=="Admin")) {?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a class="text-info" href="viewcustomer.php">Active Customers</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4><?php
            $sql ="SELECT * FROM customer WHERE status='Active'";
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fa fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a class="text-warning" href="viewemployee.php">No. of Active Emplyees</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4><?php
            $sql ="SELECT * FROM employee WHERE status='Active'";
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users-cog fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php } ?>    

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a class="text-primary" href="viewproduct.php">Total No. of Products</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4><?php
             if (($_SESSION[emptype]=="Employee") || ($_SESSION[emptype]=="Admin")) 
              { 
                $sql ="SELECT * FROM product WHERE status='Active'"; 
              }else
              {
                $sql ="SELECT * FROM product WHERE status='Active' AND comp_id='$_SESSION[comp_id]'";
              }
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-drumstick-bite fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="text-success" href="viewpurchase.php">No. of purchase</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4><?php
                if (($_SESSION[emptype]=="Employee") || ($_SESSION[emptype]=="Admin")) 
              { 
                $sql ="SELECT * FROM purchase WHERE deliverystatus='Delivered'"; 
              }else
              {
                $sql ="SELECT * FROM purchase WHERE deliverystatus='Delivered' AND companyid='$_SESSION[comp_id]'";
              }
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-shopping-basket fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php if (($_SESSION[emptype]=="Employee") || ($_SESSION[emptype]=="Admin")) {?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a class="text-info" href="viewseller.php">No. of Active Seller</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4><?php
            $sql ="SELECT * FROM seller WHERE status='Active'";
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-store fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>  


    <!-- Earnings (Monthly) Card Example -->
    <!--<div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>-->    
  </div>
  <!-- Content Row -->








  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>