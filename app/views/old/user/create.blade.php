@extends('layout.login-page')

@section('content')
<div class="container">
  {{Form::open(array('route'=>'user.store','class'=>'form-signin'))}} 
    <h2 class="form-signin-heading">Prosím přihlašte se:</h2>
      {{Form::label('email','Emailová adresa',array("class"=>'sr-only'))}}
      {{Form::input('email','email','',array('placeholder'=>'Emailová adresa','required','autofocus','class'=>'form-control'))}}
      {{Form::label('password','Heslo',array("class"=>'sr-only'))}}
      {{Form::input('password','password','',array('placeholder'=>'Heslo','required','class'=>'form-control'))}}
      {{Form::label('password_again','Heslo znovu',array("class"=>'sr-only'))}}
      {{--Form::input('password','password_again','',array('placeholder'=>'Heslo znovu','required','class'=>'form-control'))--}}
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrovat se</button>
  {{Form::close()}}

</div>
@stop