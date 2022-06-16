<?php 
    ob_start();
    session_start();
    include "inc/db.php";

    if( empty( $_SESSION['id'] ) ){
        header("location: login.php");
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
    <link href="assets/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="assets/lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="assets/css/bracket.css">
  </head>

  <body>

      <!-- ########## START: LEFT PANEL ########## -->
      <?php include"inc/menubar.php";?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include"inc/topbar.php";?>
   
    <!-- ########## END: HEAD PANEL ########## -->