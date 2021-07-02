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
			$id=$_POST["id"];
			$s1=$_POST["1star"];
			$s2=$_POST["2star"];
			$s3=$_POST["3star"];
			$s4=$_POST["4star"];
			$s5=$_POST["5star"];
			$cmnt=$_POST["comment"];
			$sql="INSERT INTO feedback VALUES('$id', '$s1', '$s2', '$s3', '$s4', '$s5', '$cmnt');";
			mysqli_query($conn, $sql);
			$sql="SELECT emp_id AS emp FROM h_services WHERE guest_id='$id';";
			$result=mysqli_query($conn, $sql);
			if($result->num_rows>0) {
				while($row=mysqli_fetch_array($result)) {
					if($row["emp"]!='admin') {
						$emp=$row["emp"];
						$sql="SELECT dept_id FROM employee WHERE emp_id='$emp';";
						$result1=mysqli_query($conn, $sql);
						$row1=mysqli_fetch_array($result1);
						$D=$row1["dept_id"];
						$sql="SELECT count(feedback.guest), sum($D) FROM feedback, h_services WHERE feedback.guest=h_services.guest_id AND emp_id='$emp';";
						$result1=mysqli_query($conn, $sql);
						$row1=mysqli_fetch_array($result1);
						$c=$row1[0];
						$s=$row1[1];
						$score=(($s/$c)/5)*100;
						$sql="UPDATE employee SET score='$score' WHERE emp_id='$emp';";
						mysqli_query($conn, $sql);
					}
				}
			}
			$sql="SELECT emp_id AS emp FROM r_services WHERE guest_id='$id';";
			$result=mysqli_query($conn, $sql);
			if($result->num_rows>0) {
				while($row=mysqli_fetch_array($result)) {
					if($row["emp"]!='admin') {
						$emp=$row["emp"];
						$sql="SELECT dept_id FROM employee WHERE emp_id='$emp';";
						$result1=mysqli_query($conn, $sql);
						$row1=mysqli_fetch_array($result1);
						$D=$row1["dept_id"];
						$sql="SELECT count(feedback.guest), sum($D) FROM feedback, r_services WHERE feedback.guest=r_services.guest_id AND emp_id='$emp';";
						$result1=mysqli_query($conn, $sql);
						$row1=mysqli_fetch_array($result1);
						$c=$row1[0];
						$s=$row1[1];
						$score=(($s/$c)/5)*100;
						$sql="UPDATE employee SET score='$score' WHERE emp_id='$emp';";
						mysqli_query($conn, $sql);
					}
				}
			}
			mysqli_close($conn);
			echo "<div class='w3-panel w3-green w3-center'>
					<h3>Thank You for your valuable feedback!!!</h3>
					<button class='w3-button w3-block w3-white w3-section w3-padding' onclick='history.go(-1)'>Okay</button>
				</div>";
		?>
	</body>
</html>