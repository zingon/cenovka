$(document).ready(function() {
	window.App.Contacts = {}

	var contacts = "#contacts";
	var search = "#search";

	loadContacts(contacts);

	$(contacts).on("click", ".delete", function() {
		deleteContact(contacts, $(this).data("id"));
	});

	$(contacts).on("click", ".edit", function() {
		editContact($(this).data("id"));
	});

	$(search).keyup(function() {
      if($(this).val().length>0) {

        searchContacts(contacts,$(this).val());
      } else {
        loadContacts(contacts);
      }
  });
});