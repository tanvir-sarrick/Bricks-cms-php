<?php
    if( isset($_POST['reSendmail']) ){
        //echo "resend";
        $_GET['id']=$id;
        echo $id;
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