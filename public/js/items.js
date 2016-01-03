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
  } else {
    loadItems(items);
  }
  /**
    Načtení kategorii
  */
  loadCategories(sidenav, function(target) {
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
    Resetování kategorii
  */
  $(".categoryReseter").click(function() {
    window.location.hash = "";
    loadItems(items);
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
    reload();
  });
  /**
    Řazení tažením
  */
  if (window.location.hash.length <= 0) {
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
      update: function(e, ui) {
        console.log($(ui.item[0]).index(), $(ui.item).data("id"));
      }
    });
    $(".sortable").disableSelection();
  }
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