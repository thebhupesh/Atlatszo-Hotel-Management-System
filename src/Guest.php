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
		.txt-center {
			text-align: center;
		}
		.hide {
			display: none;
		}
		.clear {
			float: none;
			clear: both;
		}
		.rating {
			width: 90px;
			unicode-bidi: bidi-override;
			direction: rtl;
			text-align: center;
			position: relative;
		}
		.rating > label {
			display: inline;
			padding: 0;
			position: relative;
			cursor: pointer;
			color: #000;
		}
		.rating > label:hover, 
		.rating > label:hover ~ label, 
		.rating > input.radio-btn:checked ~ label {
			color: transparent;
		}
		.rating > label:hover:before, 
		.rating > label:hover ~ label:before, 
		.rating > input.radio-btn:checked ~ label:before, 
		.rating > input.radio-btn:checked ~ label:before {
			content: "\2605";
			position: absolute;
			left: 0;
			color: #FFD700;
		}
    </style>
	<?php
		$servername="localhost";
		$username="root";
		$password="";
		$mydb="hms";
		$conn=new mysqli($servername, $username, $password, $mydb);
		$id=$_POST["id"];
		$total=0;
		$sql="SELECT name, DATEDIFF(check_out, check_in) AS days FROM guest WHERE guest_id='$id';";
		$result=mysqli_query($conn, $sql);
		if($result->num_rows>0) {
			while($row=$result->fetch_assoc()) {
				$days=$row["days"];
				$name=$row["name"];
			}
		}
		$sql="SELECT * FROM rooms WHERE guest='$id';";
		$result=mysqli_query($conn, $sql);
		if($result->num_rows>0) {
			while($row=$result->fetch_assoc()) {
				$total+=$days*$row["cost"];
			}
			$sql="SELECT * FROM h_services WHERE guest_id='$id';";
			$result=mysqli_query($conn, $sql);
			while($row=$result->fetch_assoc()) {
				$total+=$row["total_cost"];
			}
			$sql="SELECT * FROM r_services WHERE guest_id='$id';";
			$result=mysqli_query($conn, $sql);
			while($row=$result->fetch_assoc()) {
				$total+=$row["total_cost"];
			}
		}
		$gst=(20/100)*$total;
		$total+=$gst;
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
					$name_='Welcome ';
					$sql="SELECT name FROM guest WHERE guest_id='$id'";
					$result=mysqli_query($conn, $sql);
					if($result->num_rows > 0) {
						while($row=$result->fetch_assoc()) {
							$name=$row["name"];
							$name_.=$row["name"];
						}
					}
					echo "<h3 class='w3-border-bottom w3-border-light-grey w3-padding-16 w3-center'><b>$name_</b></h3>";
				?>
				<div class="w3-container">
					<div class="w3-bar w3-black">
						<a href="#home"><button class="w3-bar-item w3-button tablink w3-light-grey" onclick="operation(event, 'home')">Home</button></a>
						<a href="#checkout"><button class="w3-bar-item w3-button tablink" onclick="operation(event, 'checkout')">Check-Out</button></a>
						<div class="w3-dropdown-hover">	
							<button class="w3-button tablink">Services</button>
							<div class="w3-dropdown-content w3-bar-block w3-card-4">
								<a href="#hservice"><button class="w3-bar-item w3-button w3-black tablink" onclick="operation(event, 'h_services')">Hotel Services</button></a>
								<a href="#rservice"><button class="w3-bar-item w3-button w3-black tablink" onclick="operation(event, 'r_services')">Room Services</button></a>
							</div>
						</div>
						<a href="#bill"><button class="w3-bar-item w3-button tablink" onclick="operation(event, 'bill')">Bill</button></a>
						<a href="#feedback"><button class="w3-bar-item w3-button tablink" onclick="operation(event, 'feedback')">Feedback</button></a>
					</div>
					<div id="home" class="w3-container w3-border tabs">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Details</b></h2>
						<div class="w3-center">
							<?php
								$sql="SELECT * FROM guest WHERE guest_id='$id';";
								$result=mysqli_query($conn, $sql);
								if($result->num_rows > 0) {
									while($row=$result->fetch_assoc()) {
										echo "<br><b>Guest ID: </b> {$row["guest_id"]}<br>";
										echo "<br><b>Name: </b> {$row["name"]}<br>";
										echo "<br><b>Contact No.: </b> {$row["contact_no"]}<br>";
										echo "<br><b>No of guests: </b> {$row["no_of_people"]}<br>";
										echo "<br><b>Check-In: </b> {$row["check_in"]}<br>";
										echo "<br><b>Check-Out: </b> {$row["check_out"]}<br>";
										echo "<br><b>Room No.: </b> {$row["room_no"]}<br>";
										echo "<br><b>Due Amount: </b>₹ $total<br>";
										$room=$row["room_no"];
									}
								}
							?>
						</div>
					</div>
					<div id="checkout" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Check-Out</b></h2>
						<?php
							echo "<form action='checkout.php' method='post' target='_blank'>
								<input type='hidden' name='id' value='$id'>
								<input type='hidden' name='room' value='$room'>
								<input type='hidden' name='name' value='$name'>
								<input type='hidden' name='type' value='guest'>
								<input class='w3-input w3-section w3-border' type='password' placeholder='Enter Password' required name='pwd'>
								<button class='w3-button w3-black w3-section' type='submit' >
									<i class='fa fa-paper-plane'></i> Submit
								</button>
							</form>";
						?>
					</div>
					<div id="h_services" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Hotel Services</b></h2>
						<?php
							$sql="SELECT * FROM services WHERE service_type='H';";
							if($result=mysqli_query($conn, $sql)) {
								echo "<table class='w3-table w3-striped'>";
								echo "<thead>";
								echo "<tr class='w3-light-grey'>";
								echo "<th class='w3-center'>Sno.</th>";
								echo "<th class='w3-center'>Service Name</th>";
								echo "<th class='w3-center'>Cost</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								while($row=mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td class='w3-center'></td>";
									echo "<td class='w3-center'> {$row[2]}</td>";
									echo "<td class='w3-center'>₹ {$row[4]}</td>";
								}
								echo "</tr></tbody></table>";
							}
						?>
					</div>
					<div id="r_services" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Room Services</b></h2>
						<?php      
							$sql="SELECT * FROM services WHERE service_type='R';";
							if($result=mysqli_query($conn, $sql)) {
								echo "<table class='w3-table w3-striped'>";
								echo "<thead>";
								echo "<tr class='w3-light-grey'>";
								echo "<th class='w3-center'>Sno.</th>";
								echo "<th class='w3-center'>Service Name</th>";
								echo "<th class='w3-center'>Cost</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								while($row=mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td class='w3-center'></td>";
									echo "<td class='w3-center'> {$row[2]}</td>";
									echo "<td class='w3-center'>₹ {$row[4]}</td>";
								}
								echo "</tr></tbody></table>";
							}
						?>
					</div>
					<div id="bill" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Bill Details</b></h2>
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
								$total=0;
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
						?>
					</div>
					<div id="feedback" class="w3-container w3-border tabs" style="display:none">
						<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Feedback</b></h2>
						<?php 
							echo "<form action='addfeedback.php' method='post'>";
								echo "<input type='hidden' name='id' value='$id'>";
								echo "<table class='w3-table w3-striped'>";
									echo "<thead><tr class='w3-light-grey'>";
									echo "<th class='w3-center'>Sno.</th>";
									echo "<th class='w3-center'>Services</th>";
									echo "<th>Rating</th>";
									echo "</tr></thead>";
									echo "<tbody>";
									echo "<tr><td class='w3-center'></td>";
									echo "<td class='w3-center'>Front Office</td>";
									echo "<td>
										<div class='txt-center'>
											<div class='rating'>
												<input id='star5' name='1star' type='radio' value='5' class='radio-btn hide'>
												<label for='star5' >☆</label>
												<input id='star4' name='1star' type='radio' value='4' class='radio-btn hide'>
												<label for='star4' >☆</label>
												<input id='star3' name='1star' type='radio' value='3' class='radio-btn hide'>
												<label for='star3' >☆</label>
												<input id='star2' name='1star' type='radio' value='2' class='radio-btn hide'>
												<label for='star2' >☆</label>
												<input id='star1' name='1star' type='radio' value='1' class='radio-btn hide'>
												<label for='star1' >☆</label>
												<div class='clear'></div>
											</div>
										</div>
										</td></tr>";
									echo "<tr>";
									echo "<td class='w3-center'></td>";
									echo "<td class='w3-center'>House Keeping</td>";
									echo "<td>
										<div class='txt-center'>
											<div class='rating'>
												<input id='star10' name='2star' type='radio' value='5' class='radio-btn hide'>
												<label for='star10' >☆</label>
												<input id='star9' name='2star' type='radio' value='4' class='radio-btn hide'>
												<label for='star9' >☆</label>
												<input id='star8' name='2star' type='radio' value='3' class='radio-btn hide'>
												<label for='star8' >☆</label>
												<input id='star7' name='2star' type='radio' value='2' class='radio-btn hide'>
												<label for='star7' >☆</label>
												<input id='star6' name='2star' type='radio' value='1' class='radio-btn hide'>
												<label for='star6' >☆</label>
												<div class='clear'></div>
											</div>
										</div>
										</td></tr>";
									echo "<tr>";
									echo "<td class='w3-center'></td>";
									echo "<td class='w3-center'>Purchasing ans Store</td>";
									echo "<td>
										<div class='txt-center'>
											<div class='rating'>
												<input id='star15' name='3star' type='radio' value='5' class='radio-btn hide'>
												<label for='star15' >☆</label>
												<input id='star14' name='3star' type='radio' value='4' class='radio-btn hide'>
												<label for='star14' >☆</label>
												<input id='star13' name='3star' type='radio' value='3' class='radio-btn hide'>
												<label for='star13' >☆</label>
												<input id='star12' name='3star' type='radio' value='2' class='radio-btn hide'>
												<label for='star12' >☆</label>
												<input id='star11' name='3star' type='radio' value='1' class='radio-btn hide'>
												<label for='star11' >☆</label>
												<div class='clear'></div>
											</div>
										</div>
										</td></tr>";
									echo "<tr>";
									echo "<td class='w3-center'></td>";
									echo "<td class='w3-center'>Room Service</td>";
									echo "<td>
										<div class='txt-center'>
											<div class='rating'>
												<input id='star20' name='4star' type='radio' value='5' class='radio-btn hide'>
												<label for='star20' >☆</label>
												<input id='star19' name='4star' type='radio' value='4' class='radio-btn hide'>
												<label for='star19' >☆</label>
												<input id='star18' name='4star' type='radio' value='3' class='radio-btn hide'>
												<label for='star18' >☆</label>
												<input id='star17' name='4star' type='radio' value='2' class='radio-btn hide'>
												<label for='star17' >☆</label>
												<input id='star16' name='4star' type='radio' value='1' class='radio-btn hide'>
												<label for='star16' >☆</label>
												<div class='clear'></div>
											</div>
										</div>
										</td></tr>";
									echo "<tr>";
									echo "<td class='w3-center'></td>";
									echo "<td class='w3-center'>Security</td>";
									echo "<td>									
										<div class='txt-center'>
											<div class='rating'>
												<input id='star25' name='5star' type='radio' value='5' class='radio-btn hide'>
												<label for='star25' >☆</label>
												<input id='star24' name='5star' type='radio' value='4' class='radio-btn hide'>
												<label for='star24' >☆</label>
												<input id='star23' name='5star' type='radio' value='3' class='radio-btn hide'>
												<label for='star23' >☆</label>
												<input id='star22' name='5star' type='radio' value='2' class='radio-btn hide'>
												<label for='star22' >☆</label>
												<input id='star21' name='5star' type='radio' value='1' class='radio-btn hide'>
												<label for='star21' >☆</label>
												<div class='clear'></div>
											</div>
										</div>
										</td></tr></tbody>";
								echo "</table>";
								echo "<textarea class='w3-input w3-section w3-border' type='text' placeholder='Comments' name='comment' rows=5></textarea>";
								echo "<div class='w3-center'><button class='w3-button w3-black w3-section' type='submit' >
										<i class='fa fa-paper-plane'></i> Submit
									</button></div>";  
							echo "</form>";
						?>
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