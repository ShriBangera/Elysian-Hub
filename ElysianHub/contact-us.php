<?php
include 'header.php';
if(isset($_POST[submit]))
{
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d h:i:s");
    $sql ="INSERT INTO contact(name,email,message,posteddate) VALUES('$_POST[uname]','$_POST[email]','$_POST[msgbody]','$date')";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<SCRIPT>alert('Message sent successfully.Thank you!');</SCRIPT>";
        echo "<script>window.location='contact-us.php';</script>";
    }
}
if(isset($_SESSION[customerid]))
{
    $sqledit = "SELECT * FROM customer WHERE customerid='$_SESSION[customerid]'";
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
</style>
<!-- ANWAR CSS ends-->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Contact Us</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"> Contact Us </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>GET IN TOUCH</h2>
                        <p>Give your Feed-back here</p>
                        <form method="post" action="" name="frmform" onsubmit="return validateform()">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Name <span class="errmsg" id="idname"></span></label><br>
                                        <input tabindex="1" id="name" name="uname" type="text" value="<?php echo $rsedit[customername]; ?>" class="col-md-12" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Email ID <span class="errmsg" id="idemail"></span></label><br>
                                        <input tabindex="2" id="email" name="email" type="text" value="<?php echo $rsedit[emailid]; ?>"  class="col-md-12" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Message/Feedback <span class="errmsg" id="idmessage"></span></label><br>
                                        <textarea class="col-md-12" id="message" name="msgbody" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12">
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit" name="submit">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
				<div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>CONTACT INFO</h2>
                        <p>Come to office in between 7:00AM and 10:00PM</p>
                        <ul>
                            <li>
                                <p><a href="ourlocation.php"><i class="fas fa-map-marker-alt"></i>Address: 2nd Floor, Hybe Building<br>Eshwar Nagar <br>Kochi Road,<br> Chennai, 578708</a> </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+91 9997768970</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">elysianhub@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

<?php
include 'ourpartners.php';
include 'footer.php';
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
    if(!document.frmform.uname.value.match(alphaspaceExp))
    {
        document.getElementById("idname").innerHTML="Entered User Name should contain only alphabets...";
        errcondition ="false";
    }
    if(document.frmform.uname.value=="")
    {
        document.getElementById("idname").innerHTML = "User Name should not be empty...";
        errcondition ="false";      
    }
    if(!document.frmform.email.value.match(emailExp))
    {
        document.getElementById("idemail").innerHTML="Entered Email ID is not valid...";
        errcondition ="false";  
    }
    if(document.frmform.email.value=="")
    {
        document.getElementById("idemail").innerHTML = "Email ID  should not be empty...";
        errcondition ="false";      
    }
    if(document.frmform.msgbody.value.length > 200)
    {
        document.getElementById("idmessage").innerHTML = "Message can contain only or less than 200 charecters...";
        errcondition ="false";  
    }
    if(document.frmform.msgbody.value=="")
    {
        document.getElementById("idmessage").innerHTML = "Message should not be empty...";
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