m<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Careers Form" />
        <meta name="keywords" content="HTML, CSS, JavaScript" />
        <meta name="author" content="Hussain" />
        <title>Career Form</title>
        <link rel="stylesheet" href="styles/styles.css" />
        <!-- References to external responsive CSS file -->
        <link href="styles/applyresponsive.css" rel="stylesheet" media="screen and (max-width:1024px)" />
		<!-- References to external javascript file -->
		<script src="scripts/apply.js"></script> 
    </head>
    <body id="applybody">
			<header>
			<?php
				// highlight the third menu option
				$option = 3;
				include_once ("php_menu.php");
			?>
			</header>
		
        <form id="regform" method="post" action="validation.php" novalidate="novalidate">
            <fieldset id="jbn">
                <legend id="jbn1">Job Reference Number</legend>
                <input class="numbers" id="jrn" type="text" maxlength="6" name="JobReferenceNumber" pattern="[A-Za-z\d]{6}" readonly="readonly" required="required" />
            </fieldset>
			
            <fieldset class="left">
                <legend>Personal Details</legend>
                <p>
                    <label for="Firstname">First name</label>
                    <br />
                    <input type="text" id="Firstname" name="Firstname" value="" pattern="[A-Za-z]+" title="Use Alphabets only" required="required" maxlength="25" />
					<br/><span id="firstnameerror"></span>
                </p>
                <p>
                    <label for="Lastname">Last name</label>
                    <br />
                    <input type="text" id="Lastname" name="Lastname" pattern="[A-Za-z]+" title="Alphabets only" required="required" maxlength="25" />
					<br/><span id="lastnameerror"></span>
                </p>
                <p>
                    <label for="DateOfBirth">Date Of Birth</label>
                    <br />
                    <input class="numbers" name="DateOfBirth" id="DateOfBirth" placeholder="dd/mm/yy" pattern="\d{1,2}/\d{1,2}/\d{2}" required="required" />
					<br/><span id="DOBerror"></span>
                </p>
                <label for="Gender">Gender</label>
                <br />
                <input type="radio" id="Gender" name="Gender" value="Male" required="required" /> Male<br/>
				<input type="radio" name="Gender" value="Female" /> Female<br/>
				<input type="radio" name="Gender" value="Other" /> Other 
			</fieldset>
			
            <fieldset class="left">
                <legend>Contact Details</legend>
                <p>
                    <label for="StreetAdress">Street Adress</label>
                    <br />
                    <input type="text" id="StreetAdress" name="StreetAdress" maxlength="40" required="required" /><br/>
					<span id="streeterror"></span>
                </p>
                <p>
                    <label for="Suburb">Suburb/Town</label>
                    <br />
                    <input type="text" id="Suburb" name="Suburb" maxlength="40" required="required" /><br/>
					<span id="suburberror"></span>
                </p>
				
                <label for="State">State</label>
                <br />
                <select id="State" name="State" required="required">
				<option value="" disabled selected hidden>Please Select</option>
                    <option id="VIC" value="VIC">VIC</option>
                    <option id="NSW" value="NSW">NSW</option>
                    <option id="QLD" value="QLD">QLD</option>
                    <option id="NT" value="NT">NT</option>
                    <option id="WA" value="WA">WA</option>
                    <option id="SA" value="SA">SA</option>
                    <option id="TAS" value="TAS">TAS</option>
                    <option id="ACT" value="ACT">ACT</option>
                </select>
                <p>
                    <label for="Postcode">Postcode</label>
                    <br />
                    <input maxlength="4" type="text" name="Postcode" id="Postcode" pattern="\d{4}" placeholder="4 digits" required="required" />
					<br/><span id="postcodeerror"></span>
                </p>
                <p>
                    <label for="EmailAdress">Email adress</label>
                    <br />
                    <input type="email" name="EmailAdress" id="EmailAdress" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="jack@hotmail.com" />
					<br/><span id="emailerror"></span>
                </p>
                <label for="Phonenumber">Phone number</label>
                <br />
                <input type="text" name="Phonenumber" id="Phonenumber" pattern="\d{8,12}" title="8-12 digits" required="required" />
				<br/><span id="phoneerror"></span>
            </fieldset>
			
            <fieldset class="left">
                <legend>Skills</legend>
                <div id="checkbox">
                    <input type="checkbox" name="Skills[]" value="HTML"/>HTML<br/><br/>
					<input type="checkbox" name="Skills[]" value="CSS" />CSS<br/><br/>
					<input type="checkbox" name="Skills[]" value="JavaScript" />JavaScript<br/><br/>
					<input type="checkbox" name="Skills[]" value="PHP" />PHP<br/><br/>
					<input type="checkbox" name="Skills[]" value="MySQL" />MySQL<br/><br/>
					<input id="otherskills" type="checkbox" name="Skills[]" value="OtherSkills" />Other Skills<br/><br/> 
				</div>
				
				<aside>
				<label for="comments">Other Skills</label>
				<textarea id="comments" name="textarea" placeholder="Provide a description of other skills that you possess..."></textarea>
				<br/><span id="skillerror"></span>
				</aside>
		   </fieldset>
            <br />
            <input class="full" type="submit" value="Apply" />
            <input class="full" type="reset" value="Reset form" />
        </form>
    </body>
</html>