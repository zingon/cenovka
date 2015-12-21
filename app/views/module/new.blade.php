<div class="row">
	<div class="small-12 columns">
		<h4>{{$title}}</h4>
	</div>
</div>
{{Form::open(array('route'=>$route,'id'=>'moduleForm','method'=>$method))}}
	<section>
		<div class="small-12 columns">
			{{Form::label('name', 'Název')}}
        	{{Form::text('name',$data->name,array('placeholder'=>'Název'))}}
		</div>
	</section>
	<section>
		<div class="small-12 columns">
			{{Form::label('key', 'Klíč')}}
        	{{Form::text('key',$data->key,array('placeholder'=>'Klíč'))}}
		</div>
	</section>
	<ul class="button-group right">
    <li><button type="submit" class="button success">Uložit</button></li>
</ul>
{{Form::close()}}
<a class="close-reveal-modal" arial-label="Close">&#215;</a>