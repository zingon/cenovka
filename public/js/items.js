// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).ready(function() {

  window.App.Items = {};
  window.App.ItemSort = "poradi:asc";
  window.App.pagination.onPage = 20;
  window.App.pagination.element = "#pagination";
  init();

});

function init() {
  var items = "#items";
  var sidenav = ".side-nav";
  var search = "#search";
  var sort = "#sort";

  if (window.location.hash.length > 0) {
    loadItems(items, window.location.hash.split("#")[1]*1);
  } else {
    loadItems(items);

  }

  loadCategories(sidenav, function(target) {
    $(target + " a").click(function() {
      loadItems(items, $(this).attr("href").split("#")[1]*1);
    });
  });

  $(items).on("click", ".delete", function() {
    deleteItem(items, $(this).data("id"));
  });

  $(items).on("click", ".edit", function() {
    editItem($(this).data("id"));
  });


  $(".categoryReseter").click(function() {
    window.location.hash = "";
    loadItems(items);
  });


  /* Vyhledávání*/
  $(search).keyup(function() {
    if($(this).val().length>0){
      if (window.location.hash.length > 0) {
        loadItems(items,[window.location.hash.split("#")[1]*1,$(this).val()]);
      } else {
        loadItems(items,$(this).val());
      }
    } else {
      if(window.location.hash.length > 0) {
        loadItems(items,window.location.hash.split("#")[1]*1)
      } else {
        loadItems(items);
      }
    }
  });


  $(sort).change(function() {
    window.App.ItemSort = $(this).val();
    reload();
  });


}


function reload() {
  var items = "#items";
  var search = "#search";
  var param = [];
  if($(search).val().length>0) {
    param.push($(search).val());
  }
  if (window.location.hash.length > 0) {
    param.push(window.location.hash.split("#")[1]*1);
  }

  loadItems(items,param);

}
