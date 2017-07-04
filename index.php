<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="About Royal Cyber Company" />
        <meta name="keywords" content="HTML, CSS, Royal Cyber" />
        <meta name="author" content="Hussain" />
        <title>Royal Cyber: About US</title>
        <!-- CSS refrence -->
        <link rel="stylesheet" href="styles/index.css" />
        <!-- References to external responsive CSS file -->
        <link href="styles/indexresponsive.css" rel="stylesheet" media="screen and (max-width:1024px)" />
		<!-- References to external javascript file -->
		<script src="scripts/highlight.js"></script>
    </head>
    <body>
        <header id="indexheader">
			
			<?php
				// highlight the third menu option
				$option = 1;
				include_once ("php_menu.php");
			?>
			
            <h1 id="indexh1">To go further than the ordinary</h1>
            <p id="h1para">At Royal Cyber, we help organizations to streamline their business operations<br />
			and compete in the global marketplace by providing cutting edge IT services.</p>
        </header>
		
        <img id="hand" src="images/who-we-are.png" alt="hand" />
		
        <section id="s1">
            <h2>Who we are ?</h2>
            <p>	
			Royal Cyber is a Modernized e-Business Solutions provider specializing in <br /> software deployment. 
			We are an IBM Premier Business Partner, an IBM <br /> 
			Authorized trainer and Microsoft Certified Gold Partner.</p>
            <p>	Since its inception in 2002, our experts have been leaders in providing <br />
			exceptional and award winning services to organizations of different<br />
			industry verticals all across the globe.</p>
            <p>	Headquartered in Sydney, we have a global footprint with offices <br />
			and development centers across Austrlalia, Asia, Europe, Africa and <br />
			the Middle East region. Our strategic move of establishing an offshore <br />
			center in Asia has helped us to reduce costs and provide highly <br />
			competitive rates to our valued clients without compromising over quality.</p>
        </section>
		
        <div id="img">
            <img class="image" src="images/logo1.GIF" alt="Focus On Clients" height="500" width="466" />
            <img class="image" src="images/logo2.GIF" alt="Domain Excellence" height="500" width="466" />
            <img class="image" src="images/logo3.GIF" alt="Core Values" height="500" width="466" />
        </div>
		
        <div id="endpart">
            <aside>
                <p id="center1"><strong>Get In Touch</strong>
                    <br />We are waiting to hear from you.</p>
            </aside>
            <footer>
                <p>Copyright © 2002-2016&#160;<a href="https://www.royalcyber.com/company/about-us">RoyalCyber</a>&#160;All Rights Reserved</p>
            </footer>
        </div>
		
    </body>
</html>