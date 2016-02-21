@extends('layout.inner')
@section("submenu")
  <button id="actual" class="expand" data-id="{{$id}}">Aktuální verze</button>
<h4>Historie Dokumentů</h4>
<ul id="history" class="side-nav">
  <li><a href="">24.1.2016</a></li>
</ul>
@stop


@section('content')
<article id="document">
  <iframe src="" class="document" scrolling="no" onload="resizeIframe(this)"></iframe>
</article>



@stop

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
  window.App.actualDoc = {{$id}};
});
</script>
{{ HTML::script('js/show.js')}}

<script type="text/javascript">

	$('#loader').hide();
</script>
@stop
