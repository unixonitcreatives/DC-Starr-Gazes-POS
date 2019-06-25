<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
                         
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

         <meta http-equiv="pragma" content="no-cache" />
         <meta http-equiv="expires" content="-1" />


        <title>DC Starr Gazes | Dashboard</title>
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
        <!-- AdminLTE Skins. Choose a skin from the css/skins
folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
    <!-- the fixed layout is not compatible with sidebar-mini -->
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>DC</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>DC </b>Starr Gazes</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="profile.php" class="icon-bar">
                                    <span class="hidden-xs">Hello, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                                </a>
                            </li>

                            <li class="dropdown user user-menu">
                                <a href="logout.php" class="icon-bar">
                                    <span class="hidden-xs">Log out</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="dist/img/profile.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i>
                                
                                <?php
                                    switch (connection_status())
                                    {
                                    case CONNECTION_NORMAL:
                                      $txt = 'Online';
                                      break;
                                    case CONNECTION_ABORTED:
                                      $txt = 'Connection aborted';
                                      break;
                                    case CONNECTION_TIMEOUT:
                                      $txt = 'Connection timed out';
                                      break;
                                    case (CONNECTION_ABORTED & CONNECTION_TIMEOUT):
                                      $txt = 'Connection aborted and timed out';
                                      break;
                                    default:
                                      $txt = 'Unknown, please contact support';
                                      break;
                                    }

                                    echo $txt;
                                    ?>





                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <!-- Optionally, you can add icons to the links -->
                        <li class="active"><a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-id-card-o"></i> <span>Supplier</span></a></li>
                        <li class="inactive"><a href="category.php"><i class="fa fa-cubes"></i> <span>Category</span></a></li>
                        <li class="inactive"><a href="product.php"><i class="fa fa-cube"></i> <span>Product</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-building"></i> <span>Branch</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-cart-plus"></i> <span>Purchase Order</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-money"></i> <span>Sales Order</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-truck"></i> <span>Delivery</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-users"></i> <span>Customer</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-user-circle-o"></i> <span>User</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-pie-chart"></i> <span>Report</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-superpowers"></i> <span>Support</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-close"></i> <span>Logout</span></a></li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        DASHBOARD
                        <small>You can see a brief summary and overview of operation of business</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard active"></i> Dashboard</a></li>
                    </ol>
                </section>
                    <section class="content">





      <!-- =========================================================== -->
      <!-- Small boxes (Stat box) -->
      

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                  <?php
                         // Include config file
                         require_once "config.php";

                         // Attempt select query execution
                        $query = "SELECT COUNT(*) FROM suppliers";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){
                            $supp_count = mysqli_fetch_array($result);
                            echo $supp_count[0];
                            mysqli_free_result($result);
                          } else{
                            echo "0";
                          }
                         }
                         else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }
                        ?>

              </h3>

              <p>Supplier Count</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="supplier-manage.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>

                <?php
                         // Include config file
                         require_once "config.php";

                         // Attempt select query execution
                        $query = "SELECT COUNT(*) FROM products";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){
                            $prod_count = mysqli_fetch_array($result);
                            echo $prod_count[0];
                            mysqli_free_result($result);
                          } else{
                            echo "0";
                          }
                         }
                         else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }
                        ?>
                
                        </h3>

              <p>Product Count</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="product-manage.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
                
              <h3> 
                         <?php
                         // Include config file
                         require_once "config.php";

                         // Attempt select query execution
                        $query = "SELECT COUNT(*) FROM customers";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){
                            $cust_count = mysqli_fetch_array($result);
                            echo $cust_count[0];
                            mysqli_free_result($result);
                          } else{
                            echo "0";
                          }
                         }
                         else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }
                        ?>


              </h3>
              <p>Customer Count</p>
                        
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="customer-manage.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                  <?php
                         // Include config file
                         require_once "config.php";

                         // Attempt select query execution
                        $query = "SELECT COUNT(*) FROM customers";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){
                            $cust_count = mysqli_fetch_array($result);
                            echo $cust_count[0];
                            mysqli_free_result($result);
                          } else{
                            echo "0";
                          }
                         }
                         else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }
                        ?>

              </h3>

              <p>Incoming Items</p>
            </div>
            <div class="icon">
              <i class="fa fa-truck"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>


          </div>
        
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- =========================================================== -->
        

    </section>
                <!-- Main content -->

                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <?php include('template/footer.php'); ?>
            </footer>

            <!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>



    </body>
</html>
