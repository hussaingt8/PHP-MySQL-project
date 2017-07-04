<?php
	echo "<!DOCTYPE html>";
	echo "<html lang='en'>";
	echo "<head>";
	echo "<meta charset='utf-8' />";
	echo "<title>Job Application Validation Page</title>";
	echo "</head>";
	
	//sanitize input
	function sanitise_input($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
				
	//checks if process was trigerred by a form submit, if not display an error message
	if (isset ($_POST["jrn"])) {
		$jrn = $_POST["jrn"];
	}

	if (isset ($_POST["Firstname"])) {
		$Firstname = $_POST["Firstname"];
		$Firstname = sanitise_input($Firstname);
	}
	
	if (isset ($_POST["Lastname"])) {
		$Lastname = $_POST["Lastname"];
		$Lastname = sanitise_input($Lastname);
	}
	
	if (isset ($_POST["DateOfBirth"])) {
		$DateOfBirth = $_POST["DateOfBirth"];
		$DateOfBirth = sanitise_input($DateOfBirth);
	}
	
	if (isset ($_POST["StreetAdress"])) {
		$StreetAdress = $_POST["StreetAdress"];
		$StreetAdress = sanitise_input($StreetAdress);
	}

	if (isset ($_POST["Suburb"])) {
		$Suburb = $_POST["Suburb"];
		$Suburb = sanitise_input($Suburb);
	}

	if (isset ($_POST["Postcode"])) {
		$Postcode = $_POST["Postcode"];
		$Postcode = sanitise_input($Postcode);
	}
			
	if (isset ($_POST["EmailAdress"])) {
		$EmailAdress = $_POST["EmailAdress"];
		$EmailAdress = sanitise_input($EmailAdress);
	}
	
	if (isset ($_POST["Phonenumber"])) {
		$Phonenumber = $_POST["Phonenumber"];
		$Phonenumber = sanitise_input($Phonenumber);
	}
	if (isset ($_POST["textarea"])) {
		$textarea = $_POST["textarea"];
		$textarea = sanitise_input($textarea);
	}
	

	$errMsg = "";
	$Firstname = $_POST["Firstname"];
	$Lastname = $_POST["Lastname"];
	$DateOfBirth = $_POST["DateOfBirth"];
	$StreetAdress = $_POST["StreetAdress"];
	$Suburb = $_POST["Suburb"];
	$EmailAdress = $_POST["EmailAdress"];
	$Phonenumber = $_POST["Phonenumber"];
	$textarea = trim($_POST["textarea"]);
	
	//check if first name empty
	if ($Firstname == "") {
		$errMsg .= "You must enter your first name.<br/>";
	}
	//check first name format
	else if (!preg_match("/^[a-zA-Z]*$/", $Firstname)) {
		$errMsg .= "Only alpha characters are allowed in your first name<br/>";
	}
	//check if last name empty
	if ($Lastname == "") {
		$errMsg .= "You must enter your last name.<br/>";
	}
	//check lastname format
	else if (!preg_match("/^[a-zA-Z]*$/", $Lastname)) {
		$errMsg .= "Only alpha characters are allowed in your last name<br/>";
	}
	//check if DOB empty
	if ($DateOfBirth == "") {
		$errMsg .= "You must enter your date of birth.<br/>";
	}	
	//check DOB format
	else if (!preg_match("/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})*$/", $DateOfBirth)) {
			$errMsg .= "Please enter a valid date in the format - dd/mm/yyyy<br/>";
	}
	
	//validate age is between 15 and 80
	if ($DateOfBirth != "") {
		$from = date_create_from_format('d/m/Y', $DateOfBirth);			//get date of birth of applicant 
		$to = new DateTime();											//get current age
		$age = date_diff($to, $from)->y;								//return the difference as age 
		if ($age < 15) {												//checks if age is lesser than 15
			$errMsg .= "You must be 15 years old or more !<br/>";
		}
		if ($age > 80) {												//checks if age is greater than 80
			$errMsg .= "You must not be older than 80 !<br/>";
		}
	}
	
	//check if gender is empty
	if (empty($_POST["Gender"])) {
		$errMsg .= "Gender is required<br/>";
	}
	//check if street address is empty
	if ($StreetAdress == "") {
		$errMsg .= "You must enter your street address.<br/>";
	}
	//street address pattern - letters and digits
	else if (!preg_match("/^[a-zA-Z0-9 \/]*$/", $StreetAdress)) {
		$errMsg .= "Only alpha characters and digits are allowed in your street address field<br/>";
	}
	//check if suburb is empty
	if ($Suburb == "") {
		$errMsg .= "You must enter your suburb.<br/>";
	}
	//suburb pattern - letters and digits
	else if (!preg_match("/^[a-zA-Z0-9 \/]*$/", $Suburb)) {
		$errMsg .= "Only alpha characters and digits are allowed in your suburb field<br/>";
	}
	//check if state is selected
	if (!isset ($_POST["State"])) {
		$errMsg .= "Select a State.<br/>";
	}		
	//check if email is empty
	if ($EmailAdress == "") {
		$errMsg .= "Please enter your Email Adress.<br/>";
	}
	//validate email address pattern(AUTO)
	else if (!filter_var($EmailAdress, FILTER_VALIDATE_EMAIL)) {
		$errMsg .= "Invalid email format.<br/>"; 
	}
	//check if phone number is empty
	if ($Phonenumber == ""){
		$errMsg .= "Please enter your phone number.<br/>";
	}
	//validate phone number is between 8 or 12 digits
	else if (!preg_match("/^([0-9]{8,12})*$/", $Phonenumber)) {
		$errMsg .= "Phone number must be 8 or 12 digits.<br/>";
	}
	
	//text area must not be empty if other skill checkbox selected
	if (!isset ($_POST["Skills"])){
		$errMsg .= "Please select atleast one skill.<br/>";
	}
	else foreach ($_POST["Skills"] as $selected_skills){							//get value for each checkbox selected
		if (($selected_skills == 'OtherSkills') && (!strlen($textarea) > 0)){			//other skills checkbox selected and textarea empty
				$errMsg .= "Please describe your other skills in the text box area !<br/>" ;
		}
	}
	
	//display error message if some field is invalid
	if ($errMsg != "") {
		echo "$errMsg";
	}
	
	else {
		require_once ("settings.php");								//mysql database connection settings
		
		$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
		if (!$conn) {
			echo "<p>Database connection failure</p>";
		}
		else if ($conn) {
			$JobReferenceNumber = trim($_POST["JobReferenceNumber"]);
			$Firstname = trim($_POST["Firstname"]);
			$Lastname = trim($_POST["Lastname"]);
			$StreetAdress = trim($_POST["StreetAdress"]);
			$Suburb = trim($_POST["Suburb"]);
			$State = $_POST["State"];
			$Postcode = trim($_POST["Postcode"]);
			$EmailAdress = trim($_POST["EmailAdress"]);
			$Phonenumber = trim($_POST["Phonenumber"]);
			$textarea = trim($_POST["textarea"]);
			if(isset($_POST['Skills'])){
				$Skills = implode(", ",$_POST['Skills']);    					//joins all the array elements with a string
			}
			
			$random_numbers = rand();													//for generating a random string of numbers
			$unique_ID = md5($random_numbers);											//calculate MD5 hash of the above random number 
			
			$sql_table="Applicant_Details";
			$Status = "New";
			$query = "insert into $sql_table (Unique_ID, Job_Reference_Number, First_Name, Last_Name, Street_Address, Suburb_town, State,
											  Postcode, Email_address, Phone_number, Skills, Other_skills, Status) 
						values ('$unique_ID', '$JobReferenceNumber', '$Firstname', '$Lastname', '$StreetAdress', '$Suburb', '$State', '$Postcode',
								'$EmailAdress', '$Phonenumber', '$Skills', '$textarea', '$Status')";
								
			$result = mysqli_query($conn, $query);
				
			//creates a table if it doesnt exist
			if(empty($result)) {
	            $query = "CREATE TABLE Applicant_Details (
							EOInumber 						int(11) 		AUTO_INCREMENT,
							Unique_ID						varchar(100) 	NOT NULL,
							Job_Reference_Number 			varchar(6) 		NOT NULL,			
							First_Name 						varchar(25) 	NOT NULL,
							Last_Name 						varchar(25) 	NOT NULL,
							Street_Address 					varchar(40) 	NOT NULL,
							Suburb_town 					varchar(40) 	NOT NULL,
							State 							varchar(11) 	NOT NULL,
							Postcode						int(4),			
							Email_address 					varchar(255) 	NOT NULL,
							Phone_number 					int(12),			
							Skills 							varchar(255) 	NOT NULL,
							Other_skills					varchar(500) 	NOT NULL,
							Status							varchar(50) 	NOT NULL,
							PRIMARY KEY 					(EOInumber)
							)";
				$result = mysqli_query($conn, $query);
				echo "<p>Please refresh page</p>";
			}
			
			else if(!$result) {
				echo "<p>Something is wrong with ", $query, "</p>";
			}
			else {
				$EOInumber = mysqli_insert_id($conn);
				echo "<p>Your Application has been submitted.</p>";
				echo "<p>Your EOInumber is <strong>", "<span style=\"color: red;\"> $EOInumber </span>" ,"</strong> and Unique-ID is <strong>", "<span style=\"color: red;\"> $unique_ID </span>", "</strong>Please note these down !</p>"; 
			}
			mysqli_close($conn);
		}
	}
?>
