<?php
	$conn=require "connection.php";
	echo "<title>USER PORTAL</title>";
	if($_SESSION['role']!=0)
		die("Unauthorized access!");
	$query="select * from items;";
	$res=mysqli_query($conn,$query);
	if(mysqli_num_rows($res)>0)
	{
		echo "<table border=1>";
		while($row=mysqli_fetch_assoc($res))
		{
			echo "<tr>";
			echo "<td>".$row["item_id"]."</td><td>".$row["name"]."</td><td>".$row["stock"]."</td><td>".$row["price"]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else
		echo "No items found!";
	echo "<br><br>Buy items:<br>";
	echo "<form action=\"paymentportal.php\" method=\"POST\">";
	mysqli_data_seek($res,0);
	while($row=mysqli_fetch_assoc($res))
	{
		echo $row["name"].": <input name='".$row["item_id"]."' id='".$row["item_id"]."' type=number value=0><br>";
	}
	echo "<button type=submit> Proceed to checkout </button>";
	echo"</form>";
	echo"<a href=\"login.php\"> <b>Go to login page</b><br></a>";
?>