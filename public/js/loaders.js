function loadCategories(target, callback) {
  $.get(localStorage.categoryUrl, function(response) {
    categoryTemplate(response, target);
    $(target).before("<h4>Kategorie</h4>");
    return callback(target);
  });
}

function loadItems(target) {
    $.get(localStorage.itemsUrl, function(response) {
      itemTemplate(response, target);
      window.App.Items = response;
    });
}

function filterItems(target, categoryId) {
  if (window.App.Items.length > 0) {
    var filtered = $.grep(window.App.Items, function(arr, i) {
      return (arr['category_id'] === categoryId);
    });
    itemTemplate(filtered, target);
  } else {
    $.get(localStorage.itemsUrl, function(response) {
      var filtered = $.grep(response, function(arr, i) {
        return (arr['category_id'] === categoryId);
      });
      itemTemplate(filtered, target);
    });
  }
}

function deleteItem(items, itemId) {
  var url = localStorage.ItemDeleteUrl.replace("0",itemId);
  $.delete(url,{id: itemId},function() {
    loadItems(items);
  });
}