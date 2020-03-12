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
         Returns Report<br>
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
                <h3 class="box-title">Returns Data</h3><br>
                <a href="index.php" class="text-center">go to Dashboard</a>
                <button type="button" class="btn btn-primary pull-right" onclick="exportTableToExcel('example2')">Export To Excel</button>
              </div>
              
              <div class="box-body">
                
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="form" method="POST">
                      <h4>Date Range</h4>
                      <div class="row">
                          <div class="offset-md-1 col-md-8">                          
                            <div class="input-daterange input-group" id="date-range">
                              <input type="date" name="start" class="form-control">
                                <span class="input-group-addon bg-blue text-white" style="border: none; border-radius: -5px;">to</span>
                              <input type="date" name="end" class="form-control">                                    
                            </div>                                    
                          </div>
                          
                          <div class="col-md-4">
                            <button type="submit" name="action" class="btn btn-primary">Search</button>
                          </div>
                          
                      </div>
                    </form>
                  
                  <br>
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

                      <thead id='head'>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="5%">NO</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Date of Purchase</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Transaction ID</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Customer</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Item</th>
                           <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Quantity</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Cashier</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                           // Include config file
                        require_once 'config.php';
                        $start = $end = "";

             
                          @$start = date('Y-m-d', strtotime($_POST['start']));
                          @$end = date('Y-m-d', strtotime($_POST['end']));
                          
                        // Attempt select query execution
             
//                    $query = "SELECT returns.date_purchase,returns.qty,returns.trans_id,returns.remarks,customers.lastName,customers.firstName,users.username,returns.created_at FROM returns 
//                    INNER JOIN customers ON returns.customer = customers.custID  
//                    INNER JOIN product_model ON returns.item = product_model.product_description
//                    INNER JOIN users ON returns.cashier = users.username WHERE returns.created_at BETWEEN '$start' AND '$end'";
                        
                    $query = "SELECT * FROM returns WHERE created_at BETWEEN '$start' AND '$end'";    

                        // Attempt select query execution
                       
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_assoc($result)){ 
                              //$id = $row['custID'];
                              $ctr++;
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $row['date_purchase'] . "</td>";
                              echo "<td>" . $row['trans_id'] ."</td>";
                              echo "<td>" . $row['customer'] . "</td>";
                              echo "<td>" . $row['item'] . "</td>";
                              echo "<td>" . $row['qty'] . "</td>";
                              echo "<td>" . $row['cashier'] . "</td>";
                              echo "<td>" . $row['remarks'] . "</td>";
//                              echo "<td>";
////                              echo "<a href='user-update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
////                              echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
//                              echo "</td>";
                              echo "</tr>";
                            
                            // Free result set
                      
                            }
                                    mysqli_free_result($result);
                          } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                          }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        // Close connection
    
                        ?>
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

<script>
  
  function exportTableToExcel(id){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(id);
    var table_html = '<table><thead><tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead></table>';
    var tableHTML = table_html + tableSelect.outerHTML;
    
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
        downloadLink.href = 'data:' + dataType + ',' + encodeURIComponent(tableHTML);
    
        //triggering the function
        downloadLink.click();
}

}
</script>

</body>
</html>
