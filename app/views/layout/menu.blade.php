<div class="contain-to-grid">
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="/">Cenovka @if (Auth::getUser()->admin && (strpos(Route::currentRouteName(), "admin")!==false)) - Administrace @endif</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>
        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
                @if (!Auth::getUser()->admin || (Auth::getUser()->admin && (strpos(Route::currentRouteName(), "admin")===false)))
                <li class="has-dropdown">
                    <a href="#">Nastavení</a>

                    <ul class="dropdown">
                        <li><a href="{{route('get.setting.user', UserSetting::findOrCreate(['user_id'=> Auth::getUser()->id])->id) }}"  data-reveal-id="universalLargeModal" data-reveal-ajax="true">Uživatelské nastavení</a></li>
                        <li><a href="{{route('api.user.edit', Auth::getUser()->id)}}"  data-reveal-id="universalSmallModal" data-reveal-ajax="true">Změna hesla</a></li>
                         @if (Auth::getUser()->admin)
                           
                         
                         <li>
                            <a href="{{ URL::route('admin.user.index') }}">Vzhůru do Administace</a>
                        </li>
                        @endif
                         
                    </ul>
                </li>
                @endif
            @if (Auth::getUser()->admin && (strpos(Route::currentRouteName(), "admin")!==false))
                <li>
                    <a href="{{ URL::route('document.index') }}">Zpět do klasického režimu</a>
                </li>
            @endif
                <li><a href="{{ URL::route('session.destroy') }}" class="alert">Odhlásit se</a></li>
            </ul>
            <!-- Left Nav Section -->
            <ul class="left">
                @if (!Auth::getUser()->admin || (Auth::getUser()->admin && (strpos(Route::currentRouteName(), "admin")===false)))
                {{-- expr --}}
                <li {{(URL::current()==URL::route('item.index'))?'class="active"':""}}><a href="{{ URL::route('item.index') }}">Ceník</a></li>
                <li {{(URL::current()==URL::route('contact.index'))?'class="active"':""}}><a href="{{ URL::route('contact.index') }}">Adresář</a></li>
                <li {{(URL::current()==URL::route('document.index'))?'class="active"':""}}><a href="{{ URL::route('document.index') }}">Dokumenty</a></li>
                @else
                <li {{(URL::current()==URL::route('admin.user.index'))?'class="active"':""}}><a href="{{ URL::route('admin.user.index') }}">Uživatelé</a></li>
                @endif
            </ul>
        </section>
    </nav>
</div>