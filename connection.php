<?php
 
 
$db_server="localhost";  
$db_uname="root";  
$db_password="";  
$db_name="wtk";  
error_reporting(0);    

$conn=mysqli_connect($db_server,$db_uname,$db_password,$db_name);  

 

if($conn)
{
	echo " Database Connected Successfully";
	
	
	$query="insert into users values(null,'LIMONDIPU','Hasan','male','01/02/1998','islam','dhaka','comilla','0178147547','dipu@gmail.com','dipu.aiub.edu','dipu','12345')";  
	
	

	
	if(mysqli_query($conn,$query))   
	{
		echo "row inserted successfully"."<br>";
	}
	else
		
		{
			echo "Not inserted row";
		}	 
 
} 
   
else
{
	echo mysqli_connect_error();
	  
}
?>