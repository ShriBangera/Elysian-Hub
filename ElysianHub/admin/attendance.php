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
<h1 class="h3 mb-0 text-gray-800">Attendance</h1>
</div>

<!-- Content Row -->
<div class="row">

  
          <div class="col-md-12" style="margin: auto;">         
           <form method="post" action="" id="myForm">
                <!--<input type="hidden" name="randomid" value="<?php //echo $_SESSION[randomid]; ?>"  />-->
                <div class="control-group" style="text-align: center;border: 1px dashed black;">Attendance Date <input style="height: auto;width: auto;"  onchange="submitdate()" id="atddatebar" name="attendancedate" max="<?php
         echo date('Y-m-d'); ?>" type="date" class="form-control" value="<?php 
        if(isset($_POST[attendancedate]))
        {
        echo $attdate = $_POST[attendancedate];
        }
        else
        {
        echo $attdate = date("Y-m-d");
        }
        ?>" ><br><!--<input type="submit" name="submit" value="Submit" class="btn btn_s" />--> </div>
    </form>
<div class="form-w3agile form1" id="employeenames">
          <table id="mydataTable"  class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Employee ID</th>
                  <th>Employee Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php
  $sql = "SELECT * FROM employee WHERE status='Active' and emptype='Employee'";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
      $sqlattendance = "SELECT * FROM attendance WHERE empid='$rs[employeeid]' AND date='$attdate'";
      $qsqlattendance = mysqli_query($con,$sqlattendance);
      $rsattendance = mysqli_fetch_array($qsqlattendance);
  echo "<tr>
    <td>&nbsp;$rs[employeeid]</td>
    <td>&nbsp;$rs[empname]</td>
    <td>";
    ?>
  
  <input type="radio" name="attendance<?php echo $rs[employeeid]; ?>"  onclick='addattendance(`<?php echo $rs[employeeid]; ?>`,`<?php echo $attdate
  ?>`,`Present`)' 

<?php
if($rsattendance[attendance_type] =="Present")
{
echo ' checked="checked" ';
}
?>
>Present <br /> 
    <input type="radio"  name="attendance<?php echo $rs[employeeid]; ?>"   onclick='addattendance(`<?php echo $rs[employeeid]; ?>`,`<?php echo $attdate
?>`,`Absent`)' 
<?php
if($rsattendance[attendance_type] =="Absent")
{
echo ' checked="checked" ';
}
?>
>Absent</a> <br />
    <input type="radio"  name="attendance<?php echo $rs[employeeid]; ?>"   onclick='addattendance(`<?php echo $rs[employeeid]; ?>`,`<?php echo $attdate
?>`,`Half day`)' 
<?php
if($rsattendance[attendance_type]=="Half day")
{
echo ' checked="checked" ';
}
?>
>Half day</a>
<?php
    echo "</td></tr>";

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
<script>
      $(document).ready( function () {
    $('#mydataTable').DataTable();
} );
</script>

<script type="application/javascript">
function addattendance(employee_id,attendancedate,atttype)
{
  //alert(employee_id + " - " + attendancedate + " - " + atttype);
      if (window.XMLHttpRequest)
    {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    /*
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
    */
        xmlhttp.open("GET","ajaxattendance.php?employee_id="+employee_id+"&attendancedate="+attendancedate+"&atttype="+atttype,true);
        xmlhttp.send();
}
</script>

<script>
  //Anwar scripts
function submitdate()
{
//document.getElementById("myForm").submit();
   var date = new Date($('#atddatebar').val());
  day = date.getDate();
  month = date.getMonth() + 1;
  year = date.getFullYear();
  //alert([day, month, year].join('-'));
if (day<10) {day=""+0+day;}
if (month<10) {month=""+0+month;}
  var finaldate = "" + day + "-" + month + "-" + year;
  //alert(finaldate);
                var selected_date = finaldate;  
                if(selected_date != '')  
                {  
                     $.ajax({  
                          url:"filterattendance.php",  
                          method:"POST",  
                          data:{selected_date:selected_date},  
                          success:function(data)  
                          {                                  
                               $('#employeenames').html(data);  
                          }  
                     });  
                }  
                //else  
                //{  
                //     alert("Please Select Date");  
               // }  
}
</script>

