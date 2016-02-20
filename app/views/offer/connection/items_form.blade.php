{{Form::open(array('route'=>$route,'method'=>$method,'id'=>'documentNewItems', "data-edit" =>$edit))}}
<table>
        <thead>
        <tr>
            @if (!$edit)
        	<th></th>
            @endif
        	<th>Kód</th>
            <th>Název</th>
            <th>Cena</th>
            <th>Počet</th>
            <th>Sleva</th>
            @if ($edit)
            <th>Smazat</th>
            @endif
        </tr>
        </thead>
        <tbody id="itemsSpace">

        </tbody>
        <tfoot>
            <tr>
            <td colspan="7">
                <div id="connectionPagination"></div>
            </td>
        </tr>
        </tfoot>
    </table>
    <div class="row">
        <div class="small-12 columns right">
            @if ($edit)
                <button type="button" id="updateItems" class="right">Aktualizovat</button>
            @else
                <button type="button" id="sendItems" class="right">Uložit</button>
            @endif

        </div>
    </div>
{{Form::close()}}