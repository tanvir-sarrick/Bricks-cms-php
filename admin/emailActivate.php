<?php 
    ob_start();
    session_start();
    include "inc/db.php";

    if(isset( $_GET['token'] )){
        $token = $_GET['token'];
        $sql = "UPDATE users SET status='1' WHERE token = '$token' ";
        $query= mysqli_query($db, $sql);

        if($query){
            if(isset($_SESSION['msg']))
                { 
                  $_SESSION['success'] = "Account Updated Successfully";
                  header("location:login.php");
                } 
            else{
                header("location:login.php");
            }
        }
    }
?>