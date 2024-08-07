<?php
include 'header.php';
if(isset($_POST[submit]))
    {
        //Step 4 : Update statement starts here
        $sql ="UPDATE purchase SET status='Cancellation Request',cancellationreason='$_POST[cancellationreason]' where purchaseid='$_GET[purchaseid]'";
        $qsql = mysqli_query($con,$sql);
       echo mysqli_error($con);
        if(mysqli_affected_rows($con) == 1)
        {
        echo "<SCRIPT>alert('Cancellation Request sent successfully...');</SCRIPT>";
        echo "<script>window.location='viewcustpurchase.php';</script>";
        }
        //Step 4 : Update statement ends here
    }
/*if(isset($_GET[editid]))
        {
          $sqledit = "SELECT * FROM purchase WHERE purchaseid='$_GET[editid]'";
          $qsqledit = mysqli_query($con,$sqledit);
          $rsedit = mysqli_fetch_array($qsqledit);
        }*/
?>
<style>
    .errmsg{
        color: red;
    }
</style>
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Product Cancellation</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Cancelling Order</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start My Account  -->
    <div class="my-account-box-main">
        <div class="container">
            <div class="my-account-page" style="overflow-x: auto;">
              
<form action="" method="post" name="frmform" onsubmit="return validateform()">

                        <table id="" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Purchase No.</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Cost</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$sql =  "SELECT purchase.*,customername,title FROM purchase LEFT JOIN customer ON purchase.customerid=customer.customerid LEFT JOIN product ON purchase.productid=product.productid WHERE purchase.customerid='$_SESSION[customerid]' AND  purchase.purchaseid='$_GET[purchaseid]' ";
                            $qsql = mysqli_query($con,$sql);
                            while($rs = mysqli_fetch_array($qsql))
                            {
                                echo "<tr>
                                    <td>$rs[purchaseid]</td>
                                    <td>$rs[purchasedate]</td>
                                    <td>$rs[customername]</td>
                                    <td>$rs[title]</td>
                                    <td>₹$rs[cost]</td>
                                    <td>$rs[qty]</td>
                                    <td>₹" . $rs[cost] * $rs[qty] . "</td>
                                    </tr>";
                            }
                            ?>
                            </tbody>
                        </table>    
    <fieldset>
                 


        
        <div class="control-group">
            <label class="control-label"><b>Reason for Cancellation</b><span class="errmsg" id="idcost"></span></label>
            <div class="controls">
                <input type="text" name="cancellationreason" placeholder="Enter Reason for Cancellation" class="form-control">
            </div>
        </div>
        
        <hr>
        <input class="btn hvr-hover" name="submit" type="submit" value="Request for cancellation">
    </fieldset>
</form> 
             
            </div>
        </div>
    </div>
    <!-- End My Account -->

<?php
include 'ourpartners.php';
include 'footer.php';
?>
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
            if(document.frmform.cancellationreason.value=="")
            {
                document.getElementById("idcost").innerHTML = " Cancellation reason should not be empty...";
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

  

