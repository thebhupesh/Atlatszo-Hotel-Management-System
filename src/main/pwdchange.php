<?php
	$servername="localhost";
	$username="root";
	$password="";
	$mydb="hms";
	$conn=new mysqli($servername, $username, $password, $mydb);
	$user=$_POST["user"];
	$oldpwd=$_POST["old"];
	$newpwd=$_POST["new"];
	$sql="SELECT * FROM users WHERE username='$user';";
	$result=mysqli_query($conn, $sql);
	if($result->num_rows==1) {
		while($row=$result->fetch_assoc()) {	
			if($oldpwd==$row["password"]) {
				$sql="UPDATE users SET password='$newpwd' WHERE username='$user';";
				mysqli_query($conn, $sql);
				echo '<script>alert("Password Changed Successfully!!!");
				history.go(-2);</script>';
			}
			else {
				echo '<script>alert("Incorrect Old Password!!!\nRetry...");
				history.go(-1);</script>';
			}
		}
	}
	else {
		echo '<script>alert("ERROR!!! Retry...");
		history.go(-1);</script>';
	}
	mysqli_close($conn);
?>