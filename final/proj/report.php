<?php
	$conn=require "connection.php";
	echo "<title>REPORT</title>";
	if($_SESSION['role']!=1)
		die("Unauthorized access!");
	$query="select * from paymentdetails;";
	$res=mysqli_query($conn,$query);
	if(mysqli_num_rows($res)>0)
	{
		echo "<table border=1>";
		while($row=mysqli_fetch_assoc($res))
		{
			echo "<tr>";
			echo "<td>".$row["trans_id"]."</td><td>".$row["cust_id"]."</td><td>".$row["amount"]."</td><td>".$row["payment_time"]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else
		echo "No items found!";
	echo"<a href=\"login.php\"> <b>Go to login page</b><br></a>";
?>