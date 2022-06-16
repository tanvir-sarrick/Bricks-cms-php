<!-- <style>
      span {
        color:red;
      }
  </style> -->
    <?php 
    ob_start();
    
    include "inc/db.php";

?>
<?php 
          $fullName="";
          $email      = "";
          $err_fullName="";
          $err_email = "";
          $password ="";
          $err_password="";
          $repassword="";
          $err_repassword="";
        
          $hasError = false;
          if( isset($_POST['registerbtn']) ){

              
              
              if(empty($_POST["fullname"])){
                $err_fullName=" *Fullname is required";
                $hasError = true;
              }
              elseif(strlen($_POST["fullname"]) < 4){
                $err_fullName="*Fullname must be 4 characters";
                $hasError = true;
              }
              else{
                $fullName=$_POST["fullname"];
              }
              if(empty($_POST["email"])){
                $err_email=" *Email is required";
                $hasError = true;
              }
              
              else{
                $email=$_POST["email"];
              }

              if(empty($_POST["password"])){
                $err_password="*Password is required";
                $hasError = true;
              }
              elseif(strlen($_POST["password"]) < 6){
                $err_password="*Password must be 6 characters";
                $hasError = true;
              }
              else{
                $password=$_POST["password"];
              }
              if(empty($_POST["repassword"])){
                $err_repassword="*Re-type Password is required";
                $hasError = true;
              }

              if(!$hasError){
                $email= $_POST["email"];
                $password= $_POST["password"];
                $repassword= $_POST["repassword"];
                $fullName= $_POST["fullname"];
                


                if( $password == $repassword ){
                  $hassedPass = sha1($password);
                  $sql = "SELECT * FROM users WHERE email = '$email' ";
                  $read_data = mysqli_query($db, $sql);
                  $userData = mysqli_num_rows($read_data);
                  if($userData == 1){
                    $err_email="*Sorry!!! This Email already Taken.";
                     //echo ' <div class="alert alert-danger">Sorry!!! This Email already Taken. </div>';
                   }
  
                   else{
                    $data_insert = "INSERT INTO users (name, email, password) VALUES ('$fullName', '$email','$hassedPass') ";
                    $sql  = mysqli_query($db, $data_insert);
                    if($sql){
                      header("location:login.php");
                    }
                    else{
                      echo "User not create";
                    }
                  }
                }
  
                else{
                  $err_repassword="*Password do not match";
                  //echo ' <div class="alert alert-warning">Password do not match</div>';
                 
                }
              }
            }
/////////////////////////////////////////////////////////
             
          
        
        
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
    <link href="assets/lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="assets/css/bracket.css">
  </head>

  <body>

    <div class="row no-gutters flex-row-reverse ht-100v">
      <div class="col-md-6 bg-gray-200 d-flex align-items-center justify-content-center">
        <div class="login-wrapper wd-250 wd-xl-350 mg-y-30">
          <h4 class="tx-inverse tx-center">Sign Up</h4>
          <p class="tx-center mg-b-60">Create your own account.</p>

          <form action="" method="POST" data-parsley-validate>
              <div class="form-group">
                <input type="email" name="email" value="<?php echo $email ?>" class="form-control" placeholder="Enter your email">
                <span class="tx-danger"><?php echo $err_email; ?></span>
              </div><!-- form-group -->
              <div class="form-group">
                <input type="password" name="password" value="<?php echo $password ?>" class="form-control" placeholder="Enter your password">
                <span class="tx-danger"><?php echo $err_password; ?></span>
              </div><!-- form-group -->
              <div class="form-group">
                <input type="password" name="repassword" class="form-control" placeholder="Re-type your password">
                <span class="tx-danger"><?php echo $err_repassword; ?></span>
              </div><!-- form-group -->
              <div class="form-group">
                <input type="text" name="fullname" value="<?php echo $fullName ?>" class="form-control" placeholder="Enter your Fullname">
                <span class="tx-danger"><?php echo $err_fullName; ?></span>
              </div><!-- form-group -->
              <!-- form-group -->
              <div class="form-group tx-12">By clicking the Sign Up button below you agreed to our privacy policy and terms of use of our website.</div>
              <input type="submit" name="registerbtn" value="Sign Up" class="btn btn-info btn-block">
          </form>
          
         

          <div class="mg-t-60 tx-center">Already a member? <a href="login.php" class="tx-info">Sign In</a></div>
        </div><!-- login-wrapper -->
      </div><!-- col -->
      <div class="col-md-6 bg-br-primary d-flex align-items-center justify-content-center">
        <div class="wd-250 wd-xl-450 mg-y-30">
          <div class="signin-logo tx-28 tx-bold tx-white"><span class="tx-normal">[</span> bracket <span class="tx-info">plus</span> <span class="tx-normal">]</span></div>
          <div class="tx-white-7 mg-b-60">The Admin Template For Perfectionist</div>

          <h5 class="tx-white">Why bracket plus?</h5>
          <p class="tx-white-6">When it comes to websites or apps, one of the first impression you consider is the design. It needs to be high quality enough otherwise you will lose potential users due to bad design.</p>
          <p class="tx-white-6 mg-b-60">When your website or app is attractive to use, your users will not simply be using it, they’ll look forward to using it. This means that you should fashion the look and feel of your interface for your users.</p>
          <a href="" class="btn btn-outline-light bd bd-white bd-2 tx-white pd-x-25 tx-uppercase tx-12 tx-spacing-2 tx-medium">Purchase Template</a>
        </div><!-- wd-500 -->
      </div>
    </div><!-- row -->

    <script src="assets/lib/jquery/jquery.min.js"></script>
    <script src="assets/lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/select2/js/select2.min.js"></script>
    <script>
      $(function(){
        'use strict';

        $('.select2').select2({
          minimumResultsForSearch: Infinity
        });
      });
    </script>
    <?php 
      ob_end_flush();
    ?>
  </body>
</html>
