<!DOCTYPE html>
<html>
	<title>ATLATSZO</title>
	<body>
		<?php
			$servername="localhost";
			$username="root";
			$password="";
			$mydb="hms";
			$conn=new mysqli($servername, $username, $password, $mydb);
			$username=$_POST["Username"];
			$password=$_POST["Password"];
			$sql="SELECT * FROM users WHERE username='$username';";
			$result=mysqli_query($conn, $sql);
			if($result->num_rows==1) {
				while($row=$result->fetch_assoc()) {		
					if($username==$row["username"] && $password==$row["password"]) {
						if($row["user_type"]=='admin') {
							echo "<form action='Admin.php' method='post' name='form'><input type='hidden' name='id' value='$username'></form>";
							echo "<script>document.form.submit();</script>";
						}
						elseif($row["user_type"]=='emp') {
							echo "<form action='Emp.php' method='post' name='form'><input type='hidden' name='id' value='$username'></form>";
							echo "<script>document.form.submit();</script>";
						}
						elseif($row["user_type"]=='guest') {
							echo "<form action='Guest.php' method='post' name='form'><input type='hidden' name='id' value='$username'></form>";
							echo "<script>document.form.submit();</script>";
						}
					}
					else {
						echo '<script>alert("Incorrect Credentials!!!\nRetry...");
							history.go(-1);</script>';
					}
				}
			}
			else {
				echo '<script>alert("Incorrect Credentials!!!\nRetry...");
					history.go(-1);</script>';
			}
			mysqli_close($conn);
		?>
	</body>
</html>