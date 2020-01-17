<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- =================================================== -->

<?php 

require_once "config.php"; 

//$custName = $_GET['so_cust'];

//$q = "SELECT * FROM customers";
$q = "SELECT * FROM sales_order WHERE mop='Installment'";
$r = mysqli_query($link,$q);

while($row = mysqli_fetch_assoc($r)){
  $custName = $row['so_cust'];

}
$query = "SELECT * FROM customers WHERE custID='$custName'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_assoc($result)){
    $firstname        = $row['firstName'];
    $lastname         = $row['lastName'];
    $custID           = $row['custID'];
  }
  //$num_rows = mysqli_num_rows($result);
} else{
  echo "<p class='lead'><em>No records were found.</em></p>";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>DC Star Gazes | Dashboard</title>
<!-- ======================= CSS ================================= -->
<?php include('template/css.php'); ?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <!-- ======================= MENU BAR =========================== -->
  <?php include('template/menu-bar.php'); ?>
  <!-- ======================= SIDEBAR ============================ -->
  <?php include('template/sidebar-manage.php'); ?>
  <!-- ======================== HEADER CONTENT ==================== -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Welcome to DC Starr Gazes Dashboard<br>
        <small>Insert Tagline, Contact Details or Important Details</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="box box-block tile tile-2 bg-success mb-2">
                <div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
                  <div class="t-content">
                    <h2 class="mb-1">Total Product Sold</h2>
                    <h4>1000000</h4>
                  </div>
              </div>
        </div>
 -->
       <?php
        $q = "SELECT COUNT(id) as total_customers FROM customers";
        $r = mysqli_query($link,$q);

        while($row = mysqli_fetch_assoc($r)){
       ?> 
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="box box-block bg-white tile tile-4 mb-2">
                  <div class="fa fa-users t-icon bg-success"></div>
                  <div class="t-content text-right">
                    <h6 class="text-uppercase" style='font-size: 13px;'>Total Customer</h6>
                    <h2 class="mb-0"><?php echo $row['total_customers']; ?></h2>
                  </div>
                </div>
              </div>

          <?php } ?>

           <?php
        $q = "SELECT COUNT(id) as total_stocks FROM stock WHERE stock_status = 'In Stock'";
        $r = mysqli_query($link,$q);

        while($row = mysqli_fetch_assoc($r)){
       ?> 
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="box box-block bg-white tile tile-4 mb-2">
                  <div class="fa fa-cubes t-icon bg-danger"></div>
                  <div class="t-content text-right">
                    <h6 class="text-uppercase" style='font-size: 13px;'>Total Items In-Stock</h6>
                    <h2 class="mb-0"><?php echo $row['total_stocks']; ?></h2>
                  </div>
                </div>
              </div>

          <?php } ?>


           <?php
        $q = "SELECT COUNT(id) as total_suppliers FROM supplier";
        $r = mysqli_query($link,$q);

        while($row = mysqli_fetch_assoc($r)){
       ?> 
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="box box-block bg-white tile tile-4 mb-2">
                  <div class="fa fa-id-card-o t-icon bg-warning"></div>
                  <div class="t-content text-right">
                    <h6 class="text-uppercase" style='font-size: 13px;'>Total Suppliers</h6>
                    <h2 class="mb-0"><?php echo $row['total_suppliers']; ?></h2>
                  </div>
                </div>
              </div>

          <?php } ?>


           <?php
        $q = "SELECT COUNT(id) as total_warehouse FROM warehouse";
        $r = mysqli_query($link,$q);

        while($row = mysqli_fetch_assoc($r)){
       ?> 
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="box box-block bg-white tile tile-4 mb-2">
                  <div class="fa fa-dropbox t-icon bg-primary"></div>
                  <div class="t-content text-right">
                    <h6 class="text-uppercase" style='font-size: 13px;'>Total Warehouse</h6>
                    <h2 class="mb-0"><?php echo $row['total_warehouse']; ?></h2>
                  </div>
                </div>
              </div>

          <?php } ?>

        <div class="col-lg-6">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title" >UNPAID INVOICE</h3>
                  <a href="si-credits.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-bars"></i>
                  </a>
                  <a href="si-generate.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-plus"></i>
                  </a> 
              </div>
        
              <div class="box-body">
                <table class="table table-responsive table-striped table-bordered">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php

                  $query = "SELECT * FROM customers INNER JOIN sales_order WHERE sales_order.so_cust = customers.custID AND sales_order.mop='Installment' ORDER BY sales_order.created_at DESC LIMIT 5";
                  $result = mysqli_query($link,$query);

                  if(mysqli_num_rows($result) > 0){
                    $ctr = 0;
                    while($row = mysqli_fetch_assoc($result)){
                      $ctr++;
                      echo "<tr>
                              <td>".$ctr."</td>
                              <td>".$row['firstName']."&nbsp;".$row['lastName']."</td>
                              <td class='text-center text-danger' style='font-weight:bold; font-size:15px;'>UNPAID</td>
                              <td>".$row['created_at']."</td>
                            </tr>
                      ";
                    }
                  } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                  }

                  ?>
                      </tbody>
                </table>
            </div>      
      </div>
      <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">RECENT CATEGORY</h3>
                <a href="category-manage.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-bars"></i>
                  </a>
                  <a href="category-add.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-plus"></i>
                  </a> 
              </div>
            
              <div class="box-body">
                <table class="table table-striped table-responsive table-bordered">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php

                  $query = "SELECT * FROM categories ORDER BY custID DESC LIMIT 5";
                  $result = mysqli_query($link,$query);

                  if(mysqli_num_rows($result) > 0){
                    $ctr = 0;
                    while($row = mysqli_fetch_assoc($result)){
                      $ctr++;
                      echo "<tr>
                              <td>".$ctr."</td>
                              <td>".$row['custID']."</td>
                              <td>".$row['category_name']."</td>
                              <td>".$row['created_at']."</td>
                            </tr>
                      ";
                    }
                  } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                  }

                  ?>
                  </tbody>
                </table>
            </div>      
      </div>
     
            
    </div>  

    <div class="col-lg-6">
      <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">RECENT CUSTOMERS</h3>
                <a href="customer-manage.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-bars"></i>
                  </a>
                  <a href="customer-add.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-plus"></i>
                  </a> 
              </div>
          
              <div class="box-body">
                <table class="table table-responsive table-striped table-bordered">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php

                  $query = "SELECT * FROM customers ORDER BY custID DESC LIMIT 5";
                  $result = mysqli_query($link,$query);

                  if(mysqli_num_rows($result) > 0){
                    $ctr = 0;
                    while($row = mysqli_fetch_assoc($result)){
                      $ctr++;
                      echo "<tr>
                              <td>".$ctr."</td>
                              <td>".$row['custID']."</td>
                              <td>".$row['firstName']."&nbsp;".$row['lastName']."</td>
                              <td>".$row['created_at']."</td>
                            </tr>
                      ";
                    }
                  } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                  }

                  ?>
                      </tbody>
                </table>
            </div>      
      </div>
            
      <div class="box">
              <div class="box-header">
                <h3 class="box-title">RECENT SUB-CATEGORY</h3>
                <a href="category-sub-manage.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-bars"></i>
                  </a>
                  <a href="category-sub-add.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-plus"></i>
                  </a> 
              </div>
              <div style="border-bottom: solid 1px #F6F5F6"></div>
              <div class="box-body">
                <table class="table table-responsive table-striped table-bordered">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Sub Category ID</th>
                    <th>Parent Category ID</th>
                    <th>Sub Category Name</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php

                  $query = "SELECT * FROM categories_sub ORDER BY custID DESC LIMIT 5";
                  $result = mysqli_query($link,$query);

                  if(mysqli_num_rows($result) > 0){
                    $ctr = 0;
                    while($row = mysqli_fetch_assoc($result)){
                      $ctr++;
                      echo "<tr>
                              <td>".$ctr."</td>
                              <td>".$row['custID']."</td>
                              <td>".$row['parent_category']."</td>
                              <td>".$row['sub_category_name']."</td>
                              <td>".$row['created_at']."</td>
                            </tr>
                      ";
                    }
                  } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                  }

                  ?>
                  </tbody>
                </table>
            </div>      
      </div>
    </div>
    </div>
    </section>
  <!-- /.content-wrapper -->
</div>


<!-- =========================== FOOTER =========================== -->
  <footer class="main-footer">
      <?php include('template/footer.php'); ?>
  </footer>


<!-- =========================== JAVASCRIPT ========================= -->
      <?php include('template/js.php'); ?>


<!-- =========================== PAGE SCRIPT ======================== -->

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

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
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
