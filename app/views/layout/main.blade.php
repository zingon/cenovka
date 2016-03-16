<!doctype html>
<html class="no-js" lang="{{ Lang::locale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
         <title>Cenová nabídka</title>
        {{HTML::style('stylesheets/app.css')}}

        {{HTML::script('bower_components/modernizr/modernizr.js')}}
        {{ HTML::script('bower_components/jquery/dist/jquery.min.js')}}
        {{ HTML::script('bower_components/foundation-datepicker/js/foundation-datepicker.js')}}
        {{ HTML::script('bower_components/foundation-datepicker/js/locales/foundation-datepicker.cs.js')}}
        {{ HTML::script('bower_components/foundation/js/foundation.min.js')}}
        {{ HTML::script('bower_components/jsrender/jsrender.min.js')}}
        {{ HTML::script('bower_components/jquery-ui/jquery-ui.min.js')}}
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
        var urls = {
            //Položky
            categoryUrl: "{{route('api.category.index')}}",
            ItemsUrl: "{{route('api.get.items')}}",
            ItemDeleteUrl: "{{route('item.destroy',0)}}",
            ItemEditUrl: "{{route('item.edit',0)}}",
            ItemChangePosition: "{{route('changePosition')}}",

            //Kontakty
            ContactsUrl: "{{route('api.get.contacts')}}",
            ContactCreateUrl: "{{route('contact.create')}}",
            ContactDeleteUrl: "{{route('contact.destroy',0)}}",
            ContactEditUrl: "{{route('contact.edit',0)}}",

            //Nabídky
            DocumentUrl: "{{ route('api.get.documents') }}",
            DocumentShowUrl: "{{ route('document.show',0) }}",
            DocumentCreateUrl: "{{ route('document.create') }}",
            DocumentEditUrl: "{{ route('document.edit',0) }}",
            DocumentDeleteUrl: "{{ route('document.destroy',0) }}",

            // Spojení nabídky s položkamy
            SelectEdit: "{{ route('select.edit',0)}}",
            SelectDeleteUrl: "{{ route('select.destroy',0)}}",

            //Nastavení
            SettingUserUrl: "{{route('get.setting.user')}}",

            //Export
            ExportUrl: "{{route('api.export.index')}}",
            ExportShowUrl: "{{route('export.show',0)}}",
            ExportOfferUrl: "{{route('export.offer',0)}}",
        }
        var firstLogin = ('{{$first_login}}'.lenght>0)?true:false;

        $(document).ready(function() {
            var mainController = new GlobalController();
            mainController.setUrls(urls);
            mainController.setFirstLogin(firstLogin);
            mainController.init(window.location.pathname.replace("/",""));
        });

        // localStorage.first_login = ('{{$first_login}}'.lenght>0)?true:false;

        //Položky
        localStorage.categoryUrl = "{{route('api.category.index')}}";
        localStorage.ItemsUrl = "{{route('api.get.items')}}";
        localStorage.ItemDeleteUrl = "{{route('item.destroy',0)}}";
        localStorage.ItemEditUrl = "{{route('item.edit',0)}}";
        localStorage.ItemChangePosition = "{{route('changePosition')}}";

        //Kontakty
        localStorage.ContactsUrl = "{{route('api.get.contacts')}}";
        localStorage.ContactCreateUrl = "{{route('contact.create')}}";
        localStorage.ContactDeleteUrl = "{{route('contact.destroy',0)}}";
        localStorage.ContactEditUrl = "{{route('contact.edit',0)}}";

        //Nabídky
        localStorage.DocumentUrl = "{{ route('api.get.documents') }}";
        localStorage.DocumentShowUrl = "{{ route('document.show',0) }}";
        localStorage.DocumentCreateUrl = "{{ route('document.create') }}";
        localStorage.DocumentEditUrl = "{{ route('document.edit',0) }}";
        localStorage.DocumentDeleteUrl = "{{ route('document.destroy',0) }}";

        // Spojení nabídky s položkamy
        localStorage.SelectEdit = "{{ route('select.edit',0)}}"
        localStorage.SelectDeleteUrl = "{{ route('select.destroy',0)}}"

        //Nastavení
        localStorage.SettingUserUrl = "{{route('get.setting.user')}}";

        //Export
        localStorage.ExportUrl = "{{route('api.export.index')}}";
        localStorage.ExportShowUrl = "{{route('export.show',0)}}";
        localStorage.ExportOfferUrl = "{{route('export.offer',0)}}";
        </script>

        {{ HTML::script('js/putDelete.js')}}
        {{ HTML::script('js/global.js')}}
        {{ HTML::script('js/templates/global.js')}}
        {{ HTML::script('js/loaders/global.js')}}

        @yield('script')
        {{ HTML::script('js/lib/pagination.js')}}

    </body>
</html>