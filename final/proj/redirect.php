<?php
	$conn=require "connection.php";
	$query="select name from roles where role_id=".$_SESSION["role"].";";
	$res=mysqli_query($conn,$query);
	if(!mysqli_num_rows($res))
			die("Invalid role!");
	else
	{
		$value=mysqli_fetch_assoc($res);
		if($value["name"]=="user")
			header("Location: userview.php");
		elseif ($value["name"]=="admin")
			header("Location: adminview.php");
	}
?>