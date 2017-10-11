/** FileMaker PHP Site Assistant Utility Functions for iPhone and iPod Touch */

window.onorientationchange = updateOrientation;
window.onscroll = onScrollHandler;

function onLoadHandler() {
	updateOrientation();
	window.scrollTo(0, 0);
	
	var loc = location.href;
	if(loc.match("recordlist.php") != null ) {
		document.getElementById("recordlist_nav_range").style.opacity = "1";
		setTimeout ( "hideRecListRange()", 3000 );
	}
}

function onScrollHandler() {
	var offset = window.pageYOffset;
	if(offset <= 20) {
		offset = 20;
	}
	document.getElementById("dock").style.top = offset + "px";
}

// =======================================================
	
function scrollToTop() {
	window.scrollTo(0, 0);
	onScrollHandler();
}

function goToSortList() {
	// TODO
	nudgePage();
}

function openUrl(url) { 
	location = url;
}

function hideRecListRange() {
	document.getElementById("recordlist_nav_range").style.opacity = "0";
}

function updateOrientation() {
	var orientation = window.orientation;
	switch(orientation) {
		case 0:
			document.body.setAttribute("class","portrait");
			break;          
		case 90:
		case -90:
			document.body.setAttribute("class","landscape");
			break;
	}
}

function nudgePage() {
	setTimeout ( "onScrollHandler()", 100 );
}

// =============Find Page==========================================

function clearSearch(id) {
	var field = document.getElementById(id);
	field.value = '';
	document.getElementById("clear" + id).style.visibility = "hidden";
	showFindBackground(id);
}

function findFocusHandler(id) {
	var field = document.getElementById(id);
	if (field.value.length == 0) {
		document.getElementById("clear" + id).style.visibility = "hidden";
	}
	else if (field.value.length >= 1) {
		document.getElementById("clear" + id).style.visibility = "visible";
	}
	
	findOnClickHandler(id);
}

function findOnClickHandler(id) {
	document.getElementById(id).style.background = "none";
}

function findOnBlurHandler(id) {
	var field = document.getElementById(id);
	if (field.value.length == 0) {
		showFindBackground(id);
	}
	nudgePage();
}

function showFindBackground(id) {
	document.getElementById(id).style.background = "url(images/find_field.png) no-repeat 3px center";
}