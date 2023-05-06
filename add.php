<?php
    session_start();
    if($_SESSION['user']){
    }
    else{ 
       header("location:index.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = mysqli_connect("localhost", "root", "", "php-web-app-db");    


        $details = mysqli_real_escape_string($mysqli, $_POST['details']);
        $time = date("H:i:s"); //time
        $date = date("F j, Y"); //date
        $decision = "no";

       foreach($_POST['public'] as $each_check)                          //gets the data from
                                                                         //the checkbox
       {
          if($each_check != null){ //checks if checkbox is checked
             $decision = "yes"; // sets the value
          }
       }

       mysqli_query($mysqli, "INSERT INTO list(details, date_posted, time_posted, public)
                    VALUES ('$details','$date','$time','$decision')"); //SQL query
       header("location:home.php");
    }
    else
    {
       header("location:home.php"); //redirects back to home
    }
?>