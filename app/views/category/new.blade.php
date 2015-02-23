<div class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nová kategorie</h4>
      </div>
      <div class="modal-body">
        {{Form::open(array('route'=>'category.store','id'=>'categoryNew','class'=>'form-horizontal'))}}
        
            <div class="form-group">
                {{Form::label('code','Kod:',array('class'=>'col-sm-2'))}}
                <div class="col-sm-10">
                    {{{$code}}}
                </div>
            </div>

            <div class="form-group">
                {{Form::label('name', 'Název:',array('class'=>'col-sm-2'))}}
                 <div class="col-sm-10">
                    {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Název'))}}
                </div>
            </div>

            <div class="form-group">
                {{Form::label('note','Poznámka:',array('class'=>'col-sm-2'))}}
                <div class="col-sm-10">
                    {{Form::textarea('note','',array('class'=>'form-control','placeholder'=>'Poznámka','rows'=>'3'))}}
                </div>
            </div>
        {{Form::close()}}
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default closeModal" data-dismiss="modal" form="categoryNew">Close</button>
        <button type="submit" class="btn btn-primary" form="categoryNew">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->