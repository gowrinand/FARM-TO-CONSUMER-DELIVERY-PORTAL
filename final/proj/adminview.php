<?php
	$conn=require "connection.php";
	echo "<title>ADMIN PORTAL</title>";
	if($_SESSION['role']!=1)
		die("Unauthorized access!");
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if($_POST["itemname"]=="addnew")
		{
			if(isset($_POST["cname"])&&isset($_POST["cstock"])&&isset($_POST["cprice"]))
			{
				$query="insert into items(name,stock,price) values ('".$_POST["name"]."',".$_POST["stock"].",".$_POST["price"].");";
				$res=mysqli_query($conn,$query);
				if(!$res)
					echo "Error: ".mysqli_error($conn)."<br>";
			}
			else echo "Insufficient values!<br>";
		}
		else
		{
			$query="update items set";
			if(isset($_POST["cname"]))
			{	
				if($_POST["cname"]==1)
				{
					$qname=$query." name='".$_POST["name"]."' where item_id=".$_POST["itemname"].";";
					$res1=mysqli_query($conn,$qname);
					if(!$res1)
						echo "Error: ".mysqli_error($conn)."<br>";
				}
			}
			if(isset($_POST["cstock"]))
			{
				if($_POST["cstock"]==1)
				{
					$qstock=$query." stock='".$_POST["stock"]."' where item_id=".$_POST["itemname"].";";
					$res2=mysqli_query($conn,$qstock);
					if(!$res2)
						echo "Error: ".mysqli_error($conn)."<br>";
				}
			}
			if(isset($_POST["cprice"]))
			{
				if($_POST["cprice"]==1)
				{
					$qprice=$query." price='".$_POST["price"]."' where item_id=".$_POST["itemname"].";";
					$res3=mysqli_query($conn,$qprice);
					if(!$res3)
						echo "Error: ".mysqli_error($conn)."<br>";
				}
			}
		}	
	}
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
	echo "<br><br>Add/modify items:<br>";
	echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"POST\">";
	echo "Select item: <select name=\"itemname\" id=\"itemname\"><option value=\"addnew\">Add new item...</option>";
	mysqli_data_seek($res,0);
	while($row=mysqli_fetch_assoc($res))
	{
		echo "<option value='".$row["item_id"]."'>".$row["item_id"]."</option>";
	}
	echo "</select><br>";
	echo "<input type=\"checkbox\" name=\"cname\" value=1> Name: <input name=\"name\" id=\"name\" type=text><br>";
	echo "<input type=\"checkbox\" name=\"cstock\" value=1>Stock: <input name=\"stock\" id=\"stock\" type=number><br>";
	echo "<input type=\"checkbox\" name=\"cprice\" value=1>Price: <input name=\"price\" id=\"price\" type=text><br>";
	echo "<button type=submit> Proceed </button>";
	echo"</form>";
	echo"<a href=\"login.php\"> <b>Go to login page</b><br></a>";
	echo"<a href=\"report.php\"> <b>View payment statistics</b><br></a>";
?>