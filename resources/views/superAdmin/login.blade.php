@extends('superAdmin.master')

@section('content')
	{!! Form::open() !!}
	<div class='row'>
		<div class='col-md-4'></div>
		<div class='row col-md-4'>
			<div class='col-md-12'>
				<h3>Super Admin Login</h3>
				<h6>{{ $message }}</h6>
			</div>
			<div class='col-md-12'>
				{!! Form::label('email', 'Email') !!}
				{!! Form::text('email', null, array('id' => 'email', 'placeholder' => 'Email', 'class' => 'form-control', 'maxlength' => '25')) !!}
			</div>
			<div class='col-md-12'>
				<br />
				{!! Form::label('password', 'Password') !!}
				{!! Form::password('password', array('id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control', 'maxlength' => '25')) !!}
			</div>
			<div class='col-md-12'>
				<br />
				{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
			</div>
			
		</div>
	</div>
	{!! Form::close() !!}
@stop