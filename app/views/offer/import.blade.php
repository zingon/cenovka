{{Form::open(array('route'=>$route,'method'=>$method))}}


<div class="row">
	<div class="small-12 columns">
		{{Form::label('json','Dokument který chcete importovat:')}}
		{{Form::file('json');)}}
	</div>
</div>
<ul class="button-group right">
    <li><button type="submit" class="button success">Importovat</button></li>
</ul>
{{Form::close()}}