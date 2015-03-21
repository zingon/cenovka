<ul class="nav categories">
    	<a class="btn btn-default reset">Zrušit filrování</a>
    	<h4>Kategorie</h4>
    		<li><a data-filter="0" class='category'>Bez kategorie</a></li>
    	@foreach($categories as $item)
        	<li><a data-filter="{{$item->id}}" class='category'>{{$item->name}}</a></li>
    	@endforeach
</ul>

