@extends('layout.main')
@section('content_basic')
@include('layout.menu')
<article>
	<div class="row">
		<div class="small-12 columns">
			@yield('content')
		</div>
	</div>
</article>
@stop