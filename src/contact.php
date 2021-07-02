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
			$name=$_POST["Name"];
			$email=$_POST["Email"];
			$subject=$_POST["Subject"];
			$comment=$_POST["Comment"];
			$sql="INSERT INTO contact VALUES('$name', '$email', '$subject', '$comment');";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			echo "<div class='w3-panel w3-green w3-center'>
					<h3>Success!</h3>
					<p>Message Sent Successfully!!!</p>
					<button class='w3-button w3-block w3-white w3-section w3-padding' onclick='history.go(-1)'>Okay</button>
				</div>";	
		?>
	</body>
</html>