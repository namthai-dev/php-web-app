<html>
    <head>
        <title>PHP web app</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back</a>
        <br/>
        <br/>
        <form action="register.php" method="POST">
           Enter Username: <input type="text" name="username" required="required" /> 
           <br/>
           Enter password: <input type="password" name="password" required="required" /> 
           <br/>
           <input type="submit" value="Register"/>
        </form>
    </body>
</html>

<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = mysqli_connect("localhost", "root", "", "php-web-app-db");

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($mysqli, $_POST['username']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);
        $bool = true;

        $query = mysqli_query($mysqli, "SELECT * FROM users"); //Query the users table
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $table_users = $row['username']; // the first username row 
                                          // is passed on to $table_users, 
                                          // and so on until the query is finished
            if($username == $table_users) {     // checks if there are any matching fields
                $bool = false; // sets bool to false
                Print '<script>alert("Username has been taken!");</script>';        //Prompts the user
                Print '<script>window.location.assign("register.php");</script>';   //redirects to 
                                                                                    //register.php
            }
        }
        if($bool) { // checks if bool is true
            mysqli_query($mysqli, "INSERT INTO users (username, password) VALUES ('$username', '$password')"); // inserts value into table users
            Print '<script>alert("Successfully Registered!");</script>';      // Prompts the user
            Print '<script>window.location.assign("register.php");</script>'; // redirects to 
                                                                              // register.php
        }        
    }
?>