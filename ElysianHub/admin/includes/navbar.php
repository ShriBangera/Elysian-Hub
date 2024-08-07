   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
<?php
  if($_SESSION[emptype] == "Admin")
  {
  echo "<div class='sidebar-brand-text mx-3'>Admin <sup>Dashboard</sup></div>";  
  }elseif ($_SESSION[emptype]=="Employee") 
  {
    echo "<div class='sidebar-brand-text mx-3'>Employee <sup>Dashboard</sup></div>";
  }elseif ($_SESSION[emptype]=="Seller") 
  {
  echo "<div class='sidebar-brand-text mx-3'>Seller <sup>Dashboard</sup></div>";  
  }
?>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item singlenave">
  <a class="nav-link" href="index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<?php
if($_SESSION[emptype]=="Admin" || $_SESSION[emptype]=="Employee"){ ?>
<!-- Nav Item - Products Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-drumstick-bite"></i>
    <span>Products</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="viewproduct.php">View products</a>
      <a class="collapse-item" href="viewproductstock.php">View Product stock</a>
    </div>
  </div>
</li>

<?php if($_SESSION[emptype] == "Admin"){ ?> 
<!-- Nav Item - Employee Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities1">
    <i class="fas fa-user-friends"></i>
    <span>Employees</span>
  </a>
  <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="employee.php">Add Employee</a>
      <a class="collapse-item" href="viewemployee.php">View Employee</a>
      <a class="collapse-item" href="salary.php">Salary</a>
      <a class="collapse-item" href="attendance.php">Put Attendance</a>
      <a class="collapse-item" href="viewattendance.php">View Attendance</a>
      <!--<a class="collapse-item" href="viewempsalary.php">View Employee Salary</a>-->
    </div>
  </div>
</li>
<?php } ?>

<!-- Nav Item - Category Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
   <i class="fas fa-list"></i>
    <span>Category</span>
  </a>
  <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="category.php">Add Category</a>
      <a class="collapse-item" href="subcategory.php">Add Sub Category</a>
      <a class="collapse-item" href="viewcategory.php">View Categories</a>
      <a class="collapse-item" href="viewsubcategory.php">View Subcategories</a>
    </div>
  </div>
</li>

<!-- Nav Item - Seller Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities3">
    <i class="far fa-user"></i>
    <span>Seller</span>
  </a>
  <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="viewsellerapplication.php">Seller Applications</a>
      <a class="collapse-item" href="viewseller.php">View Sellers</a>
      <a class="collapse-item" href="adminpay.php">Seller Payment</a>
      <a class="collapse-item" href="viewsellerpayment.php">View Seller Payment</a>
    </div>
  </div>
</li>

<!-- Nav Item - Report Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4" aria-expanded="true" aria-controls="collapseUtilities4">
    <i class="fas fa-clipboard"></i>
    <span>Report</span>
  </a>
  <div id="collapseUtilities4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="viewcustomer.php">Customer Report</a>
      <a class="collapse-item" href="viewpurchase.php">Purchase Report</a>
      <a class="collapse-item" href="viewbilling.php">Billing Report</a>
      <a class="collapse-item" href="viewempsalary.php">Salary Report</a>
      <a class="collapse-item" href="viewstockreport.php">Stock Report</a>
    </div>
  </div>
</li>

<li class="nav-item singlenave">
  <a class="nav-link" href="viewfeedback.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Feedback</span></a>
</li>

<?php } else if(isset($_SESSION[comp_id])){ ?>

<!-- Nav Item - Products Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="true" aria-controls="collapseTwo5">
    <i class="fas fa-drumstick-bite"></i>
    <span>Products</span>
  </a>
  <div id="collapseTwo5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="product.php">Add product</a>
      <a class="collapse-item" href="viewproduct.php">View Product</a>
    </div>
  </div>
</li>

<!-- Nav Item - Category Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
   <i class="fas fa-list"></i>
    <span>Category</span>
  </a>
  <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="viewcategory.php">View Categories</a>
      <a class="collapse-item" href="viewsubcategory.php">View Subcategories</a>
    </div>
  </div>
</li>

<!-- Nav Item - Products Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo15" aria-expanded="true" aria-controls="collapseTwo15">
    <i class="fas fa-cubes"></i>
    <span>Stocks</span>
  </a>
  <div id="collapseTwo15" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="addstock.php">Add products to stock</a>
      <a class="collapse-item" href="viewproductstock.php">View Product stock</a>
    </div>
  </div>
</li>

<!-- Nav Item - Report Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities6" aria-expanded="true" aria-controls="collapseUtilities6">
    <i class="fas fa-clipboard"></i>
    <span>Report</span>
  </a>
  <div id="collapseUtilities6" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="viewpurchase.php">Purchase Report</a>
      <a class="collapse-item" href="viewbilling.php">Billing Report</a>
      <a class="collapse-item" href="viewsellerpayment.php">Seller Payment Report</a>
      <a class="collapse-item" href="viewstockreport.php">Stock Report</a>
    </div>
  </div>
</li>
<?php } ?>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
             <div class="col-xl-6 col-md-6 mb-4">
            <img src="admin\logo.png" class="logo" alt="">
            </div> 
            </div>
          </form>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <?php /*<li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li> */ ?>

            <!-- Nav Item - Alerts -->
            <?php /*<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li> */ ?>

            <!-- Nav Item - Messages -->
            <?php /*<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li> */ ?>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <?php if($_SESSION[emptype] == "Admin"){ ?> 
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION[employeename]; ?></span>
               <i class="fas fa-user-tie fa-lg" style="color: orange;"></i>
              </a>
            <?php } ?>
            <?php if($_SESSION[emptype] == "Employee"){ ?> 
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION[employeename]; ?></span>
               <i class="far fa-user-circle fa-lg" style="color: green;"></i>
              </a>
            <?php } ?>
            <?php if(isset($_SESSION[comp_id])){ ?> 
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION[sellername]; ?></span>
               <i class="fas fa-user-circle fa-lg" style="color: blue;"></i>
              </a>
            <?php } ?>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
<?php if($_SESSION[emptype]=="Admin" || $_SESSION[emptype]=="Employee"){ ?>
<a class="dropdown-item" href="employeeprofile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Update Profile</a>
<a class="dropdown-item" href="changeadminpassword.php">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>Change Password</a>
<?php } ?>
<?php if(isset($_SESSION[comp_id])){ ?>
<a class="dropdown-item" href="sellerprofile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Update Profile</a>
<a class="dropdown-item" href="sellerchangepassword.php">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>Change Password</a>
<a class="dropdown-item" href="sellerbankaccount.php">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Bank Details</a>
<?php } ?>  
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top" style="z-index: 1;">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form action="logout.php" method="POST"> 
          
            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

          </form>


        </div>
      </div>
    </div>
  </div>