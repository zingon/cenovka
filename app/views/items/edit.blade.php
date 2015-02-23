<div class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editovat položku {{$item->code}}</h4>
      </div>
      <div class="modal-body">
        {{Form::open(array('route'=>array('item.update',$item->id),'method'=>'PUT','id'=>'itemForm','class'=>'form-horizontal'))}}
			<div class="form-group">
				{{Form::label('name','Název:',array('class'=>'col-sm-2'))}}
				 <div class="col-sm-10">
					{{Form::text('name',$item->name,array('class'=>'form-control','placeholder'=>'Název'))}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('price','Cena:',array('class'=>'col-sm-2'))}}
				 <div class="col-sm-10">
					{{Form::number('price',(float)$item->price,array('class'=>'form-control','placeholder'=>'Cena'))}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('category','Kategorie',array('class'=>'col-sm-2'))}}
				 <div class="col-sm-4">
					{{Form::select('category',$categories,$item->category->id,array('class'=>'form-control'))}}
				</div>
				{{Form::label('unit','Jednotka',array('class'=>'col-sm-2'))}}
				 <div class="col-sm-4">
					{{Form::select('unit',array('bm'=>'bm','ks'=>'ks','m^2'=>'m2','m^3'=>'m3','km'=>'km'),$item->unit,array('class'=>'form-control'))}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('note','Poznámka:',array('class'=>'col-sm-2'))}}
				<div class="col-sm-10">
					{{Form::textarea('note',$item->note,array('class'=>'form-control','rows' => '3', 'placeholder'=> 'Poznámka'))}}
				</div>
			</div>
			
        {{Form::close()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default closeModal" data-dismiss="modal">Zavřít</button>
        <button type="submit" class="btn btn-primary" form="itemForm">Uložit Změny</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->