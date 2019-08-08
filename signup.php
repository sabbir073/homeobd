<?php include("header.php");?>
<?php 
require('db.php');
$error = "";
if (isset($_POST['register'])){
        $userval = "";
        $emailval = "";
        $username = stripslashes($_REQUEST['username']);
	      $username = mysqli_real_escape_string($con,$username); 
	      $email = stripslashes($_REQUEST['email']);
	      $email = mysqli_real_escape_string($con,$email);
	      $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,$password);
        $passconfirm = stripslashes($_REQUEST['confirmpassword']);
        $passconfirm = mysqli_real_escape_string($con,$passconfirm);

        if(empty($username) || empty($email) || empty($password)){
          $error = "Please fill all field";
        }
        else{
          if($password !== $passconfirm){
            $error = "password did not match! Type again";
            $userval = $_POST['username'];
            $emailval = $_POST['email'];
          }
          else{
            $emailquery = "SELECT * FROM users WHERE email='$email' LIMIT 1 ";
            $return = mysqli_query($con,$emailquery);
            $return = mysqli_fetch_assoc($return);
            if($return){
              $error = "Email already Exist! <a href=''>Forgot password?</a>";
              mysqli_close($con);
            }
            else{
              $query = "INSERT into `users` (username, email, password)
            VALUES ('$username', '$email', '".md5($password)."')";
                    $result = mysqli_query($con,$query);
                    if($result){
                        $error = "Registered successfully! please <a href='login.php'>Login from here</a>";
                    }
                    else{
                        $error = "something is wrong!";
                    }
            }
            

          }
         
        }
        
    
}

?>
<body class="az-body">

    <div class="az-signup-wrapper">
      <div class="az-column-signup-left">
        <div>
          <i class="typcn typcn-chart-bar-outline"></i>
          <h1 class="az-logo">Homeo<span>B</span>D</h1>
          <h5>Homeopathic Software Solution</h5>
          <p>We are excited to launch our new company and product Homeobd. With this software you will be able to Track your patient, analyze Disease and medicine. this Software is also prescription ready!</p>
          <p>Browse our site and see for yourself why you need Homeobd.</p>
          <a href="#" class="btn btn-outline-indigo">Learn More</a>
        </div>
      </div><!-- az-column-signup-left -->
      <div class="az-column-signup">
        <h1 class="az-logo">Homeo<span>B</span>D</h1>
        <div class="az-signup-header">
          <h2>Get Started</h2>
          <h4>It's free to signup and only takes a minute.</h4>

          <h5 style="color:red;"><?php echo $error;?></h5>

          <form method="post" action="signup.php">
            <div class="form-group">
              <label>Your Name</label>
              <input name="username" type="text" value="<?php echo $userval; ?>" class="form-control" placeholder="Enter your firstname and lastname">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Email</label>
              <input name="email" type="email" value="<?php echo $emailval; ?>" class="form-control" placeholder="Enter your email">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
              <input name="password" type="password" class="form-control" placeholder="Enter your password">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Confirm Password</label>
              <input name="confirmpassword" type="password" class="form-control" placeholder="Enter your password again">
            </div><!-- form-group -->
            <button name="register" class="btn btn-az-primary btn-block">Create Account</button>
            <div class="row row-xs">
              <!--<div class="col-sm-6"><button class="btn btn-block"><i class="fab fa-facebook-f"></i> Signup with Facebook</button></div>
              <div class="col-sm-6 mg-t-10 mg-sm-t-0"><button class="btn btn-primary btn-block"><i class="fab fa-twitter"></i> Signup with Twitter</button></div>-->
            </div><!-- row -->
          </form>
        </div><!-- az-signup-header -->
        <div class="az-signup-footer">
          <p>Already have an account? <a href="login.php">Sign In</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-column-signup -->
    </div><!-- az-signup-wrapper -->

    <script src="../old/lib/jquery/jquery.min.js"></script>
    <script src="../old/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../old/lib/ionicons/ionicons.js"></script>

    <script src="../old/js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>