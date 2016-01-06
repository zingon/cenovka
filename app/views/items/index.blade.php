@extends('layout.inner')
@section("submenu")
	<!-- Kategorie -->
	<h4>Kategorie</h4>
	<ul class="side-nav"></ul>

	<!-- Řazení -->
	<h4>Řadit dle:</h4>
	<label>
	<select id="sort">
		<option value="poradi:asc:num" data-user-sort="true">Vlastního pořadí</option>
		<option value="code:desc" data-user-sort="false">Kódu - Sestupně</option>
		<option value="code:asc" data-user-sort="false">Kódu - Vzestupně</option>
		<option value="name:desc" data-user-sort="false">Názvu - Sestupně</option>
		<option value="name:asc" data-user-sort="false">Názvu - Vzestupně</option>
		<option value="price:desc:num" data-user-sort="false">Ceny - Sestupně</option>
		<option value="price:asc:num" data-user-sort="false">Ceny - Vzestupně</option>
	</select>
	</label>

	<!-- Vyhledávání -->
	<h4>Vyhledávání</h4>
	<input type="text" id="search" placeholder="Vyhledávání...">
@stop
@section('content')
<section>

	<div class="small-12 columns">
		<ul class="button-group right">
			<li><a href="{{route('item.create')}}" class="button success" data-reveal-id="universalLargeModal" data-reveal-ajax="true"><i class="fi-page-add"></i> Nová položka</a></li>
			<li><a href="{{route('api.category.create')}}" class="button" data-reveal-id="universalSmallModal" data-reveal-ajax="true"><i class="fi-page-add"></i> Nová kategorie</a></li>
			<li><a href="{{route('api.category.edit')}}" class="button" data-reveal-id="universalLargeModal" data-reveal-ajax="true"><i class="fi-page-edit"></i> Editovat kategorie</a></li>
		</ul>
	</div>
</section>
<section>
	<table class="small-12 columns" id="mainTable">
		<thead>
			<tr>
				<th class="p10">Kod</th>
				<th class="p20">Název</th>
				<th class="p13">Cena</th>
				<th class="p7">MJ</th>
				<th class="p36">Poznámka</th>
				<th class="p7"><span class="fi-pencil"></span></th>
				<th class="p7"><span class="fi-trash"></span></th>
			</tr>
		</thead>
		<tbody id="items" class="sortable">
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