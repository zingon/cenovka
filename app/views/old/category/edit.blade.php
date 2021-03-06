<div class="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nová kategorie</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kód</th>
                    <th>Název</th>
                    <th>Poznámka</th>
                    <th><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->code}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->note}}</td>
                    <td>{{Form::destroy('category',$category->id)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default closeModal" data-dismiss="modal" form="categoryNew">Close</button>
        <button type="submit" class="btn btn-primary" form="categoryNew">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->