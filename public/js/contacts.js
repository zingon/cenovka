$(document).ready(function() {
	window.App.Contacts = {}
	window.App.pagination.onPage = 20;
	window.App.pagination.element = "#pagination";
	init();
});

function init() {
	var contacts = "#contacts";
	var search = "#search";
	loadContacts(contacts);
	$(search).keyup(function() {
		if ($(this).val().length > 0) {
			searchContacts(contacts, $(this).val());
		} else {
			loadContacts(contacts);
		}
	});
	$(contacts).on("click", ".delete", function() {
		deleteContact(contacts, $(this).data("id"));
	});
	$(contacts).on("click", ".edit", function() {
		editContact($(this).data("id"));
	});
}

function reload() {
	var contacts = "#contacts";
	var search = "#search";
	if($(search).val().length>0) {
		searchContacts(contacts, $(search).val());
	} else {
		loadContacts(contacts);
	}
}