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
         Sales Invoice Credit Record<br>
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
              <div class="box-header with-border">
                <h3 class="box-title">Search for Sales Invoice Credit Data</h3><br>
                <a href="si-generate.php" class="text-center">+ Generate new Sales Invoice</a>
              </div>
              <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="5%"></th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Sales Invoice No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Customer ID</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Total Credit/s</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Credit Status</th>

                          <th >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';
                        $mop="";
                        // Attempt select query execution
                        $query = "SELECT txID, so_cust, SUM(so_price)-discount AS TPrice, mop FROM sales_order WHERE mop='Installment' GROUP BY txID ORDER BY created_at DESC";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){

                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $mop = $row['mop'];
                              $ctr++;?>
                              <tr>
                              <td><?php echo $ctr; ?></td>
                              <td><a href="si-view-in-rows.php?txID=<?php echo $row['txID']; ?>"><?php echo $row['txID']; ?></td>
                              <td><?php echo $row['so_cust'];?></td>
                              <td><?php echo $row['TPrice'];?></td>
                              <?php
                            if ($mop == 'Installment'){
                              echo "<td>Unpaid</td>";
                            }else if ($mop == 'Paid'){
                              echo "<td>Paid</td>";
                            }
                              ?>
                              <td>
                               <a href='si-print-data.php?id=<?php echo $row['txID']; ?>' title="Print" data-toggle="tooltip"><span class="glyphicon glyphicon-print"></span></a>
                               <a href='si-view-credits.php?txID=<?php echo $row['txID']; ?>&&so_cust=<?php echo $row['so_cust']; ?>' title="Update Payment" data-toggle="tooltip"><span class="glyphicon glyphicon-th-list"></span></a>
                              </td>
                            <?php }
                            // Free result set
                            mysqli_free_result($result);
                          } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                          }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
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
  <footer class="main-footer">
      <?php include('template/footer.php'); ?>
  </footer>


<!-- =========================== JAVASCRIPT ========================= -->
      <?php include('template/js.php'); ?>



</body>
</html>
