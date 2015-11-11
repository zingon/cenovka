// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();
$(document).ready(function() {

//GetContent(start) - Funkce načítající data z backendu a duplikující řádek z kterého je vyvolána
    $(".getContent").each(function(k, contentV) {

    	$.get($(contentV).data("url"),function(response) {
    		var basic_row = $(contentV).removeClass("getContent").removeAttr("data-url")[0];
    		$.each(response,function(k,v) {
              console.log(v);
              var row = $(basic_row).clone().appendTo($(basic_row).parent());
              row.find("a").text(v.name);
              row.find("a").attr("href","#"+v.id);
              //row.find("a").data()
              //row 
    		});
          $(basic_row).parent("ul").before("<h4>Kategorie</h4>");
          $(basic_row).parent("ul").find("li")[0].remove();
    	});
    });
//GetContent(stop)
});