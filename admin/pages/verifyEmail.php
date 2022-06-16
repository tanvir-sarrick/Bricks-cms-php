<?php 
    ob_start();
    session_start();
    include "../inc/db.php";

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
    <link href="../assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="../stylesheet" href="assets/css/bracket.css">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> bracket <span class="tx-info">plus</span> <span class="tx-normal">]</span></div>
        <div class="tx-center mg-b-60">The Admin Template For Perfectionist</div>

        <div >
            <?php 
              if(isset($_SESSION['msg']))
                { 
                  //echo $_SESSION['msg'];
                  echo ' <div class="alert bg-success text-white">'.$_SESSION['msg'].'</div>';
                } 
            ?>
        </div>
        <!-- <div class="mg-t-60 tx-center">
            Not yet Email? <button>Re-Send Email</button>
        </div> -->
        <?php 
         
          $verify_user = "SELECT *  FROM users WHERE status = 1";
          
          $verify_sql = mysqli_query($db, $verify_user);
          
          if($verify_sql){
            header("location:../dashboard.php");
          }
          $verify = "SELECT *  FROM users WHERE status = 0";
          $verisql = mysqli_query($db, $verify);
          if($verisql){
            header("location:../other.php");
          }
        ?>
        
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="../assets/lib/jquery/jquery.min.js"></script>
    <script src="../assets/lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="../assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php 
      ob_end_flush();
    ?>
  </body>
</html>
