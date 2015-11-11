
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
            <td>{{$category->name}}</td>
            <td>{{$category->note}}</td>
            <td>{{Form::destroy('category',$category->id)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<a class="close-reveal-modal" arial-label="Close">&#215;</a> 
