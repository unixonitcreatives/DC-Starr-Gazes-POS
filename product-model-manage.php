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

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $usertype = test_input($_POST['usertype']);

    // Validate username
    if(empty($username)){
        $alertMessage = "Please enter a username.";
    }

    // Validate password
    if(empty($password)){
        $alertMessage = "Please enter a password.";
    }

    // Validate user type
    if(empty($usertype)){
        $alertMessage = "Please enter a user type.";
    }


    // Check input errors before inserting in database
    if(empty($alertMessage)){
        //Check if the username is already in the database
        $sql_check = "SELECT username FROM users WHERE username ='$username'";
        if($result = mysqli_query($link, $sql_check)){ //Execute query
                                 if(mysqli_num_rows($result) > 0){
                                    //If the username already exists
                                    //Try another username pop up
                                    echo "<script> window.alert('Username already exist, Please try again a different name')</script>";

                                     mysqli_free_result($result);
                                 } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database
                                    //Checking the values are existing in the database or not
                                    $query = "INSERT INTO users (username, password, usertype)
                                                   VALUES ('$username', '$password', '$usertype')"; //Prepare query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute query

                                    if($result){
                                      //If execution is completed

                                      $alertMessage = "<div class='alert alert-success' role='alert'>
                                      New user successfully added.
                                      </div>";

                                      header("location: user-add.php");
                                    }else{
                                      //If execution failed

                                      $alertMessage = "<div class='alert alert-danger' role='alert'>
                                      Error adding data.
                                      </div>";}
                                      mysqli_close($link);
                                 }
                             } else{
                                 echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                             }

                             mysqli_close($link);

        }
      }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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
         Manage Product Models<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
  <?php
  if(@$_GET['alert'] == "updatesuccess"){
          $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully updated.</div>";
        }else if(@$_GET['alert'] == "deletesuccess"){
          $alertMessage = "<div class='alert alert-danger' role='alert'>Data successfully deleted.</div>";
        }else if(@$_GET['alert'] == "addsuccess"){
          $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully added.</div>";
  }
   ?>
 
    <!-- Main content -->
    <section class="content">
          <?php echo $alertMessage; ?>
          <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Search for Product Model Information</h3>
              <br><a href="product-model-add.php" class="text-center">+ add new product model</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">PM No.</th>
                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Product Description</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SKU</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Category</th>
                           <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Sub-Category</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Supplier</th>
                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Supplier Price</th>
                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Retail Price</th>
                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SRP</th>
                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Detail</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM product_model ORDER BY created_at DESC";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;?>
                              <tr>
                              <td><?php echo $ctr; ?></td>
                              <td><?php echo $row['custID']; ?></td>
                              <td><?php echo $row['product_description']; ?></td>
                              <td><?php echo $row['product_SKU'];?></td>
                              <td><span data-toggle='tooltip' title=''><?php echo $row['product_category'];?></span></td>
                              <td><span data-toggle='tooltip' title=''><?php echo $row['product_sub_category'];?></span></td>
                              <td><?php echo $row['product_supplier'];?></td>
                              <td><?php echo  $row['supplier_price'];?></td>
                              <td><?php echo  $row['sell_price'];?></td>
                              <td><?php echo  $row['suggested_retail_price'];?></td>
                              <td><?php echo $row['product_detail'];?></td>
                              <td>
                              <a href='product-model-update.php?id=<?php echo $row['id'];?>' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                               &nbsp; <a  href='#' data-toggle='modal' data-target='#modal-delete<?php echo $row['id']; ?>'><span class='glyphicon glyphicon-trash'></span></a>
                              </td>
                              <!-- =========================== DELETE MODAL ====================== -->
                              <div class="modal fade" id="modal-delete<?php echo $row['id']; ?>">
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
                                      <a class="btn btn-danger" href='product-model-delete.php?id=<?php echo $row['id'] ?>&name=<?php echo $row['product_SKU']; ?>&desc=<?php echo $row['product_description'];?>'>Delete</a>
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
