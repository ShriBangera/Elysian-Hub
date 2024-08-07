

<?php
include 'header.php';
$sql = "SELECT product.*,category.categorytype  FROM product LEFT JOIN category ON product.categoryid=category.categoryid LEFT JOIN seller ON seller.comp_id=product.comp_id WHERE product.status='Active' AND product.productid='$_GET[productid]'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);
?>

<!-- ANWAR CSS starts-->
<style type="text/css">
    .mybtn1{
        border:none;
        padding: 0;
}
a#activea:hover{
color: white;
}
</style>
<!-- ANWAR CSS ends-->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Product Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Product Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
 <?php
        $sqledit = "SELECT * FROM product_image WHERE productid='$rs[0]'";
        $qsqledit = mysqli_query($con,$sqledit);
        $c=0;
        while($rsedit = mysqli_fetch_array($qsqledit))
        {
            if($rsedit[imgpath] == "")
            {
                $imgproduct = "themes/images/No-image-found.jpg";
            }
            else if(file_exists("imgproduct/".$rsedit[imgpath]))
            {
                $imgproduct = "imgproduct/".$rsedit[imgpath];
            }
            else
            {
                $imgproduct = "themes/images/No-image-found.jpg";
            }
            $c++;
?>      
                            <div class="carousel-item <?php if($c==1){echo"active";} ?>"> <img class="d-block w-100" src="<?php echo $imgproduct; ?>" alt="<?php echo $rsedit[description]; ?>" style="height:300px;object-fit:contain;"> </div>
<?php
        }
?>
                            

                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span> 
                    </a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
                        <i class="fa fa-angle-right" aria-hidden="true"></i> 
                        <span class="sr-only">Next</span> 
                    </a>
                        <ol class="carousel-indicators">
<?php
                            $c=0;
        $sqledit = "SELECT * FROM product_image WHERE productid='$rs[0]'";
        $qsqledit = mysqli_query($con,$sqledit);
        while($rsedit = mysqli_fetch_array($qsqledit))
        {
            if($rsedit[imgpath] == "")
            {
                $imgproduct = "themes/images/No-image-found.jpg";
            }
            else if(file_exists("imgproduct/".$rsedit[imgpath]))
            {
                $imgproduct = "imgproduct/".$rsedit[imgpath];
            }
            else
            {
                $imgproduct = "themes/images/No-image-found.jpg";
            }
            

?>      
                            <li data-target="#carousel-example-1" data-slide-to="<?php echo "$c"; ?>" class="<?php if($c==0){echo"active";} ?>">
                                <img class="d-block w-100 img-fluid" src="<?php echo $imgproduct; ?>" alt="<?php echo $rsedit[description]; ?>" />
                            </li>
<?php
$c++;
        }
?>
                            
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
            <form method="get" action="purchase.php">
            <input type="hidden" name="productid" value="<?php echo $_GET[productid]; ?>" >
                        <h2><?php echo $rs[title]; ?></h2>
                        <h5> <del>&#8377;<?php echo $rs[costbd]; ?></del> &#8377;<?php echo $rs[costad]; ?></h5>
                        <?php
        $sqlpurchase = "SELECT ifnull(sum(quantity),0) FROM stock where productid='$_GET[productid]'";
        $qsqlpurchase =mysqli_query($con,$sqlpurchase);
        $rspurchase = mysqli_fetch_array($qsqlpurchase);
        $sqlsales = "SELECT ifnull(sum(qty),0) FROM purchase where purchase.productid='$_GET[productid]' AND purchase.status!='Pending'";
        $qsqlsales =mysqli_query($con,$sqlsales);
        $rssales = mysqli_fetch_array($qsqlsales);      
        $totqty =$rspurchase[0] - $rssales[0];
        ?>            
                        <h3> <b><?php echo $rs[compname]; ?></b></h3>
                        <p class="available-stock"><span>In Stock <a href="#"><?php echo $totqty; ?></a></span></p>
                        <h4>Short Description:</h4>
                        <p><?php echo $rs[description]; ?></p>
                            <start>
                                <start1>
                                    <?php 
if(isset($_SESSION[customerid]))
{
    $sqlcartview= "SELECT * FROM purchase WHERE status='Pending' AND customerid='$_SESSION[customerid]' AND productid='$_GET[productid]'";
    $qsqlcartview = mysqli_query($con,$sqlcartview);
    if(mysqli_num_rows($qsqlcartview) == 0)
    {
?>          
    
        <?php
        $sqlpurchase = "SELECT ifnull(sum(quantity),0) FROM stock where productid='$_GET[productid]'";
        $qsqlpurchase =mysqli_query($con,$sqlpurchase);
        $rspurchase = mysqli_fetch_array($qsqlpurchase);
        $sqlsales = "SELECT ifnull(sum(qty),0) FROM purchase where purchase.productid='$_GET[productid]' AND purchase.status!='Pending'";
        $qsqlsales =mysqli_query($con,$sqlsales);
        $rssales = mysqli_fetch_array($qsqlsales);      
        $totqty =$rspurchase[0] - $rssales[0];
        ?>

            
        <?php
        if($totqty >0) 
        {
        ?>
        
                        <ul>
                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control" type="number" min="1" max="<?php echo $totqty; ?>"  id="cartqty" name="cartqty"  value="1">
                                </div>
                            </li>
                        </ul>
                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                              <button class="mybtn1" type="submit" name="btnbuynow"><a id="activea" class="btn hvr-hover" data-fancybox-close="">Buy Now</a></button>
                                <button class="mybtn1"  type="submit" name="btnaddtocart"><a id="activea" class="btn hvr-hover" data-fancybox-close="" >Add to cart</a></button>
                            <?php
                            $sqlwishlistview= "SELECT * FROM wishlist WHERE custid='$_SESSION[customerid]' AND productid='$_GET[productid]'";
                                $qsqlwishlistview = mysqli_query($con,$sqlwishlistview);
                                if(mysqli_num_rows($qsqlwishlistview) >= 1)
                                { ?>
                                <button class="mybtn1" type="button" name="" onclick="window.location='wishlist.php'"><a class="btn hvr-hover" data-fancybox-close="" href="#"><i class="fas fa-heart"></i> View Wishlist</a></button>
                            <?php }else
                            { ?>
                              <button class="mybtn1"  type="submit" name="btnaddtowishlist"><a id="activea" class="btn hvr-hover" data-fancybox-close="" ><i class="far fa-heart"></i> Add to Wishlist</a></button>
                            <?php } ?>                                
                                
                            </div>
                        </div>

                        <div class="add-to-btn">
                            <div class="add-comp">
                                <!--<button class="mybtn1"><a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a></button>-->
                            </div>
                            <div class="share-bar">
                                <a class="btn hvr-hover" href="https://www.facebook.com/profile.php"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://twitter.com/?lang=en"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://in.pinterest.com/"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://api.whatsapp.com/"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                            </div>
                        </div>  

        
       
<?php
        }
        else
        {
?>
            <h4 style="color: red;">Out of Stock!</h4>
                <?php
                            $sqlwishlistview= "SELECT * FROM wishlist WHERE custid='$_SESSION[customerid]' AND productid='$_GET[productid]'";
                                $qsqlwishlistview = mysqli_query($con,$sqlwishlistview);
                                if(mysqli_num_rows($qsqlwishlistview) >= 1)
                                { ?>
                                <button class="mybtn1" type="button" name="" onclick="window.location='wishlist.php'"><a class="btn hvr-hover" data-fancybox-close="" href="#"><i class="fas fa-heart"></i> View Wishlist</a></button>
                            <?php }else
                            { ?>
                              <button class="mybtn1"  type="submit" name="btnaddtowishlist"><a id="activea" class="btn hvr-hover" data-fancybox-close="" ><i class="far fa-heart"></i> Add to Wishlist</a></button>
                            <?php } ?> 
<?php
        }
    }
    else
    {
?>
    <h4>Product already exist in the cart..</h4>
    <div class="price-box-bar">
    <button class="mybtn1" type="button" name="" onclick="window.location='cart.php'"><a class="btn hvr-hover" data-fancybox-close="" href="#">View cart</a></button>
    </div>
                            <?php
                            $sqlwishlistview= "SELECT * FROM wishlist WHERE custid='$_SESSION[customerid]' AND productid='$_GET[productid]'";
                                $qsqlwishlistview = mysqli_query($con,$sqlwishlistview);
                                if(mysqli_num_rows($qsqlwishlistview) >= 1)
                                { ?>
                                <button class="mybtn1" type="button" name="" onclick="window.location='wishlist.php'"><a class="btn hvr-hover" data-fancybox-close="" href="#"><i class="fas fa-heart"></i> View Wishlist</a></button>
                            <?php }else
                            { ?>
                              <button class="mybtn1"  type="submit" name="btnaddtowishlist"><a id="activea" class="btn hvr-hover" data-fancybox-close="" ><i class="far fa-heart"></i> Add to Wishlist</a></button>
                            <?php } ?> 
<?php
    }
?>

            
<?php
}else
{
?> 
                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <a type="submit" name="btnbuynow" onclick="window.location='login.php?productid=<?php echo $_GET[productid]; ?>'" class="btn hvr-hover" data-fancybox-close="" >Buy Now</a>
                                <a type="submit" name="btnaddtocart" onclick="window.location='login.php?productid=<?php echo $_GET[productid]; ?>'" class="btn hvr-hover" data-fancybox-close="" >Add to cart</a>
                                <a type="submit" name="btnaddtowishlist" onclick="window.location='login.php?productid=<?php echo $_GET[productid]; ?>'" class="btn hvr-hover" data-fancybox-close="" ><i class="far fa-heart"></i> Add Wishlist</a>
                            </div>
                        </div>

                        <div class="add-to-btn">
                            <div class="add-comp">
                                <!--<a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>-->
                            </div>
                            <div class="share-bar">
                                <a class="btn hvr-hover" href="https://www.facebook.com/profile.php"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://twitter.com/?lang=en"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://in.pinterest.com/"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://api.whatsapp.com/"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                            </div>
                        </div>
<?php
}
?>
                                </start1>
                        

                        

</start></form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

<?php
include 'ourpartners.php';
include 'footer.php';
?>