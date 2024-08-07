<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>
<!-- ANWAR CSS starts-->
<style type="text/css">
  .form-group label{
    font-weight: bold;
  }
  .errmsg{
    color: red;
  }
  .form-group input{
    color: black;
  }
  .form-group textarea{
    color: black;
  }
  td,th{
    color: black;
  }
</style>
<!-- ANWAR CSS ends-->
<div id="load2"></div>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Seller Payment</h1>
</div>

<!-- Content Row -->
<div class="row">
   <div class="col-md-12" style="margin: auto;overflow-x: auto;"> 
            <table id="mydataTable"  class="table table-striped table-bordered">
              <thead>
                <tr>
                      <th>#</th>
                    <th>Seller</th>
                    <th>Bank Name</th>
                    <th>Account No.</th>
                     <th>Amount</th>
                    <th>Admin %</th>
                    <th>Pay Amount</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody> 
<?php
$result = mysqli_query($con, "select * from seller inner join tblselleraccount on seller.comp_id=tblselleraccount.sellerid where status='Active'");
                $c = 1;
                $listcount = 0;
                while($row=mysqli_fetch_array($result))
                {
                  
                  $paid = date("Y-m-d");
                  $total = 0;
                  //if($row['paid_date'] != null)
                  //{
                    $qry2 = "SELECT purchase.purchaseid,purchase.productid,purchase.status,purchase.sellerpayment,purchase.deliverystatus,purchase.cost,(purchase.cost*purchase.qty) as amt FROM purchase inner join product on purchase.productid = product.productid WHERE purchase.sellerpayment !='paid' and product.comp_id=$row[0] and purchase.status!='Pending' AND purchase.deliverystatus='Delivered'";
                  //}
                  // else 
                  // {
                  //     $qry2 = "SELECT purchase.*,(purchase.cost*purchase.qty) as amt,  FROM purchase inner join product on cart.prodid = product.product_id LEFT JOIN brandoffer on cart.brand_offer=brandoffer.offer_id inner join purchase on cart.billid=purchase.purchase_id where billid != 0 and product.seller_id=$row[0] and purchase.order_date < '$paid'";
                  // }
                  $rs = mysqli_query($con, $qry2);
                  $noofitems = mysqli_num_rows($rs);
                  while($row1 = mysqli_fetch_array($rs))
                  {
                    $amt = $row1['amt'];
                    $total = $total + $amt;
                  }
                  if ($total>0) {
                  $GLOBALS['listcount'] = $GLOBALS['listcount'] + 1;  
                  $adminamt = ($total*5)/100;
                  $finalamt = $total - $adminamt;
                  
                  echo "<tr>
                    <td>".$c++."</td>
                    <td>".$row['compname']."</td>
                    <td>".$row['bankname']."<br/>Branch: ".$row['branch']."</td>
                    <td>".$row['accountno']."</td>
                    <td><input type='text' value='".number_format((float)$total, 2, '.', '')."' name='total_amt' readonly/></td>
                    <td><input type='number' class='adminperbar' value='5' min='1' max='100' name='admin_per".$row[0]."' id='admin_per".$row[0]."' onchange='update_per(this.value,$total,$row[0])'/></td>
                    <td><input type='text' value='".number_format((float)$finalamt, 2, '.', '')."' name='final_amt' id='final_amt".$row[0]."' readonly/></td>
                    <td><a href='#' onclick='paynow($noofitems,$total,$finalamt,$row[0],admin_per".$row[0].".value)'>Pay Now</a></td>
                  </tr>";
                }
                }
                if (!$GLOBALS['listcount']>0) {
                  echo "<td colspan='8'><center><h4 style='color:red;'>No Payments Available</h4></center></td>";
                }
?>
              </tbody>
            </table>          
          </div>
</div>
  <!-- Content Row -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
<script>
      $(document).ready( function () {
    $('#mydataTable').DataTable();
} );
</script>
<script>
function update_per(percen, total,sellerid)
{
  var adminamt = (total*percen)/100;
  var finalamt = total - adminamt;
  var id = "final_amt"+sellerid;
  document.getElementById(id).value=finalamt;
}
function paynow(noofitems,total,amt,sellerid,admin_per)
{

    if(window.XMLHttpRequest)
    {
      xmlhttp= new XMLHttpRequest();
    }
    else
    {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        if(xmlhttp.responseText.trim() == "success")
        {
          document.querySelector("#load2").style.visibility = "hidden";
          document.querySelector("#load2").style.display = "none";
          alert('Payment Success!!');
          window.location = 'adminpay.php';
        }
        else{
          alert(xmlhttp.responseText.trim());
        }
      }
    }
    document.querySelector("#load2").style.display = "block";
    document.querySelector("#load2").style.visibility = "visible";
    xmlhttp.open("GET","ajaxpay.php?total="+total+"&amt="+amt+"&admin_per="+admin_per+"&sellerid="+sellerid+"&noitems="+noofitems, true);
    xmlhttp.send();
 
}
</script>
<script>
  $(function() {

    $('.adminperbar').keydown(function(e){           
         e.preventDefault();              
    });

  })
</script>