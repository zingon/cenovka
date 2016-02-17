$(document).foundation();
$(document).ready(function() {
  window.App = {};
  window.App.pagination = {
  	onPage:5, // Počet prvků na stránce
  	page:1, // Na kolikáté stránce jsem
  	element:"#pagination", // Název elementu v kterém se paginace objevuje
  }
  if(localStorage.first_login>0) {
  	setMeIn();
  }
});
