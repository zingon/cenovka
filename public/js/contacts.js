function ContactController(App,data) {
	this.App = App;
	this.App.Contacts = data;
	this.App.helpers.contact = new ContactHelpers(App.helpers.global);

	this.App._pagination.onPage = 15;

	this.parts = {}

	this.init = function() {
		this.parts.contacts = "#contacts";
		this.parts.search = "#search";

		this.eventSetup();

		var filtered = this.contactChecker(this.App.Contacts);
		this.App.helpers.contact.insertContacts(filtered,this.parts.contacts);
	}

	this.setContacts = function(data) {
		this.App.Contacts = data;
	}

	this.reloader = function() {
		var parentThis = this;
		$.get(parentThis.App.getUrl("ContactsUrl"),function(contacts) {
			parentThis.setContacts(contacts);
			var filtered = parentThis.contactChecker(parentThis.App.Contacts);
			parentThis.App.helpers.contact.insertContacts(filtered,parentThis.parts.contacts);
		});
	}


	this.paginate = function(data) {
		var paginationInst = new Pagination(data);
		paginationInst.init(this.App._pagination);
		paginationInst.setupEventOnClick(this.changePage,this);
		
		this.App.helpers.contact.insert(paginationInst.generatePagination(),"#pagination");
		return paginationInst.getItems();
	}

	this.changePage = function(page,firstThis) {
		firstThis.App._pagination.page = page;
		firstThis.contactChanger();
	}

	this.contactChecker = function(items) {
		var search = "";
		var filtered = items;
		if($(this.parts.search).length>0) {
			search = $(this.parts.search).val();
			filtered = this.App.helpers.contact.contactSearch(search,filtered);
		}
		return this.paginate(filtered);
	}

	this.contactChanger= function() {
		var filtered = this.contactChecker(this.App.Contacts);
		this.App.helpers.contact.insertContacts(filtered,this.parts.contacts);
	}

	this.eventSetup = function() {
		var parentThis = this;
		$(this.parts.search).keyup(function() {
			parentThis.contactChanger();
		});

		//Mazání
		$(parentThis.parts.contacts).on("click", ".delete", function() {
			parentThis.App.helpers.contact.deleteContact($(this).data("id"),parentThis.App.getUrl("ContactDeleteUrl"));
			parentThis.reloader();
		});

		//Editace
		$(parentThis.parts.contacts).on("click", ".edit", function() {
			parentThis.App.helpers.contact.editContact($(this).data("id"),parentThis.App.getUrl("ContactEditUrl"));
		});
	}
}

function ContactHelpers(globalHelpers) {
	this.globalHelpers = globalHelpers;

	this.insertContacts = function(contacts, target) {
		this.insert($.render.contactRow(contacts),target);
	}
	
	this.insert=function(what,where) {
		$(where).html(what);
	}


	this.contactSearch= function(text,data) {
		var contacts = [];
		if(!(text.length >0)) {
			return data;
		}
	  if (typeof data == "object") {
	    var elementsToFilter = ["name","firstname","lastname","city","zip_code","adress","ic","dic","email","phone","note"];
	    //console.log(window.App.Items);
	    $.each(data, function(key,value){
	       if(searchObject(value,text,elementsToFilter)){
	        //console.log("necoo")
	        contacts.push(value);
	       }
	    });
	   	return contacts;
	  }
	}

	this.deleteContact=function(contactId,route) {
		var parentThis = this;
		var url = route.replace("0", contactId);
		$.delete(url, {
			id: contactId
		}, function(response) {
			parentThis.globalHelpers.message(response);
		});
	}

	this.editContact=function(contactId,route) {
		var parentThis = this;
		var url = route.replace("0", contactId);
		$.get(url, function(response) {
			parentThis.globalHelpers.modalTemplate("large", response);;
		});
		}
	
}

$.templates("contactRow",(
	'<tr>'+
		'<td>{{:name}}</td>'+
		'<td>{{:firstname}} {{:lastname}}</td>'+
		'<td>{{:adress}}{{if city || zip_code}},{{/if}} {{:city}} {{:zip_code}}</td>'+
		'<td>{{:note}}</td>'+
		'<td><button class="edit button" data-id="{{:id}}"><i class="fi-pencil"></i></button></td>'+
		'<td><button class="delete button alert" data-id="{{:id}}"><i class="fi-trash"></i></button></td>'+
	'</tr>'
	));