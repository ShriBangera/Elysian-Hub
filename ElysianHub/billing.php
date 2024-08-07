<?php
include 'header.php';
?>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Invoice</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">My Invoice</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start My Account  -->
    <div class="my-account-box-main">
        <div class="container">
    <div class="row">
<div class="col-md-12" style="margin: auto;overflow-x: auto;"> 
<div class="col-md-12" style="margin: auto;overflow-x: auto;"> 
<iframe style="width: 100%;height: 1000px;" src="billingreceipt.php?purchaseid=<?php echo $_GET[purchaseid]; ?>" frameBorder="0"></iframe>
</div>
</div>
</div>
        </div>
    </div>
    <!-- End My Account -->

<?php
include 'ourpartners.php';
include 'footer.php';
?>


  

 