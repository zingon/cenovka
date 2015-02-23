<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigace</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::route('document.index')}}">Cenová nabídka</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li {{(URL::current()==URL::route('item.index'))?'class="active"':""}}><a href="{{ URL::route('item.index') }}">Ceník</a></li>
                <li {{(URL::current()==URL::route('contact.index'))?'class="active"':""}}><a href="{{ URL::route('contact.index') }}">Adresář</a></li>
                <li {{(URL::current()==URL::route('document.index'))?'class="active"':""}}><a href="{{ URL::route('document.index') }}">Dokumenty</a></li>

            </ul>
            <!--<button type="button" class="btn btn-default navbar-btn">Vytvořit fakturu</button>
            <button type="button" class="btn btn-default navbar-btn">Vytvořit nabídku</button>
            <button type="button" class="btn btn-primary navbar-btn">Nová položka</button>-->
        </div><!--/.nav-collapse -->

    </div>
</div>