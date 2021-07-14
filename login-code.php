<?php

require_once('connection.php');
$email = $password = $pwd = '';

$username = $_POST['username'];
$pwd = $_POST['password'];
$password = ($pwd);
$sql = "SELECT * FROM user WHERE username='$username' AND Password='$password'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$password = $row["password"];
		$usernmae = $row["username"];
		session_start();
		$_SESSION['password'] = $password;
		$_SESSION['usernamel'] = $username;
	}
	header("Location: welcome.php");
}
else
{
	echo "Invalid username or password";
}
?>