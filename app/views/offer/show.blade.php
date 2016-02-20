@extends('layout.inner')
@section("submenu")
<h4>Historie Dokumentů</h4>
<ul class="side-nav"></ul>
@stop


@section('content')
<article id="document">
          <table class="body">
            <thead>
              <tr>
                <td class="half"></td>
                <td class="quater border r-b-none center">
                  <h1>Cenová nabídka</h1>
                </td>
                <td class="quater border l-b-none center">
                  číslo: 2015/0001
                </td>
              </tr>
            </thead>
            <tbody>
              <tr id="contacts">
                <td class="half">
                  <small>Dodavatel:</small>
                  <p>
                  <strong>Vaše jméno</strong><br />
                  Ulice č.p. <br />
                  Město, PSČ <br />
                  <br />
                  IČ: xxx xx xxx<br />
                  DIČ: CZ xxxxxxxxxx<br />
                  </p>
                  <p>
                  <i>Poznámka</i>
                  </p>
                </td>
                <td class="half" colspan="2">
                  <small>Odběratel:</small>
                  <p>
                  <strong>Jméno</strong><br />
                  Ulice č.p. <br />
                  Město, PSČ <br />
                  <br />
                  IČ: xxx xx xxx<br />
                  DIČ: CZ xxxxxxxxxx<br />
                  </p>
                </td>
              </tr>
              <tr id="dates">


                       <td class="half" style="border-bottom:1px solid black;border-top:1px solid black;">Datum vystavení: 24.4.2034</td>
                        <td class="half" style="border-bottom:1px solid black;border-top:1px solid black;" colspan="2"><strong>Datum konce platnosti:</strong> 24.4.2035</td>


              </tr>
              <tr id="items" class="border">
                <td class="full" colspan="3"  style="border-bottom:1px solid black">
                  <table>
                    <thead>
                      <tr>
                        <th style="width:13%">Kód</th>
                        <th style="width:40%">Název</th>
                        <th style="width:15%">Cena za ks</th>
                        <th style="width:12%">Ks</th>
                        <th style="width:20%" class="r">Cena celkem</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>001/002</td>
                      <td>Lorem ipsum Sunt eiusmod ut.</td>
                      <td>50 Kč</td>
                      <td>50</td>
                      <td class="r">2500 Kč</td>
                    </tr>
                    <tr>
                      <td>001/002</td>
                      <td>Lorem ipsum Ullamco deserunt exercitation nulla proident.</td>
                      <td>50 Kč</td>
                      <td>5</td>
                      <td class="r">250 Kč</td>
                    </tr>
                    <tr>
                      <td>001/002</td>
                      <td>Lorem ipsum Nostrud deserunt ex.</td>
                      <td>50 Kč</td>
                      <td>2</td>
                      <td class="r">100 Kč</td>
                    </tr>
                    <tr>
                      <td>001/002</td>
                      <td>Lorem ipsum Deserunt culpa aute.</td>
                      <td>50 000 Kč</td>
                      <td>6</td>
                      <td class="r">300 000 Kč</td>
                    </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr id="endPrice">
                <td class="half"></td>
                <td class="quater border r-b-none"><strong>Celkem k úhradě: </strong></td>
                <td class="quater border l-b-none r"><strong>302 850 Kč</strong></td>
              </tr>
               <tr id="signature">
                <td class="half"><p class="sign">Podpis:</p></td>
                 <td class="half" colspan="2"><p class="stamp">Razítko:</p></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3">Vyřizuje: <strong>Ondřej Brabec</strong>, Telefon: +420 xxx xxx xxx</td>
              </tr>
            </tfoot>
          </table>
 </article>

    <!--
  </body>
</html>-->

@stop

@section('script')
<script type="text/javascript">
	$('#loader').hide();
</script>
@stop
