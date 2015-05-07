 <!DOCTYPE html>
 <html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=">
     {{HTML::style('css/faktura.css')}}
 </head>
 <body>
 <table id="faktura">
            <tr>
                <td>
                    <table id="fakturaHlavicka">
                        <tr>
                            <td>Cenová nabídka</td>
                            <td>číslo: {{$document->code}}</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table id="fakturaUdaje">
                        <tr>
                            <td>Dodavatel:</td>
                            <td>Odběratel:</td>
                        </tr>
                        <tr>
                            <td>

                            	<strong>{{{$document->dodavatel()->removed()->name}}}</strong>
                            	<br>
                                {{{$document->dodavatel()->removed()->firstname}}} {{{$document->dodavatel()->removed()->lastname}}}
                                <br>
                                {{{$document->dodavatel()->removed()->adress}}}
                                <br>
                                {{{$document->dodavatel()->removed()->city}}}, {{{$document->dodavatel()->removed()->zip_code}}}
                            </td>
                            <td rowspan="2">
                                <strong>{{{$document->name}}}</strong>
                                <br>
                                <strong>{{{$document->odberatel()->removed()->name}}}</strong>
                                @if(!empty($document->odberatel()->removed()->firstname)||!empty($document->odberatel()->removed()->lastname))
                                <br>
                                {{{$document->odberatel()->removed()->firstname}}} {{{$document->odberatel()->removed()->lastname}}}
                                @endif
                                @if(!empty($document->odberatel()->removed()->adress))
                                <br>
                                {{{$document->odberatel()->removed()->adress}}}
                                @endif
                                <br>
                                {{{empty($document->odberatel()->removed()->city)?'':$document->odberatel()->removed()->city}}}
                                {{{empty($document->odberatel()->removed()->zip_code)?'':', '.$document->odberatel()->removed()->zip_code}}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            @if(!empty($document->dodavatel()->removed()->ic))
                                IČ: <em>{{{$document->dodavatel()->removed()->ic}}}</em>
                                <br>
                            @endif
                            @if(!empty($document->dodavatel()->removed()->dic))
                                DIČ: <em>{{{$document->dodavatel()->removed()->dic}}}</em>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td>
                                {{--Podnikatel zapsán v živ.rejstříku MÚ Mladá Boleslav--}}
                            </td>
                            <td>
                            @if(!empty($document->odberatel()->removed()->ic))
                                IČ: <em>{{{$document->odberatel()->removed()->ic}}}</em>
                            @endif
                            @if(!empty($document->odberatel()->removed()->dic))
                               , DIČ: <em>{{{$document->odberatel()->removed()->dic}}}</em>
                            @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table id="fakturaPodm">
                        {{--<tr>
                            <td colspan="4">
                                <strong>Platební podmínky:</strong>
                            </td>
                        </tr>--}}
                        <tr>
                            {{--<td>
                                <br>
                                Forma úhrady
                                <br>
                                Bankovní spojení:
                                <br>
                                Číslo účtu:
                            </td>
                            <td>
                                <br>
                                Bankovním převodem
                                <br>
                                Česká spořitelna
                                <br>
                                <strong>0800/XXXXXXXXX</strong>
                            </td>--}}
                            <td>
                                <i>Datum vystavení</i>
                                {{--<br>
                                <i>Datum zdanitel. plnění</i>--}}
                                <br>
                                <br>
                                <strong>Kones platnosti nabídky:</strong>
                            </td>
                            <td>
                                <i>{{date('d.m.Y', strtotime($document->vystaven))}}</i>
                                {{--<br>
                                 <i>10.3.2011</i>--}}
                                <br>
                                <br>
                                <strong>{{date('d.m.Y', strtotime($document->expire))}}</strong>
                            </td>
                        </tr>
                        {{--<tr>
                            <td>
                                Variabilní symbol:
                            </td>
                            <td colspan="3">
                                20110001
                            </td>
                        </tr>--}}
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table id="fakturaFakturace">
                        <tr>
                            <td>
                                <strong>Položky:</strong>
                            </td>
                            <td>
                                Cena za jednotku:
                            </td>
                            <td>
                                Množství:
                            </td>
                            <td>
                                Jednotka:
                            </td>
                            
                            <td>
                                Sleva:
                            </td>
                            <td>
                                Celkem po slevě:
                            </td>
                            <td></td>
                        </tr>
                        @if(!empty($polozky))
                        @foreach($polozky as $item)
                        <tr>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                {{$item->price}} Kč
                            </td>
                             <td>
                                {{$item->count}}
                            </td>
                            <td>
                                {{$item->unit[0]}}<sup>{{$item->unit[1] or ""}}</sup>
                            </td>
                            <td>
                                {{$item->discount}} %
                            </td>
                            <td>
                                {{$item->priceDiscount}} Kč
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table id="fakturaPaticka">
                        <tr>
                            <td>
                                Základ pro DPH:
                                <br>
                                DPH častka {{$document->dph}}%:
                                <br> 
                                <b>Cena s DPH:</b>
                            </td>
                            <td>
                                 {{$total_price}} Kč
                                <br>
                                {{round($total_price * $dph_kons,2)}} Kč
                                <br>
                                <strong>{{round($total_price+$total_price* $dph_kons, 2)}} Kč</strong>
                            </td>
                        </tr>
                        <tr>
                            <td  colspan="2">
                                <strong>Vyřizuje:</strong>
                                <br>
                                <br>
                                {{{$document->dodavatel()->removed()->firstname}}} {{{$document->dodavatel()->removed()->lastname}}}
                                <br>
                                Tel: {{{ $document->dodavatel()->removed()->phone }}}
                                <br>
                                Email: {{{ $document->dodavatel()->removed()->email }}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>