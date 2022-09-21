<?php
	session_start();
	$serverurl="localhost";
	$username="root";
	$password="";
	$DBname="project";
	$status=mysqli_connect($serverurl,$username,$password,$DBname);
	if(!$status)
		echo "Failed to connect: ".mysqli_connect_error()."<br>";
	else
		return $status;
?>