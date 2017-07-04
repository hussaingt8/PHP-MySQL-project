<?php
	require_once ("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Search Database</title>
<meta charset="utf-8" />
<meta name="description" content="Applicant details"  />
<meta name="keywords" content="PHP, File, input, output" />
</head>
<body>
	<h1>Application Database Management !</h1>
	<h2><a href = "logout.php">Sign Out</a></h2>
	<hr/>
	<br/>
	<form>
		<p>1. <input type="submit" name="JobReferenceNumber" formaction="display_details.php" id="carmake" value="Click here to show entire applicantion database"/></p>
		<br/>
		
		<p>2. <input type="text" name="JobReferenceNumber" placeholder="Enter Job Ref. Number" id="JobReferenceNumber" />
		<input type="submit" formmethod="post" formaction="display_details_by_jrn.php" value="Search by Job Reference Number" /></p>
		<br/>

		<p>3. <input type="text" name="Firstname" placeholder="Enter First Name" id="Firstname" />
		<input type="submit" formmethod="post" formaction="display_by_firstname.php" value="Search by First Name" /></p>
		<br/>

		<p>4. <input type="text" name="Lastname" placeholder="Enter Last Name" id="Lastname" />
		<input type="submit" formmethod="post" formaction="display_by_lastname.php" value="Search by Last Name" /></p>
		<br/>
		
		<p>5. <input type="text" name="Fullname" placeholder="Enter Full Name" id="Fullname" />
		<input type="submit" formmethod="post" formaction="display_by_fullname.php" value="Search by Full Name" /></p>
		<br/>
		
		<p>6. <input type="text" name="JRN" placeholder="Enter Job Ref. Number" id="JRN" />
		<input type="submit" formmethod="post" formaction="delete_jrn.php" value="Delete Applicants for this job !!!" /></p>
		<br/>	
		
		<p>6. <input type="text" name="full" placeholder="Enter Full Name" id="full" />
			<select id="Status" name="Status">
				<option value="" disabled selected hidden>Please Select</option>
				<option id="New" value="New">New</option>
				<option id="Current" value="Current">Current</option>
				<option id="Final" value="Final">Final</option>
			</select>
			<input type="submit" formmethod="post" formaction="change_status.php" value="Change Applicant Status !" /></p>
	</form>
</body>
</html>