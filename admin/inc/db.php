<?php
    $dbName = "bricks_cms";
    $dbUser = "root";
    $dbPass = "";
    $host   = "localhost";

    $db = mysqli_connect( $host, $dbUser, $dbPass, $dbName );

    if($db)
    {
        //echo "Db cunnect successfully";
    }
    else{
        die('MySql Database Error. ' . mysqli_error($db) );
    }
?>