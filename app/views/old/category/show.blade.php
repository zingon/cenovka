@foreach($items as $item)
<tr>
	<td>{{{$item->code}}}</td>
	<td>{{{$item->name}}}</td>
	<td>{{{$item->price}}}</td>
	<td>{{{$item->unit}}}</td>
	<td>{{{$item->note}}}</td>
	<td><a href="{{route('item.edit',$item->id)}}" class="glyphicon glyphicon-pencil btn btn-primary modalLink"></a></td>
	<td>{{Form::destroy('item',$item->id)}}</td>
@endforeach