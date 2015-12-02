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
        $.ajaxSetup({ headers: {'csrftoken' : '{{ csrf_token() }}'}})
        localStorage.categoryUrl = "{{route('category.index')}}";
        localStorage.ItemsUrl = "{{route('item.index')}}";
        localStorage.ItemDeleteUrl = "{{route('item.destroy',0)}}";
        </script>
        {{ HTML::script('bower_components/foundation/js/foundation.min.js')}}
        {{ HTML::script('bower_components/jsrender/jsrender.min.js')}}
        {{ HTML::script('js/putDelete.js')}}
        {{ HTML::script('js/templates.js')}}
        {{ HTML::script('js/loaders.js')}}

        @yield('script')

    </body>
</html>