<div class="row">
	<div class="small-12 columns">
		<h4>{{$title}}</h4>
	</div>
</div>
<section id="tabNav">
	<div class="small-12 columns">
		<ul class="side-nav row">
			@if ($edit)
				<li class="small-4 columns active offer"><a href="#" data-open="offer">Úprava nabídky</a></li>
				<li class="small-4 columns items"><a href="#" data-open="items">Přidání položek do nabídky</a></li>
				<li class="small-4 columns editItems"><a href="#" data-open="editItems">Editace položek</a></li>
			@else
				<li class="small-6 columns active offer"><span>Vytvoření nabídky</span></li>
				<li class="small-6 columns items"><span>Přidání položek do nabídky</span></li>
			@endif
		</ul>
	</div>
</section>
<section>
	<div class="small-12 columns">
		<div id="offer">
			{{Form::open(array('route'=>$route, "method"=>$method,"data-edit"=>$edit))}}
			<div class="row">
				<div class="small-12 columns">
					{{Form::label('name','Jméno')}}
					{{Form::text('name',$data->name,array('placeholder'=>'Název'))}}
				</div>
			</div>
			<div class="row">
				<div class="small-4 columns">
					{{Form::label('dodavatel','Dodavatel:')}}
					{{{$dodavatel->name}}}
				</div>

				<div class="small-8 columns">
					{{Form::label('odberatel','Odběratel:')}}
					{{Form::select('odberatel',$odberatele,$data->odberatel_id)}}
				</div>
			</div>
			<div class="row">

				<div class="small-6 columns">
					{{Form::label('vystaven','Vystaven:')}}
					{{Form::text('vystaven', date_format(date_create($data->vystaven), 'd.m.Y'), array('class'=>'date vystaven'));}}
				</div>

				<div class="small-6 columns">
					{{Form::label('expire','Konec platnosti nabídky')}}
					{{Form::text('expire',  date_format(date_create($data->expire), 'd.m.Y'), array('class'=>'date expire'));}}
				</div>
			</div>
			<div class="row">

				<div class="small-12 columns">
					{{Form::label('dph','DPH:')}}
					{{Form::select('dph',array('21'=>'21%','15'=>'15%','0'=>'0%'),$data->dph)}}
				</div>
			</div>
			<div class="row">

				<div class="small-12 columns">
					{{Form::label('note', 'Poznámka:')}}
					{{Form::textarea('note',$data->note,array('rows'=>'3'))}}
				</div>
			</div>
			<div class="row">
				<div class="small-12 columns">
					@if (!$edit)
					<button type="button" class="next right" data-open="items">Další krok</button>
					@else
					<button type="button" class="saveDoc right">Uložit</button>
					@endif
				</div>
			</div>
			{{Form::close()}}
		</div>
		<div id="items" data-url="{{route('select.create')}}">

		</div>
		<div id="editItems" data-url="{{route('select.edit',$data->id)}}">

		</div>
	</div>
</section>
<script>
$(document).ready(function() {
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(),nowTemp.getDate(),0,0,0,0);
	var vystaven = $("#vystaven").fdatepicker({
		language: 'cs',
		format: 'dd.mm.yyyy',
		weekStart:1,
	});
	if(!($("#vystaven").val().length>0)){
		vystaven.fdatepicker('update',now);
	}

	var expire = $("#expire").fdatepicker({
		language: 'cs',
		format: 'dd.mm.yyyy',
		weekStart:1,
		});
	if(!(expire.val().length>0)) {
		now.setDate(now.getDate()+30);
		expire.fdatepicker('update',now);
	}


});
</script>