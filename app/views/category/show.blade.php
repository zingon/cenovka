@foreach($items as $item)
<tr>
	<td>{{{$item->code}}}</td>
	<td>{{{$item->name}}}</td>
	<td>{{{$item->price}}}</td>
	<td>{{{$item->note}}}</td>
	<td><a href="{{route('item.edit',$item->id)}}">Upravit</a></td>
	<td>{{Form::destroy('item',$item->id)}}</td>
@endforeach