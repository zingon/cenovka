@extends('layout.inner-onecol')
{{--@section("submenu")
<h4>Vyhledávání</h4>
<input type="text" id="search" placeholder="Vyhledávání...">
@stop--}}
@section('content')
<section>
	<div class="small-12 medium-6 medium-push-6 columns">
		<ul class="button-group right">
			<li><a href="{{route('contact.create')}}" class="button success" data-reveal-id="universalLargeModal" data-reveal-ajax="true"><i class="fi-page-add"></i> Nový kontakt</a></li>
		</ul>
	</div>
	<div class="small-12 medium-6 medium-pull-6 columns">
		<input type="text" id="search" placeholder="Vyhledávání...">
	</div>
</section>
<section>
	<table class="small-12 columns" id="mainTable">
		<thead>
			<tr>
				<th class="p15">Název</th>
				<th class="p15">Jméno</th>
				<th class="p25">Adresa</th>
				<th>Poznámka</th>
				<th class="p7"><span class="fi-pencil"></span></th>
				<th class="p7"><span class="fi-trash"></span></th>
			</tr>
		</thead>
		<tbody id="contacts">
		</tbody>
		<tfoot>
		<tr><td colspan="7">
			<div id="pagination"></div>
		</td></tr>
		</tfoot>
	</table>

</section>
@stop
@section("script")
{{ HTML::script('js/contacts.js')}}
{{ HTML::script('js/loaders/contact.js')}}
{{ HTML::script('js/templates/contact.js')}}
@stop