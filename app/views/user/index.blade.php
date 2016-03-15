@extends('layout.inner-onecol')

@section('content')
<section>
	<table class="small-12 columns" id="mainTable">
		<thead>
			<tr>
				<th>#</th>
				<th>Jméno</th>
				<th>Počet dokumentů</th>
				<th>Počet položek</th>
				<th>Počet kontaktů</th>
				<th>Registrován</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
				<td>{{$user->id}}</td>
				<td>{{$user->user_setting->name}}</td>
				<td>{{sizeof($user->documents)}}</td>
				<td>{{sizeof($user->items)}}</td>
				<td>{{sizeof($user->contacts)}}</td>
				<td>{{date('d. m. Y', strtotime($user->created_at))}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</section>
@stop
@section("script")
<script type="text/javascript">
	$(function() {
		$("#loader").hide();
	});
</script>
@stop