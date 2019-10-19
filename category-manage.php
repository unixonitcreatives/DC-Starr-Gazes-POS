<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
 include('template/user_auth.php');
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
          Manage Categories<br>
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
              <h3 class="box-title">Search for Categories</h3>
              <br><a href="category-add.php" class="text-center">+ add new category</a>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                  <tr>
                    <th>CT No.</th>
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Include config file
                  require_once 'config.php';
                  // Attempt select query execution
                  $query = "SELECT * FROM categories ORDER BY category_name asc";
                  if($result = mysqli_query($link, $query)){
                    if(mysqli_num_rows($result) > 0){
                      //$ctr = 0;
                      while($row = mysqli_fetch_array($result)){
                        //$ctr++;
                        echo "<tr>";
                        //echo "<td>" . $ctr . "</td>";
                        echo "<td>" . $row['custID'] . "</td>";
                        echo "<td>" . $row['category_name'] . "</td>";
                        echo "<td>";
                        echo "<a href='user-update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                        echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
