// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();
$(document).ready(function() {

//GetContent(start) - Funkce načítající data z backendu a duplikující řádek z kterého je vyvolána
    $(".getContent").each(function(k, contentV) {

    	$.get($(contentV).data("url"),function(response) {
    		var basic_row = $(contentV).removeClass("getContent").removeAttr("data-url")[0];
    		$.each(response,function(k,v) {

    		});
    	});
    });
//GetContent(stop)


});