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
         Sales Invoice Record<br>
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
                <h3 class="box-title">Search for Sales Invoice data</h3><br>
                <a href="si-generate.php" class="text-center">+ Generate new Sales Invoice</a>
              </div>
              <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="5%">NO.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Transaction ID</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Customer Name</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Total Amount</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Paid Amount</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM sales_order GROUP BY txID ORDER BY soID desc";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;?>
                              <tr>
                              <td><?php echo $ctr; ?></td>
                              <td><</td>
                              <td><?php echo $row['mop']; ?></td>
                              <td></td>

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
