<!DOCTYPE html>
<html>
	<title>ATLATSZO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<body class="w3-container">
		<?php
			$servername="localhost";
			$username="root";
			$password="";
			$mydb="hms";
			$conn=new mysqli($servername, $username, $password, $mydb);
			$eid=$_POST["eid"];
			$room=$_POST["room"];
			$s=$_POST["id"];
			$sid=$_POST["sid"];
			$quantity=[];
			foreach($_POST["qty"] as $qty) {
				if($qty!=NULL) {
					array_push($quantity, $qty);
				}
			}
			$sql="SELECT * FROM rooms WHERE room_no='$room';";
			$result=mysqli_query($conn, $sql);
			if($result->num_rows>0) {
				while($row=$result->fetch_assoc()) {
					$gid=$row["guest"];
				}
			}
			if($s=='H') {
				foreach(array_combine($sid, $quantity) as $item=>$qty) {
					$sql="SELECT * FROM services WHERE service_id='$item';";
					$result=mysqli_query($conn, $sql);
					if($result->num_rows>0) {
						while($row=$result->fetch_assoc()) {
							$sname=$row['service_name'];
							$did=$row['dept_id'];
							$cost=$row['cost'];
							$total=$cost * $qty;
							$sql="INSERT INTO h_services VALUES('$item', '$sname', '$did', '$cost', '$qty', '$gid', '$eid', '$total');";
							mysqli_query($conn, $sql);
						}
					}
				}
			}
			if($s=='R') {
				foreach(array_combine($sid, $quantity) as $item=>$qty) {
					$sql="SELECT * FROM services WHERE service_id='$item';";
					$result=mysqli_query($conn, $sql);
					if($result->num_rows>0) {
						while($row=$result->fetch_assoc()) {
							$sname=$row['service_name'];
							$did=$row['dept_id'];
							$cost=$row['cost'];
							$total=$cost * $qty;
							$sql="INSERT INTO r_services VALUES('$item', '$sname', '$did', '$cost', '$qty', '$gid', '$eid', '$total');";
							mysqli_query($conn, $sql);
						}
					}
				}
			}
			mysqli_close($conn);
			echo "<div class='w3-panel w3-green w3-center'>
					<h3>Service Added Successfully!!!</h3>
					<button class='w3-button w3-block w3-white w3-section w3-padding' onclick='history.go(-1)'>Okay</button>
				</div>";
		?>
	</body>
</html>