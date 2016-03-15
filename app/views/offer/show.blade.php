@extends('layout.inner')
@section("submenu")
  <button id="actual" class="expand" data-id="{{$id}}">Aktuální verze</button>
<h4>Historie Dokumentů</h4>
<ul id="history" class="side-nav"></ul>
@stop


@section('content')
<section>
    <div class="small-12 columns">
        <ul class="button-group right">
         	<li><a href="{{URL::route('export.offer',$id)}}/0" class="button success" id="saveButton"><i class="fi-page-add"></i> Uložit verzi</a></li>
            <li><a href="{{URL::route('export.offer',$id)}}/1" class="button success" id="exportButton" target="_blank"><i class="fi-page-add"></i> Export PDF</a></li>
        </ul>
    </div>
</section>
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
function resizeIframe(obj) {
   obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}
	$('#loader').hide();

</script>
@stop
