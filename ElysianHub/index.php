<?php
include 'header.php';
if($_SESSION[emptype]=="Admin" || $_SESSION[emptype]=="Employee" || $_SESSION[emptype]=="Seller")
{echo "<script>window.location='admin/index.php';</script>";}
?>

    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="imgproduct\background1.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Elysian Hub</strong></h1>
                            <p class="m-b-40">Creating spaces that feel like home.!</p>
                            <p><a class="btn hvr-hover" href="products.php">Shop Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="imgproduct\background2.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Elysian Hub</strong></h1>
                            <p class="m-b-40">Transforming Spaces, <br> Elevating Homes</p>
                            <p><a class="btn hvr-hover" href="products.php">Shop Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="imgproduct\background3.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Elysian Hub</strong></h1>
                            <p class="m-b-40">Your dream home starts here.</p>
                            <p><a class="btn hvr-hover" href="products.php">Shop Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">
                <?php $sql = "SELECT * FROM category WHERE status='Active' ORDER BY `categorytype` ASC";
                            $qsql = mysqli_query($con,$sql);
                            while($rs = mysqli_fetch_array($qsql))
                            {
                echo "<div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                    <div class='shop-cat-box'>
                        <img class='img-fluid' src='imgcategory/$rs[categoryimg]' alt='$rs[description]' style='height:300px;object-fit: cover;'/>
                        <a class='btn hvr-hover' href='products.php?categoryid=$rs[categoryid]'>$rs[categorytype]</a>
                    </div>
                </div>";
                }
                ?>
                
            </div>
        </div>
    </div>
    <!-- End Categories -->
<?php
include 'ourpartners.php';
include 'footer.php';
?>