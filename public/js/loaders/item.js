function loadCategories(target, callback) {
  $.get(localStorage.categoryUrl, function(response) {
    categoryTemplate(response, target);
    return callback(target);
  });
}

function loadItems(target) {
    if(window.App.Items.length>0) {
      itemTemplate(window.App.Items, target);
    } else {
      $.get(localStorage.itemsUrl, function(response) {
        itemTemplate(response, target);
        window.App.Items = response;
      });

    }
}

function filterItems(target, categoryId, limit, offset) {
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
      window.App.Items = response;
      itemTemplate(filtered, target);
    });
  }
}

function deleteItem(items, itemId) {
  var url = localStorage.ItemDeleteUrl.replace("0",itemId);
  $.delete(url,{id: itemId},function(response) {
    loadItems(items);
    message(response);
  });
}

function editItem(itemId) {
  var url = localStorage.ItemEditUrl.replace("0",itemId);
  $.get(url,function(response){
    modalTemplate("large",response);
  ;});
}

function searchItems(target,string) {
  var items = [];

  if (typeof window.App.Items == "object") {
    var elementsToFilter = ["name","note","code","unit","price"];
    //console.log(window.App.Items);
    $.each(window.App.Items, function(key,value){
       if(searchObject(value,string,elementsToFilter)){
        console.log("necoo")
        items.push(value);
       }
    });
  }
  itemTemplate(items, target);
}
