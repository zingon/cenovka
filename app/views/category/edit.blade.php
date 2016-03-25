{{Form::open(array("route"=>["category.update",0],"method"=>"PUT"))}}
<table class="small-12 columns">
    <thead>
        <tr>
            <th>Kód</th>
            <th>Název</th>
            <th>Poznámka</th>
            <th>Smazat</th>
        </tr>
    </thead>
    <tbody>

    @foreach($categories as $category)
        <tr>
            <td>{{$category->code}}</td>
            <td>{{Form::text("categories[".$category->id."][name]",$category->name)}}</td>
            <td>{{Form::textarea("categories[".$category->id."][note]",$category->note,array("rows"=>"2"))}}</td>

            <td>@if($category->code != 000)<button data-id="{{$category->id}}" type="button" id="categoryDelete" class="fi-trash expand alert"></button>@endif</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
        <tr>
        <td colspan="2"></td><td colspan="2">{{Form::button("Uložit", array("class"=>" right","type"=>"submit"))}}</td>
        </tr>
    </tfoot>
</table>
{{Form::close()}}
<a class="close-reveal-modal" arial-label="Close">&#215;</a> 
