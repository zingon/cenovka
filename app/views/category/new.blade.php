{{Form::open(array('route'=>'category.store','id'=>'categoryNew','class'=>'form-horizontal'))}}
<div class="row">
    <div class="small-12 columns">
        <h3>Nová kategorie - {{{$code}}}</h3>
    </div>
</div>
<div class="row">
    <div class="small-12 columns">
        {{Form::label('name', 'Název',array('class'=>'col-sm-2'))}}
        {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Název'))}}
    </div>
</div>
<div class="row">
    <div class="small-12 columns">
        {{Form::label('note','Poznámka',array('class'=>'col-sm-2'))}}
        {{Form::textarea('note','',array('class'=>'form-control','placeholder'=>'Poznámka','rows'=>'3'))}}
    </div>
</div>
<ul class="button-group right">
    <li><button type="submit" class="button success">Uložit</button></li>
</ul>
{{Form::close()}}
<a class="close-reveal-modal" arial-label="Close">&#215;</a> 