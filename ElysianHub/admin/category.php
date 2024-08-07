<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
if(isset($_POST[submit]))
{
  //coding to upload image starts here
  $imgname= rand(). $_FILES[categoryimg][name];
  move_uploaded_file($_FILES["categoryimg"]["tmp_name"],"../imgcategory/".$imgname);
  //coding to upload image ends here..
  
  if(isset($_GET[editid]))
  {
    //Step 4 : Update statement starts here
    $sql ="UPDATE category SET categorytype='$_POST[categorytype]'";
    if($_FILES[categoryimg][name] != "")
    {
    $sql = $sql . ",categoryimg='$imgname'";
    }
    $sql = $sql . ",status='$_POST[status]',description='$_POST[description]',status='$_POST[status]'where categoryid='$_GET[editid]'";
      $qsql = mysqli_query($con,$sql);
     echo mysqli_error($con);
      if(mysqli_affected_rows($con) == 1)
      {
    echo "<SCRIPT>alert('Category record updated successfully...');</SCRIPT>";
    echo "<script>window.location='viewcategory.php';</script>";
      }
    //Step 4 : Update statement ends here
  }
  else
  {
      $sql ="INSERT INTO category(categorytype,categoryimg,description,status) VALUES('$_POST[categorytype]','$imgname','$_POST[description]','$_POST[status]')";
      $qsql = mysqli_query($con,$sql);
      echo mysqli_error($con);
      if(mysqli_affected_rows($con) == 1)
      {
    echo "<SCRIPT>alert('Category record inserted successfully...');</SCRIPT>";
    echo "<script>window.location='category.php';</script>";
      }
  }
}
//Step 1 : Link from viewcategory.php
//Step 2 : Select record from database starts here
if(isset($_GET[editid]))
{
  $sqledit = "SELECT * FROM category WHERE categoryid='$_GET[editid]'";
  $qsqledit = mysqli_query($con,$sqledit);
  $rsedit = mysqli_fetch_array($qsqledit);
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
<h1 class="h3 mb-0 text-gray-800">Category</h1>
</div>
<!-- Content Row -->
<div class="row">
          
        <div class="col-md-8" style="margin: auto;">
  <form action="" method="post" class="form-stacked" enctype="multipart/form-data" name="frmform" onsubmit="return validateform()">
  <fieldset>
    <div class="form-group">
      <label class="control-label">Category type <span class="errmsg" id="idcategorytype"></span></label>
      <div class="controls">
        <input type="text" name="categorytype" placeholder="Enter category" class="form-control"
      value="<?php echo $rsedit[categorytype]; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Category Image <span class="errmsg" id="idcategoryimg"></span></label>
      <div class="controls">
        <input type="file" name="categoryimg" placeholder="Category image" class="form-control"><br>
        <?php
      if(isset($_GET[editid]))
      {
         echo "<img src='../imgcategory/$rsedit[categoryimg]' style='height:250px;'>";
      }
      ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Category description <span class="errmsg" id="iddescription"></span></label>
      <div class="controls">
        <textarea name="description" placeholder="Enter category description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Status <span class="errmsg" id="idstatus"></span></label>
      <div class="controls" class="form-control">
        <select  class="form-control" name="status">
        <option value=''>Select status</option>
        <?php
        $arr = array("Active","Inactive");
        foreach($arr as $val)
        {
          if($val == $rsedit[status])
          {
          echo "<option value='$val' selected>$val</option>";
          }
          else
          {
          echo "<option value='$val'>$val</option>";
          }
        }
        ?>
        </select>
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
        $(".errmsg").html('');
        //alert("test test");
        var errcondition = "true";
        if(document.frmform.categorytype.value=="")
        {
          document.getElementById("idcategorytype").innerHTML = "Category Type should not be empty...";
          errcondition ="false";    
        }
<?php if(!isset($_GET[editid])) { ?>
        if(document.frmform.categoryimg.value=="")
        {
          document.getElementById("idcategoryimg").innerHTML = "Category Image should not be empty...";
          errcondition ="false";    
        }
<?php } ?>
        if(document.frmform.description.value=="")
        {
          document.getElementById("iddescription").innerHTML ="Category description should not be empty...";
          errcondition ="false";    
        }
        if(document.frmform.status.value=="")
        {
          document.getElementById("idstatus").innerHTML = "Status should not be empty...";
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