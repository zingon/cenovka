@extends('layout.inner')
@section("submenu")
<h4>Vyhledávání</h4>
<input type="text" id="search" placeholder="Vyhledávání...">
@stop
@section('content')
<section>
	<div class="small-12 columns">
		<ul class="button-group right">
			<li><a href="{{route('contact.create')}}" class="button success" data-reveal-id="universalLargeModal" data-reveal-ajax="true"><i class="fi-page-add"></i> Nový kontakt</a></li>
		</ul>
	</div>
</section>
<section>
	<table class="small-12 columns" id="mainTable">
		<thead>
			<tr>
				<th>Název</th>
	            <th>Jméno</th>
	            <th>Adresa</th>
	            <th>Poznámka</th>
				<th><span class="fi-pencil"></span></th>
				<th><span class="fi-trash"></span></th>
			</tr>
		</thead>
		<tbody id="contacts">
		</tbody>
		<tfoot>
		<tr>
			<td colspan="7">
				<div class="center">
					<ul class="bottom">
					</ul>
				</div>
			</td>
		</tr>
		</tfooter>
	</table>
</section>
@stop
@section("script")

{{ HTML::script('js/contacts.js')}}
{{ HTML::script('js/loaders/contact.js')}}
{{ HTML::script('js/templates/contact.js')}}
@stop