// JavaScript Document
function Snackbar(text) {
    var x = document.getElementById("snackbar");
	x.innerHTML=text;
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}