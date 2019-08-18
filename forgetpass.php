<?php include("header.php");?>

<?php
session_start();
if(isset($_SESSION["username"])){
    header("Location: dashboard/index.php");
    }
$error = "";
$sucess = "";
if (isset($_POST['forgetpass'])) {
    require('db.php');

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con,$email);
    if(empty($email)){
        $error = "Please type a email first!";
      }
      else{
        $emailquery = "SELECT * FROM users WHERE email='$email' LIMIT 1 ";
        $return = mysqli_query($con,$emailquery);
        $return = mysqli_num_rows($return);
        echo $return;
        if($return == 1){
            $token = strval(bin2hex(openssl_random_pseudo_bytes(30)));
            $sqlquery = "UPDATE users SET token = '$token' WHERE email='$email' LIMIT 1";
            $results = mysqli_query($con, $sqlquery);
            if ($results){
              $to = $email;
              $subject = "Homeobd pasword reset request!";
              $msg = "Hi there, click on this <a href=\"resetpass.php?token=" . $token . "\">link</a> to reset your password";
              $msg = wordwrap($msg,70);
              $headers = "From: info@homeobd.com";
              mail($to, $subject, $msg, $headers);
              $sucess = "Emailed! Please check your email to reset password!";
            }
            else{
              echo "ERROR: Could not able to execute $sqlquery. " . mysqli_error($con);
            }
          
        }
        else{
            $error = "Email does not exist!";
        }
      }
}

?>

<body class="az-body">
    <div class="az-signin-wrapper">
        <div class="az-card-signin">
            <h1 class="az-logo">Homeo<span>B</span>D</h1>
            <div class="az-signin-header">
                <h2>Forget your password?</h2>
                <h4><?php echo $sucess;?></h4>
                <h4 style="color:red;"><?php echo $error;?></h4>
                <form method="post" action="">
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter your email">
                    </div><!-- form-group -->
                    <button type="submit" name="forgetpass" class="btn btn-az-primary btn-block">Send</button>
                </form>
            </div><!-- az-signin-header -->
            <div class="az-signin-footer">
                <p><a href="login.php">Have account? login</a></p>
                <p>Don't have an account? <a href="signup.php">Create an Account</a></p>
            </div><!-- az-signin-footer -->
        </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="./old/lib/jquery/jquery.min.js"></script>
    <script src="./old/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./old/lib/ionicons/ionicons.js"></script>

    <script src="./old/js/azia.js"></script>
    <script>
    $(function() {
        'use strict'

    });
    </script>
</body>

</html>