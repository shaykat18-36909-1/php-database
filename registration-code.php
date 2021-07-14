<?php
require_once('connection.php');
$fname = $lname = $gender = $email = $password = $pwd = '';

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$gender = $_POST['gender'];
$dob= $_POST['dob'];
$religion = $_POST['religion'];
$permanent address = $_POST['permanent-address'];
$present address = $_POST['present address'];
$phn = $_POST['phn-number'];
$personal website = $_POST['website-link'];
$email = $_POST['email'];
$username = $_POST['username'];
$pwd = $_POST['password'];
$password = ($pwd);

$sql = "INSERT INTO user (Firstname,Lastname,Gender,dob,religion,permanent address,present address,phn,personal website,username,Email,Password) VALUES ('$fname','$lname','$gender','$dob','$religion','$permanent address','$present address','$username','$email','$password')";
$result = mysqli_query($conn, $sql);
if($result)
{
	header("Location: login.php");
}
else
{
	echo "Error :".$sql;
}
?>