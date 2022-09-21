<?php
	$conn=require "connection.php";
	if($_SERVER["REQUEST_METHOD"]=="GET")
		$_POST=array();
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if($_POST["password1"]!=$_POST["password2"])
			echo "Passwords did not match! Try again<br><br>";
		else
		{
			$usr=$_POST["username"];
			$pass=$_POST["password1"];
			$mob=$_POST["mobile_no"];
			$email=$_POST["email"];
			$address=$_POST["address"];
			$distance=rand(30,95);
			$query1="insert into login (username,password) values ('".$usr."','".$pass."');";
			$res1=mysqli_query($conn,$query1);
			if(!$res1)
				echo "Error: ".mysqli_error($conn)."<br>";
			$query2="insert into userdetails values ('".$usr."','".$mob."','".$email."','".$address."',".$distance.");";
			$res2=mysqli_query($conn,$query2);
			if(!$res2)
				echo "Error: ".mysqli_error($conn)."<br>";
			if($res1 && $res2)
				echo "Account created successfully!<br><br>";
			else echo "Error encountered!<br><br>";
		}
	}
?>
<html>
	<head>
		<title> Sign up</title>
	</head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			Username: <input name="username" id="username" type=text><br>
			Password: <input name="password1" id="password1" type=password><br>
			Confirm password: <input name="password2" id="password2" type=password><br>
			Mobile number: <input name="mobile_no" id="mobile_no" type=text><br>
			Email: <input name="email" id="email" type=text><br>
			Address: <input name="address" id="address" type=text><br>
			<button type=submit> Sign up </button>
		</form>
		<a href="login.php"> <b>Go to login page</b><br></a>
	</body>
</html>