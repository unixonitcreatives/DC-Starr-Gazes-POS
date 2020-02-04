<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- =================================================== -->

<?php 

require_once "config.php"; 

// //$custName = $_GET['so_cust'];

// //$q = "SELECT * FROM customers";
// $q = "SELECT * FROM sales_order WHERE mop='Installment'";
// $r = mysqli_query($link,$q);

// while($row = mysqli_fetch_assoc($r)){
//   $custName = $row['so_cust'];

// }
// $query = "SELECT * FROM customers WHERE custID='$custName'";
// $result = mysqli_query($link, $query) or die(mysqli_error($link));

// if (mysqli_num_rows($result) > 0) {

//   while ($row = mysqli_fetch_assoc($result)){
//     $firstname        = $row['firstName'];
//     $lastname         = $row['lastName'];
//     $custID           = $row['custID'];
//   }
//   //$num_rows = mysqli_num_rows($result);
// } else{
//   echo "<p class='lead'><em>No records were found.</em></p>";
// }

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
    <style type="text/css">

      td {
      text-align: center;
      padding: .75rem;
      border-top: 1px solid #dee2e6;
      }

    th {
      text-align: center;
      display: table-cell;
      font-weight: bold;
    }


    .box {
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0.3px solid rgba(0,0,0,.125);
    border-radius: .25rem;
    border-radius: 7px;
  }

  .btn-tool{
      color: gray;
      font-size: 15px;
  }

  .box-header {
    margin-left: 5px;
    margin-top: 10px;
  }

  .text-uppercase {
    color: gray;
  }

    </style>
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
           <!--  <div class="chart col-md-12">
              
              <canvas id="salesChart" style="height: 180px;"></canvas>
           </div> -->
      <?php
        $q = "SELECT COUNT(id) as total_customers FROM customers";
        $r = mysqli_query($link,$q);

        while($row = mysqli_fetch_assoc($r)){
       ?> 
        <div class="col-md-3">
            <div class="box" style="height: 115px;">
              <span class="info-box-icon bg-green" style="height: 115px;"><i class="fa fa-users" style="margin-top: 30px"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" style="color: gray; font-weight: 600; font-size: 14px;">Total Customers</span>
                  <br> 
                  <span class="info-box-number" style="font-size: 30px; text-align: right;"><?php echo $row['total_customers']?></span>
                </div>
            </div>
        </div>

      <?php } ?>

       

      <?php
        $q = "SELECT COUNT(id) as total_stocks FROM stock WHERE stock_status = 'In Stock'";
        $r = mysqli_query($link,$q);

        while($row = mysqli_fetch_assoc($r)){
       ?> 
          <div class="col-md-3">
            <div class="box" style="height: 115px;">
              <span class="info-box-icon bg-red" style="height: 115px;"><i class="fa fa-cubes" style="margin-top: 30px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" style="color: gray; font-weight: 600; font-size: 14.1px;">Total Items<br>In-Stock</span>
                  
                  <span class="info-box-number" style="font-size: 30px; text-align: right;"><?php echo $row['total_stocks']?></span>
                </div>
            </div>
          </div>

      <?php } ?>


      <?php
        $q = "SELECT COUNT(id) as total_suppliers FROM supplier";
        $r = mysqli_query($link,$q);

        while($row = mysqli_fetch_assoc($r)){
      ?> 
        <div class="col-md-3">
            <div class="box" style="height: 115px;">
              <span class="info-box-icon bg-yellow" style="height: 115px;"><i class="fa fa-id-card-o" style="margin-top: 30px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" style="color: gray; font-weight: 600; font-size: 14.1px;">Total Suppliers</span>
                  <br>
                  <span class="info-box-number" style="font-size: 30px; text-align: right;"><?php echo $row['total_suppliers']?></span>
                </div>
            </div>
        </div>

        <?php } ?>


           <?php
        $q = "SELECT COUNT(id) as total_warehouse FROM warehouse";
        $r = mysqli_query($link,$q);

        while($row = mysqli_fetch_assoc($r)){
       ?> 
          <div class="col-md-3">
            <div class="box" style="height: 115px;">
              <span class="info-box-icon bg-blue" style="height: 115px;"><i class="fa fa-dropbox" style="margin-top: 30px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" style="color: gray; font-weight: 600; font-size: 13.8px;">Total Warehouse</span>
                  <br>
                  <span class="info-box-number" style="font-size: 30px; text-align: right;"><?php echo $row['total_warehouse']?></span>
                </div>
            </div>
          </div>

          <?php } ?>

          <div class="col-lg-12">
            <div class="box">
              <div class="box-header">
                <h4 class="box-title lead" style="margin-left: 5px; margin-top: 10px; font-size: 20px;">Quick Access:</h4>
              </div>

                <div class="box-body">
                
                  <a href='si_generate.php' class="btn bg-red" style="padding: 11px;font-size:15px;border-radius:7px;">Add Invoice</a>
                  <a href='po_generate.php' class="btn bg-green" style="padding: 11px;font-size:15px;border-radius:7px;">Add Purchase Order</a>
                  <a href='warehouse-add.php' class="btn bg-primary" style="padding: 11px;font-size:15px;border-radius:7px;">Add Warehouse</a>
                  <a href='customer-add.php' class="btn bg-yellow" style="padding: 11px;font-size:15px;border-radius:7px;">Add Customer</a>
                  <a href='supplier-add.php' class="btn bg-green" style="padding: 11px;font-size:15px;border-radius:7px;">Add Supplier</a>
                  <a href='product-model-add.php' class="btn bg-primary" style="padding: 11px;font-size:15px;border-radius:7px;">Add Product Model</a>
                  <a href='category-add.php' class="btn bg-red" style="padding: 11px;font-size:15px;border-radius:7px;">Add Category</a>
                  <a href='category-sub-add.php' class="btn bg-yellow" style="padding: 11px;font-size:15px;border-radius:7px;">Add Sub-Category</a>
                </div>
            </div>
          </div>

        <div class="col-lg-6">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title lead" style="margin-left: 5px; margin-top: 10px;">UNPAID INVOICES</h3>
                  <a href="si-credits.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-bars" title="Manage Invoice" data-toggle='tooltip'></i>
                  </a>
                  <a href="si-generate.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-plus" title="Add Invoice" data-toggle="tooltip"></i>
                  </a>
              </div>
                <br>
                <table class="table table-responsive table-striped">
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
                              <td class='text-center text-danger' style='font-weight: 550; font-size: 15px;'>UNPAID</td>
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
      <div class="box">
              <div class="box-header">
                <h3 class='box-title lead' style="margin-left: 5px; margin-top: 10px;">RECENT CATEGORY</h3>
                <a href="category-manage.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-bars" title="Manage Category" data-toggle="tooltip"></i>
                  </a>
                  <a href="category-add.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-plus" title="Add Category" data-toggle='tooltip'></i>
                  </a> 
              </div>
                <br>
                <table class="table table-striped table-responsive">
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

    <div class="col-lg-6">
      <div class="box">
              <div class="box-header">
                <h3 class="box-title lead" style="margin-left: 5px; margin-top: 10px;">RECENT CUSTOMERS</h3>
                <a href="customer-manage.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-bars" title="Manage Customers" data-toggle="tooltip"></i>
                  </a>
                  <a href="customer-add.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-plus" title="Add Customer" data-toggle="tooltip"></i>
                  </a> 
              </div>
              <br>
               <table class="table table-responsive table-striped">
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
            
      <div class="box">
              <div class="box-header">
                <h3 class="box-title lead" style="margin-left: 5px; margin-top: 10px;">RECENT SUB CATEGORY</h3>
                <a href="category-sub-manage.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-bars" title="Manage Sub Categories" data-toggle="tooltip"></i>
                  </a>
                  <a href="category-sub-add.php" class="btn btn-tool btn-sm pull-right">
                    <i class="fa fa-plus" title="Add Sub Categories" data-toggle='tooltip'></i>
                  </a> 
              </div>
              <br>
                <table class="table table-responsive table-striped">
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
