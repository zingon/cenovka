<!doctype html>
<html class="no-js" lang="{{ Lang::locale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
         <title>Cenová nabídka</title>
        {{HTML::style('stylesheets/app.css')}}
        {{HTML::script('bower_components/modernizr/modernizr.js')}}
    </head>
    <body>
        <div class="loader-capsule">
        <div id="loader">
            <img src="/img/loader.svg">
        </div>
    </div>
        @yield('content_basic')

        <div class="message-box">
        @if (!$errors->isEmpty())
         @foreach ($errors->all() as $key => $value)
            <div data-alert class="alert-box alert">
                    {{$value}}
              <a href="#" class="close">&times;</a>
            </div>
            @endforeach
        @endif
        </div>
        <!--Modalové okno-->
        <div id="modalField">

        </div>
        <div id="universalSmallModal" class="reveal-modal small" data-reveal>
            <section>

            </section>
            <a class="close-reveal-modal" arial-label="Close">&#215;</a>
        </div>
        <div id="universalLargeModal"  class="reveal-modal large"  data-reveal>
            <section>

            </section>
            <a class="close-reveal-modal" arial-label="Close">&#215;</a>
        </div>
        {{ HTML::script('bower_components/jquery/dist/jquery.min.js')}}
        <script type="text/javascript">
        $.ajaxSetup({
            headers: {'csrftoken' : '{{ csrf_token() }}'},
            beforeSend: function() {
                $('#loader').show();
            },
            complete: function(){
                $('#loader').hide();
            },
            success: function() {}
        });

        localStorage.first_login = {{$first_login}};

        //Položky
        localStorage.categoryUrl = "{{route('api.category.index')}}";
        localStorage.ItemsUrl = "{{route('item.index')}}";
        localStorage.ItemDeleteUrl = "{{route('item.destroy',0)}}";
        localStorage.ItemEditUrl = "{{route('item.edit',0)}}";
        localStorage.ItemChangePosition = "{{route('changePosition')}}";

        //Kontakty
        localStorage.ContactsUrl = "{{route('contact.index')}}";
        localStorage.ContactCreateUrl = "{{route('contact.create')}}";
        localStorage.ContactDeleteUrl = "{{route('contact.destroy',0)}}";
        localStorage.ContactEditUrl = "{{route('contact.edit',0)}}";

        //Nabídky
        localStorage.DocumentUrl = "{{ route('document.index') }}"

        //Nastavení
        localStorage.SettingUserUrl = "{{route('get.setting.user')}}";

        </script>
        {{ HTML::script('bower_components/foundation-datepicker/js/foundation-datepicker.js')}}
        {{ HTML::script('bower_components/foundation-datepicker/js/locales/foundation-datepicker.cs.js"></script>')}}
        {{ HTML::script('bower_components/foundation/js/foundation.min.js')}}
        {{ HTML::script('bower_components/jsrender/jsrender.min.js')}}
        {{ HTML::script('bower_components/jquery-ui/jquery-ui.min.js')}}
        {{ HTML::script('js/putDelete.js')}}
        {{ HTML::script('js/global.js')}}
        {{ HTML::script('js/templates/global.js')}}
        {{ HTML::script('js/loaders/global.js')}}

        @yield('script')
        {{ HTML::script('js/lib/pagination.js')}}

    </body>
</html>