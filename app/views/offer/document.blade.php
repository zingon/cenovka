<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width"/>
  <style type="text/css">
  body {font-family: DejaVu Sans, sans-serif;font-size: 14px; } table table{margin-top: 0; padding-top: 0} .r {text-align: right; } table.container { width:100%; } table.body { width:100%; border-collapse: collapse; } table.body thead tr{ font-size: 0.9rem; } table.body thead h1{ font-size: 1.2rem ; padding: 0; margin: 0; padding-top: 0.7rem; padding-bottom: 0.7rem; padding-left: 0.2rem; } .border { border:1px solid black; } table.body .left { float:left; } table.body .right { float:right; } table.body .center { text-align: center; } table.body tbody { border: 1px solid black; border-bottom: none; } table.body tfoot {line-height: 2rem;font-size: 0.8rem;border: 1px solid black;border-top: none; } table.body tfoot td {padding-left:1rem;height: 5rem;vertical-align: bottom; } table.body .half { width: 50%; } table.body .quater { width: 25%; } table,tr,td { border-collapse: collapse; } td.blank { border: none; } table.body .r-b-none { border-right: none; } table.body .l-b-none { border-left: none; } #contacts td {font-size: 0.9rem; vertical-align: top; padding-top: 1rem; } #contacts small{ margin-left: 1.5rem; } #contacts p{ margin-left: 2rem; } #contacts p>i{ font-size: 0.9rem; } table.body .full { width:100%; padding:0 0rem; } #dates td {font-size: 0.9rem;padding: 0.6rem;padding-left: 1rem; } #items table { width: 100%; height: auto; font-size: 0.9rem; padding:0; margin:0; margin-bottom: 1rem; margin-top: 1rem; } #items table thead tr {line-height: 2.5rem} #items table th {text-align: left;font-size: 0.7rem;line-height: 1rem;vertical-align: middle; padding:0 0.5rem;} #items table tbody {border: none;margin: 0; } #items table tbody tr {line-height: 1.3rem; font-size: 0.7rem; padding-top:0.3rem;padding-left:1rem;padding-right:1rem} #items table tbody td { padding-top:0.3rem; padding-left:0.5rem;padding-right:0.5rem} @media print {#items table th {  font-size: 0.8rem;  line-height: 1.3rem;}#items table tbody tr {  line-height: 1rem; font-size:0.8rem;} } #items table td {vertical-align: top; } #endPrice td {font-size: 0.9rem;padding-bottom: 1rem;padding-top: 1rem;padding-left: 1rem;padding-right: 1rem; } #signature {vertical-align: top;height:8rem;font-size: 0.9rem; } #signature .sign {margin-bottom: 2rem;padding-left:1rem; } #signature .stamp {margin-bottom: 4rem; }
  </style>
  </head>
  <body>
  <table class="container">
    <tr>
    <td>
      <center>
      <table class="body">
      <thead>
        <tr>
        <td class="half"></td>
        <td class="quater border r-b-none center">
          <h1>Cenová nabídka</h1>
        </td>
        <td class="quater border l-b-none center">
          číslo: {{$document->code}}
        </td>
        </tr>
      </thead>
      <tbody>
        <tr id="contacts">
        <td class="half">
          <small>Dodavatel</small>
          <p>

          <strong>{{$document->user->user_setting->name}}</strong><br />
          @if($document->user->user_setting->name != ($document->user->user_setting->firstname." ".$document->user->user_setting->lastname)) {{$document->user->user_setting->firstname}} {{$document->user->user_setting->lastname}}<br />@endif
         @if ( $document->user->user_setting->adress) {{$document->user->user_setting->adress}}<br />@endif
          @if ( $document->user->user_setting->city||$document->user->user_setting->zip_code) {{$document->user->user_setting->city}}@if ( $document->user->user_setting->city&&$document->user->user_setting->zip_code), @endif{{$document->user->user_setting->zip_code}} <br />@endif
          <br />
          @if ( $document->user->user_setting->ic)IČ: {{$document->user->user_setting->ic}}<br />@endif
          @if ( $document->user->user_setting->dic)DIČ: {{$document->user->user_setting->dic}}<br />@endif
          </p>
        </td>
        <td class="half" colspan="2">
          <small>Odběratel</small>
          <p>
          <strong>{{$document->odberatel->name}}</strong><br />
          @if ( $document->odberatel->name != ($document->odberatel->firstname." ".$document->odberatel->lastname) ){{$document->odberatel->firstname}} {{$document->odberatel->lastname}}<br />@endif
         @if ( $document->odberatel->adress) {{$document->odberatel->adress}}<br />@endif
          @if ( $document->odberatel->city||$document->odberatel->zip_code) {{$document->odberatel->city}}@if ( $document->odberatel->city&&$document->odberatel->zip_code),@endif {{$document->odberatel->zip_code}} <br />@endif
          <br />
          @if ( $document->odberatel->ic)IČ: {{$document->odberatel->ic}}<br />@endif
          @if ( $document->odberatel->dic)DIČ: {{$document->odberatel->dic}}<br />@endif
          </p>
        </td>
        </tr>
        <tr id="dates">


             <td class="half" style="border-bottom:1px solid black;border-top:1px solid black;">Datum vystavení: {{date_format(date_create($document->vystaven), 'd.m.Y')}}</td>
            <td class="half" style="border-bottom:1px solid black;border-top:1px solid black;" colspan="2"><strong>Datum konce platnosti:</strong> {{date_format(date_create($document->expire), 'd.m.Y')}}</td>


        </tr>
        <tr id="items" class="border">
        <td class="full" colspan="3"  style="border-bottom:1px solid black">
          <table style="margin-top: 0">
          <thead style="border-bottom:1px solid black">
            <tr>
            <th style="width:7%; border-right:1px solid black">Kód</th>
            <th style="width:15%; border-right:1px solid black">Název</th>
            <th style="width:6%; border-right:1px solid black">Sleva</th>
            <th style="width:17%; border-right:1px solid black">Cena za ks bez DPH</th>
            <th style="width:17%; border-right:1px solid black">Cena za ks s DPH</th>
            <th style="width:4%; border-right:1px solid black">Ks</th>
            <th style="width:17%; border-right:1px solid black" class="r">Cena celkem bez DPH</th>
            <th style="width:17%" class="r">Cena celkem s DPH</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($document->items_conection as $item)
             <tr>
                      <td>{{$item->item->code}}</td>
                      <td>{{$item->item->name}}</td>
                      <td style="text-align: center">{{$item->discount}} %</td>
                      <td class="r">{{$item->without_tax_one}} Kč</td>
                      <td class="r">{{$item->with_tax_one}} Kč</td>
                      <td style="text-align: center">{{$item->count}}</td>
                      <td class="r">{{$item->without_tax_all}} Kč</td>
                      <td class="r">{{$item->with_tax_all}} Kč</td>
                    </tr>
          @endforeach

          </tbody>
          </table>
        </td>
        </tr>
        <tr id="endPrice">
        <td class="half"></td>
        <td class="quater border r-b-none"><strong>Celkem k úhradě: </strong></td>
        <td class="quater border l-b-none r"><strong>{{$document->total_price}} Kč</strong></td>
        </tr>
         <tr id="signature">
        <td class="half"><p class="sign">Podpis:</p></td>
         <td class="half" colspan="2"><p class="stamp">Razítko:</p></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
        <td colspan="3">Vyřizuje: <strong>{{$document->user->user_setting->firstname}} {{$document->user->user_setting->lastname}}</strong>, Telefon: {{$document->user->user_setting->phone}}</td>
        </tr>
      </tfoot>
      </table>
      </center>
    </td>
    </tr>
  </table>
  </body>
</html>