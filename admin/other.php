<?php
session_start();
if( empty( $_SESSION['email'] ) ){
    header("location: login.php");
}
$_SESSION['resend'] = "";
include "inc/db.php";
?>

<?php
    if( isset($_POST['reSendmail']) ){
        
        $email = $_SESSION['email'];
        $token = bin2hex(random_bytes(15));
        $sql = " UPDATE users SET token ='$token' WHERE email = '$email' ";
        $updateData = mysqli_query($db, $sql);
        if($updateData){
            //header("location:login.php");
            
              
              $subject = "Email Activation";
              $body = "Hi,Click here to activate your Account 
              http://localhost/ssb-419/Project/admin/emailActivate.php?token=$token";
              $sender_email = "From: sarrick2022@gmail.com";

              if (mail($email, $subject, $body, $sender_email)) {
                  //$_SESSION['msg'] = "Check you mail to activate your account $email";
                  $_SESSION['resend'] = "Send Email Link Again...";
              } else {
                  echo "Email sending failed...";
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
    <link rel="stylesheet" href="assets/css/custom.css">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> bracket <span class="tx-info">plus</span> <span class="tx-normal">]</span></div>
        <div class="tx-center mg-b-60">The Admin Template For Perfectionist</div>

        <div >
            <?php 
            if($_SESSION['resend'] != ''){?>
                <div class="alert alert-success" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Well Done!</strong> <?php echo $_SESSION['resend'];?></span>
                  </div><!-- d-flex -->
                </div><!-- alert -->
                 <?php 
                }
            ?>
        </div>
        <div class="text-justify resend">
            <span>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</span>
        </div>
        <div class="">
            <form action="" method="POST">
                <!-- form-group -->
                <input type="submit" name="reSendmail" value="Re-Send Email Link" class="btn btn-dark btn-block"></input>
            </form>
        </div>
        
       
        <div class="mg-t-60 tx-center"> <a href="login.php" class="tx-dark">Back in Sign In</a></div>
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



