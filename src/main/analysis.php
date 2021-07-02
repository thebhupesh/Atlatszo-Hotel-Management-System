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
		$dept=$_POST["dept"];
    ?>
    <title>Employee Analysis</title>
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
				<h3 class="w3-border-bottom w3-border-light-grey w3-center"><b>Department</b></h3>
                </div>
                <div class="w3-panel w3-border">
					<?php
                        $sql="SELECT dept_name FROM department WHERE dept_id='$dept';";
                        $result=mysqli_query($conn, $sql);
                        $row=$result->fetch_assoc();
                        $name=$row["dept_name"];
                        $sql="SELECT count(*) AS heads FROM employee WHERE dept_id='$dept';";
                        $result=mysqli_query($conn, $sql);
                        $row=$result->fetch_assoc();
                        $count=$row["heads"];
                        echo "<p><b>Department ID:</b> $dept"; 
                        echo "<br><br><b>Department Name:</b> $name";
                        echo "<br><br><b>Employee Count:</b> $count";
					?>
                    </p>
                </div>
                <?php
                    $sql="SELECT count(guest) AS cnt, sum($dept) AS sum FROM feedback;";
                    $result=mysqli_query($conn, $sql);
                    $row=$result->fetch_assoc();
                    $score=(($row["sum"]/$row["cnt"])/5)*100;
					$score=round($score, 2);
					echo "<div class='w3-light-grey'>
                        <div class='w3-container w3-black w3-center' style='width:$score%'>Department Score: $score/100</div>
                    </div>";
                ?>
                <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16 w3-center"><b>Employees</b></h3>
				<table class="w3-table w3-striped">
					<thead>
						<tr class="w3-light-grey">
						<th class="w3-center">Rank</th>
						<th class="w3-center">ID</th>
						<th class="w3-center">Name</th>
						<th class="w3-center">Score</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql="SELECT * FROM employee WHERE dept_id='$dept' ORDER BY score DESC;";
						$result=mysqli_query($conn, $sql);
						if($result->num_rows>0) {
							while($row=$result->fetch_assoc()) {
								echo "<tr><td class='w3-center'></td>";
								echo "<td class='w3-center'> {$row["emp_id"]}</td>";
								echo "<td class='w3-center'> {$row["name"]}</td>";
								echo "<td class='w3-center'> {$row["score"]}/100</td></tr>";
							}
						}
					?>
					</tbody>
				</table>
            </div>    
		</div>
    </body>
    <?php
        mysqli_close($conn);
    ?>
</html>