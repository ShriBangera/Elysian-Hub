<?php  
include("includes/dbconnection.php");
session_start();
error_reporting(0);
if(isset($_POST["selected_date"]))  
 {  
  $time = strtotime($_POST[selected_date]);
  $newformat = date('Y-m-d',$time);
 //echo "$_POST[selected_date]";
 //echo "$newformat";
      $connect = mysqli_connect("localhost", "root", "", "testing");  
      $output = '';  
      $query = "  
           SELECT * FROM employee WHERE joindate <=  '$newformat' AND status='Active' AND emptype='Employee'";
      $result = mysqli_query($con, $query);
      $output .= '  
          <table id="mydataTable"  class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Employee ID</th>
                  <th>Employee Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
             $sqlattendance = "SELECT * FROM attendance WHERE empid='$row[employeeid]' AND date='$newformat'";
      $qsqlattendance = mysqli_query($con,$sqlattendance);
      $rsattendance = mysqli_fetch_array($qsqlattendance); 

                $output .= "  
                     <tr>
    <td>&nbsp;$row[employeeid]</td>
    <td>&nbsp;$row[empname]</td>
    <td>
    <input type='radio' name='attendance$row[employeeid]'  onclick='addattendance(`$row[employeeid]`,`$newformat`,`Present`)'";
    if($rsattendance[attendance_type] =="Present")
    {
    $output .= " checked='checked' ";
    }
    $output .= ">Present <br />  
    <input type='radio'  name='attendance$row[employeeid]'   onclick='addattendance(`$row[employeeid]`,`$newformat`,`Absent`)'";
    if($rsattendance[attendance_type] =="Absent")
    {
    $output .= " checked='checked' ";
    } 
    $output .= ">Absent</a> <br />
    <input type='radio'  name='attendance$row[employeeid]'   onclick='addattendance(`$row[employeeid]`,`$newformat`,`Half day`)'"; 
    if($rsattendance[attendance_type]=="Half day")
    {
    $output .= " checked='checked' ";
    }
    $output.= ">Half day</a>";
    $output.="</td></tr></tbody>"; 
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="3" style="text-align:center;">No Data to Put Attendance</td>  
                </tr>';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>
