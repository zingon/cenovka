@extends('layout.inner-onecol')

@section('content')
<section>
    <div class="small-12 columns">
        <ul class="button-group right">
            <li><a href="{{URL::route('document.create')}}" class="button success modalLink" data-reveal-id="universalLargeModal" data-reveal-ajax="true"><i class="fi-page-add"></i> Nový dokument</a></li>
        </ul>
    </div>
</section>
<section>

        <table id="mainTable" class="large-12 columns">
            <thead>
                <tr>
                    <th>Kod</th>
                    <th>Název</th>
                    <th>Odběratel</th>
                    <th>Počet položek</th>
                    <th>Datum vystavení</th>
                    <th>Datum konce platnosti</th>
                    <th><span class="fi-pencil"></span></th>
                    <th><span class="fi-trash"></span></th>
                </tr>
            </thead>
            <tbody>
                {{--@foreach($documents as $document)
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
                @endforeach--}}
            </tbody>
            <tfoot>
            <tr>
                <td colspan='8' style="text-align: center">
                    {{--$documents->links()--}}
                </td>
            </tr>
            </tfoot>
        </table>
</section>
@stop