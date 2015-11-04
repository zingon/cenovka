@extends('layout.main')

@section('content')
<p style="text-align: right; padding-right: 20px">
    <a href="{{URL::route('document.create')}}" class="btn btn-success modalLink"><span class="glyphicon glyphicon-plus"></span>Nová Položka</a>
</p>
    <table class="table table-striped table-bordered" id="mainTable">
        <thead>
        <tr>
            <th>Kod</th>
            <th>Název</th>
            <th>Odběratel</th>
            <th>Počet položek</th>
            <th>Datum vystavení</th>
            <th>Datum konce platnosti</th>
            <th><span class="glyphicon glyphicon-pencil"></span></th>
            <th><span class="glyphicon glyphicon-remove"></span></th>
        </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
        <tr>
            <td>{{$document->code}}</td>
            <td><a href="{{URL::route('document.show',array($document->id))}}">{{$document->name}}</a></td>
            <td>{{$document->odberatel()->removed()->name}}</td>
            <td>{{$document->items()->count()}}</td>
            <td>{{$document->vystaven}}</td>
            <td>{{$document->expire}}</td>
            <td><a href='{{URL::route("document.edit",$document->id)}}' class="glyphicon glyphicon-pencil btn btn-primary modalLink"></a></td>
            <td>{{Form::destroy('document',$document->id)}}</td>
        </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td colspan='8' style="text-align: center">
                {{$documents->links()}}
                </td>
            </tr>
        </tfoot>
    </table>
    
@stop
