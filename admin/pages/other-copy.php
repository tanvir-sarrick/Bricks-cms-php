<?php
session_start();
if( empty( $_SESSION['email'] ) ){
    header("location: login.php");
}

include "inc/db.php";?>
<div class="mg-t-60 tx-center">
            <!-- Not yet Email? <button>Re-Send Email</button> -->
            <form action="" method="POST">
                <div class="form-group">
                    <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? 
                    If you didnt receive the email, we will gladly send you another.</p> 
                    
                    <input type="submit" name="reSendmail" value="Re-Send Email" class="btn btn-info btn-block"></input>
                </div>
            </form>
</div>

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
                  echo "Email sending success...";
              } else {
                  echo "Email sending failed...";
              }
            
        }
     }
?>

