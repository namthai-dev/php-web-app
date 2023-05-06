<?php
    session_start(); //starts the session
    if($_SESSION['user']){           //checks if user is logged in
    }
    else {
       header("location:index.php"); //redirects if user is not logged in.
    }

    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        $mysqli = mysqli_connect("localhost", "root", "", "php-web-app-db");         
        $details = mysqli_real_escape_string($mysqli, $_POST['details']);        
        $id = $_GET['id'];
        mysqli_query($mysqli, "DELETE FROM list WHERE id='$id'");
        header("location:home.php");
    }
?>