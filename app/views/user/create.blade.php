@extends('layout.main')
@section('content_basic')
<div class="small-12 medium-7 large-4 large-centered medium-centered columns">
    <div class="login-box">
        <div class="row">
            <div class="small-12 columns">
                <h1>Cenovka</h1>
            </div>
        </div>
         <div class="row">
            <div class="small-12 columns">
                <h3>Registrace</h3>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
            	{{Form::open(array('route'=>'user.store'))}}
            	<div class="row">
                                <div class="large-12 columns">
                                <div class="input-wrapper">
                                	{{Form::input('email','email',false,array('placeholder'=>'Emailová adresa','required','autofocus'))}}
                                    <!--<small class="error">A valid email address is required.</small>-->
                                </div>
                                </div>
                            </div>
					<div class="row">
                                <div class="large-12 columns">
                                <div class="input-wrapper">
                            {{Form::input('password','password','',array('placeholder'=>'Heslo','required'))}}
                            </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                <div class="input-wrapper">
                                	{{Form::input('password','password_again','',array('placeholder'=>'Heslo znovu','required'))}}
                                    <!--<small class="error">A valid email address is required.</small>-->
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 large-centered columns">
                                    <ul class="stack button-group">
                                    	<li><button type="submit" class="button expand">Registrovat se</button></li>
                                        <li><a href="{{URL::route('login.create')}}" class="button expand"><strong>&lt;</strong> Zpět na přihlášení</a></li>
                                    </ul>
                                </div>
                            </div>
            	{{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
    <script type="text/javascript">
        $('#loader').hide();
    </script>
@stop