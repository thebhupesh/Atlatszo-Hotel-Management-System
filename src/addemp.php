<!DOCTYPE html>
<html>
	<title>ATLATSZO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<body class="w3-container">
		<?php
			function emp() {
				$id=rand(1000, 9999);
				$mysqli=new mysqli('localhost', 'root', '', 'hms');
				$result=$mysqli->query("SELECT emp_id FROM employee WHERE emp_id='$id';");
				if($result->num_rows==0) {
					return strval($id);
				}
				else {
					emp();
				}
				$mysqli->close();
			}
			$servername="localhost";
			$username="root";
			$password="";
			$mydb="hms";
			$conn=new mysqli($servername, $username, $password, $mydb);
			$id='E';
			$id.=emp();
			$name=$_POST["name"];
			$gender=$_POST["gender"];
			$age=$_POST["age"];
			$number=$_POST["number"];
			$doa=$_POST["doa"];
			$desig=$_POST["desig"];
			$dept=$_POST["dept"];
			$salary=$_POST["salary"];
			$sql="INSERT INTO employee VALUES('$id', '$name', '$gender', '$age', '$number', '$doa', '$desig', '$dept', '$salary', '0');";
			mysqli_query($conn, $sql);
			$sql="INSERT INTO users VALUES('$id', '$id', 'emp');";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			echo "<div class='w3-panel w3-green w3-center'>
					<h3>Employee Added Successfully!!!</h3>
					<p><b>Employee ID: $id</b></p>
					<button class='w3-button w3-block w3-white w3-section w3-padding' onclick='history.go(-1)'>Okay</button>
				</div>";
		?>
	</body>
</html>