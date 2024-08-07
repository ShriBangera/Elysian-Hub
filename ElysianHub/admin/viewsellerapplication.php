<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_GET[comp_id]))
{
  $sqlseller ="SELECT * FROM seller WHERE comp_id='$_GET[comp_id]' and status='Pending'";
  $qsqlseller = mysqli_query($con,$sqlseller);
  $sql = "UPDATE seller SET status='$_GET[st]' where comp_id='$_GET[comp_id]'";
  $qsql = mysqli_query($con,$sql);
  echo mysqli_error($con);
  if(mysqli_affected_rows($con) == 1)
  {
      if($_GET[st]=='Active')
      {
        echo "<script>alert('Seller Application Accepted successfully...');</script>"; 
        $rsseller = mysqli_fetch_array($qsqlseller);
        $currenturl = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/../sellerlogin.php";
        $to = $rsseller['emailid'];
        $subject = "Status of MeatZone Registration";
        $txt = "<b>Hello $rsseller[compname],</b> <br><br> Congratulations, You are Approved by MeatZone. Your Account is Activated.Please <a href='$currenturl'><b>Login</b></a> and Continue Your work.If Link not works, Visit our site directly and Update your bank account details";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: meatzone.online";
        mail($to,$subject,$txt,$headers);
      }else 
      { 
        echo "<script>alert('Seller Application Rejected successfully...');</script>"; 
        $rsseller = mysqli_fetch_array($qsqlseller);
        $currenturl = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/../ourlocation.php";
        $to = $rsseller['emailid'];
        $subject = "Status of MeatZone Registration";
        $txt = "<b>Hello $rsseller[compname],</b> <br><br> We are so sad to inform that, You are Rejected by MeatZone. For more details, You can visit our <a href='$currenturl'><b>Headoffice</b></a>.";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: meatzone.online";
        mail($to,$subject,$txt,$headers);
      }
  }
}
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
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Seller Applications</h1>
</div>
<!-- Content Row -->
<div class="row">
    
          <div class="col-md-12" style="margin: auto;overflow-x: auto;">        
            <table id="mydataTable"  class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Logo</th>
                  <th>Seller</th>
                  <th>Login ID</th>
                  <th>Address</th>
                  <th>PAN No.</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody> 
<?php
$sql = "SELECT * FROM seller WHERE status='Pending'";
$qsql = mysqli_query($con,$sql);
$c=0;
while($rs = mysqli_fetch_array($qsql))
{$c++;
  if($rs[companylogo] == "")
  {
    $imgname="../images/No-image-found.jpg";
  }
  else if(file_exists("../imgcompany/$rs[companylogo]"))
  {
    $imgname="../imgcompany/$rs[companylogo]";
  }
  else
  {
    $imgname="../images/No-image-found.jpg";
  }
  echo "<tr><td>$c</td>
    <td><img src='$imgname' style='width:75px;height:75px;object-fit: cover;'></td>
    <td><b>$rs[compname]</b></td>
    <td>$rs[loginid]</td>
    <td>$rs[address]<br>$rs[state]<br>$rs[city]<br><b>PIN -</b> $rs[pincode]<br> <b>Landmark</b> - $rs[landmark]<br> <b>Email</b> - $rs[emailid]<br> <b>Contact No.</b> - $rs[contactno]</td>
    <td>$rs[pancardno]</td>";
  echo "<td><b><a href='viewsellerapplication.php?comp_id=$rs[0]&st=Active' class='btn btn-success'>Approve</a> |  <a href='viewsellerapplication.php?comp_id=$rs[0]&st=Rejected' onclick='return confirmreject()' class='btn btn-danger'>Reject</a></b></td></tr>";
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script>
$(document).ready(function() {
    $('#mydataTable').DataTable( {
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script>
function confirmreject()
{
  if(confirm("Are you sure want to Reject this Application") == true)
  {
    return true;
  }
  else
  {
    return false;
  }
}
</script>