/* Filename: highlight.js
   Target html: index.html, about.html
   Purpose : higlight the menu link of the current page
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

function init() {
	Highlight_page();
}

window.onload = init;