<?php include("header.php");?>

<?php
session_start();
if(isset($_SESSION["username"])){
  header("Location: dashboard/index.php");
  }
$error = "";
if (isset($_POST['login_user'])) {
  require('db.php');
  if (isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);
	  $username = mysqli_real_escape_string($con,$username);
	  $password = stripslashes($_REQUEST['password']);
	  $password = mysqli_real_escape_string($con,$password);
    $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
    $result = mysqli_query($con,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
      if($rows==1){
    $_SESSION['username'] = $username;
    header("Location: dashboard/index.php");
      }
     else{
       $error = 'Please check your Username and password again';
     }
  }
}

?>
  <body class="az-body">
    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <h1 class="az-logo">Homeo<span>B</span>D</h1>
        <div class="az-signin-header">
          <h2>Welcome back!</h2>
          <h4>Please sign in to continue</h4>
          <h4 style="color:red;"><?php echo $error;?></h4>
          <form method="post" action="">
            <div class="form-group">
              <label>Email</label>
              <input name="username" type="text" class="form-control" placeholder="Enter your email">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
              <input name="password" type="password" class="form-control" placeholder="Enter your password">
            </div><!-- form-group -->
            <button type="submit" name="login_user" class="btn btn-az-primary btn-block">Sign In</button>
          </form>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
          <p><a href="">Forgot password?</a></p>
          <p>Don't have an account? <a href="signup.php">Create an Account</a></p>
        </div><!-- az-signin-footer -->
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
