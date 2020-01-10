<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DC Starr Gazes - Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
body {

  /* Full height */
  height: auto;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;



}

</style>

</head>

<body >
  <div class="container-fluid">
    <div class="form-group row">
      <form id='add-user' method="POST">
        <div class="col-lg-3 col-lg-offset-4">
          <label>First Name</label>
          <input class="form-control center" id="fname" name="first_name" type="text">
        </div>
        <br><br><br><br>
        <div class="col-lg-3 col-lg-offset-4">
          <label>Last Name</label>
          <input class="form-control" id="lname" name="last_name" type="text">
        </div>

        <input type="hidden" id='user_id' name='user_id'>

        <button type="button" id='action' name='action' class="btn btn-info col-lg-offset-5" align='center'></button>
  </form>
     </div>
    <br>
    <hr>
    <br>
    <div id="result">

    </div>

</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script>

$(document).ready(function(){
// // fetch user WORKING
    fetchUser();
    function fetchUser(){
      var action = 'select';
      $.ajax({
        url: "select.php",
        method: "POST",
        data:{action:action},
        success:function(data){
          $('#fname').val('');
          $('#lname').val('');
          $('#action').text("Add User");
          $('#result').html(data);
        }
      })
    }

//insert user WORKING
  $('#action').click(function(){
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var action = $('#action').text();
    if(fname != '' || lname != ''){
      $.ajax({
        url: 'insert.php',
        method: 'POST',
        data:{firstName:fname,lastName:lname,action:action},
        success:function(data){
          alert(data);
          fetchUser();
        }
      });
    }
  });

// function userTable(){
//   var table = $('tbody')
//   $.ajax({
//     url: "fetch.php",
//     method: "POST",
//     dataType: "text",
//     data: {table:table},
//     success:function(res){
//       $('tbody').html(res);
//       userTable();
//     }
//   })
// }

  // $('#action').click(function(){
  //    if($('#lname').val() == '' || $('#fname').val() == ''){
  //      alert('all fields required');
  //    } else{
  //      var fname = $('#fname').val();
  //      var lname = $('#lname').val();
  //      $.ajax({
  //        url: 'insert.php',
  //        method: 'POST',
  //        data: {fname:fname,lname:lname},
  //        success:function(response){
  //          alert(response);
  //          $('tbody').html(response);
  //          $('#action').text("Add");
  //          $('#fname').val();
  //          $('#lname').val();
  //        }
  //     });
  //     }
  // });
});

</script>

</body>
</html>
