<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
 include('template/user_auth.php');
?>
<!-- ========================================== -->

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
         Stock Manage (In-Stock)<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">
          <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <!-- <br><a href="po-generate.php" class="text-center">+ generate new PO</a> -->
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SC No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">PO No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SKU</th>

                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Warehouse</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>

                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Approved By</th>

                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM stock WHERE stock_status='In Stock' ORDER BY custID, warehouse_ID asc";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $row['custID'] . "</td>";
                              echo "<td>" . $row['product_SKU'] . "</td>";
                              echo "<td>" . $row['PO_ID'] . "</td>";

                              echo "<td><a href='warehouse-view.php?WHid=".$row['warehouse_ID']."'>" . $row['warehouse_ID'] . "</a></td>";

                              if($row['stock_status']=="In Stock"){
                                echo "<td><span class='badge bg-green'>In Stock</span></td>";
                              } elseif ($row['stock_status']=="Sold"){
                                echo "<td><span class='badge bg-orange'>Sold</span></td>";
                              } elseif ($row['stock_status']=="Void"){
                                echo "<td><span class='badge bg-red'>Void</span></td>";
                              } else {
                                echo "<td><span class='badge bg-gray'>Error</span></td>";
                              }

                              echo "<td>" . $row['approved_by']." on ". $row['created_at'] . "</td>";
                              echo "<td>";

                              if($row['stock_status']=="In Stock"){
                                echo " &nbsp; <a href='#". $row['id'] ."' title='Some Function Here' data-toggle='tooltip'><span class='glyphicon glyphicon-ok'></span></a>";

                                echo " &nbsp; <a href='#". $row['id'] ."' title='Some Function Here' data-toggle='tooltip'><span class='glyphicon glyphicon-cog'></span></a>";

                                echo " &nbsp; <a href='generate-barcode.php?id=". $row['custID'] ."' title='Print Barcode' data-toggle='tooltip'><span class='glyphicon glyphicon-barcode'></span></a>";

                                echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='Void' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";

                              } elseif ($row['po_status']=="Sold"){


                              } elseif ($row['po_status']=="Void"){


                              } else {

                              }
                              
                              echo "</td>";
                              echo "</tr>";
                            }
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


</body>
</html>
