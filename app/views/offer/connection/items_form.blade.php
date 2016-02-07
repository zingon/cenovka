{{Form::open(array('route'=>'select.store','id'=>'documentNewItems'))}}
<table>
        <thead>
        <tr>
        	<th></th>
        	<th>Kód</th>
            <th>Název</th>
            <th>Cena</th>
            <th>Počet</th>
            <th>Sleva</th>
        </tr>
        </thead>
        <tbody id="itemsSpace">

        </tbody>
        <tfoot>
            <tr>
            <td colspan="6">
                <div id="connectionPagination"></div>
            </td>
        </tr>
        </tfoot>
    </table>
{{Form::close()}}