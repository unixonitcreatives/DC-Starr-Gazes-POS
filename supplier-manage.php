<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
 include('template/user_auth.php');
?>
<!-- =======================   =================== -->

<?php
// Define variables and initialize with empty values
$username=$password=$usertype=$alertMessage="";
require_once "config.php";

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
         Manage User Accounts<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <?php
      
    if(@$_GET['alert'] == "success"){
      $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully updated.</div>";
    }else if(@$_GET['alert'] == "deletesuccess"){
      $alertMessage = "<div class='alert alert-danger' role='alert'>Data successfully deleted.</div>";
      //echo "<script>window.location.href='supplier-manage.php'</script>";
    }else if(@$_GET['alert'] == "addsuccess"){
      $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully added.</div>";
    }
     ?>
    
    <section class="content">
         <?php echo $alertMessage; ?>
          <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Search for User Account Information</h3>
              <br><a href="user-add.php" class="text-center">+ add new user</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SP No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Supplier Name</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Contact Person</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Contact No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">E-mail</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Address</th>

                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM supplier ORDER BY custID asc";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++; ?>
                              <tr>
                              <td><?php echo $ctr; ?></td>
                              <td><?php echo $row['custID'];?></td>
                              <td><?php echo $row['supplier_name'];?></td>
                              <td><?php echo $row['supplier_contact_person'];?></td>
                              <td><?php echo $row['supplier_contact_no'];?></td>
                              <td><?php echo $row['supplier_email'];?></td>
                              <td><?php echo $row['supplier_address'];?></td>
                              <td>
                              <a href='supplier-update.php?id=<?php echo $row['id']; ?>"' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                              &nbsp; <a href='#' title='Delete Record' data-toggle='modal' data-target="#deleteModal<?php echo $row['id']; ?>"><span class='glyphicon glyphicon-trash'></span></a>
                              </td>
                              <!-- =========================== DELETE MODAL ====================== -->
                              <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title">Delete Data</h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Are you sure you want to delete this data?</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <a class="btn btn-danger" href='supplier-delete.php?id=<?php echo $row['id'];?>&name=<?php echo $row['supplier_name']; ?>'>Delete</a>
                                    </div>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                              <!-- /.modal -->
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
