<?php

Form::macro('destroy', function($controller,$id)
{
   	$return = Form::open(array('route'=>array($controller.'.destroy',$id), 'method'=> 'delete','class'=>'destroy'));
   	$return .= Form::hidden('id',$id);
   	$return .= Form::button('',array('class'=>"glyphicon glyphicon-remove btn btn-danger", 'aria-hidden'=>"false","type"=>'submit'));
   	$return .= Form::close();
   	return $return;
});