<?php 
include 'header.php';
include 'qtymanager.php';
if(isset($_GET[wishid]))
{
    $sql = "DELETE FROM wishlist where w_id='$_GET[wishid]'";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    echo "<script>alert('One item deleted from Wishlist');</script>";
    echo "<script>window.location='wishlist.php';</script>";
}
if(isset($_GET[cartprodid]))
{
    $sql0 = "SELECT * FROM purchase WHERE customerid='$_SESSION[customerid]' AND productid='$_GET[cartprodid]' AND status='Pending'";
    $qsql0 = mysqli_query($con,$sql0);
     if(mysqli_num_rows($qsql0)>=1)
     {
             echo "<script>alert('This item already exist in cart');</script>";
             echo "<script>window.location='cart.php#cimg$_GET[cartprodid]';</script>";
     }else
     {
       $sql ="INSERT INTO purchase(customerid,productid,qty,cost,status,companyid,sellerpayment) VALUES('$_SESSION[customerid]','$_GET[cartprodid]','1','$_GET[cartcost]','Pending','$_GET[cartcompid]','notpaid')";
        if($qsql = mysqli_query($con,$sql))
        {
             echo "<script>alert('Item added to cart');</script>";
             echo "<script>window.location='cart.php#cimg$_GET[cartprodid]';</script>";   
        }
        echo mysqli_error($con);
     }
}
?>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Wishlist</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="products.php">Shop</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Wishlist  -->
    <div class="wishlist-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Unit Price </th>
                                    <th>Stock</th>
                                    <th>Add Item</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$total =0;
 $sql =  "SELECT wishlist.*,product.productid,product.comp_id,product.title,product.costad,product_image.imgpath FROM wishlist LEFT JOIN product ON wishlist.productid=product.productid LEFT JOIN product_image ON product_image.productid=product.productid  WHERE wishlist.custid='$_SESSION[customerid]' GROUP BY wishlist.w_id";
                            $qsql = mysqli_query($con,$sql);
                            while($rs = mysqli_fetch_array($qsql))
                            {
                                
            if($rs[imgpath] == "")
            {
                $imgproduct = "themes/images/No-image-found.jpg";
            }
            else if(file_exists("imgproduct/".$rs[imgpath]))
            {
                $imgproduct = "imgproduct/".$rs[imgpath];
            }
            else
            {
                $imgproduct = "themes/images/No-image-found.jpg";
            }
?>        
<?php
        $sqlpurchase = "SELECT ifnull(sum(quantity),0) FROM stock where productid='$rs[1]'"; //$rs[1]=productid
        $qsqlpurchase =mysqli_query($con,$sqlpurchase);
        $rspurchase = mysqli_fetch_array($qsqlpurchase);
        $sqlsales = "SELECT ifnull(sum(qty),0) FROM purchase where purchase.productid='$rs[1]' AND purchase.status!='Pending'";
        $qsqlsales =mysqli_query($con,$sqlsales);
        $rssales = mysqli_fetch_array($qsqlsales);      
        $totqty =$rspurchase[0] - $rssales[0];
?>
                                

                                    <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
                                    <img class="img-fluid" src="<?php echo $imgproduct; ?>" alt="" />
                                        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="product-detail.php?productid=<?php echo $rs[productid]; ?>">
                                    <?php echo $rs[title]; ?>
                                        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p>&#8377; <?php echo $rs[costad] ?></p>
                                    </td>
                                    <td class="quantity-box"><?php echo $totqty; ?></td>
                            
                                    <?php if($totqty>=1){ ?>
                                     <td class="add-pr" onclick="addtocart('<?php echo $rs[1]; ?>','<?php echo $rs[costad]; ?>','<?php echo $rs[comp_id]; ?>')">
                                        <a class="btn hvr-hover" href="#">Add to Cart</a>
                                    </td>
                                    <?php }else{echo "<td>(Out of Stock)</td>";} ?>
                
                                  
                                  <td class="remove-pr">
                                        <a href="#">
                                    <i class="fas fa-times" onclick="deleterecord('<?php echo $rs[0]; ?>')"></i>
                                </a>
                                    </td>
                                </tr>
<?php } ?>
                            
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Wishlist -->

<?php
include 'ourpartners.php';
include 'footer.php';
?>
<script>
function deleterecord(wishid)         
  {
      if(confirm("Are you sure want to delete this product from wishlist?") == true)
      {
        window.location="wishlist.php?wishid="+wishid;
      }
      else
      {
          return false;
      }
  }

  function addtocart(cartprodid,cartcost,cartcompid)         
  {
      
        window.location="wishlist.php?cartprodid="+cartprodid+"&cartcost="+cartcost+"&cartcompid="+cartcompid;
  }
</script>    