<div class="row">
	<div class="small-12 columns title">
		<h4>{{$title}}</h4>
	</div>
</div>
{{Form::open(array('route'=>$route,'id'=>'contactForm','method'=>$method))}}
<div class="row">
	<div class="small-12 columns">
		{{Form::label('name','Název')}}
		{{Form::text('name',$data->name,array('placeholder'=>'Název'))}}
	</div>
</div>
<div class="row">
	<div class="small-12 medium-6 columns">
		{{Form::label('firstname','Křestní jméno')}}
		{{Form::text('firstname',$data->firstname,array('placeholder'=>'Křestní Jméno'))}}
	</div>
	<div class="small-12 medium-6 columns">
		{{Form::label('lastname','Příjmení')}}
		{{Form::text('lastname',$data->lastname,array('placeholder'=>'Příjmení'))}}
	</div>
</div>
<div class="row">
	<div class="small-12 medium-12 columns">
		{{Form::label('phone','Telefon')}}
		{{Form::text('phone',$data->phone,array('placeholder'=>'Telefon'))}}
	</div>
</div>
<div class="row">
	<div class="small-12 medium-6 columns">
		{{Form::label('dic','DIČ')}}
		{{Form::text('dic',$data->dic,array('placeholder'=>'DIČ'))}}
	</div>
	<div class="small-12 medium-6 columns">
		{{Form::label('ic','IČ')}}
		{{Form::text('ic',$data->ic,array('placeholder'=>'IČ'))}}
	</div>
</div>
<div class="row">
	<div class="small-12 columns">
		{{Form::label('adress','Ulice a č.p')}}
		{{Form::text('adress',$data->adress,array('placeholder'=>'Ulice a č.p'))}}
	</div>
</div>
<div class="row">
	<div class="small-12 medium-6 columns">
		{{Form::label('city','Město')}}
		{{Form::text('city',$data->city,array('placeholder'=>'Město'))}}
	</div>
	<div class="small-12 medium-6 columns">
		{{Form::label('zip_code','PSČ')}}
		{{Form::text('zip_code',$data->zip_code,array('placeholder'=>'PSČ'))}}
	</div>
</div>
<ul class="button-group right">
	<li><button type="submit" class="button success">Uložit</button></li>
</ul>
{{Form::hidden("hidden",0)}}
{{Form::close()}}
<a class="close-reveal-modal" arial-label="Close">&#215;</a>