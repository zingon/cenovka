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
                <th class="p8">Kod</th>
                <th class="p20">Název</th>
                <th class="p20">Odběratel</th>
                <th class="p8">Počet položek</th>
                <th class="p15">Datum vystavení</th>
                <th class="p15">Datum konce platnosti</th>
                <th class="p7"><span class="fi-pencil"></span></th>
                <th class="p7"><span class="fi-trash"></span></th>
            </tr>
        </thead>
        <tbody id="documents">
        </tbody>
        <tfoot>
        <tr>
            <td colspan="8">
                <div id="pagination"></div>
            </td>
        </tr>
        </tfoot>
    </table>
</section>
@stop
@section("script")
{{ HTML::script('js/items.js')}}
{{ HTML::script('js/document.js')}}
<!-- {{ HTML::script('js/loaders/document.js')}}
{{ HTML::script('js/templates/document.js')}} -->
@stop