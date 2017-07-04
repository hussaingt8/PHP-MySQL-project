/* Filename: apply.js
   Target html: apply.html
   Purpose : demonstrate form data validation using JS
   author : Hussain
   Date written: 20/4/2016
   Revisions:  1/5/2016
*/

/*Validation rules
- First name max 25 alpha characters
- Last name max 25 alpha characters
- Street Address max 40 characters
- Suburb/town max 40 characters
- Postcode exactly 4 digits
- Email address valid format
- Phone number 8 to 12 digits, or spaces
- For the date of birth text field, a valid date must be entered in valid dd/mm/yyyy format.
- Applicants must be at between 15 and 80 years old at the time they fill in the form.  
- The selected state must match the first digit of the postcode  
- VIC = 3 OR 8, NSW = 1 OR 2 ,QLD = 4 OR 9 ,NT = 0 ,WA = 6 ,SA=5 ,TAS=7 ,ACT= 0
- If the “Other skills...” is selected in the Skills Checkbox list, the Other Skills text area cannot be blank.
*/

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
//SOME CODE IS INSPIRED BY THE CAT DEMO CODE FROM THE LECTURE. EVERYTHING ELSE IS ORIGINAL CODE.             
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

var gErrorMsg = "";
var gColor = "#ff3333";

//check the input data from various controls are valid format
//display error message if not valid
function validateApplyForm(){
 "use strict";   //directive to ensure variables are declared
   var isAllOK = false;  
   gErrorMsg = "";  //reset error message
   var nameOK = chkName(); 
   var dobOK = isDobOK();
   var ApplicantAddressOK = chkApplicantAddress();
   var postCodeOK = chkPostCode();
   var postCodeDigitOK = chkPostCodeDigit();
   var emailOK = chkEmail();
   var phoneOK = chkPhone();
   var skillsOK = chkOtherSkills();

   if (nameOK && dobOK && ApplicantAddressOK && postCodeOK && postCodeDigitOK && emailOK && phoneOK && skillsOK) {  
      isAllOK = true;
   } 
   
   if (isAllOK) {
	   storeFormDetails()  //stores form in sessionStorage if form validates 
   }
   
   else {
	   gErrorMsg = gErrorMsg + "Please check if all your details are valid";
	   alert(gErrorMsg)
	   isAllOK = false;
   }
   return isAllOK;
}

// check applicant's name is a valid format
// check for an empty field
function chkName () {
	var applicant = document.getElementById("Firstname").value;
	var pattern = /^[a-zA-Z ]+$/     //check only alpha characters or space  
	var nameOk = true;
	if (applicant.length == 0){        
		document.getElementById("firstnameerror").innerHTML = "<font color="+gColor+">First name cannot be blank !</font>"; 
		nameOk = false;
	}	
	else if (!pattern.test(applicant)){
		document.getElementById("firstnameerror").innerHTML = "<font color="+gColor+">Your name must only contain alpha characters !</font>"; 
		nameOk = false;  
	}
	else{
		nameOK = true;
		document.getElementById("firstnameerror").innerHTML = ""; 
	}
	
	var applicantLN = document.getElementById("Lastname").value;
	var patternLN = /^[a-zA-Z-]+$/      //check only alpha characters or space  
	if ((applicantLN.length == 0)){    
		document.getElementById("lastnameerror").innerHTML = "<font color="+gColor+">Last  name cannot be blank !</font>"; 
		nameOk = false; 
	}
	else if (!patternLN.test(applicantLN)){
		document.getElementById("lastnameerror").innerHTML = "<font color="+gColor+">Your name must only contain alpha characters !</font>"; 
		nameOk = false;  //checks for correct pattern
	}
	else {
		nameOK = true;
		document.getElementById("lastnameerror").innerHTML = ""; 
	}
	
	return nameOk;
}

//check date format is ok 
//check applicant is between 15 and 80 years of age when applying.
function isDobOK(){
	var validDOB = true;   //set to false if not ok
	var now = new Date();   //current date-time
	var dob = document.getElementById("DateOfBirth").value;
	var dateMsg = "";
	var dmy = dob.split("/");   //split date into array with elements dd mm yyy 
	var allNumbers = true;
	for (var i = 0; i < dmy.length; i++){
		if(isNaN(dmy[i])){
			document.getElementById("DOBerror").innerHTML = "<font color="+gColor+">Date of birth must only consist of numbers !</font>"; 
			validDOB = false;
		}
		else {
			validDOB = true;
			document.getElementById("DOBerror").innerHTML = ""; 
		}
	}
   
   	if ((dmy[0] <1) || (dmy[0] > 31)){   //day
		document.getElementById("DOBerror").innerHTML = "<font color="+gColor+">Please eneter a day between 1 and 31 !</font>";
		validDOB = false;
	}
	if ((dmy[1] <1) || (dmy[1] > 12)){   //month
		document.getElementById("DOBerror").innerHTML = "<font color="+gColor+">Month must be between 1 and 12 !</font>";
		validDOB = false;
	}
	if ((dmy[2] < now.getFullYear() - 80)) {    //check if 80 years old or lesser
		document.getElementById("DOBerror").innerHTML = "<font color="+gColor+">You must be 80 years old or less !</font>";
		validDOB = false;
	}
	if ((dmy[2] > now.getFullYear() - 15 )) {    //to check is 15 years old or greater
		document.getElementById("DOBerror").innerHTML = "<font color="+gColor+">You must be 15 years old or more !</font>";
		validDOB = false;
	}
	if (dmy[2] > now.getFullYear()){   //cannot not be greater than current year
		document.getElementById("DOBerror").innerHTML = "<font color="+gColor+">You aren't born yet !</font>";
		validDOB = false;
	}
	else if (validDOB) {
		document.getElementById("DOBerror").innerHTML = ""; 
	}
	return validDOB;
}

//validate applicanst address
function chkApplicantAddress() {
	var streetAddress = document.getElementById("StreetAdress").value; 
	var suburb_town = document.getElementById("Suburb").value;
	var pattern = /^[a-zA-Z0-9 /]+$/  
	var result = true;
	
	if (streetAddress.length == 0) {
		document.getElementById("streeterror").innerHTML = "<font color="+gColor+">Address cannot be blank !</font>";
		result = false;
	}
	else if (!pattern.test(streetAddress)){
			document.getElementById("streeterror").innerHTML = "<font color="+gColor+">Your street address can only contain alpha characters or digits !</font>";
			result = false; 
	}
	else {
		result = true;
		document.getElementById("streeterror").innerHTML = ""; 
	}

	if (suburb_town.length == 0) {
		document.getElementById("suburberror").innerHTML = "<font color="+gColor+">Please enter your suburb/town !</font>";
		result = false;
	}
	else if (!pattern.test(suburb_town)){
			document.getElementById("suburberror").innerHTML = "<font color="+gColor+">Your suburb/town can only contain alpha characters or digits !</font>";
			result = false; 
	}
	else {
		result = true;
		document.getElementById("suburberror").innerHTML = "";
	}
	
	return result;
}

//validates Postcode
function chkPostCode(){
	var postCode = document.getElementById("Postcode").value;
	var pattern = /^\d{4}$/
	var result = true;
	
	//makes sure postcode is not empty
	if (postCode.length == 0){        
		document.getElementById("postcodeerror").innerHTML = "<font color="+gColor+">Please enter a postcode !</font>";
		result = false;
	}
	//makes sure posticde enetered is only digits
	else if(isNaN(postCode)){
		document.getElementById("postcodeerror").innerHTML = "<font color="+gColor+">You must enter only numbers as a postcode !</font>";
		result = false;
    }
	//makes sure Postcode has 4 digits only
	else if (!pattern.test(postCode)) {
		document.getElementById("postcodeerror").innerHTML = "<font color="+gColor+">Post code must be exactly 4 digits !</font>";
		result = false;
	}
	else {
		result = true;
		document.getElementById("postcodeerror").innerHTML = "";
	}
	return result;
}

//validate first digit of postcode against state selected
function chkPostCodeDigit(){
	var postCode = document.getElementById("Postcode").value;
    var PC_String = postCode.toString();  			//converts postcode to string
	var PC_First_Char = PC_String.charAt(0);  		//gets the first character of the string at index 0
	var PC_First_Digit = parseInt(PC_First_Char);	//gets first character of string and converts to number
	var State = document.getElementById("State").selectedIndex;  //gets the index of the selected state
	var result = false;
		
	switch (State){
		//Makes sure a state is selecetd
		case 0:
			document.querySelector("#postcodeerror").innerHTML = "<font color="+gColor+">Please select a State First !</font>";
			break;
		//validates first didgit of postcode for VIC
		case 1:
			if (PC_First_Digit == 3 || PC_First_Digit == 8) {
				result = true;
			}
			else {
				document.querySelector("#postcodeerror").innerHTML = "<font color="+gColor+">Post code for VIC should start with a 3 or 8 !</font>";
				result = false;	
			}
			break;
		//validates first didgit of postcode for NSW
		case 2:
			if (PC_First_Digit == 1 || PC_First_Digit == 2) {
				result = true;
			}
			else {
				document.querySelector("#postcodeerror").innerHTML = "<font color="+gColor+">Post code for NSW should start with a 1 or 2 !</font>";
				result = false;	
			}
			break;
		//validates first didgit of postcode for QLD
		case 3:
			if (PC_First_Digit == 4 || PC_First_Digit == 9) {
				result = true;
			}
			else {
				document.querySelector("#postcodeerror").innerHTML = "<font color="+gColor+">Post code for QLD should start with a 4 or 9 !</font>";
				result = false;	
			}
			break;
		//validates first didgit of postcode for NT
		case 4:
			if (PC_First_Digit == 0) {
				result = true;
			}
			else {
				document.querySelector("#postcodeerror").innerHTML = "<font color="+gColor+">Post code for NT should start with a 0 !</font>";
				result = false;	
			}
			break;
		//validates first didgit of postcode for WA
		case 5:
			if (PC_First_Digit == 6) {
				result = true;
			}
			else {
				document.getElementById("#postcodeerror").innerHTML = "<font color="+gColor+">Post code for WA should start with a 6!</font>";
				result = false;	
			}
			break;
		//validates first didgit of postcode for SA
		case 6:
			if (PC_First_Digit == 5) {
				result = true;
			}
			else {
				document.getElementById("postcodeerror").innerHTML = "<font color="+gColor+">Post code for SA should start with a 5!</font>";
				result = false;	
			}
			break;
		//validates first didgit of postcode for TAS
		case 7:
			if (PC_First_Digit == 7) {
				result = true;
			}
			else {
				document.getElementById("postcodeerror").innerHTML = "<font color="+gColor+">Post code for TAS should start with a 7 !</font>";
				result = false;	
			}
			break;
		//validates first didgit of postcode for ACT
		case 8:
			if (PC_First_Digit == 0) {
				result = true;
			}
			else {
				document.getElementById("postcodeerror").innerHTML = "<font color="+gColor+">Post code for ACT should start with a 0 !</font>";
				result = false;	
			}
			break;
	}
	return result;
}

//check the pattern of email
function chkEmail () {  
	var email = document.getElementById("EmailAdress").value;
	var pattern = /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-za-zA-Z0-9.-]{1,4}$/;
	var result = true; 
	
	if (email.length == 0){        
		document.getElementById("emailerror").innerHTML = "<font color="+gColor+">Your email cannot be blank !</font>";
		result = false;
	}
	else if (!pattern.test(email)){
		document.getElementById("emailerror").innerHTML = "<font color="+gColor+">Please enter a valid email format !</font>";
		result = false;
	}
	else {
		result = true;
		document.getElementById("emailerror").innerHTML = "";
	}
	return result;
}

//validates phone number
function chkPhone() {
	var phoneNumber = document.getElementById("Phonenumber").value;
	var pattern = /^\d{8,12}$/
	var validPhone = true;
	
	if (phoneNumber.length == 0){ 
		document.getElementById("phoneerror").innerHTML = "<font color="+gColor+">Your phone number cannot be blank !</font>";	
		result = false;
	}
	else if(isNaN(phoneNumber)){
		document.getElementById("phoneerror").innerHTML = "<font color="+gColor+">You must enter only digits for phone number !</font>";	
		validPhone = false;
    }
	else if (!pattern.test(phoneNumber)){
		document.getElementById("phoneerror").innerHTML = "<font color="+gColor+">Your phone number must be between 8-12 digits !</font>";
		validPhone = false;
	}
	else {
		result = true;
		document.getElementById("phoneerror").innerHTML = "";
	}
	return validPhone;
}

//if other skills checked description to be provided in textbox
function chkOtherSkills(){
	var comments = document.getElementById("comments").value;
	var checkBox = document.getElementById("otherskills");
	result = true;
	
	if ((comments == 0) && (checkBox.checked)){         //other skills checked and textarea empty
		document.getElementById("skillerror").innerHTML = "<font color="+gColor+">Please inform us about your other skills !</font>";
		result = false;
	}
	else {
		result = true;
		document.getElementById("skillerror").innerHTML = "";
	}
	return result;
}

function storeFormDetails(){
	var Firstname = document.getElementById("Firstname").value;
	var Lastname = document.getElementById("Lastname").value;
	var DateOfBirth = document.getElementById("DateOfBirth").value;
	var StreetAdress = document.getElementById("StreetAdress").value;
	var Suburb = document.getElementById("Suburb").value;
//var State = document.getElementById("State").selectedIndex.value;
	var Postcode = document.getElementById("Postcode").value;
	var EmailAdress = document.getElementById("EmailAdress").value;
	var Phonenumber = document.getElementById("Phonenumber").value;
	var comments = document.getElementById("comments").value;
	
	sessionStorage.Firstname = Firstname;
	sessionStorage.Lastname = Lastname;
	sessionStorage.DateOfBirth = DateOfBirth;
	sessionStorage.StreetAdress = StreetAdress;
	sessionStorage.Suburb = Suburb;	
//sessionStorage.State = State;	
	sessionStorage.Postcode = Postcode;
	sessionStorage.EmailAdress = EmailAdress;
	sessionStorage.Phonenumber = Phonenumber;
	sessionStorage.comments = comments;
}

function getFormDetails(){
	if (sessionStorage.Firstname != null){
		document.getElementById("Firstname").value = sessionStorage.Firstname;
		document.getElementById("Lastname").value = sessionStorage.Lastname;
		document.getElementById("DateOfBirth").value = sessionStorage.DateOfBirth;
		document.getElementById("StreetAdress").value = sessionStorage.StreetAdress;
		document.getElementById("Suburb").value =sessionStorage.Suburb;
		document.getElementById("Postcode").value = sessionStorage.Postcode;
		document.getElementById("EmailAdress").value = sessionStorage.EmailAdress;
		document.getElementById("Phonenumber").value = sessionStorage.Phonenumber;
		document.getElementById("comments").value = sessionStorage.comments;
	}
	
}

//gets the job reference number from local storage
function getJobRefernceNumber(){
	if (localStorage.getItem("applyjobs1") !== null) {
	document.getElementById("jrn").value = localStorage.getItem("applyjobs1");
	}
	else if (localStorage.getItem("applyjobs2") !== null) {
	document.getElementById("jrn").value = localStorage.getItem("applyjobs2");
	}
}

//highlights the active menu link of the current page
function Highlight_page() { 
	var url = location.href.split("/");  //gets the url of the current page
	var navLinks = document.getElementsByTagName("nav")[0].getElementsByTagName("a"); //gets all the menu links from HTML page in the nav tag
	var i = 0;
	var currentPage = url[url.length - 1];
	for(i; i < navLinks.length; i++){
		var lb = navLinks[i].href.split("/");
		if(lb[lb.length-1] == currentPage) {
			navLinks[i].className = "active"; //access the CSS script to change the menu style of the active page
		}
	}
 }

//check field as soon as focus is lost
function validateInputOnBlur(){
	var objectLostFocus_id = this.id;
	var isOk = false;
	
	switch (objectLostFocus_id){
		case "Firstname": 
			isOk = chkName();
			break;		
		case "Lastname": 
			isOk = chkName();
			break;
		case "DateOfBirth": 
			isOk = isDobOK();
			break;
		case "StreetAdress":
			isOk = chkApplicantAddress();
			break;	
		case "Suburb":
			isOk = chkApplicantAddress();
			break;
		case "Postcode": 
			isOk = chkPostCode();
			break;
		case "EmailAdress": 
			isOk = chkEmail();
			break;
		case "Phonenumber": 
			isOk = chkPhone();
			break;
	}
	
	if (!isOk) {
		document.getElementById(objectLostFocus_id).style.borderColor = "red"; 
        document.getElementById(objectLostFocus_id).style.backgroundColor = "lightgray";
		gErrorMsg = "";
	}
}

//reset the text field background to white after user has clicked in it 
function resetFormat(){
   var clicked_id = this.id;    //gives us the id of the input control that was clicked
   document.getElementById(clicked_id).style.backgroundColor = "white";
   document.getElementById(clicked_id).style.borderColor = "grey";
}

//register onblur events for all the input elements
//an onblur event occurs when an element loses focus
function registerInputsOnBlur(){   
	var inputElements = document.getElementById("regform").getElementsByTagName("input");
	for (var i = 0; i < inputElements.length; i++){
		inputElements[i].onblur = validateInputOnBlur;
	}
}

//register onclick events for all the input elements
//when the user clicks in an input to fix it remove the error highlighting
function registerInputsOnClick(){   
	var inputElements = document.getElementById("regform").getElementsByTagName("input");
	for (var i = 0; i < inputElements.length; i++){
		inputElements[i].onclick = resetFormat;
	}
}

//if validateForm returns returns false nothing will be sent to the server
function init() {
	var form = document.getElementById("regform");
	var regform = document.getElementById("regform");
	//registerInputsOnBlur();
	//registerInputsOnClick();
	Highlight_page();
	//regform.onsubmit = validateApplyForm;
	getFormDetails();
	getJobRefernceNumber();

}

window.onload = init; 