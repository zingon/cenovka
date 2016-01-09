<div class="row">
	<div class="small-12 columns">
		<h4>{{$title}}</h4>
	</div>
</div>
<section>
	<div class="small-12 medium-4 large-3 columns">
		<ul class="side-nav">
			<li><a href="#" data-open="offer">Vytvoření nabídky</a></li>
			<li><a href="#" data-open="items">Přidání položek do nabídky</a></li>
			@if ($edit)
			<li><a href="#" data-open="editItems">Editace položek</a></li>
			@endif
		</ul>
	</div>
	<div class="small-12 medium-8 large-9 columns">
		<div id="offer">
			{{Form::open(array('route'=>$route, "method"=>$method))}}
			<div class="row">
				<div class="small-12 columns">
					{{Form::label('name','Jméno')}}
					{{Form::text('name','',array('placeholder'=>'Název'))}}
				</div>
			</div>
			<div class="row">
				<div class="small-4 columns">
					{{Form::label('dodavatel','Dodavatel:')}}
					{{{$dodavatel->name}}}
				</div>

				<div class="small-8 columns">
					{{Form::label('odberatel','Odběratel:')}}
					{{Form::select('odberatel',$odberatele,'')}}
				</div>
			</div>
			<div class="row">

				<div class="small-6 columns">
					{{Form::label('vystaven','Vystaven:')}}
					{{Form::text('vystaven', date('Y-m-d',time()), array('class'=>'date vystaven'));}}
				</div>

				<div class="small-6 columns">
					{{Form::label('expire','Konec platnosti nabídky')}}
					{{Form::text('expire', date('Y-m-d',time()), array('class'=>'date expire'));}}
				</div>
			</div>
			<div class="row">

				<div class="small-12 columns">
					{{Form::label('dph','DPH:')}}
					{{Form::select('dph',array('21'=>'21%','15'=>'15%','0'=>'0%'),'')}}
				</div>
			</div>
			<div class="row">

				<div class="small-12 columns">
					{{Form::label('note', 'Poznámka:')}}
					{{Form::textarea('note','',array('rows'=>'3'))}}
				</div>
			</div>
			{{Form::close()}}
		</div>
		<div id="items">

		</div>
	</div>
</section>