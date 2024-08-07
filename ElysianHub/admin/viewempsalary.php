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
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Employee Salary Report</h1>
</div>
<!-- Content Row -->
<div class="row">
<div class="col-lg-12" style="overflow-x:auto;">
            <table id="mydataTable"  class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Salary ID</th>
                  <?php if((isset($_SESSION[employeeid])) and ($_SESSION['emptype'] == "Admin")){ echo "<th>Employee Name</th>";} ?>
                  <th>Basic Pay</th>
                  <th>Salary Month</th>
                  <th>Salary Year</th>
                  <th>Total Working Days</th>
                  <th>Days Worked</th>
                  <th>Salary</th>
                  <th>Date</th>
                  </tr>
              </thead>
              <tbody>
              <?php
              if ($_SESSION['emptype']=='Admin') {
                $sql = "SELECT salary.*,employee.empname FROM salary LEFT JOIN employee on salary.empid=employee.employeeid WHERE employee.emptype='Employee'";
              }
              elseif ($_SESSION['emptype']=='Employee') {
                $sql = "SELECT salary.*,employee.empname FROM salary LEFT JOIN employee on salary.empid=employee.employeeid WHERE employee.emptype='Employee' AND employee.employeeid=$_SESSION[employeeid]";
                }
        
              $qsql = mysqli_query($con,$sql);
              $c = 0;
              while($rs = mysqli_fetch_array($qsql))
              {$c++;
                
                echo "<tr>
                <td>$c</td>
                  <td>$rs[salary_id]</td>";
                  if((isset($_SESSION[employeeid])) and ($_SESSION['emptype'] == "Admin")){ echo "<td>$rs[empname]</td>";} 
                echo "<td>₹$rs[basicsalary]</td>
                  <td>$rs[salarymonth]</td>
                  <td>$rs[salyear]</td>
                  <td>$rs[noworkingdays]</td>
                  <td>$rs[daysworked]</td>
                  <td>$rs[salary]</td>
                  <td>$rs[date]</td>
                    </tr>";
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