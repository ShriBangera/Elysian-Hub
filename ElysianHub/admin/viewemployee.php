<?php
include('includes/header.php'); 
include('includes/navbar.php');
if(isset($_GET[delid]))
{
    $sql = "DELETE FROM employee where employeeid='$_GET[delid]'";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<script>alert('Employee record deleted successfully...');</script>";
        echo "<script>window.location='viewemployee.php';</script>";
    }
} 
?>
<!--ANWAR style starts-->
<style>
    td,th{
        color: black;
    }
</style>
<!--Anwar style ends -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">View Employee</h1>
</div>

<!-- Content Row -->
<div class="row" style="overflow-x: auto;">
<div class="col-lg-12">
<table id="mydataTable"  class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Employee name</th>
                                    <th>Employee type</th>
                                    <th>Address</th>
                                    <th>Login ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM employee";
                            $qsql = mysqli_query($con,$sql);
                            $c=0;
                            while($rs = mysqli_fetch_array($qsql))
                            {$c++;
                            echo "<tr>
                                <td>$c</td>
                                <td>$rs[empname]</td>
                                <td>$rs[emptype]</td>
                                <td>$rs[address]<br>$rs[state]<br>$rs[city]<br><b>PIN -</b> $rs[pincode]<br> <b>Contact No</b> - $rs[contactno]<br> <b>Email</b> - $rs[emailid]<br> <b>Adhar No.</b> - $rs[adharno]</td>
                                <td>$rs[loginid]</td>
                                <td>$rs[status]</td>";
                            if(isset($_SESSION['employeeid']) AND $rs['employeeid']==$_SESSION['employeeid'])
                            {
                            echo "<td><center><b><a href='#' class='btn btn-info disabled'>Edit</a><hr><a href='#' class='btn btn-danger disabled'>Delete</a></center></b></td>
                                </tr>";
                            }else{
                            echo "<td><center><b><a href='employee.php?editid=$rs[0]'  class='btn btn-info'>Edit</a><hr><a href='viewemployee.php?delid=$rs[0]' onclick='return confirmdelete()' class='btn btn-danger'>Delete</a></center></b></td>
                                </tr>";
                            }
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
function confirmdelete()
{
    if(confirm("Are you sure want to delete this record? Deliting is not recomeded! Better to Try Inactiving employee status, Press Cancel") == true)
    {
        return true;
    }
    else
    {
        return false;
    }
}
</script>
