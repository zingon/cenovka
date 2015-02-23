@extends('layout.main')

@section('content')
 <a href="{{route('reload',$document->id)}}" class="btn btn-primary hidden-print"><span class="glyphicon glyphicon-refresh"></span>
  Aktualizovat Nabídku</a><i class="hidden-print"> Poslední aktualizace: {{$document->last_update}}</i>
 {{$document->exported_document}}
@stop