<html>

<head>
	<title>PHP web app</title>
</head>
<?php
session_start(); //starts the session
if ($_SESSION['user']) { //checks if user is logged in
} else {
	header("location:index.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
$id_exists = false;
?>

<body>
	<h2>Home Page</h2>
	<p>Hello
		<?php print "$user" ?>!
	</p> <!--Displays user's name-->
	<a href="logout.php">Click here to logout</a><br /><br />
	<a href="home.php">Return to Home page</a>
	<h2 align="center">Currently Selected</h2>
	<table border="1px" width="100%">
		<tr>
			<th>Id</th>
			<th>Details</th>
			<th>Post Time</th>
			<th>Edit Time</th>
			<th>Public Post</th>
		</tr>
		<?php
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			$_SESSION['id'] = $id;
			$id_exists = true;
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$mysqli = mysqli_connect("localhost", "root", "", "php-web-app-db");
			$query = mysqli_query($mysqli, "Select * from list Where id='$id'"); // SQL Query
			$count = mysqli_num_rows($query);
			if ($count > 0) {
				while ($row = mysqli_fetch_array($query)) {
					print "<tr>";
					print '<td align="center">' . $row['id'] . "</td>";
					print '<td align="center">' . $row['details'] . "</td>";
					print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
					print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
					print '<td align="center">' . $row['public'] . "</td>";
					print "</tr>";
				}
			} else {
				$id_exists = false;
			}
		}
		?>
	</table>
	<br />
	<?php
	if ($id_exists) {
		print '
		<form action="edit.php" method="POST">
			Enter new detail: <input type="text" name="details"/><br/>
			public post? <input type="checkbox" name="public[]" value="yes"/><br/>
			<input type="submit" value="Update List"/>
		</form>
		';
	} else {
		print '<h2 align="center">There is no data to be edited.</h2>';
	}
	?>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$mysqli = mysqli_connect("localhost", "root", "", "php-web-app-db");
	$details = mysqli_real_escape_string($mysqli, $_POST['details']);
	$public = "no";
	$id = $_SESSION['id'];
	$time = date("H:i:s"); //time
	$date = date("F j, Y"); //date

	foreach ($_POST['public'] as $list) {
		if ($list != null) {
			$public = "yes";
		}
	}
	mysqli_query($mysqli, "UPDATE list SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'");

	header("location: home.php");
}
?>