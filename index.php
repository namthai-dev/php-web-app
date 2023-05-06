<html>

<head>
    <title>PHP web app</title>
</head>

<body>
    <?php
    echo "<p>Hello World!</p>";
    ?>
    <a href="login.php"> Click here to login
        <a href="register.php"> Click here to register
</body>
<br />
<h2 align="center">List</h2>
<table width="100%" border="1px">
    <tr>
        <th>Id</th>
        <th>Details</th>
        <th>Post Time</th>
        <th>Edit Time</th>
    </tr>
    <?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = mysqli_connect("localhost", "root", "", "php-web-app-db");
    $query = mysqli_query($mysqli, "Select * from list Where public='yes'"); // SQL Query
    while ($row = mysqli_fetch_array($query)) {
        print "<tr>";
        print '<td align="center">' . $row['id'] . "</td>";
        print '<td align="center">' . $row['details'] . "</td>";
        print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
        print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
        print "</tr>";
    }
    ?>
</table>

</html>