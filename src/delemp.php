<?php
	$servername="localhost";
	$username="root";
	$password="";
	$mydb="hms";
	$conn=new mysqli($servername, $username, $password, $mydb);
	$id=$_POST["id"];
	$name=$_POST["name"];
	$sql="SELECT * FROM employee WHERE emp_id='$id';";
	$result=mysqli_query($conn, $sql);
	if($result->num_rows==1) {
		while($row=$result->fetch_assoc()) {
			if($id==$row["emp_id"] && $name==$row["name"]) {
				$sql="DELETE FROM employee WHERE emp_id='$id';";
				mysqli_query($conn, $sql);
				$sql="DELETE FROM users WHERE username='$id';";
				mysqli_query($conn, $sql);
				echo '<script>alert("Employee Deleted Successfully!!!");</script>';
				echo "<script>history.go(-1);</script>";
			}
			else {
				echo '<script>alert("Incorrect Name!!!\nRetry...");</script>';
				echo "<script>history.go(-1);</script>";
			}
		}
	}
	else {
		echo '<script>alert("Incorrect Employee ID!!!\nRetry...");</script>';
		echo "<script>history.go(-1);</script>";
	}
	mysqli_close($conn);
?>