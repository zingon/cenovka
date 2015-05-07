<div class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nová položka</h4>
      </div>
      <div class="modal-body">
        {{Form::open(array('route'=>'item.store','id'=>'itemForm','class'=>'form-horizontal'))}}
			<div class="form-group">
				{{Form::label('name','Název:',array('class'=>'col-sm-2'))}}
				 <div class="col-sm-10">
					{{Form::text('name','',array('class'=>'form-control','placeholder'=>'Název',"required"))}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('buy_price','Nákupní cena:',array('class'=>'col-sm-2'))}}
				<div class="col-sm-4">
					{{Form::number('buy_price','',array('class'=>'form-control','placeholder'=>'Nákupní cena',"required"))}}
				</div>
				{{Form::label('price','Cena:',array('class'=>'col-sm-2'))}}
				 <div class="col-sm-4">
					{{Form::number('price','',array('class'=>'form-control','placeholder'=>'Cena',"required"))}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('category','Kategorie',array('class'=>'col-sm-2'))}}
				 <div class="col-sm-4">
					{{Form::select('category',$categories,null,array('class'=>'form-control'))}}
				</div>

				{{Form::label('unit','Jednotka',array('class'=>'col-sm-2'))}}
				 <div class="col-sm-4">
					{{Form::select('unit',array('bm'=>'bm','ks'=>'ks','m^2'=>'m2','m^3'=>'m3','km'=>'km','h'=>'h'),null,array('class'=>'form-control'))}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('note','Poznámka:',array('class'=>'col-sm-2'))}}
				<div class="col-sm-10">
					{{Form::textarea('note','',array('class'=>'form-control','rows' => '3', 'placeholder'=> 'Poznámka'))}}
				</div>
			</div>

        {{Form::close()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default closeModal" data-dismiss="modal">Zavřít</button>
        <button type="submit" class="btn btn-primary" form="itemForm">Uložit položku</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->