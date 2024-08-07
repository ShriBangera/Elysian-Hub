<?php
include('includes/header.php');
include('includes/navbar.php'); 
?>
<!-- ANWAR CSS starts-->
<style type="text/css">
  td,th{
    color: black;
  }
</style>
<!-- ANWAR CSS ends-->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Feedbacks</h1>
</div>

<!-- Content Row -->
<div class="row">
<div class="col-md-12" style="margin: auto;overflow-x: auto;"> 
  <table id="mydataTable"  class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Message/Feedback</th>
                  <th>Posted Date</th>
                  <!--<th>Action</th>-->
                </tr>
              </thead>
              <tbody>
<?php
$result = mysqli_query($con, "select * from contact");
        $c = 0;
        while($row1=mysqli_fetch_array($result))
          {   $c++;
            echo "<tr>
                    <td>$c</td>
                    <td><b>$row1[name]</b></td>
                    <td>$row1[email]</td>
                    <td>$row1[message]</td>
                    <td>$row1[posteddate]</td>
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
