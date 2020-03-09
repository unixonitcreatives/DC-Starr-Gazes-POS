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
         Void Invoice Report<br>
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
                <h3 class="box-title">Void Invoice Data</h3><br>
                <a href="index.php" class="text-center">go to Dashboard</a>
              </div>
              <div class="box-body">
                <button type="button" class="btn btn-primary pull-right" onclick="exportTableToExcel('example2')">Export To Excel</button>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="form" method="POST">
                      <h4>Date</h4>
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

                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="5%">NO</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Product Description</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Quantity</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Status</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Total Price</th>
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
                    $q = "SELECT * FROM sales_order";
                    $r = mysqli_query($link,$q);
                    $row = mysqli_fetch_assoc($r);
                    
                    $query = "SELECT * FROM void_so WHERE mop='Void' AND created_at BETWEEN '$start' AND '$end' ORDER BY created_at DESC";
                   
                }
                          
                 
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;

                            while($row = mysqli_fetch_assoc($result)){
                              $ctr++;?>
                              <tr>
                              <td><?php echo $ctr; ?></td>
                              <td><?php echo $row['stock_ID']; ?></td>
                              <td><?php echo $row['so_qty']; ?></td>
                              <td><?php echo $row['mop']; ?></td>
                              <td><?php echo $row['so_price']; ?></td>
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
    var table_html = '<table><thead><tr><th>NO.</th><th>Product Description</th><th>Quantity</th><th>Status</th><th>Total Price</th></tr></thead></table>';
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
