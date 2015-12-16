@extends('layout.main')
@section('content_basic')
@include('layout.menu')
<article>
	<div class="row">
		<div class="small-12 medium-4 large-3 columns">
			<section class="side">

					@yield('submenu')

			</section>
		</div>
		<div class="small-12 medium-8 large-9 columns">
			@yield('content')
		</div>
	</div>
</article>
@stop