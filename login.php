<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$alertError = $alertMessage = $username_err = $password_err = $hashed_password = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  $username = test_input($_POST['username']);
  $password = test_input($_POST['password']);

  // Validate username and password
  if(empty($username)){
      $username_err = "Please enter username.";
  }
  if(empty($password)){
      $password_err = "Please enter password.";
  }

  //Query
  $query="SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($link, $query) or die(mysqli_error($link));

  if($result){

  $rows = mysqli_fetch_array($result);



  //Direct pages with different user levels
  if ($rows['usertype'] == "Administrator") {

    session_start();
    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    $_SESSION["usertype"] = "Administrator";
    header('location: dashboard.php');
    exit;
  }
  else
  if ($rows['usertype'] == "Manager") {
    session_start();
    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    $_SESSION["usertype"] = "Manager";
    header('location: dashboard.php');
    exit;

  }
  else
  if ($rows['usertype'] == 'Accounting') {
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    $_SESSION["usertype"] = "Accounting";
    header('location: dashboard.php');
  }

  else
  {
    // Display an error message
    $alertError = "Invalid username & password combination";
  }
   
  // Close connection
  mysqli_close($link);
}



}

function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DC Starr Gazes - Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
body {
  background-image: url("dist/img/bg.png");

  /* Full height */
  height: auto;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

}
</style>

</head>

<body >
  <div class="login-box">

    <!-- <a href="index.php"><b>MyHome</b>IMS</a> -->

  <!-- /.login-logo -->
  <div class="login-box-body">

    <img class="img-responsive pad" src="dist/logo-01.png">
    <p class="login-box-msg">Sign in your credentials</p>
      <p class="text-danger"><?php echo $alertError ?></p>
    

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" oninput="upperCase(this)">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <p class="text-danger"><?php echo $username_err; ?></p>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password"> 
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <p class="text-danger"><?php echo $password_err; ?></p>
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    Powered by: <a href="http://www.unixondev.com" class="text-center">Unixon IT Creatives</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include('template/js.php'); ?>

</body>
</html>
