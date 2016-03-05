function loadDocuments(target) {
	if(window.App.Documents.length>0) {
		documentTemplate(target,window.App.Documents);
	} else {
		$.get(localStorage.DocumentUrl,function(response) {
			documentTemplate(target,response);
			window.App.Documents = response;
		});
	}
}

function changeTab(open,getfunction,data) {
	if(typeof data == "undefined") data={edit:0};
	var parts = ["items","offer","editItems"];
	parts.forEach(function(v, k) {
		$("#"+ v).hide();
		$("li."+v).removeClass("active");
	});
	$("#"+open).show();
	$("li."+open).addClass("active");
	var url =$("#"+open).data("url");
	if(url.length>0) {
		$.get(url,{edit:data.edit}, function(response){
			getfunction(response);
		});
	}
}

function loadItems(param) {
  if (typeof param == "undefined") param = false;
  if (!(window.App.Items.length > 0)) {
    $.get(localStorage.ItemsUrl, function(response) {
      window.App.Items = response;
      if(response.length>0) {
        return itemFilter(response,param);
      } else {
        $("#loader").hide();
      }

    });
  }
}
function itemFilter(items,param) {
	if (param.length > 0 || param) {
      switch (typeof param) {
        case "object":
        case "array":
          var filtered = items;
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
         return filtered;
          break;
        case "string":
          return searchItems(items, param, ["name", "note", "code", "unit", "price"]);
          break;
        case "number":
          return filterItems(items, param);
          break;
      }
    } else {
    	return window.App.Items;
    }
}
function loadCategories(target, callback) {
  $.get(localStorage.categoryUrl, function(response) {
    categoryTemplate(response, target);
    return callback(target, response);
  });
}

function insertItems(html, targetHtml, target, items,edit) {

	if(typeof items == "undefined") items = window.App.Items;
	if(typeof edit == "undefined") edit = 0;
	if(edit) {
		itemEditConnectionTemplate(html,targetHtml,target,items);
	} else {
		itemConnectionTemplate(html,targetHtml,target,items);
	}

}

function getSelectedItems(documentId, callback) {
	$.get(localStorage.SelectEdit.replace("0",documentId), function(resp) {
		callback(resp);
	})
}
function deleteDocument(documentId) {
  var url = localStorage.DocumentDeleteUrl.replace("0", documentId);
  $.delete(url, {
    id: documentId
  }, function(response) {
  	window.App.Documents = {};
    reload();
    message(response);
  });
}

function editDocument( documentId, callback) {
	resetSelected();
  var url = localStorage.DocumentEditUrl.replace("0", documentId);
  $('#universalLargeModal').foundation('reveal', 'open', {
	    url: url,
	    success: function(data) {
	        callback();
	    },
	    error: function() {
	        console.log('failed loading modal');
	    }
	});
}

function findItemById(arrayOfObjects, id) {
	var array = arrayOfObjects.filter(function(element,index,array) {
		return findId(element,id);
	});
	if(array.length>1) {
		return array[0];
	} else {
		return {};
	}
}

function diffItems(all,selected) {
  var onlyInA = all.filter(function(current){
    return selected.filter(function(current_selected){
        return current_selected.item_id == current.id
    }).length == 0
});

var onlyInB = selected.filter(function(current_selected){
    return all.filter(function(current){
        return current.id == current_selected.item_id
    }).length == 0
});

    return onlyInA.concat(onlyInB);
  }

 function findId(object, id) {
  	if(object.id == id || object.id==(id*1) ) {
  		return true;
  	} else {
  		return false;
  	}
  }

 function resetSelected() {
 	window.App.Edit.selected = {};
 }

 function removeSelectedItem(id) {
 	$.delete(localStorage.SelectDeleteUrl.replace("0",id),function(res) {
 		$("#tabNav li.editItems a").click();
 		window.App.Documents = {}
 		reload();
 		message(res);
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