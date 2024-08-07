
<?php
include 'header.php';
include 'qtymanager.php';
if(isset($_GET[purchaseid]))
{
    $sql = "DELETE FROM purchase where purchaseid='$_GET[purchaseid]'";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    echo "<script>alert('One item deleted from Cart...');</script>";
    echo "<script>window.location='cart.php';</script>";
}
?>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="products.php">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
$total =0;
 $sql =  "SELECT purchase.*,customername,product.title,product_image.imgpath FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid LEFT JOIN product_image ON product_image.productid=product.productid  WHERE purchase.customerid='$_SESSION[customerid]' AND purchase.status='Pending' GROUP BY purchase.purchaseid";
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
        $sqlpurchase = "SELECT ifnull(sum(quantity),0) FROM stock where productid='$rs[2]'"; //$rs[3]=productid
        $qsqlpurchase =mysqli_query($con,$sqlpurchase);
        $rspurchase = mysqli_fetch_array($qsqlpurchase);
        $sqlsales = "SELECT ifnull(sum(qty),0) FROM purchase where purchase.productid='$rs[2]' AND purchase.status!='Pending'";
        $qsqlsales =mysqli_query($con,$sqlsales);
        $rssales = mysqli_fetch_array($qsqlsales);      
        $totqty =$rspurchase[0] - $rssales[0];
?>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" id="cimg<?php echo $rs[productid]; ?>" src="<?php echo $imgproduct; ?>" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="product-detail.php?productid=<?php echo $rs[productid]; ?>">
									<?php echo $rs[title]; ?>
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>&#8377;<?php echo $rs[cost]; ?></p>
                                    </td>
                                    <td class="quantity-box">
                                    <?php if($totqty>0){ ?>
                                    <input type="number" id="qty<?php echo $rs[0]; ?>" <?php if($totqty<=0){ echo "min='0' max='0'";} else{ echo"min='1' max='$totqty'";} ?> value="<?php if($totqty<$rs[qty]){echo $totqty;} else{echo $rs[qty];} ?>" onchange="updatecart('<?php echo $rs[0]; ?>',this.value,'<?php echo $rs[cost]; ?>')"  onkeyup="updatecart('<?php echo $rs[0]; ?>',this.value,'<?php echo $rs[cost]; ?>')" size="4" class="c-input-text qty text qtyamtbar">
                                <?php } else {echo "(Out of Stock)";} ?>

                                    </td>
                                    <td class="total-pr">
                                        <p>&#8377;<span id="totalcost<?php echo $rs[0]; ?>"><?php if($totqty<=0){echo "0";} else{echo $rs[cost]*$rs[qty];} ?></span></p>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="#">
									<i class="fas fa-times" onclick="return deleterecord('<?php echo $rs[0]; ?>')"></i>
								</a>
                                    </td>
                                </tr>
<?php
if($totqty>0){
    $total = $total + ($rs[cost]*$rs[qty]);
}
    }
?>
                                <tr style="background-color:grey;color:black;">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Grand Total</th>
                                <th id="divtotal">₹<?php echo $total; ?></th>
                                <th></th>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!--<div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                            <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="button">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="update-box">
                        <input value="Update Cart" type="submit">
                    </div>
                </div>
            </div>-->

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <!--<div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> $ 130 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Discount</h4>
                            <div class="ml-auto font-weight-bold"> $ 40 </div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Coupon Discount</h4>
                            <div class="ml-auto font-weight-bold"> $ 10 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Tax</h4>
                            <div class="ml-auto font-weight-bold"> $ 2 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Shipping Cost</h4>
                            <div class="ml-auto font-weight-bold"> Free </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> $ 388 </div>
                        </div>
                        <hr> </div>
                </div>-->
                <div class="col-12 d-flex shopping-box"><a href="checkout.php" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

<?php
include 'ourpartners.php';
include 'footer.php';
?>
<script>            
  function deleterecord(purchaseid)         
  {
      if(confirm("Are you sure want to delete this product from cart?") == true)
      {
        window.location="cart.php?purchaseid="+purchaseid;
      }
      else
      {
          return false;
      }
  }
  //Coding to update cart starts here
  function updatecart(purchaseid,qty,cost)
  {
     var tqty = document.getElementById("qty"+purchaseid).value;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("totalcost"+purchaseid).innerHTML = tqty * cost;
                document.getElementById("divtotal").innerHTML= "₹" +  this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxcost.php?purchaseid="+purchaseid+"&tqty="+tqty+"&cost="+cost,true);
        xmlhttp.send();
  }
  //Coding to update cart ends here
</script>
<script>
  $(function() {

    $('.qtyamtbar').keydown(function(e){           
         e.preventDefault();              
    });

  })
</script>