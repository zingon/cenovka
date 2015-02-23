<ul class="nav categories">
    	<a class="btn btn-default reset">Zrušit filrování</a>
    	<h4>Kategorie</h4>
    	@foreach($categories as $item)
        	<li><a data-filter="{{$item->class}}" class='category'>{{$item->name}}</a></li>
    	@endforeach
</ul>

