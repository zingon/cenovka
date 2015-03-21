<div class="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upravit dokument</h4>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-sm-3">
        <nav id="sideNav">
            <ul class="nav main">
                <li> <a class="edit">Editovat nabídku</a></li>
                <li> <a class="list">Editovat položky nabídky</a></li>
                <li> <a class="new">Přidat položky nabídky</a></li>
            </ul>
            <div class="second"></div>
            <a class="back btn btn-primary hidden">Zpět do nabídky</a>
            <a class="category btn btn-primary hidden">Zobrazit Kategorie</a>
        </nav>
      </div>
      <div class="col-sm-9 edit">
      {{Form::open(array('route'=>array('document.update', $document->id), 'method' => 'PUT','class'=>'form-horizontal','id'=>'documentEdit'))}}
        <div class="form-group">
            {{Form::label('name','Jméno',array('class'=>'col-sm-2'))}}
            <div class="col-sm-10">
                {{Form::text('name', $document->name,array('class'=>'form-control','placeholder'=>'Název'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('dodavatel','Dodavatel:',array('class'=>'col-sm-2'))}}
            <div class="col-sm-4">
                {{{$document->dodavatel->name}}}
            </div>

            {{Form::label('odberatel','Odběratel:',array('class'=>'col-sm-2'))}}
            <div class="col-sm-4">
                {{$document->odberatel->name}}
                {{Form::hidden('odberatel',$document->odberatel->id)}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('vystaven','Vystaven:',array('class'=>'col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::text('vystaven', '', array('id'=>'vystaven','class'=>'form-control'));}}
            </div>

            {{Form::label('expire','Konec platnosti nabídky',array('class'=>'col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::text('expire', '', array('id'=>'expire','class'=>'form-control'));}}
            </div>
        </div>
        
        <div class="form-group">
            {{Form::label('dph','DPH:',array('class'=>'col-sm-2'))}}
            <div class="col-sm-10">
                {{Form::select('dph',array('21'=>'21%','15'=>'15%','0'=>'0%'),$document->dph,array('class'=>'form-control'))}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('note', 'Poznámka:',array('class'=>'col-sm-2'))}}
            <div class="col-sm-10">
                {{Form::textarea('note',$document->note,array('class'=>'form-control','rows'=>'3'))}}
            </div>
        </div>

        {{Form::close()}}
        </div>
        <div class="col-sm-9 list hidden table-responsive">
        {{Form::open(array('route'=>array('select.update',$document->id),'method'=>'PUT','id'=>'documentItemEdit'))}}{{Form::close()}}
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Kód</th>
                <th>Název</th>
                <th>Cena</th>
                {{--<th>Poznámka</th>--}}
                <th class="col-xs-2">Počet</th>
                <th class="col-xs-2">Sleva</th>
                <th><span class="glyphicon glyphicon-remove"></span></th>
            </tr>
            </thead>
            <tbody>
            
                @foreach($items as $item)

            <tr data-filter="{{$item->category->id or 0}}" @if(!empty($item->note)) data-placement="bottom" data-toggle="popover" title="Poznámka" data-content="{{$item->note}}"@endif>
                <td class="col-md-2">{{$item->code}}</td>
                <td class="col-md-3">{{$item->name}}</td>
                <td class="col-md-2">{{$item->price}}</td>
                {{--<td>{{$item->note}}</td>--}}
                <td class="col-md-2">{{Form::input('text','count['.$item->id.']',$item->count,array("form"=>"documentItemEdit",'class'=>'form-control',"size"=>5,"patern"=>'^\\$?(([1-9](\\d*|\\d{0,2}(,\\d{3})*))|0)(\\.\\d{1,2})?$'))}}</td>
                <td class="col-md-2">{{Form::input('number','discount['.$item->id.']',$item->discount,array("form"=>"documentItemEdit",'class'=>'form-control',"patern"=>'^\\$?(([1-9](\\d*|\\d{0,2}(,\\d{3})*))|0)(\\.\\d{1,2})?$'))}}</td>
                <td class="col-md-1">{{Form::destroy('select',$item->id)}}</td>
            </tr>
                @endforeach
            </tbody>
        </table>
        
        </div>
        <div class="col-sm-9 new hidden table-responsive">
        
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default closeModal" data-dismiss="modal" form="categoryNew">Zavřít</button>
        <button type="submit" name="bez" class="btn btn-primary" form="documentEdit">Uložit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
<script type="text/javascript">
var vystaven    = new Date(Date.parse({{json_encode($document->vystaven)}}));
var expire      = new Date(Date.parse({{json_encode($document->expire)}}));   


$(function() {
    $("tr").popover({ trigger: "hover" });

    $( "#vystaven" ).datepicker()
    $( "#vystaven" ).datepicker("option", "dateFormat","yy-mm-dd");
    $( "#vystaven" ).datepicker('setDate', vystaven);

    $( "#expire").datepicker();
    $( "#expire" ).datepicker("option", "dateFormat","yy-mm-dd");
    $( "#expire" ).datepicker('setDate',expire);

    $("a.edit").click(function () {
        $('a.btn.category').addClass('hidden');
        $('ul.categories').remove();
         $('div.edit').removeClass('hidden');
         $('div.list').addClass('hidden');
         $('div.new').addClass('hidden');
         var formID = $('div.edit form').attr('id');
         $('.modal-footer button').each(function(i,v){
            $(v).attr('form',formID);
         });
    });
    $("a.list").click(function () {
         $('div.edit').addClass('hidden');
         $('div.list').removeClass('hidden');
         $('div.new').addClass('hidden');

         var formID = $('div.list form').attr('id');
         $('.modal-footer button').each(function(i,v){
            $(v).attr('form',formID);
         });
        $.get('{{URL::route('category.index')}}',function (html) {
            $('ul.categories').remove();
            $('a.btn.category').addClass('hidden');
            $('ul.main').after(html);
            $('ul.main').addClass('hidden');
            $('a.btn.back').removeClass('hidden');
            $('a.btn.back').click(function(){
                $('ul.main').removeClass('hidden');
                $('ul.categories').addClass('hidden');
                $('a.btn.back').addClass('hidden');
                $('a.btn.category').removeClass('hidden');
                $('a.btn.category').click(function(){
                    $('ul.main').addClass('hidden');
                    $('ul.categories').removeClass('hidden');
                    $('a.btn.category').addClass('hidden');
                    $('a.btn.back').removeClass('hidden');
                });
            });
            tableFilter('li>a.category','div.list tbody>tr');
            tableReseter('a.reset','div.list tbody>tr');
        });
    });
    $("a.new").click(function () {
        $('div.edit').addClass('hidden');
        $('div.list').addClass('hidden');
        $('div.new').removeClass('hidden');
         
        $.get('{{URL::route('category.index')}}',function (html) {
            $('ul.categories').remove();
            $('a.btn.category').addClass('hidden');
            $('ul.main').after(html);
            $('ul.main').addClass('hidden');
            $('a.btn.back').removeClass('hidden');
            $('a.btn.back').click(function(){
                $('ul.main').removeClass('hidden');
                $('ul.categories').addClass('hidden');
                $('a.btn.back').addClass('hidden');
                $('a.btn.category').removeClass('hidden');
                $('a.btn.category').click(function(){
                    $('ul.main').addClass('hidden');
                    $('ul.categories').removeClass('hidden');
                    $('a.btn.category').addClass('hidden');
                    $('a.btn.back').removeClass('hidden');
                });
            });
            
            $.get('{{URL::route('select.create')}}',function(shtml){
                $('div.new').html('');
                $('div.new').append(shtml);
                $("tr").popover({ trigger: "hover" });
                tableFilter('li>a.category','div.new tbody>tr');
                tableReseter('a.reset','div.new tbody>tr');
                var formID = $('div.new form').attr('id');
                 $('.modal-footer button').each(function(i,v){
                    $(v).attr('form',formID);
                 });
            });
         });
    });


});
</script>