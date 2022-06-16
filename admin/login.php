<?php 
    ob_start();
    session_start();
    include "inc/db.php";

?>
<?php
   $_SESSION['danger']="";
   $email= "";
   $err_email = "";
   $password ="";
   $err_password="";
   $hasError = false;
    if( isset($_POST['loginbtn']) ){
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
      if(!$hasError){
        $email= $_POST["email"];
        $password= $_POST["password"];
        $hassedPass = sha1($password);
              $select_user = "SELECT *  FROM users WHERE email = '$email' && password='$hassedPass'";

              $sql = mysqli_query($db, $select_user);
              if (mysqli_num_rows($sql) == 0) {
                $_SESSION['danger'] =  "Username or password incorrect";
              }
              else{
              while( $row = mysqli_fetch_array($sql) )  {
                $reqEmail         = $row['email'];
                $pass             = $row['password'];
                $status           = $row['status'];
                if( $email == $reqEmail && $hassedPass == $pass){
                 
                   $_SESSION['email']     = $reqEmail;
                 

                  if($status ==0){
                  header("location:other.php");
                  }
                  else if($status ==1){
                    
                    $_SESSION['id']     = $row['id'];
                    header("location:dashboard.php");
                    }
                }
                elseif( $email != $reqEmail || $hassedPass != $pass){
                  header("location:login.php");
                }
                else {
                  header("location:login.php");
                }
              }
          }
      }
        

    }
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

        <div >
            <?php 
            if($_SESSION['danger'] != ''){?>
                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Oh snap!</strong> <?php echo $_SESSION['danger'];?></span>
                  </div><!-- d-flex -->
                </div><!-- alert -->
             <?php 
           }
           elseif(isset($_SESSION['msg'])){ 
              if( isset($_SESSION['success']))
              {?>
                  <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                      <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                      <span><strong>Well done!</strong> <?php echo $_SESSION['success'];?></span>
                    </div><!-- d-flex -->
                  </div><!-- alert -->
              <?php 
              }
              
              else{ ?>
                 <div class="alert alert-warning" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                    <span> <?php echo $_SESSION['msg'];?></span>
                  </div><!-- d-flex -->
                </div><!-- alert -->
                <?php }
             

              }
          
         ?>
        </div>
        <form action="" method="POST">
            <div class="form-group">
              <input type="email" name="email" value="<?php echo $email; ?>" class="form-control"  placeholder="Enter your Email">
              <span class="tx-danger"><?php echo $err_email; ?></span>
            </div>
            <!-- form-group -->
            <div class="form-group">
              <input type="password" name="password" class="form-control"  placeholder="Enter your password">
              <span class="tx-danger"><?php echo $err_password; ?></span>
              <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
            </div> 
            <!-- form-group -->
            <input type="submit" name="loginbtn" value="Sign In" class="btn btn-info btn-block"></input>
        </form>
       
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
