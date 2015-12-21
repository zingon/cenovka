@extends('layout.inner')
@section('submenu')
<div class="small-12 columns">
<ul class="tabs vertical" data-tab>
@if(!Auth::getUser()->admin)
	@foreach ($module as $key => $modul)
	<li class="tab-title @if($key==0)active @endif"><a href="#{{$modul->key}}">{{$modul->name}}</a></li>
	@endforeach
@else
	<li class="tab-title active"><a href="#modules">Moduly</a></li>
	<li class="tab-title"><a href="#settings">Nastavení</a></li>
@endif
</ul>
	</div>
@stop
@section('content')
<section>
<div class="small-12 columns tabs-content">
	@if(!Auth::getUser()->admin)
	@foreach ($module as $key => $modul)
	<div class="content @if($key==0)active @endif" id="{{$modul->key}}">
		{{$modul->name}}
	</div>
	@endforeach
@else
	<div class="content active" id="modules">
	<section>

	<div class="small-12 columns">
		<ul class="button-group right">
		<li><a href="{{route('module.create')}}" class="button success" data-reveal-id="universalLargeModal" data-reveal-ajax="true"><i class="fi-page-add"></i> Nová položka</a></li>
		</ul>
	</div>
	</section>
	<section>
		<table class="small-12 columns" id="modules">
			<thead>
				<tr>
				<th class="p25">Klíč</th>
				<th>Jméno</th>
				<th class="p7"><span class="fi-pencil"></span></th>
				<th class="p7"><span class="fi-trash"></span></th>
			</tr>
			</thead>
			<tbody>
				@foreach ($module as $modul)
					<tr>
						<td>{{$modul->key}}</td>
						<td>{{$modul->name}}</td>
						<td><a href='{{URL::route("module.edit",$modul->id)}}' class="button success" data-reveal-id="universalLargeModal" data-reveal-ajax="true"><i class="fi-pencil"></i></a></td>
						<td>{{Form::destroy("module",$modul->id)}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		</section>
	</div>
	<div class="content" id="settings">

	</div>
@endif
</div>
</section>
@stop