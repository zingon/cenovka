$(document).ready(function() {

	var sidenav = ".side-nav";
	var table = "#settingTable";

	if(!(window.location.hash.length > 0)) {
		window.location.hash = $(sidenav).first().find('li a').first().attr("href");
		getSettingPage(window.location.hash);
	} else {
		getSettingPage(window.location.hash);
	}


});