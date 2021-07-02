<!DOCTYPE html>
<html>
	<style>
		body {
			counter-reset: Count-Value;     
		}
		tr td:first-child:before {
			counter-increment: Count-Value;   
			content: counter(Count-Value);
		}
	</style>
	<?php
		$servername="localhost";
		$username="root";
		$password="";
		$mydb="hms";
		$conn=new mysqli($servername, $username, $password, $mydb);
		$id=$_POST["id"];
		$room=$_POST["room"];
		$name=$_POST["name"];
		$type=$_POST["type"];
		$total=0;
		$sql="SELECT * FROM users WHERE username='$id';";
		$result=mysqli_query($conn, $sql);
		if($result->num_rows==1) {
			while($row=$result->fetch_assoc()) {
				if($type=='guest') {
					$pwd=$_POST["pwd"];
					if($row["password"]!=$pwd) {
						echo '<script>alert("Incorrect Password!!!\nRetry...");
							history.go(-1);</script>';
					}
				}
				else {
					continue;
				}
			}
		}
		else {
			echo '<script>alert("Incorrect Data!!!\nRetry...");
				history.go(-1);</script>';
		}
	?>
	<title>INVOICE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<body>
		<div class="w3-top">
			<div class="w3-bar w3-white w3-wide w3-padding w3-card">
			<div class="w3-bar-item"><b>ATLATSZO</b> HOTEL MANAGEMENT SYSTEM</div>
			</div>
		</div>
		<div class="w3-content w3-padding" style="max-width:1564px">
			<div class="w3-container w3-padding-32">
				<div class="w3-padding-24">
				<button class="w3-right w3-btn w3-black" onclick="window.print()">PRINT</button>
				<h3 class="w3-border-bottom w3-border-light-grey">Guest Invoice</h3>
				</div>
				<div class="w3-panel w3-border">
					<?php
					$sql="SELECT *, DATEDIFF(check_out, check_in) AS days FROM guest WHERE room_no='$room';";
					$result=mysqli_query($conn, $sql);
					if($result->num_rows>0) {
						while($row=$result->fetch_assoc()) {
							echo "<p><b>Name:</b> {$row["name"]}"; 
							echo "<br><b>Phone No.:</b> {$row["contact_no"]}";
							echo "<br><b>Room No.:</b> {$row["room_no"]}";
							echo "<br><b>Check-In:</b> {$row["check_in"]}";
							echo "<br><b>Check-Out:</b> {$row["check_out"]}";
							$contact=$row["contact_no"];
							$days=$row["days"];
							$id=$row["guest_id"];
						}
					}
					?>
					</p>
				</div>
				<h3 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Details</b></h3>
				<table class="w3-table w3-striped">
					<thead>
						<tr class="w3-light-grey">
						<th class="w3-center">Sno.</th>
						<th class="w3-center">Description</th>
						<th class="w3-center">Price</th>
						<th class="w3-center">Quantity</th>
						<th class="w3-center">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql="SELECT * FROM rooms WHERE guest='$id';";
						$result=mysqli_query($conn, $sql);
						if($result->num_rows>0) {
							while($row=$result->fetch_assoc()) {
								echo "<tr><td class='w3-center'></td>";
								echo "<td class='w3-center'>Room: {$row["room_type"]}</td>";
								echo "<td class='w3-center'>₹ {$row["cost"]}</td>";
								echo "<td class='w3-center'>$days</td>";
								$total+=$days*$row["cost"];
								echo "<td class='w3-center'>₹ $total</td></tr>";
							}
							$sql="SELECT * FROM h_services WHERE guest_id='$id';";
							$result=mysqli_query($conn, $sql);
							while($row=$result->fetch_assoc()) {
								echo "<tr><td class='w3-center'></td>";
								echo "<td class='w3-center'> {$row["service_name"]}</td>";
								echo "<td class='w3-center'>₹ {$row["cost"]}</td>";
								echo "<td class='w3-center'> {$row["quantity"]}</td>";
								echo "<td class='w3-center'>₹ {$row["total_cost"]}</td></tr>";
								$total+=$row["total_cost"];
							}
							$sql="SELECT * FROM r_services WHERE guest_id='$id';";
							$result=mysqli_query($conn, $sql);
							while($row=$result->fetch_assoc()) {
								echo "<tr><td class='w3-center'></td>";
								echo "<td class='w3-center'> {$row["service_name"]}</td>";
								echo "<td class='w3-center'>₹ {$row["cost"]}</td>";
								echo "<td class='w3-center'> {$row["quantity"]}</td>";
								echo "<td class='w3-center'>₹ {$row["total_cost"]}</td></tr>";
								$total+=$row["total_cost"];
							}
						}
						else {
							echo '<script>alert("Incorrect Details!!!\nRetry...");</script>';
							echo "<script>history.go(-1);</script>";
						}
					?>
					</tbody>
				</table>
				<?php
					echo "<br><p class='w3-center'><b>SUBTOTAL:</b> ₹ $total</p>";
					$gst=(20/100)*$total;
					echo "<p class='w3-center'><b>GST(20%):</b> ₹ $gst</p>";
					$total+=$gst;
					echo "<p class='w3-center'><b>GRAND TOTAL:</b> ₹ $total</p>";
					mysqli_close($conn);
				?>
				<form action="update.php" method="post">
					<?php 
						echo "<input type='hidden' name='id' value='$id'>";
						echo "<input type='hidden' name='name' value='$name'>";
						echo "<input type='hidden' name='contact' value='$contact'>";
						echo "<input type='hidden' name='total' value='$total'>";
						echo "<input type='hidden' name='type' value='$type'>";
					?>
					<br><div class="w3-center"><button type="submit" class="w3-btn w3-black">Confirm</button></div>
				</form>
			</div>
		</div>	
	</body>
</html>