<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_POST['submit']))
{
    $qry2 = mysqli_query($con, "select * from salary where empid='".$_POST['empid']."' and salarymonth='".$_POST['salarymonth']."' and salyear='".$_POST['salyear']."' and daysworked='".$_POST['daysworked']."'");
    if(mysqli_num_rows($qry2) > 0)
    {
        echo "<script>alert('Record Exist!!');</script>";
    }
    else
    {
        $date = date("Y-m-d");
        $qry = "insert into salary(empid,basicsalary,salarymonth,noworkingdays,daysworked,salary,salyear,status,date) values('".$_POST['empid']."','".$_POST['basicsalary']."','".$_POST['salarymonth']."','".$_POST['noworkingdays']."','".$_POST['daysworked']."','".$_POST['salary']."','".$_POST['salyear']."','Active','$date')";
        
        if(mysqli_query($con,$qry))
        {
            echo "<script>alert('updated Successfully!!!');</script>";
                //mailing information to customer 
                $sqlseller1 ="SELECT * FROM employee where employeeid ='$_POST[empid]'";
                $qsqlseller1 = mysqli_query($con,$sqlseller1);
                $rsseller1 = mysqli_fetch_array($qsqlseller1); 
                $to = $rsseller1['emailid'];
                $subject = "MeatZone Salary Credited";
                $txt = "<b>Hello $rsseller1[empname],</b> <br><br> Your salary for the year $_POST[salyear] and month $_POST[salarymonth] of Rs$_POST[salary] has been credited to your Account";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: meatzone.online";
                mail($to,$subject,$txt,$headers);
        }
    }
}
if(isset($_GET['id']))
{
    $qry="Select * from salary where salary_id =".$_GET['id'];
    $rst = mysqli_query($con, $qry);
    $arr = mysqli_fetch_array($rst);
    $salaryid = $arr[0];
    $empid = $arr[1];
    $basicsalary=$arr[2];
    $salarymonth=$arr[3];
    $noworkingdays = $arr[4];
    $daysworked=$arr[5];
    $salary = $arr[6];
    $salyear = $arr[8];    
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
</style>
<!-- ANWAR CSS ends-->

<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Employee Salary</h1>
</div>
<!-- Content Row -->
<div class="row">

  
<div class="col-md-8" style="margin: auto;">

 <form action="" method="post" class="form-stacked" name="frmform" onsubmit="return validateform()">
    <fieldset>
        <div class="form-group">
            <label class="control-label">Select Employee <span class="errmsg" id="idempname"></span></label>
            <div class="controls">
                <select name="empid" id="empid " value="<?php echo $empid; ?>" onchange="fillsalary(this.value)" placeholder="Select Employee Name" class="form-control">
                     <?php
                                  
                                 $rs = mysqli_query($con, "Select * from employee where status='Active' AND emptype='Employee'");
                                 echo "<option value='0'>-- Select --</option>";
                                 while($row= mysqli_fetch_array($rs))
                                 {
                                     if($empid == $row[0])
                                     {
                                          echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                          echo "<script>fillsalary(".$salaryid.",".$empid.")</script>";
                                     }
                                     else
                                     {
                                          echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                     }
                                    
                                 }
                                  ?>
                                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Basic Salary <span class="errmsg" id="idbasicsalary"></span></label> 
            <div class="controls">
                <input type="text" name="basicsalary" id="basicsalary" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Salary Year <span class="errmsg" id="idsalaryyear"></span></label>
            <div class="controls">
                <input type="text" id="salyear" placeholder="Enter year" name="salyear" value="<?php echo date("Y"); ?>" readonly class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Salary Month <span class="errmsg" id="idsalarymonth"></span></label>
            <div class="controls">
                <select name="salarymonth" id="salarymonth" value="<?php echo $salarymonth; ?>" class="form-control" onchange="getworkingdays(this.value,salyear.value,empid.value)">
                                  <option value='0'>-- Select --</option> 
                                  <option value='1'>Jan</option> 
                                  <option value='2'>Feb</option> 
                                  <option value='3'>Mar</option> 
                                  <option value='4'>Apr</option> 
                                  <option value='5'>May</option> 
                                  <option value='6'>Jun</option> 
                                  <option value='7'>Jul</option> 
                                  <option value='8'>Aug</option> 
                                 <option value='9'>Sep</option> 
                                 <option value='10'>Oct</option> 
                                 <option value='11'>Nov</option> 
                                 <option value='12'>Dec</option>  
                                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">No.of working days <span class="errmsg" id="idnoofworkingdays"></span></label> 
            <div class="controls">
                <input type="text" id="noworkingdays" placeholder="Enter total working days" name="noworkingdays" readonly class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Total days present <span class="errmsg" id="idtotaldayspresent"></span></label> 
            <div class="controls">
                <input type="text" id="daysworked" placeholder="Enter total days worked" value="<?php echo $daysworked; ?>" name="daysworked" onchange="calculatesalery(noworkingdays.value,daysworked.value,basicsalary.value)" readonly class="form-control">
            </div>
        </div>

<div class="form-group">
            <label class="control-label">Total salary <span class="errmsg" id="idloginid"></span></label> 
            <div class="controls">
                <input type="text"  id="salary" name="salary" readonly class="form-control">
            </div>
        </div>
        

        <hr>
       
                                <div class="col-md-12">
                                    <div class="submit-button text-center">                                        
                                        <input class="btn btn-primary btn-icon-split btn-lg" name="submit" type="submit" value="submit">                                                                      
                                        
                                    </div>
                                </div>
    </fieldset>
</form> 
</div>

    
</div>
<!-- Content Row -->








<?php
include('includes/scripts.php');
include('includes/footer.php');
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
                if(document.frmform.empid.value=="0")
                {
                    document.getElementById("idempname").innerHTML = "Employee Name should not be empty...";
                    errcondition ="false";      
                }
                if(document.frmform.salarymonth.value=="0")
                {
                    document.getElementById("idsalarymonth").innerHTML = "Salary Month should not be empty...";
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

     <script>
function fillsalary(empid)
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
            //alert(xmlhttp.responseText);
            document.getElementById("basicsalary").value=xmlhttp.responseText;
            document.getElementById("salarymonth").value = "0";
                document.getElementById("noworkingdays").value = "";
                    //document.getElementById("daysworked").value =xmlhttp.responseText;
            document.getElementById("salary").value = "0.00";
        }
    }
    xmlhttp.open("GET","ajaxsubcat.php?e="+empid, true);
    xmlhttp.send();
}
</script>   

<script>
function calculatesalery(noworkingdays,daysworked,salary)
{
    var sal = (daysworked * salary)/noworkingdays;
    document.getElementById("salary").value = Math.round(sal);
}
function getworkingdays(month,year,empid)
{
      if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
         
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("noworkingdays").value = this.responseText;
                getworkeddays(month,year,empid,this.responseText);
            }
        };
         
        xmlhttp.open("GET","ajaxsetup.php?month="+month+"&syear="+year,true);
        xmlhttp.send();
}

function getworkeddays(month,year,empid,totaldays)
{
      if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
         
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("daysworked").value = this.responseText;
                var basic = document.getElementById("basicsalary").value;
                calculatesalery(totaldays,this.responseText,basic);
            }
        };
         
        xmlhttp.open("GET","ajaxsetup.php?smonth="+month+"&year="+year+"&empid="+empid,true);
        xmlhttp.send();
}   
</script>
