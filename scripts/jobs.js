/* Filename: jobs.js
   Target html: jobs.html
   Purpose : store job reference number in local storage
   author : Hussain
   Date written: 25/4/2016
   Revisions:  25/4/2016
*/

//highlights the active menu link of the current page
function Highlight_page() { 
	var url = location.href.split("/");
	var navLinks = document.getElementsByTagName("nav")[0].getElementsByTagName("a");
	var i = 0;
	var currentPage = url[url.length - 1];
	for(i; i < navLinks.length; i++){
		var lb = navLinks[i].href.split("/");
		if(lb[lb.length-1] == currentPage) {
			navLinks[i].className = "active";
		}
	}
 }

//stores the respective job number of the job applied for in application form
function job1_storeJRN(){	
	localStorage.removeItem("applyjobs2");
    localStorage.setItem("applyjobs1", "SA1234");
}

function job2_storeJRN(){	
	localStorage.removeItem("applyjobs1");
    localStorage.setItem("applyjobs2", "TCW123");
}

function init() {
	var ApplyJob1 = document.getElementById("applyjobs1"); 
	var ApplyJob2 = document.getElementById("applyjobs2");
	ApplyJob1.onclick = job1_storeJRN;
	ApplyJob2.onclick = job2_storeJRN;
	Highlight_page();
}

window.onload = init;