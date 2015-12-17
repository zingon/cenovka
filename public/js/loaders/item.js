function loadCategories(target, callback) {
  $.get(localStorage.categoryUrl, function(response) {
    categoryTemplate(response, target);
    return callback(target);
  });
}

function loadItems(target,param) {
    if(typeof param == "undefined") param = false;
    if(!(window.App.Items.length>0)) {
      $.get(localStorage.itemsUrl, function(response) {
        window.App.Items = response;
      });
    }
    if(param.length>0 && param && isNaN(param)){
      itemTemplate(searchItems(window.App.Items, param), target);
      //itemTemplate(window.App.Items, target);
    } else if(param.length>0 && param) {
       itemTemplate(filterItems(window.App.Items, param), target);
    } else {
        itemTemplate(window.App.Items, target);
    }

}

function filterItems(data, categoryId) {
  if (data.length > 0) {
    return $.grep(data, function(arr, i) {
      return (arr['category_id'] === categoryId);
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

function searchItems(objects, string) {
  var items = [];

  if (typeof objects == "object") {
    var elementsToFilter = ["name","note","code","unit","price"];
    //console.log(window.App.Items);
    $.each(objects, function(key,value){
       if(searchObject(value,string,elementsToFilter)){
        console.log("necoo")
        items.push(value);
       }
    });
  }
  return items;
}
