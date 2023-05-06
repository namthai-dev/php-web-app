<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = mysqli_connect("localhost", "root", "", "php-web-app-db");

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);
$bool = true;

$query = mysqli_query($mysqli, "Select * from users WHERE username='$username'"); // Query the 
// users table
$exists = mysqli_num_rows($query); //Checks if username exists
$table_users = "";
$table_password = "";
if ($exists > 0) //IF there are no returning rows or no existing username
{
   while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) // display all rows from query
   {
      $table_users = $row['username']; // the first username row is 
      // passed on to $table_users, 
      // and so on until the query is finished
      $table_password = $row['password']; // the first password row is passed on 
      // to $table_password, and so on 
      // until the query is finished
   }
   if (($username == $table_users) && ($password == $table_password)) // checks if there 
   // are any matching fields
   {
      if ($password == $table_password) {
         $_SESSION['user'] = $username; // set the username in a session. 
         // This serves as a global variable
         header("location: home.php"); // redirects the user to the authenticated 
         // home page
      }
   } else {
      print '<script>alert("Incorrect Password!");</script>'; // Prompts the user
      print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
   }
} else {
   print '<script>alert("Incorrect username!");</script>'; // Prompts the user
   print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
}
?>