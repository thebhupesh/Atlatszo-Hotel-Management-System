<!DOCTYPE html>
<html>
	<title>ATLATSZO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<body class="w3-container">
		<?php 
			function new_pwd() {
				$data='1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
				return substr(str_shuffle($data), 0, 8);
			}
			$servername="localhost";
			$username="root";
			$password="";
			$mydb="hms";
			$conn=new mysqli($servername, $username, $password, $mydb);
			$id=$_POST["username"];
			$name=$_POST["name"];
			$number=$_POST["number"];
			$room=$_POST["room"];
			$pwd=new_pwd();
			if($room!=NULL) {
				$sql="SELECT * FROM guest WHERE guest_id='$id' AND name='$name' AND contact_no='$number' AND room_no='$room';";
				$result=mysqli_query($conn, $sql);
				if($result->num_rows==1) {
					$sql="UPDATE users SET password='$pwd' WHERE username='$id';";
					$result=mysqli_query($conn, $sql);
					echo "<div class='w3-panel w3-green w3-center'>
							<h3>Success!</h3>
							<p><b>New Password: $pwd</b></p>
							<p>Note: Kindly change password at first login</p>
							<button class='w3-button w3-block w3-white w3-section w3-padding' onclick='history.go(-1)'>Okay</button>
						</div>";
				}
				else {
					echo '<script>alert("No such user exists!!!\nRetry...");
						history.go(-1);</script>';
				}
			}
			else {
				$sql="SELECT * FROM employee WHERE emp_id='$id' AND name='$name' AND contact_no='$number';";
				$result=mysqli_query($conn, $sql);
				if($result->num_rows==1) {
					$sql="UPDATE users SET password='$pwd' WHERE username='$id';";
					$result=mysqli_query($conn, $sql);
					echo "<div class='w3-panel w3-green w3-center'>
							<h3>Success!</h3>
							<p><b>New Password: $pwd</b></p>
							<p>Note: Kindly change password at first login</p>
							<button class='w3-button w3-block w3-white w3-section w3-padding' onclick='history.go(-1)'>Okay</button>
						</div>";
				}
				else {
					echo '<script>alert("No such user exists!!!\nRetry...");
						history.go(-1);</script>';
				}
			}
			mysqli_close($conn);
		?>
	</body>
</html>