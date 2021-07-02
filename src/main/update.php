<!DOCTYPE html>
<html>
	<title>ATLATSZO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<body class="w3-container">
		<?php
			function inv() {
				$in=rand(1000, 9999);
				$mysqli=new mysqli('localhost', 'root', '', 'hms');
				$result=$mysqli->query("SELECT * FROM invoice WHERE invoice_no='$in';");
				if($result->num_rows==0) {
					return strval($in);
				}
				else {
					inv();
				}
				$mysqli->close();
			}
			$servername="localhost";
			$username="root";
			$password="";
			$mydb="hms";
			$conn=new mysqli($servername, $username, $password, $mydb);
			$date=date("Y-m-d");
			$in=inv();
			$id=$_POST["id"];
			$name=$_POST["name"];
			$contact=$_POST["contact"];
			$total=$_POST["total"];
			$type=$_POST["type"];
			$sql="INSERT INTO invoice VALUES('$in', '$name', '$contact', '$total', '$date');";
			mysqli_query($conn, $sql);
			$sql="DELETE FROM users WHERE username='$id';";
			mysqli_query($conn, $sql);
			$sql="DELETE FROM guest WHERE guest_id='$id';";
			mysqli_query($conn, $sql);
			$sql="DELETE FROM r_services WHERE guest_id='$id';";
			mysqli_query($conn, $sql);
			$sql="DELETE FROM h_services WHERE guest_id='$id';";
			mysqli_query($conn, $sql);
			$sql="UPDATE rooms SET guest=NULL WHERE guest='$id';";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			if($type!='guest') {
				echo "<div class='w3-panel w3-green w3-center'>
						<h3>Checkout Successful!!!</h3>
					</div>";
			}
			else {
				echo "<div class='w3-panel w3-green w3-center'>
						<h3>Checkout Successful!!!</h3>
						<script>window.location.replace('Home.html');</script>
					</div>";
			}
		?>
	</body>
</html>