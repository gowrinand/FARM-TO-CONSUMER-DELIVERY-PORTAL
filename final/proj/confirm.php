<?php
	$conn=require "connection.php";
	echo "<title> PROCESSING </title>";
	if($_SESSION['role']!=0)
		die("Unauthorized access!");
	$query="insert into paymentdetails(cust_id,amount) values (".$_SESSION["id"].",".$_SESSION["total"].");";
	$res=mysqli_query($conn,$query);
	if(!$res)
		echo "Error: ".mysqli_error($conn)."<br>";
	$query2="select item_id from items";
	$res2=mysqli_query($conn,$query2);
	if(mysqli_num_rows($res2)>0)
	{
		while($row=mysqli_fetch_assoc($res2))
		{
			$query3="update items set stock=".$_SESSION["new_values"][$row["item_id"]]." where item_id=".$row["item_id"].";";
			$res3=mysqli_query($conn,$query3);
			if(!$res3)
				echo "Error: ".mysqli_error($conn)."<br>";
		}
		header("Location: userview.php");
	}
	else echo "Error: ".mysqli_error($conn);
?>