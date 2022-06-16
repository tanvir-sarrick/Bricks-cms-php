<?php 
    if( empty( $_SESSION['id'] ) ){
        header("location: login.php");
    }
?>