{{Form::open(array('route'=>'select.store','id'=>'documentNewItems'))}}
{{Form::hidden("document")}}
<table class="table table-striped table-bordered">
        <thead>
        <tr>
        	<th></th>
        	<th>Kód</th>
            <th>Název</th>
            <th>Cena</th>
            <th>Počet</th>
            <th>Sleva</th>
        </tr>
        </thead>
        <tbody id="items">
        
            @foreach($items as $item)
        <tr  data-filter="{{$item->category->id or '0'}}" @if(!empty($item->note)) data-placement="bottom" data-toggle="popover" title="Poznámka" data-content="{{$item->note}}"@endif>
        	<td class="col-md-1">{{Form::checkbox('selected['.$item->id.']',$item->id,false)}}</td>
            <td class="col-md-2">{{$item->code}}</td>
            <td class="col-md-3">{{$item->name}}</td>
            <td class="col-md-2">{{$item->price}}</td>
            <td class="col-md-2">{{Form::input('number','count['.$item->id.']',1,array('class'=>'form-control',"patern"=>'^\\$?(([1-9](\\d*|\\d{0,2}(,\\d{3})*))|0)(\\.\\d{1,2})?$'))}}</td>
            <td class="col-md-2">{{Form::input('number','discount['.$item->id.']',0,array('class'=>'form-control',"patern"=>'^\\$?(([1-9](\\d*|\\d{0,2}(,\\d{3})*))|0)(\\.\\d{1,2})?$'))}}</td>
        </tr>
            @endforeach
        
        </tbody>
 
    </table>
{{Form::close()}}
