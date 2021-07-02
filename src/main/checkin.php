<!DOCTYPE html>
<html>
	<title>ATLATSZO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<body class="w3-container">	
		<?php
			function guest() {
				$id=rand(1000, 9999);
				$mysqli=new mysqli('localhost', 'root', '', 'hms');
				$result=$mysqli->query("SELECT guest_id FROM guest WHERE guest_id='$id';");
				if($result->num_rows==0) {
					return strval($id);
				}
				else {
					guest();
				}
				$mysqli->close();
			}
			$servername="localhost";
			$username="root";
			$password="";
			$mydb="hms";
			$conn=new mysqli($servername, $username, $password, $mydb);
			$id='G';
			$id .=guest();
			$name=$_POST["name"];
			$number=$_POST["number"];
			$nop=$_POST["nop"];
			$checkin=$_POST["checkin"];
			$checkout=$_POST["checkout"];
			$room=$_POST["r_no"];
			$sql="SELECT * FROM rooms WHERE room_no='$room';";
			$result=mysqli_query($conn, $sql);
			if($result->num_rows>0) {
				while($row=$result->fetch_assoc()) {
					if($row["guest"]!=NULL) {
						echo "<script>alert('Room Not Empty!!!');
							history.go(-1);</script>";
						break;
					}
					else {
						$sql="INSERT INTO guest VALUES('$id', '$name', '$number', '$nop', '$checkin', '$checkout', '$room');";
						mysqli_query($conn, $sql);
						$sql="INSERT INTO users VALUES('$id', '$id', 'guest');";
						mysqli_query($conn, $sql);
						$sql="UPDATE rooms SET guest='$id' WHERE room_no='$room';";
						mysqli_query($conn, $sql);
						mysqli_close($conn);
						echo "<div class='w3-panel w3-green w3-center'>
								<h3>Check-In Successful!!!</h3>
								<p>Guest ID: $id</p>
								<button class='w3-button w3-block w3-white w3-section w3-padding' onclick='history.go(-1)'>Okay</button>
							</div>";
								}
				}
			}
		?>
	</body>
</html>