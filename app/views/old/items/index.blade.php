@extends('layout.main')

@section('content')
<p style="text-align: right; padding-right: 20px">
	<a href="{{route('category.edit')}}" class="btn btn-primary modalLink"><span class="glyphicon glyphicon-pencil"></span>  Editovat Kategorie</a>
	<a href="{{route('category.create')}}" class="btn btn-success modalLink" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-plus"></span>  Nová Kategorie</a>

	<a href="{{route('item.create')}}" class="btn btn-success modalLink"><span class="glyphicon glyphicon-plus"></span>  Nová Položka</a>
</p>
<table class="table table-striped table-bordered" id="mainTable">
		<thead>
		<tr>
			<th>Kod</th>
			<th>Název</th>
			<th>Cena</th>
			<th>MJ</th>
			<th>Poznámka</th>
			<th><span class="glyphicon glyphicon-pencil"></span></th>
			<th><span class="glyphicon glyphicon-remove"></span></th>
			
		</tr>
		</thead>
		<tbody id="items">
			
		</tbody>
	</table>
@stop
@section('script')
<script type="text/javascript">
function getItemsByCategory(id,to){
	$(to).empty();
	$.get('/category/'+id,function(html){
		$(to).append(html);
		renewModals();
	});
}
$(function() {

	var cat = "{{$category}}";
	$.get("{{URL::route('category.index')}}",function(data) {
		$("#sideNav").html(data);
		console.log(document.location.hash);
		if(document.location.hash.length){
			getItemsByCategory(document.location.hash.replace("#",""),'#items')
			cat = document.location.hash.replace("#","");
		}
		window.onhashchange = function() {
			var id = document.location.hash; 
			id = id.replace("#","");
			cat = id;
			getItemsByCategory(id,"#items"); 
			
		};
	});

	$( "#items" ).sortable({
	  start: function(event, ui) {
		ui.item.startPos = ui.item.index();
	  },
	  stop: function(event, ui){
	  	if(ui.item.startPos!=ui.item.index()){
			$.post("{{route('changePosition')}}",({"from": ui.item.startPos,"to": ui.item.index(),'category':cat}));
		}
	  }
	});
	$( "#items" ).disableSelection();


  });

</script>
@stop