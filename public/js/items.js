// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();
$(document).ready(function() {

  window.App = {};
  window.App.Items = {};

  var items = "#items";
  var sidenav = ".side-nav";

  if (window.location.hash.length > 0) {
    filterItems(items, window.location.hash.split("#")[1]);
  } else {
    loadItems(items);
  }

  loadCategories(sidenav, function(target) {
    $(target + " a").click(function() {
      filterItems(items, $(this).attr("href").split("#")[1]);
    });
  });

  $(items).on("click",".delete",function() {
    deleteItem(items, $(this).data("id"));
  });


});