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
	?>
	<title>ATLATSZO</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<body>
		<div class="w3-top">
			<div class="w3-bar w3-white w3-wide w3-padding w3-card">
				<a href="#home" class="w3-bar-item w3-button"><b>ATLATSZO</b> HOTEL MANAGEMENT SYSTEM</a>
				<div class="w3-right w3-hide-small">
					<a href="#pwdchng" class="w3-bar-item w3-button" onclick="document.getElementById('pwdchange').style.display='block'">Change Password</a>
					<a href="Home.html" class="w3-bar-item w3-button">Log Out</a>
				</div>
			</div>
		</div>
		<div class="w3-container">
			<div id="pwdchange" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
					<div class="w3-center"><br>
						<span onclick="document.getElementById('pwdchange').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
					</div>
					<form class="w3-container" action="pwdchange.php" method="post">
						<div class="w3-section">
							<input type="hidden" name="user" value="<?php echo "$id"; ?>">
							<label><b>Old Password</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Enter Old Password" name="old" required id="old">
							<input type="checkbox" onclick="password('old')"> Show Password<br>
							<br><label><b>New Password</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Enter New Password" name="new" required id="new">
							<input type="checkbox" onclick="password('new')"> Show Password<br>
							<button class="w3-button w3-block w3-black w3-section w3-padding" type="sign_in">Change</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script>
			function password(id) {
				var x=document.getElementById(id);
				if(x.type==="password") {
					x.type="text";
				}
				else {
					x.type="password";
				}
			}
		</script>
		<div class="w3-content w3-padding" style="max-width:1564px">	
			<div class="w3-container w3-padding-32" id="container">
				<?php
					$name='Welcome ';
					$sql="SELECT name FROM employee WHERE emp_id='$id'";
					$result=mysqli_query($conn, $sql);
					if($result->num_rows > 0) {
						while($row=$result->fetch_assoc()) {
							$name.=$row["name"];
						}
					}
					echo "<h3 class='w3-border-bottom w3-border-light-grey w3-padding-16 w3-center'><b>$name</b></h3>";
				?>
				<div class="w3-container">
					<div class="w3-bar w3-black">
						<a href="#home"><button class="w3-bar-item w3-button tablink w3-light-grey" onclick="operation(event, 'home')">Home</button></a>
						<a href="#checkin"><button class="w3-bar-item w3-button tablink" onclick="operation(event, 'checkin')">Check-In</button></a>
						<a href="#checkout"><button class="w3-bar-item w3-button tablink" onclick="operation(event, 'checkout')">Check-Out</button></a>
						<a href="#guests"><button class="w3-bar-item w3-button tablink" onclick="operation(event, 'guests')">Guests</button></a>
						<a href="#room"><button class="w3-bar-item w3-button tablink" onclick="operation(event, 'status')">Rooms Status</button></a>
						<div class="w3-dropdown-hover">	
							<button class="w3-button tablink">Services</button>
							<div class="w3-dropdown-content w3-bar-block w3-card-4">
								<a href="#hservice"><button class="w3-bar-item w3-button w3-black tablink" onclick="operation(event, 'h_services')">Hotel Services</button></a>
								<a href="#rservice"><button class="w3-bar-item w3-button w3-black tablink" onclick="operation(event, 'r_services')">Room Services</button></a>
							</div>
						</div>
					</div>
					<div id="home" class="w3-container w3-border tabs">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Details</b></h2>
						<div class="w3-center">
							<?php
								$sql="SELECT * FROM employee WHERE emp_id='$id';";
								$result=mysqli_query($conn, $sql);
								if($result->num_rows > 0) {
									while($row=$result->fetch_assoc()) {
										echo "<br><b>Employee ID: </b> {$row["emp_id"]}<br>";
										echo "<br><b>Name: </b> {$row["name"]}<br>";
										echo "<br><b>Contact No.: </b> {$row["contact_no"]}<br>";
										echo "<br><b>DOA: </b> {$row["doa"]}<br>";
										echo "<br><b>Designation: </b> {$row["designation"]}<br>";
										echo "<br><b>Dept ID: </b> {$row["dept_id"]}<br>";
									}
								}
							?>
						</div>
					</div>
					<div id="checkin" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Check-In</b></h2>
						<form action="checkin.php" method="post">	
							<input class="w3-input w3-section w3-border" type="text" placeholder="Full Name" required name="name">
							<input class="w3-input w3-section w3-border" type="number" placeholder="Contact Number" required name="number">
							<input class="w3-input w3-section w3-border" type="number" placeholder="Number of People" required name="nop">
							<input class="w3-input w3-section w3-border" type="date" placeholder="Check-In" required name="checkin">
							<input class="w3-input w3-section w3-border" type="date" placeholder="Check-Out" required name="checkout">
							<input class="w3-input w3-section w3-border" type="number" placeholder="Room Number" required name="r_no">
							<button class="w3-button w3-black w3-section" type="submit">
							<i class="fa fa-paper-plane"></i> Submit
							</button>
						</form>
					</div>
					<div id="checkout" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Check-Out</b></h2>
						<form action="checkout.php" method="post" target="_blank">
							<?php echo "<input type='hidden' name='id' value='$id'>"; ?>
							<input class="w3-input w3-section w3-border" type="text" placeholder="Guest Name" required name="name">
							<input class="w3-input w3-section w3-border" type="number" placeholder="Room No." required name="room">
							<input type="hidden" name="type" value="other">
							<button class="w3-button w3-black w3-section" type="submit" >
							<i class="fa fa-paper-plane"></i> Submit
							</button>
						</form>
					</div>
					<div id="guests" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Guest Details</b></h2>
						<?php      
							$sql="SELECT * FROM guest;";
							if($result=mysqli_query($conn, $sql)) {
								echo "<table class='w3-table w3-striped'>";
								echo "<thead>";
								echo "<tr class='w3-light-grey'>";
								echo "<th class='w3-center'>Sno.</th>";
								echo "<th class='w3-center'>Guest ID</th>";
								echo "<th class='w3-center'>Name</th>";
								echo "<th class='w3-center'>Contact No.</th>";
								echo "<th class='w3-center'>Head Count</th>";  
								echo "<th class='w3-center'>Check-In</th>";
								echo "<th class='w3-center'>Check-Out</th>";
								echo "<th class='w3-center'>Room No.</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								while($row=mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td class='w3-center'></td>";
									echo "<td class='w3-center'> {$row[0]}</td>";
									echo "<td class='w3-center'> {$row[1]}</td>";
									echo "<td class='w3-center'> {$row[2]}</td>";
									echo "<td class='w3-center'> {$row[3]}</td>";
									echo "<td class='w3-center'> {$row[4]}</td>";
									echo "<td class='w3-center'> {$row[5]}</td>";
									echo "<td class='w3-center'> {$row[6]}</td>";
								}
								echo "</tr></tbody></table>";
							}
						?>
					</div>
					<div id="status" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Rooms Status</b></h2>
						<?php      
							$sql="SELECT * FROM rooms;";
							if($result=mysqli_query($conn, $sql)) {
								echo "<table class='w3-table w3-striped'>";
								echo "<thead>";
								echo "<tr class='w3-light-grey'>";
								echo "<th class='w3-center'>Sno.</th>";
								echo "<th class='w3-center'>Room No.</th>";
								echo "<th class='w3-center'>Room Type</th>";
								echo "<th class='w3-center'>Cost</th>";
								echo "<th class='w3-center'>Max</th>";  
								echo "<th class='w3-center'>Status</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								while($row=mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td class='w3-center'></td>";
									echo "<td class='w3-center'> {$row[0]}</td>";
									echo "<td class='w3-center'> {$row[1]}</td>";
									echo "<td class='w3-center'>₹ {$row[2]}</td>";
									echo "<td class='w3-center'> {$row[3]}</td>";
									if($row[4]==NULL) {	
										echo "<td class='w3-center'>Available</td>";
									}
									else {
										echo "<td class='w3-center'> {$row[4]}</td>";
									}
									echo "</tr></tbody>";
								} 
								echo "</table>";
							}
						?>
					</div>
					<div id="h_services" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Hotel Services</b></h2>
						<form action="addservice.php" method="post">
							<input type="hidden" name="id" value="H">
							<?php
								echo "<input type='hidden' name='eid' value='$id'>";
								echo "<input class='w3-input w3-section w3-border' type='text' placeholder='Room No.' required name='room'>";
								$sql="SELECT * FROM services WHERE service_type='H';";
								if($result=mysqli_query($conn, $sql)) {
									echo "<table class='w3-table w3-striped'>";
									echo "<thead>";
									echo "<tr class='w3-light-grey'>";
									echo "<th class='w3-center'>Sno.</th>";
									echo "<th class='w3-center'>Service Name</th>";
									echo "<th class='w3-center'>Cost</th>";
									echo "<th class='w3-center'>Quantity</th>";
									echo "<th class='w3-center'>Select</th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
									while($row=mysqli_fetch_array($result)) {
										echo "<tr>";
										echo "<td class='w3-center'></td>";
										echo "<td class='w3-center'> {$row["service_name"]}</td>";
										echo "<td class='w3-center'>₹ {$row["cost"]}</td>";
										echo "<td class='w3-center'><input class='w3-input w3-border' type='number' min='0' max='10' name='qty[]'>";
										echo '<td class="w3-center"><input type="checkbox" name="sid[]" value="'.$row["service_id"].'"</td>';
									}
									echo "</tr></tbody></table>";
								}
								echo "<input class='w3-button w3-black w3-section' type='submit' value='Submit'>";
							?>
						</form>
					</div>
					<div id="r_services" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Room Services</b></h2>
						<form action="addservice.php" method="post">
							<input type="hidden" name="id" value="R">
							<?php
								echo "<input type='hidden' name='eid' value='$id'>";
								echo "<input class='w3-input w3-section w3-border' type='text' placeholder='Room No.' required name='room'>";
								$sql="SELECT * FROM services WHERE service_type='R';";
								if($result=mysqli_query($conn, $sql)) {
									echo "<table class='w3-table w3-striped'>";
									echo "<thead>";
									echo "<tr class='w3-light-grey'>";
									echo "<th class='w3-center'>Sno.</th>";
									echo "<th class='w3-center'>Service Name</th>";
									echo "<th class='w3-center'>Cost</th>";
									echo "<th class='w3-center'>Quantity</th>";
									echo "<th class='w3-center'>Select</th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
									while($row=mysqli_fetch_array($result)) {
										echo "<tr>";
										echo "<td class='w3-center'></td>";
										echo "<td class='w3-center'> {$row["service_name"]}</td>";
										echo "<td class='w3-center'>₹ {$row["cost"]}</td>";
										echo "<td class='w3-center'><input class='w3-input w3-border' type='number' min='0' max='10' name='qty[]'>";
										echo '<td class="w3-center"><input type="checkbox" name="sid[]" value="'.$row["service_id"].'"</td>';
									}
									echo "</tr></tbody></table>";
								}
								echo "<input class='w3-button w3-black w3-section' type='submit' value='Submit'>";
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script>
			function operation(evt, op) {
				var i, x, tablinks;
				x=document.getElementsByClassName("tabs");
				for(i=0; i < x.length; i++) {
					x[i].style.display="none";
				}
				tablinks=document.getElementsByClassName("tablink");
				for(i=0; i < x.length; i++) {
					tablinks[i].className=tablinks[i].className.replace(" w3-light-grey", "");
				}
				document.getElementById(op).style.display="block";
				evt.currentTarget.className+=" w3-light-grey";
			}
		</script>
	</body>
	<?php mysqli_close($conn); ?>
</html>