<?php
	// The if isset prevents the loading of this file directly from the URL
	if (isset ($option)) {
		// defines the array of menu options. 
		// This is a demonstration of a 2 dimensional array
		$menuOptions = array (
					array ("index.php", "About Us"),
					array ("jobs.php", "Careers"),
					array ("apply.php", "Apply for job"),
					array ("about.php", "Leadership"),
				);

		echo "<p class=\"rclogo\">";
		echo '<img src="images/royalcyberlogo.png" height="65" width="273" alt="rclogo"/>'; 
		echo "</p>";
		
		// Generates the nav bar with hyperlinks
		echo "<nav>";
		// Loops through the menu options
		for ($i = 0; $i < count ($menuOptions); $i++) {
			// [0] refers to the first element, while [1] refers to the second element
			echo "<a href=\"{$menuOptions[$i][0]}\">{$menuOptions[$i][1]}</a>";
		}
		echo "</nav>";
	} else {
		// Redirects to the home page if loaded directly
		header ("location: index.php");
	}
?>