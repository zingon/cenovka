@extends('layout.main')
@section('content_basic')
<div class="small-12 medium-7 large-4 medium-centered columns">
            <div class="login-box">
                <div class="row">
                    <div class="small-12 columns">
                    <h1>Cenovka</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                    <h3>Přihlášení</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        {{Form::open(array('route'=>'login.store'))}}
                            <div class="row">
                                <div class="small-12 columns">
                                <div class="input-wrapper">
                                	{{Form::input('email','email','',array('placeholder'=>'Emailová adresa','required','autofocus'))}}
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                    {{Form::input('password','password','',array('placeholder'=>'Heslo','required'))}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                <label>{{Form::checkbox('remember-me','remember-me')}} Zapamatovat si údaje</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 small-centered columns">
                                    <ul class="stack button-group">
                                    	<li><button type="submit" class="button expand">Přihlásit se</button></li>
                                        <li><a href="{{URL::route('user.create')}}" class="button expand">Registrovat se</a></li>
                                    </ul>
                                </div>
                            </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
@stop

@section("script")
    <script type="text/javascript">
    $(document).ready(function() {
        $('#loader').hide();
    });
    </script>
@stop