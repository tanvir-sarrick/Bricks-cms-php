<?php 
    ob_start();
    session_start();
    include "inc/db.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Bracket Plus Responsive Bootstrap 4 Admin Template</title>

    <!-- vendor css -->
    <link href="assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="assets/css/bracket.css">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> bracket <span class="tx-info">plus</span> <span class="tx-normal">]</span></div>
        <div class="tx-center mg-b-60">The Admin Template For Perfectionist</div>

        <form action="" method="POST">
            <div class="form-group">
              <input type="email" name="email" class="form-control" required="required" placeholder="Enter your Email">
            </div><!-- form-group -->
            <div class="form-group">
              <input type="password" name="password" class="form-control" required="required" placeholder="Enter your password">
              <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
            </div><!-- form-group -->
            <input type="submit" name="loginbtn" value="Sign In" class="btn btn-info btn-block"></input>
        </form>
        <?php 
          if( isset($_POST['loginbtn']) ){
              $email    = mysqli_real_escape_string($db, $_POST['email']);
              $password = mysqli_real_escape_string($db, $_POST['password']);

              $hassedPass = sha1($password);
              $select_user = "SELECT *  FROM users WHERE email = '$email' AND status = 1";

              $sql = mysqli_query($db, $select_user);
              while( $row = mysqli_fetch_array($sql) )  {
                $reqEmail         = $row['email'];
                $pass             = $row['password'];

                if( $email == $reqEmail && $hassedPass == $pass){
                  $_SESSION['id']        = $row['id'];
                  $_SESSION['name']      = $row['name'];
                  $_SESSION['email']     = $reqEmail;
                  $_SESSION['j_date']    = $row['j_date'];

                  header("location:dashboard.php");
                }
                elseif( $email != $reqEmail || $hassedPass != $pass){
                  header("location:login.php");
                }
                else {
                  header("location:login.php");
                }
              }
          }
        
        
        ?>
        <div class="mg-t-60 tx-center">Not yet a member? <a href="register.php" class="tx-info">Sign Up</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="assets/lib/jquery/jquery.min.js"></script>
    <script src="assets/lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php 
      ob_end_flush();
    ?>
  </body>
</html>
