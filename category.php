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


        <title>DC Starr Gazes</title>
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
        <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

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
                        <li class="inactive"><a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                        <li class="inactive"><a href="supplier.php"><i class="fa fa-id-card-o"></i> <span>Supplier</span></a></li>
                        <li class="active"><a href="category.php"><i class="fa fa-cubes"></i> <span>Category</span></a></li>
                        <li class="inactive"><a href="model.php"><i class="fa fa-cube"></i> <span>Model</span></a></li>
                        <li class="inactive"><a href="product.php"><i class="fa fa-archive"></i> <span>Stock Count</span></a></li>
                        <li class="inactive"><a href="branch.php"><i class="fa fa-building"></i> <span>Branch</span></a></li>
                        <li class="inactive"><a href="PO.php"><i class="fa fa-cart-plus"></i> <span>Purchase Order</span></a></li>
                        <li class="inactive"><a href="SO.php"><i class="fa fa-money"></i> <span>Sales Order</span></a></li>
                        <li class="inactive"><a href="delivery.php"><i class="fa fa-truck"></i> <span>Delivery</span></a></li>
                        <li class="inactive"><a href="customer.php"><i class="fa fa-users"></i> <span>Customer</span></a></li>
                        <li class="inactive"><a href="user.php"><i class="fa fa-user-circle-o"></i> <span>User</span></a></li>
                        <li class="inactive"><a href="report.php"><i class="fa fa-pie-chart"></i> <span>Report</span></a></li>
                        <li class="inactive"><a href="support.php"><i class="fa fa-superpowers"></i> <span>Support</span></a></li>
                        <li class="inactive"><a href="logout.php"><i class="fa fa-close"></i> <span>Logout</span></a></li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>CATEGORY</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard active"></i> Dashboard</a></li>
                    </ol>
                </section>

                <section class="content">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">+ Add New Category</h3>
                        </div>
                        <!-- form start -->
                        <form role="form">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Category Name</label>
                              <input type="text" class="form-control" id="" placeholder="Category Name">
                            </div>
                          </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                      </div>


                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">List of Categories</h3>
                        </div>
                        <div class="box-body">
                            <div class="row"></div>
                            <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Category ID</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Category Name</th>
                              <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>
                        </div>



                      </div>


                    </div>
                  </div>

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
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->

<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Alert animation -->
<script type="text/javascript">
$(document).ready(function () {

  window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
      $(this).remove();
    });
  }, 1000);

});
</script>

<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
 </script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )


  })
</script>

<script>
  //uppercase text box
  function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}
</script>



    </body>
</html>
