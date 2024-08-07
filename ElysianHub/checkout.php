<?php
include 'header.php';
include 'qtymanager.php';
if(isset($_POST[btnsubmit]))
{     
$note =  "Payment type : " . $_POST[Paymenttype] . "<br> Card Number" .  $_POST[CardNumber] . "<br> Expiry date : " . $_POST[Expirydate] . "<br> Card Holder : " . $_POST[Cardholder] . "<br> CVV Number : " . $_POST[CVVnumber]; 
$sql = "UPDATE purchase SET deliverystatus='Pending',address='$_POST[address]',city='$_POST[city]',state='$_POST[state]',contactno='$_POST[contactno]',pincode='$_POST[pincode]',note='$note',purchasedate='$dt',status='Active' WHERE customerid='$_SESSION[customerid]' AND status='Pending' AND qty!=0";
    //Insert statement starts here  
    //$sql ="INSERT INTO   purchase(bill_type,customerid,comp_id,service_request_id,purchasedate,deliverystatus,address,city,state,contactno,pincode,total_cost,status) VALUES('Payment','$_SESSION[customerid]','0','0','$dt','Pending','$_POST[address]','$_POST[city]','$_POST[state]',,'$_POST[pincode]','$_POST[total_cost]','Pending')";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    //if(mysqli_affected_rows($con) >=1) 
    //{ 
        ///$insid= mysqli_insert_id($con);     
        ///echo "<script>window.location='paymentconfirm.php?billingid=$insid';</script>";//no use of billingid 
    //}                                                                    
    if(mysqli_affected_rows($con) >=1)
    {   
        echo "<SCRIPT>alert('All done.');</SCRIPT>";
                //mailing information to customer 
                $sqlseller1 ="SELECT * FROM customer where customerid ='$_SESSION[customerid]'";
                $qsqlseller1 = mysqli_query($con,$sqlseller1);
                $rsseller1 = mysqli_fetch_array($qsqlseller1); 
                $to = $rsseller1['emailid'];
                $subject = "MeatZone";
                $txt = "<b>Hello $rsseller1[customername],</b> <br><br> You are Order has been receved by <b>MeatZone</b>. Keep on checking your order status at MeatZone website";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: meatzone.online";
                mail($to,$subject,$txt,$headers);
        echo "<script>window.location='index.php';</script>";
    }
}
$sqlprofile="SELECT * FROM customer WHERE customerid='$_SESSION[customerid]'";
$qsqlprofile = mysqli_query($con,$sqlprofile);
$rsprofile = mysqli_fetch_array($qsqlprofile);
?>
<!-- ANWAR CSS starts-->
<style type="text/css">
    .mybtn1{
        border:none;
        padding: 0;
    }
    label{
     font-weight: bold;
    }
    .errmsg{
    color: red;
    }
/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}
</style>
<!-- ANWAR CSS ends-->
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <!--<div class="row new-account-login">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Account Login</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to Login</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formLogin">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword" placeholder="Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Login</button>
                    </form>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Create New Account</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to Register</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formRegister">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputName" class="mb-0">First Name</label>
                                <input type="text" class="form-control" id="InputName" placeholder="First Name"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputLastname" class="mb-0">Last Name</label>
                                <input type="text" class="form-control" id="InputLastname" placeholder="Last Name"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputEmail1" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword1" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword1" placeholder="Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Register</button>
                    </form>
                </div>
            </div>-->
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        <!--<form class="needs-validation" novalidate>-->
                        <form action="" method="post" id="frmform" name="frmform" onsubmit="return validateform()">                         
                            <div class="mb-3">
                                <label class="control-label">Full name <span class="errmsg" id="idfullname"></span></label>
                                <div class="input-group">                                    
                                    <input type="text" name="fullname" value="<?php echo $rsprofile[customername]; ?>" placeholder="Enter Full name" class="form-control" >
                                    <!--<div style="width: 100%;"> Your username is required. </div>-->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Address <span class="errmsg" id="idaddress"></span></label>
                                <textarea class="form-control" name="address" placeholder="Enter Address"><?php echo $rsprofile[address]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">City <span class="errmsg" id="idcity"></span></label>
                                <input type="text" name="city" value="<?php echo $rsprofile[city]; ?>" placeholder="Enter City" class="form-control" >                                
                            </div>                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">State <span class="errmsg" id="idstate"></span></label>
                                    <select name="state" class="wide w-100">
    <option value="">Select State</option>
    <?php
    $arr = array("Andaman and Nicobar Islands","Andhra Pradesh","Arunachal Pradesh","Assam","Bihar","Chandigarh","Chhattisgarh","Dadra and Nagar Haveli","Daman and Diu","Delhi","Goa","Gujarat","Haryana","Himachal Pradesh","Jammu and Kashmir","Jharkhand","Karnataka","Kerala","Lakshadweep","Madhya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Orissa","Pondicherry","Punjab","Rajasthan","Sikkim","Tamil Nadu","Tripura","Tripura","Uttaranchal","Uttar Pradesh","West Bengal");
    foreach($arr as $val)
    {
        if($val == $rsprofile['state'])
        {
            echo "<option value='$val' selected>$val</option>";
        }
        else
        {
            echo "<option value='$val'>$val</option>";
        }
    }
    ?>
</select>
                                    
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Pincode <span class="errmsg" id="idpincode"></span></label>
                                    <input type="number" name="pincode" placeholder="Enter Pin code" value="<?php echo $rsprofile[pincode]; ?>" class="form-control" >
                                    
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Contact No. <span class="errmsg" id="idcontactno"></span></label>
                                <input type="number" name="contactno" value="<?php echo $rsprofile[contactno]; ?>"  placeholder="Enter Contact Number" class="form-control" value="">
                            </div>

                            <hr class="mb-4">
                            <!--<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">
                                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next time</label>
                            </div>
                            <hr class="mb-4">
                            <div class="title"> <span>Payment</span> </div>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Credit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="debit">Debit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>-->

<div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'cardpayment');return false;" id="defaultOpen">Credit/Debit Card</button>
  <button class="tablinks" onclick="openCity(event, 'cashondelivery');return false;">Cash On Delivery</button>
  
</div>

<div id="cardpayment" class="tabcontent">
                
                
                <div class="row">

                    <div class="span6" id="divpaymenttype"><?php include("ajaxloadpaytype.php"); ?></div>   

                </div>  
                
</div>  
<div id="cashondelivery" class="tabcontent" style="visibility: hidden;height: 0px">
</div>  
                            <hr class="mb-1"> </form>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <!--<div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption1" name="shipping-option" class="custom-control-input" checked="checked" type="radio">
                                        <label class="custom-control-label" for="shippingOption1">Standard Delivery</label> <span class="float-right font-weight-bold">FREE</span> </div>
                                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption2">Express Delivery</label> <span class="float-right font-weight-bold">$10.00</span> </div>
                                    <div class="ml-4 mb-2 small">(2-4 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption3" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption3">Next Business day</label> <span class="float-right font-weight-bold">$20.00</span> </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
<?php
$total =0;
 $sql =  "SELECT purchase.*,customername,product.title,product_image.imgpath FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid LEFT JOIN product_image ON product_image.productid=product.productid  WHERE purchase.customerid='$_SESSION[customerid]' AND purchase.status='Pending' GROUP BY purchase.purchaseid";
 $slno = 1;
                            $qsql = mysqli_query($con,$sql);
                            while($rs = mysqli_fetch_array($qsql))
                            {                                           
?>
<?php
        $sqlpurchase = "SELECT ifnull(sum(quantity),0) FROM stock where productid='$rs[2]'"; //$rs[3]=productid
        $qsqlpurchase =mysqli_query($con,$sqlpurchase);
        $rspurchase = mysqli_fetch_array($qsqlpurchase);
        $sqlsales = "SELECT ifnull(sum(qty),0) FROM purchase where purchase.productid='$rs[2]' AND purchase.status!='Pending'";
        $qsqlsales =mysqli_query($con,$sqlsales);
        $rssales = mysqli_fetch_array($qsqlsales);      
        $totqty =$rspurchase[0] - $rssales[0];
        if($totqty>0){
?>        
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"> <a href="cart.php#totalcost<?php echo $rs[0]; ?>"> <?php echo $rs[title]; ?></a>
                                            <div class="small text-muted">Price: &#8377;<?php echo $rs[cost]; ?> <span class="mx-2">|</span> Qty: <?php echo $rs[qty]; ?> <span class="mx-2">|</span> Subtotal:<span id="totalcost<?php echo $rs[0]; ?>">&#8377;<?php echo $rs[cost]*$rs[qty]; ?></span></div>
                                        </div>
                                    </div>
<?php $total = $total + ($rs[cost]*$rs[qty]); }
  else{ //to make nonstock items to be 0qty
       $sql3 = "UPDATE purchase SET qty=0 WHERE customerid='$_SESSION[customerid]' AND status='Pending' AND purchaseid='$rs[purchaseid]'";
       $qsql3 = mysqli_query($con,$sql3);
      } 
?>             
<?php
        $slno = $slno + 1;
    }
?>
<?php
if(!$total>0)
{
    echo "<SCRIPT>alert('You dont have any items in cart');</SCRIPT>";
    echo "<script>window.location='cart.php';</script>";
}
?>                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <!--<div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold"> $ 440 </div>
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
                                <hr>-->
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5">&#8377;<?php echo "$total"; ?> </div>
                                </div>
                                <hr> </div>
                        </div>                        
                        <div class="col-12 d-flex shopping-box">                                        
                                        <input class="ml-auto btn hvr-hover" name="btnsubmit" id="Confirm order" type="submit" form="frmform" value="Checkout">
                                    </div>
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
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "active";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
  
  loadpaymenttype(cityName);
}

// Get the element with id="defaultOpen" and click on it
//document.getElementById("defaultOpen").click();
</script>
<script>
function loadpaymenttype(paytype)
{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divpaymenttype").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxloadpaytype.php?paytype="+paytype,true);
        xmlhttp.send();
}
</script>
       
<script>
            function validateform()
            {
            /*Regular Expressions starts*/
            var numericExpression = /^[0-9]+$/;
            var alphaExp = /^[a-zA-Z]+$/;
            var alphaspaceExp = /^[a-zA-Z\s]+$/;
            var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,8}$/;
            /*Regular Expressions ends*/
            
                $(".errmsg").html('');
                //alert("test test");
                var errcondition = "true";
                if(document.frmform.fullname.value=="")
                {
                    document.getElementById("idfullname").innerHTML = "Name should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.address.value=="")
                {
                    document.getElementById("idaddress").innerHTML = "Address should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.pincode.value.length != 6)
                {
                    document.getElementById("idpincode").innerHTML = "Pincode should contain 6 digits...";
                    errcondition ="false";  
                }
                if(document.frmform.pincode.value=="")
                {
                    document.getElementById("idpincode").innerHTML = "Pincode should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.city.value=="")
                {
                    document.getElementById("idcity").innerHTML = "City should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.contactno.value.length != 10)
                {
                    document.getElementById("idcontactno").innerHTML = "Contact Number should contain 10 digits...";
                    errcondition ="false";  
                }
                if(document.frmform.contactno.value=="")
                {
                    document.getElementById("idcontactno").innerHTML = "Contact No. should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.state.value=="")
                {
                    document.getElementById("idstate").innerHTML = "State should not be empty...";
                    errcondition ="false";      
                }
                
                if(document.frmform.Paymenttype.value=="")
                {
                    document.getElementById("idPaymenttype").innerHTML = "Payment type should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.Expirydate.value.length > 2019)
                    {
                        document.getElementById("idExpirydate").innerHTML = "Entered correct expiry date...";
                        errcondition ="false";  
                    }
                if(document.frmform.Expirydate.value=="")
                {
                    document.getElementById("idExpirydate").innerHTML = "Expirydate should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.CardNumber.value.length != 16)
                    {
                        document.getElementById("idCardNumber").innerHTML = "Card Number should contain 16 digits numeric value...";
                        errcondition ="false";  
                    }
                if(document.frmform.CardNumber.value=="")
                {
                    document.getElementById("idCardNumber").innerHTML = "Card Number should not be empty...";
                    errcondition ="false";      
                }
                if(!document.frmform.Cardholder.value.match(alphaspaceExp))
                {
                    document.getElementById("idCardholder").innerHTML="Entered Card holder should contain alphabets...";
                    errcondition ="false";  
                }
                if(document.frmform.Cardholder.value=="")
                {
                    document.getElementById("idCardholder").innerHTML = "Card holder should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.CVVnumber.value.length != 3)
                    {
                        document.getElementById("idCVVnumber").innerHTML = "CVV Number should contain 3 digits numeric value...";
                        errcondition ="false";  
                    }
                if(document.frmform.CVVnumber.value=="")
                {
                    document.getElementById("idCVVnumber").innerHTML = "CVV Number should not be empty...";
                    errcondition ="false";      
                }

                if(errcondition == "true")
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
    </script>
