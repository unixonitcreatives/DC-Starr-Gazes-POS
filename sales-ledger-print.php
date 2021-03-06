<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
 include('template/user_auth.php');
 $alertMessage="";
?>

<!-- ================================================================ -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>DC Starr Gazes</title>
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
         Sales Ledger Report<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== ALERT ======================= -->
  <?php
  if(isset($_GET['alert']) == "updatesuccess"){
    $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully updated.</div>";
  }else if(isset($_GET['alert']) == "deletesuccess"){
    $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully deleted.</div>";
  }else if(isset($_GET['alert']) == "addsuccess"){
    $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully added.</div>";
  }
   ?>
   <?php echo $alertMessage; ?>
   <!-- ======================== MAIN CONTENT ======================= -->

  <section class="content">
          <!-- general form elements -->
          <div class="box box-default">
              <div class="box-header with-border no-print">
                <h3 class="box-title">Sales Ledger Data</h3><br>
                <a href="index.php" class="text-center">go to Dashboard</a>
                    <button type="button" class="btn btn-primary pull-right" onclick="exportTableToExcel('example2')">Export To Excel</button>

                    <a href='sales-ledger-print.php' class="btn btn-default pull-right" onclick="Print()" target='_blank'>Print</a>
              </div>
              <div class="box-body">
              
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class='no-print' name="form" method="POST">
                      <h4>Date Range</h4>
                      <div class="row">
                          <div class="offset-md-1 col-md-8">                          
                            <div class="input-daterange input-group" id="date-range">
                              <input type="date" name="start" class="form-control">
                                <span class="input-group-addon bg-blue text-white" style="border: none; border-radius: -5px;">to</span>
                              <input type="date" name="end" class="form-control">                                    
                            </div>                                    
                          </div>

                          <div class="col-md-3">
                            <button type="submit" name="action" class="btn btn-primary">Search</button>
                          </div>
                      </div>
                    </form>
<br>
                    <table class="table table-bordered table-hover" role="grid">

                      <thead id='head'>
                        <tr>
                          <th>NO</th>
                          <th>Sales Invoice ID</th>
                          <th>Customer Name</th>
                          <th>Total Amount</th>
                          <th>Total Paid Amount</th>
                          <th>Mode of Payment</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        include('config.php');
                        $start = $end = "";

                          //$start = $_POST['start'];
                          //$end = $_POST['end'];            
            
                          //$ss = new DateTime($_POST['start']);
                          //$start = $ss->format('Y-m-d H:i:s');

                          //$ee = new DateTime($_POST['end']); 
                          //$end = $ee->format('Y-m-d H:i:s');
                          
                          // $ss = time();
                          // $ee = time();

                          @$start = date('Y-m-d', strtotime($_POST['start']));
                          @$end = date('Y-m-d', strtotime($_POST['end']));
                        
                        //$start = date_timestamp_get($_POST['start']);
                        //$end = date_timestamp_get($_POST['end']);

                        //$start = date_parse_from_format('mmddyyyy', $_POST['start']);
                        //$end = date_parse_from_format('mmddyyyy', $_POST['end']);

                        // Attempt select query execution
                if(!empty($start) && !empty($end)){
                  // $query = "SELECT * FROM sales_order 
                  //   WHERE sales_order.created_at BETWEEN '$start' AND '$end'";
                    $q = "SELECT * FROM installment_history";
                    $r = mysqli_query($link,$q);
                    $row = mysqli_fetch_assoc($r);
                    
                    $query = "SELECT customers.custID,customers.firstName,customers.lastName,sales_order.created_at,sales_order.so_cust,sales_order.mop,SUM(sales_order.so_price) AS total_price,sales_order.txID FROM customers
                       INNER JOIN sales_order ON customers.custID = sales_order.so_cust 
                       WHERE sales_order.mop='Cash' AND sales_order.created_at BETWEEN '$start' AND '$end' GROUP BY sales_order.txID ORDER BY sales_order.created_at DESC";
                    
                  
                }
                          
                          
            
                   
                 
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;

                            while($row = mysqli_fetch_assoc($result)){
                               $q = "SELECT * FROM installment_history";
                               $r = mysqli_query($link,$q);
                               $rw = mysqli_fetch_assoc($r);
                               $ins = ''; 
                               // $date = $row['created_at'];
                               // $date = date('M d,Y', strtotime($date));
                               $ins = $rw['ins_amount'];

                      
                              $ctr++;?>
                              <tr>
                              <td><?php echo $ctr; ?></td>
                              <td><?php echo $row['txID']; ?></td>
                              <td><?php echo $row['firstName']; echo '&nbsp;'; echo $row['lastName']; ?></td>
                              <td><?php echo $row['total_price']; ?></td>
                              <td><?php echo $row['total_price']; ?></td>
                              <td><?php echo $row['mop'];?></td>
                              <td><?php echo $row['created_at']; ?></td>

                            <?php }
                            // Free result set
                            mysqli_free_result($result);
                          }
                        } else{
                          echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);
                        ?>
                        </tr>
                      </tbody>
                    </table>
              </div>
          </div>


  </section>


  </div>

<!-- =========================== FOOTER =========================== -->
  <footer class="main-footer no-print">
      <?php include('template/footer.php'); ?>
  </footer>


<!-- =========================== JAVASCRIPT ========================= -->
      <?php include('template/js.php'); ?>

<script>

  function Print(){
    window.print();
  }

</script>

</body>
</html>
