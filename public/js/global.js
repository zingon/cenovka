$(document).foundation();
$(document).ready(function() {
  window.App = {};
  window.App.pagination = {
  	element:"#pagination",
	onPage:5, // Počet prvků na stránce
	page:1 // Na kolikáté stránce jsem
  }
});

function GlobalController() {
	this.App = {}
	this.App.helpers = {}

	this.App._pagination = {
						onPage:5, // Počet prvků na stránce
						page:1, // Na kolikáté stránce jsem
					  }



	this.App._urls = {};
	this.App._firstLogin = 0;
	
	this.init = function(pathname) {
		//Implementování šablon a helperů do this.App
		this.App.helpers.global = new globalHelpers();
		//Pokud je tu poprvé tak zobrazit modal
		if(this.App._firstLogin>0) {
			this.setMeIn();
		}

		// Zpracuj název a přesmětuj na správný controller
		this.router(pathname);
	}


	//Pomocí switche zpracuje pathname a přesměruje na správnou stránku
	this.router = function(pathname) {
		switch(pathname) {
			case "contact":
				return this.contacts();
				break;
			case "item":
				return this.items();
				break;
			case "document":
				return this.documents();
				break;
			default:
				break;
		}
	}

	//Načte kontakty a přepošle je do příslušného controlleru
	this.contacts = function() {
		var parentThis = this;
		$.get(parentThis.App.getUrl("ContactsUrl"),function(contacts) {
			var contacts = new ContactController(parentThis.App,contacts);
			contacts.init();

		});
	}

	//Načte položky a přepošle je do příslušného controlleru
	this.items = function() {
		var parentThis = this;
		$.get(parentThis.App.getUrl("ItemsUrl"),function(items) {
			var items = new ItemController(parentThis.App,items);
			$.get(parentThis.App.getUrl("categoryUrl"),function(categories) {
				items.setCategories(categories);
				items.init();
			});
		});
	}

	//Načte dokumenty a přepošle je do příslušného  controlleru
	this.documents = function() {
		console.log("documents");
	}

	//Uložení url 
	this.setUrls = function(urls) {
		if(typeof urls == "object") {
			this.App._urls = urls;
		}
	}

	//Získání url globální funkce
	this.App.getUrl = function(name) {
		if(typeof name == "string") {
			return this._urls[name];
		} else {
			return false;
		}
	}

	//Setter na first login
	this.setFirstLogin = function(first_login) {
		this.App._firstLogin = first_login;
	}

	//funkce která otevže modal pro zadání údajů o uživatelovi
	this.setMeIn = function() {
		var parentThis = this;
		$.get(parentThis.App.getUrl("SettingUserUrl"), function(data) {
			parentThis.App.helpers.global.modalTemplate("large", data);
			var modal = $("#modal");
			modal.find("input[name=hidden]").val(1);
		});
	}



}



//Pomocné funkce pro celý dokument
function globalHelpers() {


	this.searchObject= function(obj, string, columns) {
	  var nope = false;
	  $.each(string.split(" "), function(string_key, substring) {
		if (substring.length > 0) {
		  $.each(columns, function(key, value) {
			if (obj[value].length >= substring.length && obj[value].toLowerCase().search(substring.toLowerCase()) > -1) {
			  nope = true;
			}
		  });
		}
	  });
	  if (nope === true) {
		return true;
	  }
	}

	this.message=function(data) {
	  var target = ".message-box";
	  this.messageTemplate(data.messages, target);
	  $(document).foundation('alert', 'reflow');
	}

	this.inputError= function(input, text) {
	  input.addClass("error");
	  input.parent().find("small.error").remove();
	  this.inputErrorTemplate(text,input.parent());
	}

	this.sortMy= function(data, by) {
	  var sortes = by.split(":");
	  data.sort(function(a, b) {
		if (sortes[1] == "asc") {
		  var f,s;
		  if(sortes[2] == "num"){
			f = 1*a[sortes[0]];
			s = 1*b[sortes[0]];
		  } else {
			f = a[sortes[0]];
			s = b[sortes[0]];
		  }
		  if (f > s) {
			return 1;
		  } else if (f < s) {
			return -1;
		  } else {
			return 0;
		  }

		} else {
		  var f,s;
		  if(sortes[2] == "num"){
			f = 1*a[sortes[0]];
			s = 1*b[sortes[0]];
		  } else {
			f = a[sortes[0]];
			s = b[sortes[0]];
		  }
		  if (f > s) {
			return -1;
		  } else if (f < s) {
			return 1;
		  } else {
			return 0;
		  }
		}
	  });
	  return data;
	}
	this.modalTemplate = function(size, content) {
		$("#modalField").html($.render.modal({
			'size': size,
			'content': content
		}));
		$('#modal').foundation('reveal', 'open');
	}
	this.messageTemplate = function(data, target) {
		$(target).append($.render.messageBox(data));
	}
	this.inputErrorTemplate = function(text,target) {
		target.append($.render.errorInput({
			'text':text
		}));
	}


}

//Template 
$.templates('messageBox', '<div data-alert class="alert-box {{:type}}">{{:text}}<a href="#" class="close">&times;</a></div>');
$.templates('errorInput', '<small class="error">{{:text}}</small>');
$.templates('modal', '<div id="modal" class="reveal-modal {{if size}}{{:size}}{{/if}}" data-reveal><section>{{:content}}</section><a class="close-reveal-modal" arial-label="Close">&#215;</a></div>');

//Datumový konvertor do klasického formátu dd.mm.yyyy
$.views.converters("date", function(val) {
  var date = new Date(val);
  return date.getDate()+"."+(date.getMonth()+1)+"."+date.getFullYear()
});

//Parser pro jednotky s horním indexem
$.views.converters("unitParser", function(val) {
	var unit = val.split("^");
	if (unit.length > 1) {
		return unit[0] + "<sup>" + unit[1] + "</sup>"
	} else {
		return val;
	}
});