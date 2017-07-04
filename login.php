<!DOCTYPE html>
<html lang="en">
   <head>
        <meta charset="utf-8" />
        <meta name="description" content="Login page" />
        <meta name="keywords" content="HTML, CSS, JavaScript" />
        <meta name="author" content="Hussain" />
		<title>Login Page</title>
        <link rel="stylesheet" href="styles/login.css" />
		<!-- REFERENCE TO CODE : http://www.tutorialspoint.com/php/php_mysql_login.htm -->      
    </head>
   
	<body>
	
    <div id = "div1">
        <div id="div2">
			<div id="div3"><strong>Login</strong></div>				
				<div id="div4">
              
				<form method = "post">
					<label>UserName:&#160;</label><input type="text" name="username" class="box"/><br /><br />
					<label>Password:&#160;&#160;</label><input type="password" name="password" class="box" /><br/><br />
					<input type="submit" value="Submit"/><br />
				</form>
					
			</div>
		</div>
    </div>
   </body>
</html>

<?php
   include("settings.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
		$myusername = mysqli_real_escape_string($conn, $_POST['username']);
		$mypassword = mysqli_real_escape_string($conn, $_POST['password']); 
      
		$sql = "SELECT * FROM login_details WHERE username = '$myusername' and passcode = '$mypassword'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active = $row['active'];
      
		$count = mysqli_num_rows($result);
      
		// If result matched $myusername and $mypassword, table row must be 1 row
		
		if($count == 1) {
			session_register("$myusername");
			$_SESSION['login_user'] = $myusername;
         
			header("location: manage.php");
		}
		else {
			$error = "<p style = \"font-size:15px; color:#cc0000; text-align:center\">Your Login Name or Password is invalid !</p>";
			echo $error;
		}
	}
?>
