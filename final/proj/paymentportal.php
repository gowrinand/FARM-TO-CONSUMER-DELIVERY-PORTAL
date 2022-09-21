<?php
	$conn=require "connection.php";
	echo "<title>PAYMENT PORTAL</title>";
	if($_SESSION['role']!=0)
		die("Unauthorized access!");
	$_SESSION["new_values"]=array();
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$query="select * from items";
		$res=mysqli_query($conn,$query);
		if(mysqli_num_rows($res)>0)
		{
			echo "<table border=1>";
			$_SESSION["total"]=0;
			while($row=mysqli_fetch_assoc($res))
			{
				if($_POST[$row['item_id']]>$row["stock"])
					$qty=$row["stock"];
				else $qty=$_POST[$row['item_id']];
				echo "<tr>";
				echo "<td>".$row["item_id"]."</td><td>".$row["name"]."</td><td>".$qty."</td><td>".($qty*$row["price"])."</td>";
				echo "</tr>";
				$_SESSION["total"]+=($qty*$row["price"]);
				$newval=($row["stock"]-$qty);
				$_SESSION["new_values"][$row['item_id']]=$newval;
			}
			echo "<tr><td colspan=3 style='text-align:center'>Total</td><td>".$_SESSION["total"]."</td></tr>";
			echo "</table>";
			$q2="select address,distance from userdetails where username='".$_SESSION["user"]."';";
			$res=mysqli_query($conn,$q2);
			$row=mysqli_fetch_assoc($res);
			$dist=$row["distance"];
			if($dist<45)
				$_SESSION["total"]*=1.2;
			elseif($dist<65)
				$_SESSION["total"]*=1.35;
			else $_SESSION["total"]*=1.5;
			echo "<h3>Total payable amount: ".$_SESSION["total"]."<br></h3>";
			echo "<h4><br>Billing address: <br>".$row["address"]."<br></h4>";
			echo "<form action=\"confirm.php\" method=\"POST\">";
			echo "<button type=submit> Complete Payment </button>";
			echo"</form>";
		}
		else
			echo "No items found!";
	}
	echo"<a href=\"login.php\"> <b>Go to login page</b><br></a>";
?>