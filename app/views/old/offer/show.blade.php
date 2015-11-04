@extends('layout.main')

@section('content')
 <a href="{{route('reload',$document->id)}}" class="btn btn-primary hidden-print"><span class="glyphicon glyphicon-refresh"></span>
  Aktualizovat Nabídku</a><i class="hidden-print"> Poslední aktualizace: {{$document->last_update}}</i>
  <a href="{{route('export',$document->id)}}" class="btn btn-primary hidden-print">
  Export PDF</a>
 {{$document->exported_document}}
@stop