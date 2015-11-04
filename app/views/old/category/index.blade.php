<ul class="nav categories">
    	<h4>Kategorie</h4>
    	@foreach($categories as $item)
        	<li><a data-filter="{{$item->id}}" class='category'>{{$item->name}}</a></li>
    	@endforeach
    	<li><a data-filter="0" class='category'>Bez kategorie</a></li>
</ul>

<script type="text/javascript">
	$(".category").click(function(){
		location.hash = $(this).data('filter');
	});
</script>
