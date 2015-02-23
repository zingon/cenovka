@extends('layout.main')

@section('content')
{{Form::open(array('route'=>array('select.update',$document->id),'method'=>'PUT'))}}
	<table class="table table-striped table-bordered" id="mainTable">
        <thead>
        <tr>
        	<th>Kód</th>
            <th>Název</th>
            <th>Cena</th>
            <th>Poznámka</th>
            <th>Počet</th>
            <th>Sleva<th>
        </tr>
        </thead>
        <tbody>
        
            @foreach($items as $item)
        <tr>
            <td>{{$item->item->code}}</td>
            <td>{{$item->item->name}}</td>
            <td>{{$item->item->price}}</td>
            <td>{{$item->item->note}}</td>
            <td>{{Form::number('count['.$item->id.']',$item->count)}}</td>
            <td>{{Form::number('discount['.$item->id.']',$item->discount)}}</td>
        </tr>
            @endforeach
        {{Form::submit('Uložit')}}
        </tbody>
 
    </table>
{{Form::close()}}
@stop