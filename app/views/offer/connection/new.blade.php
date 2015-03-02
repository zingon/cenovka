{{Form::open(array('route'=>'select.store','id'=>'documentNewItems'))}}
{{Form::hidden("document")}}
<table class="table table-striped table-bordered">
        <thead>
        <tr>
        	<th></th>
        	<th>Kód</th>
            <th>Název</th>
            <th>Cena</th>
            <th>Poznámka</th>
            <th>Počet</th>
            <th>Sleva</th>
        </tr>
        </thead>
        <tbody>
        
            @foreach($items as $item)
        <tr  data-filter="{{$item->category->class}}">
        	<td>{{Form::checkbox('selected['.$item->id.']',$item->id,false)}}</td>
            <td>{{$item->code}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->note}}</td>
            <td>{{Form::input('number','count['.$item->id.']',1,array('class'=>'form-control'))}}</td>
            <td>{{Form::input('number','discount['.$item->id.']',0,array('class'=>'form-control'))}}</td>
        </tr>
            @endforeach
        
        </tbody>
 
    </table>
{{Form::close()}}