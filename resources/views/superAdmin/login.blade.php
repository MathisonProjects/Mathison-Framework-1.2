@extends('superAdmin.master')

@section('content')
	@if (session('Logout'))
		<h2>{{ session('Logout') }}</h2>
	@endif
	@if ($count == 0)
		{!! Form::open(['url'=>'admin/super/createAdmin/', 'ng-app' => 'LoginForm', 'ng-controller' => 'LoginController', 'name' => 'Login', 'novalidate' => '']) !!}
	@else
		{!! Form::open(['url'=>'admin/super/adminLogin/', 'ng-app' => 'LoginForm', 'ng-controller' => 'LoginController', 'name' => 'Login', 'novalidate' => '']) !!}
	@endif
	<div class='row'>
		<div class='col-md-4'></div>
		<div class='row col-md-4'>
			<div class='col-md-12'>
				<h3>Super Admin Login</h3>
				<h6>{{ $message }}</h6>
			</div>
			<div class='col-md-12'>
				{!! Form::label('email', 'Email or Username') !!}
				{!! Form::text('email', null, array('id' => 'email', 'placeholder' => 'Email', 'class' => 'form-control', 'maxlength' => '25', 'ng-model' => 'email', 'required' => '')) !!}
				  <span style="color:red" ng-show="Login.email.$invalid">
				  	<span ng-show="Login.email.$error.required">Email or Username is required.
				  </span>
				  </span>
			</div>
			<div class='col-md-12'>
				<br />
				{!! Form::label('password', 'Password') !!}
				{!! Form::password('password', array('id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control', 'maxlength' => '25', 'ng-model' => 'password', 'required' => '')) !!}
				  <span style="color:red" ng-show="Login.password.$invalid">
				  	<span ng-show="Login.password.$error.required">Password is required.</span>
				  </span>
			</div>
			<div class='col-md-12'>
				<br />
				{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12', 'ng-disabled' => 'Login.email.$invalid || Login.password.$invalid']) !!}
			</div>
			
		</div>
	</div>
	{!! Form::close() !!}

	<script>
		var app = angular.module('LoginForm', []);
		app.controller('LoginController', function($scope) {
		    $scope.email = 'admin';
		    $scope.password = '';
		});
	</script>
@stop