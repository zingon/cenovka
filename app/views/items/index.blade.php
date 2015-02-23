@extends('layout.main')

@section('content')
<p style="text-align: right; padding-right: 20px">
    <a href="{{route('category.edit')}}" class="btn btn-primary modalLink"><span class="glyphicon glyphicon-pencil"></span>  Editovat Kategorie</a>
    <a href="{{route('category.create')}}" class="btn btn-success modalLink" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-plus"></span>  Nová Kategorie</a>

    <a href="{{route('item.create')}}" class="btn btn-success modalLink"><span class="glyphicon glyphicon-plus"></span>  Nová Položka</a>
</p>
<table class="table table-striped table-bordered" id="mainTable">
        <thead>
        <tr>
            <th></th>
            <th>Kod</th>
            <th>Název</th>
            <th>Cena</th>
            <th>MJ</th>
            <th>Poznámka</th>
            <th><span class="glyphicon glyphicon-pencil"></span></th>
            <th><span class="glyphicon glyphicon-remove"></span></th>
            
        </tr>
        </thead>
        <tbody id="items">
            @foreach($items as $item)
        <tr data-filter="{{$item->category->class}}" data-position="{{$item->id}}">
            <td><button class="glyphicon glyphicon-arrow-up up"></button> <button class="glyphicon glyphicon-arrow-down down"></button></td>
            <td>{{{$item->code}}}</td>
            <td>{{{$item->name}}}</td>
            <td>{{{$item->price}}}</td>
            <td>{{{$item->unit}}}</td>
            <td>{{{$item->note}}}</td>
            <td><a href='{{URL::route("item.edit",$item->id)}}' class="glyphicon glyphicon-pencil btn btn-primary modalLink"></a></td>
            <td>{{Form::destroy('item',$item->id)}}</td>
        </tr>
            @endforeach
        </tbody>
    </table>
@stop
@section('script')
<script type="text/javascript">

$(function() {
    $.get("{{URL::route('category.index')}}",function(data) {
        $("#sideNav").html(data);
        tableFilter('a.category','tbody>tr');
        tableReseter('a.reset','tbody>tr');
    });
      
      $(".up,.down").click(function () {
      var $element = this;
      var row = $($element).parents("tr:first");
      var poradi = row.data('position');
      if($(this).is('.up')){
         row.insertBefore(row.prev());
         
         $.get('/items/'+poradi+'/poradi/up');
      } 
      else{
         row.insertAfter(row.next());
         $.get('/items/'+poradi+'/poradi/down');
      }
  });
 });

</script>
@stop