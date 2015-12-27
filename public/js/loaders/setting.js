function getSettingPage(name) {
	var fullName = name + "Setting";

	$.get(localStorage[fullName],function(data) {
		console.log(data);
	});
}