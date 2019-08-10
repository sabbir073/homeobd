<?php include("header.php");?>
<?php
session_start();
$token = $_GET['token'];
if($token == ""){
    header("Location: login.php");
    exit;
}
else{
    if(isset($_SESSION["username"])){
        header("Location: dashboard/index.php");
    }
}
?>
<?php
$error = "";
$sucess = "";
if (isset($_POST['resetpass'])) {
    require('db.php');

    

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);

    $conpassword = stripslashes($_REQUEST['conpassword']);
    $conpassword = mysqli_real_escape_string($con,$conpassword);

    if(empty($password) || empty($conpassword)){
        $error = "Please enter new password!";
    }
    else{
        if($password !== $conpassword){
            $error = "Password did not match! Try again.";
        }
        else{
            $query = "SELECT * FROM users WHERE token = '$token' LIMIT 1";
            $result = mysqli_query($con,$query);
            $result = mysqli_num_rows($result);
            if($result){
                $query2 = "UPDATE users SET password = '".md5($password)."', token = '' LIMIT 1";
                $result2 = mysqli_query($con,$query2);
                
                if($result2){
                    $sucess = "Password Reset Successfully! <a href='login.php'>Please Login</a>";
                }
                else{
                    $error = "Something went wrong!";
                }
            }
            else{
                $error = "Token is invalid!";
            }
        }
    }
}

?>
  <body class="az-body">
    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <h1 class="az-logo">Homeo<span>B</span>D</h1>
        <div class="az-signin-header" style="position: relative; top: -90px;">
          <h2>Create New password!</h2>
          
          <h4 style="color:red;"><?php echo $error;?></h4>
          <h4 style="color:green;"><?php echo $sucess;?></h4>
          <form method="post" action="">
            <div class="form-group">
              <label>New password</label>
              <input name="password" type="password" class="form-control" placeholder="Enter news password">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Confirm password</label>
              <input name="conpassword" type="password" class="form-control" placeholder="Confirm new password">
            </div><!-- form-group -->
            <button type="submit" name="resetpass" class="btn btn-az-primary btn-block">Create</button>
          </form>
        </div><!-- az-signin-header -->
        
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="./old/lib/jquery/jquery.min.js"></script>
    <script src="./old/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./old/lib/ionicons/ionicons.js"></script>

    <script src="./old/js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>
