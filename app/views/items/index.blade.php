@extends('layout.inner')
@section("submenu")
    <li class="getContent" data-url="{{route('category.index')}}"></li>
@stop
@section('content')
<section>
	<div class="small-12 columns">
		<ul class="button-group right">
			<li><a href="{{route('item.create')}}" class="button success modalLink"><i class="fi-page-add"></i> Nová položka</a></li>
			<li><a href="{{route('category.create')}}" class="button modalLink"><i class="fi-page-add"></i> Nová kategorie</a></li>
			<li><a href="{{route('category.edit')}}" class="button modalLink"><i class="fi-page-edit"></i> Editovat kategorie</a></li>
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
	</table>
</section>
@stop