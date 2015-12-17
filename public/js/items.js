// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).ready(function() {

  window.App.Items = {};
  window.App.pagination.onPage = 2;
  window.App.pagination.element = "#pagination";
  init();

});

function init() {
   var items = "#items";
  var sidenav = ".side-nav";
  var search = "#search";

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

  $(items).on("click", ".delete", function() {
    deleteItem(items, $(this).data("id"));
  });

  $(items).on("click", ".edit", function() {
    editItem($(this).data("id"));
  });

  $(search).keyup(function() {
      if($(this).val().length>0) {

        searchItems(items,$(this).val());
      } else {
        loadItems(items);
      }
  });
}


function reload() {
  var items = "#items";
  var search = "#search";
  if($(search).val().length>0) {
    loadItems(items,$(search).val());
  } else if (window.location.hash.length > 0) {
    loadItems(items, window.location.hash.split("#")[1]*1);
  } else {
    loadItems(items,false);
  }
}
