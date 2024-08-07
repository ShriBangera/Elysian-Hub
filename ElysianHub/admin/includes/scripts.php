  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <!--ANWAR scrit starts-->
  <!--for datatable-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
  <script>
        $(document).ready(function () {
           var currentpage = location.pathname.substring(location.pathname.lastIndexOf('/')+1);
            if(currentpage=='')
        {
            window.location.href='index.php';
        }
       var url = window.location;
    // Will only work if string in href matches with location
        //$('ul.nav a[href="' + url + '"]').parent().addClass('active');
    // Will also work for relative and absolute hrefs
        $('.nav-item .collapse-inner a').filter(function () {
            return this.href == url;
        }).addClass('active').parent().parent().parent().addClass('active');

    $('.nav-item.singlenave a').filter(function () {
            return this.href == url;
        }).addClass('active').parent().addClass('active');
    });
</script>
<!-- Anwar script ends-->



  <?php


$connection = mysqli_connect("localhost","root","","adminpanel");

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];

    if($password === $confirm_password)
    {
        $query = "INSERT INTO register (username,email,password) VALUES ('$username','$email','$password')";
        $query_run = mysqli_query($connection, $query);
    
        if($query_run)
        {
            echo "done";
            $_SESSION['success'] =  "Admin is Added Successfully";
            header('Location: register.php');
        }
        else 
        {
            echo "not done";
            $_SESSION['status'] =  "Admin is Not Added";
            header('Location: register.php');
        }
    }
    else 
    {
        echo "pass no match";
        $_SESSION['status'] =  "Password and Confirm Password Does not Match";
        header('Location: register.php');
    }

}

?>