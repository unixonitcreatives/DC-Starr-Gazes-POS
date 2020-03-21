<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>

<!-- ================== CONFIG ================= -->
<?php require_once 'config.php'; ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php 
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
 include('template/user_auth.php');
?>

<?php

$alertMessage="";

  if(@$_GET['alert'] == "updatesuccess"){
          $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully updated.</div>";
        }else if(@$_GET['alert'] == "deletesuccess"){
          $alertMessage = "<div class='alert alert-danger' role='alert'>Data successfully deleted.</div>";
        }else if(@$_GET['alert'] == "addsuccess"){
          $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully added.</div>";
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
         Manage User Accounts<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">
        <?php echo $alertMessage; ?>
        <div class="row">
          <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Search for User Account Information</h3>
              <br><a href="user-add.php" class="text-center">+ add new user</a>
                <button type="button" class="btn btn-primary pull-right" onclick="exportTb()">Export Excel</button>
            </div>
            <div class="box-body" id='th'>
              
              <br><br>
              <table id="example1" class="table table-bordered table-hover dataTable tb" role="grid" aria-describedby="example2_info">
                
                      <thead id='thead'>
                        <tr>
                          <th>No.</th>
                          <th>ACC No.</th>
                          <th>Username</th>
                          <th>User Type</th>
                          <th>Time Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Attempt select query execution
                        $query = "SELECT * FROM users ORDER BY created_at DESC";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_assoc($result)){
                              //$id = $row['custID'];
                              $ctr++;
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $row['custID'] . "</td>";
                              echo "<td>" . $row['username'] . "</td>";
                              echo "<td>" . $row['usertype'] . "</td>";
                              echo "<td>" . $row['created_at'] . "</td>";
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

<script type="text/javascript">

function exportTb(){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById('example1');
    var table_html = '<table><thead><tr><th>NO.</th><th>User ID</th><th>Username</th><th>Usertype</th><th>Created &nbsp; At</th></tr></thead></table>';
    var tableHTML = table_html + tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    //document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob([tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob );
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ',' + tableHTML;
    
        //triggering the function
        downloadLink.click();
}

}


</script>
   
</body>
</html>
