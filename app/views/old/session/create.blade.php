@extends('layout.login-page')

@section('content')
<div class="container">
  {{Form::open(array('route'=>'login.store','class'=>'form-signin'))}} 
    <h2 class="form-signin-heading">Prosím přihlašte se:</h2>
      {{Form::label('email','Emailová adresa',array("class"=>'sr-only'))}}
      {{Form::input('email','email','',array('placeholder'=>'Emailová adresa','required','autofocus','class'=>'form-control'))}}
      {{Form::label('password','Heslo',array("class"=>'sr-only'))}}
      {{Form::input('password','password','',array('placeholder'=>'Heslo','required','class'=>'form-control'))}}
        <div class="checkbox">
          <label>
            {{Form::checkbox('remember-me','remember-me')}} Zapamatovat si údaje
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Přihlásit se</button>
        <a href="{{URL::route('user.create')}}" class="btn btn-default btn-block btn-lg">Registrovat se</a>
  {{Form::close()}}

</div>
@stop