<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
 include('template/user_auth.php');
?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
require_once "config.php";

    if(empty($alertMessage))
      //=======================================================================================================

    $PO = $_GET['custID'];
    $query = "SELECT * FROM generate_po WHERE custID = '$PO'"; // Get Data of the row approved
      echo $_GET['custID'];  echo "<script>console.log('Test')</script>";

          if($result = mysqli_query($link, $query)){ // Execute Query
              if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){ // This is where the Magic Begins

                            $count = $row['qty']; //$count is equal to the quantity in the PO
                            $j = 0; //set lng ng mga variable
                            $product_SKU = $row['product_description']; //kukunin product description ng PO
                            $warehouse_ID = $row['warehouse_name']; //kukunin warehouse info ng PO
                            $stock_status = "In Stock"; //Automatic pag ka approve, In Stock na
                            $approved_by = $_SESSION["username"]; //Kung sino nag pindot ng Approve (Check Button)
                            $sold_to = "";
                            $sold_by = "";

                                      if ($row['po_status'] == "Pending"){ //Check lang kung nka pending yung PO, if yes, proceed, if no -> di na pwede i process ang void or approved status
                                                      for ($j = 0; $j < $count; $j++) {//LOOP Start.

                                                          $IDtype = "SC";//Set yung custom ID natin, mag sisimula lahat sa "SC"
                                                          $qry = mysqli_query($link,"SELECT MAX(id) FROM `stock`"); // Get the latest ID dun sa stock table
                                                          $resulta = mysqli_fetch_array($qry);//Execute and fetch data
                                                          $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                                          $custID = str_pad($newID, 8, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                                          $custnewID = $IDtype.$custID; //Prepare $custom new ID

                                                          $query = "INSERT INTO stock
                                                          (custID, product_SKU, PO_ID, warehouse_ID, stock_status, qty, sold_to, sold_by, approved_by)
                                                          VALUES
                                                          ('$custnewID', '$PO', '$product_SKU', '$warehouse_ID', '$stock_status', 1, '$sold_to', '$sold_by', '$approved_by')"; //Prepare insert query

                                                          $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

                                                          if($result){

                                                              $query_update = "UPDATE generate_po SET po_status = 'Approved' WHERE custID = '$PO'";
                                                              $result_update = mysqli_query($link, $query_update) or die(mysqli_error($link));
                                                              if($result_update){
                                                                //Update Query OK
                                                                echo "<script>$.notify('success','success');</script>";
                                                                header( "Location: po-manage.php" );


                                                              }else{
                                                                //Update Query Fail
                                                              }


                                                          }else{
                                                          //Insert Query execution failed
                                                          }
                                                      } //Loop End
                                      }//If End (Check PO Status)
                                      else {
                                        echo "<script>alert('this PO is no longer available for approval.')</script>";
                                        echo "<script>$.notify('asd','warn');</script>";
                                        header( "Location: po-manage.php" );
                                      }

                                  mysqli_close($link);
                            } //End Mysqli Fetch Array

            }
          }





?>
