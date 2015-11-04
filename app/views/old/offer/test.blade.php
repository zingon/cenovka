<!-- Inliner Build Version 4380b7741bb759d6cb997545f3add21ad48f010b -->
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=">
</head>
<body>
 <table id="faktura" style="font-family: sans-serif; border-collapse: collapse;">
<tr>
<td style="margin: 0; padding: 0;">
                    <table id="fakturaHlavicka" style="border-collapse: collapse; float: right; border-color: black; border-style: solid solid none; border-width: 1px;"><tr>
<td style="margin: 0; padding: 0.3em 1em;">Cenová nabídka</td>
                            <td style="font-size: 1.2em; margin: 0; padding: 0.3em 1em;">číslo: {{$document->code}}</td>
                        </tr></table>
</td>
            </tr>
<tr>
<td style="margin: 0; padding: 0;">
                    <table id="fakturaUdaje" style="border-collapse: collapse; width: 100%; border-color: black; border-style: solid solid none; border-width: 1px;">
<tr style="font-size: 0.9em;">
<td style="border-right-width: 1px; border-right-color: black; border-right-style: solid; margin: 0; padding: 0.3em 1em;">Dodavatel:</td>
                            <td style="margin: 0; padding: 0.3em 1em;">Odběratel:</td>
                        </tr>
<tr>
<td style="border-right-width: 1px; border-right-color: black; border-right-style: solid; margin: 0; padding: 0.3em 1.8em;">

                                <strong>{{{$document->dodavatel()->removed()->name}}}</strong>
                                <br>
                                {{{$document->dodavatel()->removed()->firstname}}} {{{$document->dodavatel()->removed()->lastname}}}
                                <br>
                                {{{$document->dodavatel()->removed()->adress}}}
                                <br>
                                {{{$document->dodavatel()->removed()->city}}}, {{{$document->dodavatel()->removed()->zip_code}}}
                            </td>
                            <td rowspan="2" style="margin: 0; padding: 0.3em 1.8em;">
                                <strong>{{{$document->name}}}</strong>
                                <br><strong>{{{$document->odberatel()->removed()->name}}}</strong>
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
<td style="border-right-width: 1px; border-right-color: black; border-right-style: solid; margin: 0; padding: 0.3em 1.8em;">
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
<td style="border-right-width: 1px; border-right-color: black; border-right-style: solid; font-size: 0.9em; margin: 0; padding: 0.3em 1.8em;">
                                {{--Podnikatel zapsán v živ.rejstříku MÚ Mladá Boleslav--}}
                            </td>
                            <td style="margin: 0; padding: 0.3em 1.8em;">
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
<td style="margin: 0; padding: 0;">
                    <table id="fakturaPodm" style="border-collapse: collapse; width: 100%; border-color: black; border-style: solid solid none; border-width: 1px;">
                        {{--<tr>
<td colspan="4" style="margin: 0; padding: 0.3em 1em;">
                                <strong>Platební podmínky:</strong>
                            </td>
                        </tr>--}}
                        <tr>
                            {{--<td style="margin: 0; padding: 0.3em 1.8em;">
                                <br>
                                Forma úhrady
                                <br>
                                Bankovní spojení:
                                <br>
                                Číslo účtu:
                            </td>
                            <td style="margin: 0; padding: 0.3em 1.8em;">
                                <br>
                                Bankovním převodem
                                <br>
                                Česká spořitelna
                                <br><strong>0800/XXXXXXXXX</strong>
                            </td>--}}
                            <td style="margin: 0; padding: 0.3em 1.8em;">
                                <i>Datum vystavení</i>
                                {{--<br><i>Datum zdanitel. plnění</i>--}}
                                <br><br><strong>Kones platnosti nabídky:</strong>
                            </td>
                            <td style="margin: 0; padding: 0.3em 1.8em;">
                                <i>{{date('d.m.Y', strtotime($document->vystaven))}}</i>
                                {{--<br><i>10.3.2011</i>--}}
                                <br><br><strong>{{date('d.m.Y', strtotime($document->expire))}}</strong>
                            </td>
                        </tr>
                        {{--<tr>
<td style="margin: 0; padding: 0.3em 1.8em;">
                                Variabilní symbol:
                            </td>
                            <td colspan="3" style="margin: 0; padding: 0.3em 1.8em;">
                                20110001
                            </td>
                        </tr>--}}
                    </table>
</td>
            </tr>
<tr>
<td style="margin: 0; padding: 0;">
                    <table id="fakturaFakturace" style="border-collapse: collapse; width: 100%; padding: 0.3em; border-color: black; border-style: solid solid none; border-width: 1px;">
<tr>
<td style="width: 20em; margin: 0; padding: 0.3em 0em 0.3em 1em;">
                                <strong>Položky:</strong>
                            </td>
                            <td style="text-align: right; margin: 0; padding: 0.3em 0em 0.3em 1em;" align="right">
                                Cena za jednotku:
                            </td>
                            <td style="text-align: right; margin: 0; padding: 0.3em 0em 0.3em 1em;" align="right">
                                Množství:
                            </td>
                            <td style="text-align: right; margin: 0; padding: 0.3em 1em;" align="right">
                                Jednotka:
                            </td>
                            
                            <td style="margin: 0; padding: 0.3em 0em 0.3em 1em;">
                                Sleva:
                            </td>
                            <td style="margin: 0; padding: 0.3em 0em 0.3em 1em;">
                                Celkem po slevě:
                            </td>
                            <td style="margin: 0; padding: 0.3em 0em 0.3em 1em;"></td>
                        </tr>
                        @if(!empty($polozky))
                        @foreach($polozky as $item)
                        <tr>
<td style="width: 20em; margin: 0; padding: 0.3em 0em 0.3em 1em;">
                                {{$item->name}}
                            </td>
                            <td style="text-align: right; margin: 0; padding: 0.3em 0em 0.3em 1em;" align="right">
                                {{$item->price}} Kč
                            </td>
                             <td style="text-align: right; margin: 0; padding: 0.3em 0em 0.3em 1em;" align="right">
                                {{$item->count}}
                            </td>
                            <td style="text-align: right; margin: 0; padding: 0.3em 1em;" align="right">
                                {{$item->unit[0]}}<sup>{{$item->unit[1] or ""}}</sup>
</td>
                            <td style="margin: 0; padding: 0.3em 0em 0.3em 1em;">
                                {{$item->discount}} %
                            </td>
                            <td style="margin: 0; padding: 0.3em 0em 0.3em 1em;">
                                {{$item->priceDiscount}} Kč
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
</td>
            </tr>
<tr>
<td style="margin: 0; padding: 0;">
                    <table id="fakturaPaticka" style="border-collapse: collapse; width: 100%; border: 1px solid black;">
<tr style="text-align: right;" align="right">
<td style="margin: 0; padding: 1em 0 0 20em;">
                                Základ pro DPH:
                                <br>
                                DPH častka {{$document->dph}}%:
                                <br><b>Cena s DPH:</b>
                            </td>
                            <td style="margin: 0; padding: 1em 1em 0 0;">
                                 {{$total_price}} Kč
                                <br>
                                {{round($total_price * $dph_kons,2)}} Kč
                                <br><strong>{{round($total_price+$total_price* $dph_kons, 2)}} Kč</strong>
                            </td>
                        </tr>
<tr>
<td colspan="2" style="margin: 0; padding: 0 0 3em 3em;">
                                <strong>Vyřizuje:</strong>
                                <br><br>
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
