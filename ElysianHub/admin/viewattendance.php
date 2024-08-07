<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
//if(!isset($_SESSION['type']))
//{
  //echo "<script>window.location.assign('index.php');</script>";
//}
/*if(isset($_SESSION[delid]))
{
  $sql = "DELETE FROM attendance WHERE attendanceid='$_SESSION[delid]'";
  $qsql = mysqli_query($con,$sql);
  if(mysqli_affected_rows($con) == 1)
  {
    echo "<script>alert('Attendance record deleted successfully..');</script>";
  }
  unset($_SESSION[delid]);
}*/
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
<h1 class="h3 mb-0 text-gray-800">View Attendance</h1>
</div>

<!-- Content Row -->
<div class="row">
           <div class="col-md-12" style="margin: auto;overflow-x: auto;">         
              <form method="post" action="" id="myForm">
                <!--<input type="hidden" name="randomid" value="<?php //echo $_SESSION[randomid]; ?>"  />-->
                <div class="control-group" style="text-align: center;border: 1px dashed black;">Attendance Month <input style="height: auto;width: auto;" onchange="submitmonth()" max="<?php echo date("Y-m"); ?>" name="attendancemonth" type="month" class="form-control" value="<?php 
        if(isset($_POST[attendancemonth]))
        {

          echo $attdate = $_POST[attendancemonth];
        }
        else
        {
        echo $attdate = date("Y-m");
        }
        ?>"><br><!--<input type="submit" name="submit" value="Submit" class="btn btn_s" />--> </div>
    </form>

    <?php 
      $attmonthyear = strtotime($attdate."-01");
      $attmonth = date("m",$attmonthyear);
      $attyear = date("Y",$attmonthyear);
      $daysinmonth = cal_days_in_month(CAL_GREGORIAN, $attmonth, $attyear);
    //  echo $number;
?>

<div class="form-w3agile form1" style="overflow-x: scroll;">
          <table id="mydataTable"  class="table table-striped table-bordered">
            
              <thead>
                <tr>
                  <th>Employee ID</th>
                  <th>Employee Name</th>
                  <?php
  for($i=1;$i<=$daysinmonth;$i++)
  {
   echo " <th scope='col'>$i</th>";
  }
?>    
    <th style="width:45px;" scope="col" style='color:green;'>P<br /></th>
    <th style="width:45px;" scope="col" style='color:red;'>H</th>
    <th style="width:45px;" scope="col"  style='color:#C60;'>A</th>
  <th style="width:45px;" scope="col"  style='color:#C60;'>Daysworked</th>
                </tr>
              </thead>
              <tbody>

<?php
      $results = array();
      $sqlattendance = "SELECT * FROM attendance WHERE date BETWEEN '$attdate-01' AND '$attdate-$daysinmonth' AND empid!='0' AND status='Active'";
      $qsqlattendance = mysqli_query($con,$sqlattendance);
$employee_id = array();
$attendance_type = array();
$attendance_date = array();
    while ($row = mysqli_fetch_array($qsqlattendance))
  { 
    $employee_id[$row["empid"]][$row["date"]] = $row["empid"];
    $attendance_type[$row["empid"]][$row["date"]] = $row["attendance_type"];
    $attendance_date[$row["empid"]][$row["date"]] = $row["date"];   
    }
  //echo $attendance_date[5]['2017-02-09'];
  $p=0;
  $h=0;
  $a=0;
  $sql = "SELECT * FROM employee WHERE status='Active' and emptype='Employee' ";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
  echo "<tr>";
  echo "<td>&nbsp;$rs[employeeid]</td>";
  echo "<td>&nbsp;$rs[empname]</td>";

  for($i=1;$i<=$daysinmonth;$i++)
  {
    if($i<=31)
    {
      if($i<=9)
      {
      $i = "0".$i;
      }
    }
    
    if( ($attyear."-".$attmonth."-".$i) == $attendance_date[$rs["employeeid"]][$attyear."-".$attmonth."-".$i] )
    {
      if($attendance_type[$rs["employeeid"]][$attyear."-".$attmonth."-".$i] == "Present")
      {
            echo " <th scope='col' style='color:green;'>P</th>";  
          $p = $p+1;      
      }
      if($attendance_type[$rs["employeeid"]][$attyear."-".$attmonth."-".$i] == "Absent")
      { 
            echo " <th scope='col' style='color:red;'>A</th>";
          $a = $a + 1;
      }
      if($attendance_type[$rs["employeeid"]][$attyear."-".$attmonth."-".$i] == "Half day")
      {
            echo " <th scope='col' style='color:#C60;'>H</th>";
          $h = $h+0.5;
      }
      $daysworked=$p+$h;
      
      
    }
    else
    {
      echo "<th scope='col'></th>";
    }
  }
  echo "<td><center>$p</center></td>";
  echo "<td><center>$h</center></td>";
  echo "<td><center>$a</center></td>";
  echo "<td><center>$daysworked</center></td>";
  echo "</tr>";
    $p=0;
  $h=0;
  $a=0;
}
  ?>
              </tbody>
            </table>
              </div>      
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
  function submitmonth()
{
document.getElementById("myForm").submit();
}
</script>