@extends('layout.main')
@section('content_basic')
<div class="large-3 large-centered columns">
            <div class="login-box">
                <div class="row">
                    <div class="large-12 columns">
                    <h1>Cenovka</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        {{Form::open(array('route'=>'login.store'))}} 
                            <div class="row">
                                <div class="large-12 columns">
                                <div class="input-wrapper">
                                	{{Form::input('email','email','',array('placeholder'=>'Emailová adresa','required','autofocus'))}}
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    {{Form::input('password','password','',array('placeholder'=>'Heslo','required'))}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                <label>{{Form::checkbox('remember-me','remember-me')}} Zapamatovat si údaje</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 large-centered columns">
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