<div class="contain-to-grid">
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="/">Cenovka</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>
        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
            </ul>
            <!-- Left Nav Section -->
            <ul class="left">
                @if (!Auth::getUser()->admin)
                    {{-- expr --}}
                
                <li {{(URL::current()==URL::route('item.index'))?'class="active"':""}}><a href="{{ URL::route('item.index') }}">Ceník</a></li>
                <li {{(URL::current()==URL::route('contact.index'))?'class="active"':""}}><a href="{{ URL::route('contact.index') }}">Adresář</a></li>
                <li {{(URL::current()==URL::route('document.index'))?'class="active"':""}}><a href="{{ URL::route('document.index') }}">Dokumenty</a></li>
                @else
                 <li {{(URL::current()==URL::route('user.index'))?'class="active"':""}}><a href="{{ URL::route('user.index') }}">Uživatelé</a></li>
                @endif
            </ul>
        </section>
    </nav>
</div>