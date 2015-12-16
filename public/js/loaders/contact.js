function loadContacts(target) {
	$.get(localStorage.ContactsUrl,function(response) {
		contactTemplate(response,target);
    window.App.Contacts = response;
	});
}

function deleteContact(contacts, contactId) {
  var url = localStorage.ContactDeleteUrl.replace("0",contactId);
  $.delete(url,{id: contactId},function(response) {
    loadContacts(contacts);
    message(response);
  });
}

function editContact(contactId) {
  var url = localStorage.ContactEditUrl.replace("0",contactId);
  $.get(url,function(response){
    modalTemplate("large",response);
  ;});
}

function searchContacts(target,string) {
  var contacts = [];

  if (typeof window.App.Contacts == "object") {
    var elementsToFilter = ["name","firstname","lastname","city","zip_code","adress","ic","dic","email","phone","note"];
    //console.log(window.App.Items);
    $.each(window.App.Contacts, function(key,value){
       if(searchObject(value,string,elementsToFilter)){
        //console.log("necoo")
        contacts.push(value);
       }
    });
    contactTemplate(contacts, target);
  }

}
