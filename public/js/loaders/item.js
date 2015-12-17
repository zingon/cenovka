function loadCategories(target, callback) {
  $.get(localStorage.categoryUrl, function(response) {
    categoryTemplate(response, target);
    return callback(target);
  });
}

function loadItems(target, param) {
  if (typeof param == "undefined") param = false;
  if (!(window.App.Items.length > 0)) {
    $.get(localStorage.itemsUrl, function(response) {
      window.App.Items = response;
      loadItems(target, param);
    });
  } else {
    if (param.length > 0 || param) {
      switch (typeof param) {
        case "object":
        case "array":
          var filtered = window.App.Items;
          $.each(param, function(k, v) {
            switch (typeof v) {
              case "string":
                filtered = searchItems(filtered, v, ["name", "note", "code", "unit", "price"]);
                break;
              case "number":
                filtered = filterItems(filtered, v);
                break;
            }
          });
          itemTemplate(filtered,target);
          break;
        case "string":
          itemTemplate(searchItems(window.App.Items, param, ["name", "note", "code", "unit", "price"]), target);
          break;
        case "number":
          var filtered = filterItems(window.App.Items, param);
          itemTemplate(filtered, target);
          break;
      }
    } else {
      itemTemplate(window.App.Items, target);
    }
  }
}

function filterItems(data, categoryId) {
  var result = [];
  if (data.length > 0) {
     result = $.grep(data, function(arr, i) {
      return (arr['category_id']*1 === categoryId*1);
    });
    return result;
  }
}

function deleteItem(items, itemId) {
  var url = localStorage.ItemDeleteUrl.replace("0", itemId);
  $.delete(url, {
    id: itemId
  }, function(response) {
    loadItems(items);
    message(response);
  });
}

function editItem(itemId) {
  var url = localStorage.ItemEditUrl.replace("0", itemId);
  $.get(url, function(response) {
    modalTemplate("large", response);;
  });
}

function searchItems(objects, string, elementsToFilter) {
  var items = [];
  if (typeof objects == "object") {
    $.each(objects, function(key, value) {
      if (searchObject(value, string, elementsToFilter)) {
        items.push(value);
      }
    });
  }
  return items;

}