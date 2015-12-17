@extends('layout.inner')
@section("submenu")
<h4>Kategorie</h4>
<ul class="side-nav">

</ul>
	<button type="button" class="expand categoryReseter">Zobrazit všechny položky</button>
	<h4>Vyhledávání</h4>
	<input type="text" id="search" placeholder="Vyhledávání...">
@stop
@section('content')
<section>
	<div class="small-12 columns">
		<ul class="button-group right">
			<li><a href="{{route('item.create')}}" class="button success" data-reveal-id="universalLargeModal" data-reveal-ajax="true"><i class="fi-page-add"></i> Nová položka</a></li>
			<li><a href="{{route('category.create')}}" class="button" data-reveal-id="universalSmallModal" data-reveal-ajax="true"><i class="fi-page-add"></i> Nová kategorie</a></li>
			<li><a href="{{route('category.edit')}}" class="button" data-reveal-id="universalLargeModal" data-reveal-ajax="true"><i class="fi-page-edit"></i> Editovat kategorie</a></li>
		</ul>
	</div>
</section>
<section>
	<table class="small-12 columns" id="mainTable">
		<thead>
			<tr>
				<th>Kod</th>
				<th>Název</th>
				<th>Cena</th>
				<th>MJ</th>
				<th>Poznámka</th>
				<th><span class="fi-pencil"></span></th>
				<th><span class="fi-trash"></span></th>
			</tr>
		</thead>
		<tbody id="items">
		</tbody>
		<tfoot>
		<tr>
			<td colspan="7">
				<div id="pagination">


				</div>
			</td>
		</tr>
		</tfooter>
	</table>
</section>
@stop
@section("script")
{{ HTML::script('js/items.js')}}
{{ HTML::script('js/loaders/item.js')}}
{{ HTML::script('js/templates/item.js')}}
@stop