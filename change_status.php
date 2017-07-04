<?php
	echo "<h1>Job Application Database</h1>";
	
	require_once ("settings.php");
	
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	if (!$conn) {
		echo "<p>Database connection failure</p>";
	}
	else if (isset($_POST["Status"]) && ($_POST["full"] != "")){
			
		$Status = $_POST["Status"];
		$Fullname = $_POST["full"];	
		$sql_table="Applicant_Details";
		$query = "UPDATE $sql_table SET Status='$Status' WHERE concat(First_Name, ' ', Last_Name) Like '$Fullname%' ";
		$result = mysqli_query($conn, $query);
		
		if (!$result){
			echo "<p>There are no current applications</p>";			
		}
		else {
			$query = "SELECT * FROM $sql_table";
			$result = mysqli_query($conn, $query);
			echo "<p>DATABASE UPDATED !!<p>";
			
			echo "<table border=\"1\">";
			echo "<tr>"
				."<th scope\"col\">EOInumber</th>"
				."<th scope\"col\">Job_Reference_Number</th>"
				."<th scope\"col\">First_Name</th>"
				."<th scope\"col\">Last_Name</th>"
				."<th scope\"col\">Street_Address</th>"
				."<th scope\"col\">Suburb_town</th>"
				."<th scope\"col\">State</th>"
				."<th scope\"col\">Postcode</th>"
				."<th scope\"col\">Email_address</th>"
				."<th scope\"col\">Phone_number</th>"
				."<th scope\"col\">Skills</th>"
				."<th scope\"col\">Other_skills</th>"
				."<th scope\"col\">Status</th>"
				."</tr>";
			 
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>", $row["EOInumber"],"</td>";
				echo "<td>", $row["Job_Reference_Number"],"</td>";
				echo "<td>", $row["First_Name"],"</td>";
				echo "<td>", $row["Last_Name"],"</td>";
				echo "<td>", $row["Street_Address"],"</td>";
				echo "<td>", $row["Suburb_town"],"</td>";
				echo "<td>", $row["State"],"</td>";
				echo "<td>", $row["Postcode"],"</td>";
				echo "<td>", $row["Email_address"],"</td>";
				echo "<td>", $row["Phone_number"],"</td>";
				echo "<td>", $row["Skills"],"</td>";
				echo "<td>", $row["Other_skills"],"</td>";
				echo "<td>", $row["Status"],"</td>";
				echo "</tr>";
		}
		echo "</table>";
		mysqli_free_result($result);
		}
		mysqli_close($conn);
	}
	else {
		echo "<p>Please enter Applicant's name whose status you want to change !</p>";
	}
?> 
</body>
</html>