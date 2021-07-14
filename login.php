<?php

require_once('connection.php');
$username = $password = $pwd = '';

$email = $_POST['username'];
$pwd = $_POST['password'];
$password = ($pwd);
$sql = "SELECT * FROM user WHERE username='$username' AND Password='$password'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$id = $row["ID"];
		$email = $row["username"];
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['email'] = $username;
	}
	header("Location: welcome.php");
}
else
{
	echo "Invalid username or password";
}
?>