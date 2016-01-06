// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).ready(function() {
  window.App.Items = {};
  window.App.ItemSort = "poradi:asc";
  window.App.UserSort = true;
  window.App.pagination.onPage = 20;
  window.App.pagination.element = "#pagination";
  init();
});

function init() {
  //Příprava částí stránky
  var items = "#items";
  var sidenav = ".side-nav";
  var search = "#search";
  var sort = "#sort";
  /**
    Počáteční načtení a vypsání položek.
  */
  if (window.location.hash.length > 0) {
    loadItems(items, window.location.hash.split("#")[1] * 1);
  }
  /**
    Načtení kategorii
  */
  loadCategories(sidenav, function(target, data) {
    if(!(window.location.hash.length > 0)) {
      loadItems(items, data[0].id*1);
      window.location.hash = data[0].id;
    }
    $(target + " a").click(function() {
      loadItems(items, $(this).attr("href").split("#")[1] * 1);
    });
  });
  /**
    Mazání položek
  */
  $(items).on("click", ".delete", function() {
    deleteItem(items, $(this).data("id"));
  });
  /**
    Editace položek
  */
  $(items).on("click", ".edit", function() {
    editItem($(this).data("id"));
  });

  /**
    Vyhledávání
  */
  $(search).keyup(function() {
    if ($(this).val().length > 0) {
      if (window.location.hash.length > 0) {
        loadItems(items, [window.location.hash.split("#")[1] * 1, $(this).val()]);
      } else {
        loadItems(items, $(this).val());
      }
    } else {
      if (window.location.hash.length > 0) {
        loadItems(items, window.location.hash.split("#")[1] * 1)
      } else {
        loadItems(items);
      }
    }
  });
  /**
    Základní řazení
  */
  $(sort).change(function() {
    window.App.ItemSort = $(this).val();

    if($(sort +" option[value='"+$(this).val()+"']").data("user-sort")) {
      $(".sortable").sortable( "enable" );
    } else {
      $(".sortable").sortable( "disable" );
    }
    reload();
  });
  /**
    Řazení tažením
  */

    $(".sortable").sortable({
      helper: function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
          // Set helper cell sizes to match the original sizes
          $(this).width($originals.eq(index).width());
        });
        return $helper;
      },
      stop: function(event, ui){
        $.post(localStorage.ItemChangePosition,({"id": ui.item.data("id"),"to": ui.item.index(),'category':(window.location.hash.split("#")[1] * 1)})).success(function() {
          window.App.Items = {};
        reload();
        });

    }
    });
    $(".sortable").disableSelection();
  }

function reload() {
  var items = "#items";
  var search = "#search";
  var param = [];
  if ($(search).val().length > 0) {
    param.push($(search).val());
  }
  if (window.location.hash.length > 0) {
    param.push(window.location.hash.split("#")[1] * 1);
  }
  loadItems(items, param);
}
