	<div class="row">
		<div class="small-12 columns">
			<h4>{{$title}}</h4>
		</div>
	</div>

{{Form::open(array('route'=>$route,'id'=>'itemForm','method'=>$method))}}
<div class="row">
	<div class="small-12 columns">
		{{Form::label('name','Název:')}}
		{{Form::text('name',$data->name,array('placeholder'=>'Název',"required"))}}
	</div>
</div>
<div class="row">
	<div class="small-12 medium-6 columns">
		{{Form::label('buy_price','Nákupní cena:')}}
		{{Form::number('buy_price',$data->buy_price,array('placeholder'=>'Nákupní cena','step'=>0.01,"required"))}}
	</div>
	<div class="small-12 medium-6 columns">
		{{Form::label('price','Prodejní cena:')}}
		{{Form::number('price',$data->price,array('placeholder'=>'Prodejní cena','step'=>0.01,"required"))}}
	</div>
</div>
<div class="row">
	<div class="small-12 medium-6 columns">
		{{Form::label('category','Kategorie')}}

		{{Form::select('category',$categories,$data->category_id)}}
	</div>
	<div class="small-12 medium-6 columns">
		{{Form::label('unit','Jednotka')}}
		{{Form::select('unit',array('bm'=>'bm','ks'=>'ks','m^2'=>'m2','m^3'=>'m3','km'=>'km','h'=>'h'),$data->unit)}}
	</div>
</div>
<div class="row">
	<div class="small-12 columns">
		{{Form::label('note','Poznámka:')}}
		{{Form::textarea('note',$data->note,array('rows' => '3', 'placeholder'=> 'Poznámka'))}}
	</div>
</div>
<ul class="button-group right">
    <li><button type="submit" class="button success">Uložit</button></li>
</ul>
{{Form::close()}}
<a class="close-reveal-modal" arial-label="Close">&#215;</a>