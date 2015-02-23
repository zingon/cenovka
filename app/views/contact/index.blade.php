@extends('layout.main')

@section('content')
<p style="text-align: right; padding-right: 20px">
    <a href="{{route('contact.create')}}" id="new" class="btn btn-success modalLink"><span class="glyphicon glyphicon-plus"></span> Nový Kontakt</a>
</p>
<table class="table table-striped table-bordered" >
        <thead>
        <tr>
            <th>Název</th>
            <th>Jméno</th>
            <th>Adresa</th>
            <th>Poznámka</th>
            <th><span class="glyphicon glyphicon-pencil"></span></th>
            <th><span class="glyphicon glyphicon-remove"></span></th>
        </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
        <tr>
            <td>{{{$contact->name | ""}}}</td>
            <td>{{{$contact->firstname | ""}}} {{{$contact->lastname | ""}}}</td>
            <td>{{{$contact->adress|""}}}, {{{$contact->city | ""}}}{{{" ".$contact->zip_code|""}}}</td>
            <td>{{{$contact->note | ""}}}</td>
            <td><a href='{{URL::route("contact.edit",$contact->id)}}' class="glyphicon glyphicon-pencil btn btn-primary modalLink"></a></td>
            <td>{{Form::destroy('contact',$contact->id)}}</td>
        </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan='6'>
                {{$contacts->links()}}
                </td>
            </tr>
        </tfoot>
    </table>
@stop