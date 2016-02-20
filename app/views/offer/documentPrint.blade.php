<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <style type="text/css">
    body {
      font-family: DejaVu Sans, sans-serif;
         font-size: 10px;
    }
   /* line 1, ../scss/document.scss */
/* line 1, ../scss/document.scss */
#document {
  margin-top: 2rem;
  margin-bottom: 2rem;
  font-family: DejaVu Sans, sans-serif;
  font-size: 10px;
}
/* line 7, ../scss/document.scss */
#document .r {
  text-align: right;
}
/* line 11, ../scss/document.scss */
#document .border {
  border: 1px solid black;
}
/* line 15, ../scss/document.scss */
#document table {
  margin: 0;
  padding: 0;
}
/* line 18, ../scss/document.scss */
#document table td {
  background-color: #FFFFFF;
}
/* line 21, ../scss/document.scss */
#document table.body {
  width: 100%;
  border-collapse: collapse;
}
/* line 25, ../scss/document.scss */
#document table.body thead tr {
  padding: 0;
  margin: 0;
}
/* line 29, ../scss/document.scss */
#document table.body thead h1 {
  font-size: 14px;
  padding: 0;
  margin: 0;
}
/* line 35, ../scss/document.scss */
#document table.body tbody {
  border: 1px solid black;
  border-bottom: none;
}
/* line 40, ../scss/document.scss */
#document table.body tbody tr#contacts td {
  vertical-align: top;
  padding-top: 1rem;
}
/* line 44, ../scss/document.scss */
#document table.body tbody tr#contacts small {
  margin-left: 1.5rem;
  font-size: 9px;
}
/* line 48, ../scss/document.scss */
#document table.body tbody tr#contacts p {
  margin-left: 2.5rem;
}
/* line 55, ../scss/document.scss */
#document table.body tbody tr#dates td {
  padding: 0.6rem;
  padding-left: 1rem;
}
/* line 61, ../scss/document.scss */
#document table.body tbody tr#items table {
  width: 100%;
  height: auto;
  padding: 0;
  margin: 0;
  margin-bottom: 1rem;
}
/* line 68, ../scss/document.scss */
#document table.body tbody tr#items table th {
  text-align: left;
}
/* line 71, ../scss/document.scss */
#document table.body tbody tr#items table tbody {
  border: none;
  margin: 0;
}
/* line 74, ../scss/document.scss */
#document table.body tbody tr#items table tbody tr {
  line-height: 1.7rem;
}
/* line 78, ../scss/document.scss */
#document table.body tbody tr#items table td {
  vertical-align: top;
}
/* line 84, ../scss/document.scss */
#document table.body tbody tr#endPrice td {
  padding-bottom: 1rem;
  padding-top: 1rem;
  padding-left: 1rem;
  padding-right: 1rem;
}
/* line 91, ../scss/document.scss */
#document table.body tbody tr#signature {
  vertical-align: top;
  height: 8rem;
}
/* line 94, ../scss/document.scss */
#document table.body tbody tr#signature .sign {
  margin-bottom: 2rem;
  padding-left: 1rem;
}
/* line 98, ../scss/document.scss */
#document table.body tbody tr#signature .stamp {
  margin-bottom: 4rem;
}
/* line 104, ../scss/document.scss */
#document table.body tfoot {
  line-height: 2rem;
  font-size: 7px;
  border: 1px solid black;
  border-top: none;
}
/* line 110, ../scss/document.scss */
#document table.body tfoot td {
  padding-left: 1rem;
  height: 5rem;
  vertical-align: bottom;
  font-weight: 400;
}
/* line 117, ../scss/document.scss */
#document table.body .left {
  float: left;
}
/* line 120, ../scss/document.scss */
#document table.body .right {
  float: right;
}
/* line 123, ../scss/document.scss */
#document table.body .center {
  text-align: center;
}
/* line 126, ../scss/document.scss */
#document table.body .half {
  width: 50%;
}
/* line 129, ../scss/document.scss */
#document table.body .quater {
  width: 25%;
}
/* line 132, ../scss/document.scss */
#document table.body .full {
  width: 100%;
  padding: 0;
}
/* line 135, ../scss/document.scss */
#document table.body .full table {
  margin: 0;
}
/* line 139, ../scss/document.scss */
#document table.body td.blank {
  border: none;
}
/* line 142, ../scss/document.scss */
#document table.body .r-b-none {
  border-right: none;
}
/* line 145, ../scss/document.scss */
#document table.body .l-b-none {
  border-left: none;
}

/* line 152, ../scss/document.scss */
table, tr, td {
  border-collapse: collapse;
}

</style>

  </head>
  <body>

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
  </body>
</html>