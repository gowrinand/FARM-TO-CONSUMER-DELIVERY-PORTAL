<?php
	$conn=require "connection.php";
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$query="select login_id,username,role from login where username='".$_POST["username"]."' AND password='".$_POST["password"]."';";
		$res=mysqli_query($conn,$query);
		if(!mysqli_num_rows($res))
			echo "Incorrect credentials! Try again<br><br>";
		else
		{
			$creds=mysqli_fetch_assoc($res);
			$_SESSION["id"]=$creds["login_id"];
			$_SESSION["user"]=$creds["username"];
			$_SESSION["role"]=$creds["role"];
			header("Location: redirect.php");
		}
	}
?>
<html>
	<head>
		<title> Login</title>
	</head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			Enter username: <input name="username" id="username" type=text><br>
			Enter password: <input name="password" id="password" type=password><br>
			<button type=submit> Login </button>
		</form>
		<form action="createnew.php" method="GET">
			<button type=submit> Create new account </button>
		</form>
	</body>
</html>
	