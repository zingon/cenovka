function contactLoader() {
	this.contacts={};
	this.init = function () {
		
		$.get("http://cenovka.app/contact",function(response) {
			var myClass;
			myClass = new contactLoader;
			myClass.contacts = response;
			return myClass;
		});
	}
	
}


	var contacts = new contactLoader;
	contacts = contacts.init();
	console.log(contacts.contacts);
