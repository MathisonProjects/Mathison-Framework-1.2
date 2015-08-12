@extends('superAdmin.master')

@section('title')
| Create Object
@endsection

@section('header')
	<script src='/js/create_object.js'></script>
@stop

@section('content')
	
	<h2>Create Object</h2>
	{!! Form::open(['url' => 'admin/super/createObject', 'ng-app' => 'ObjectsApp', 'ng-controller' => 'ObjectsController', 'name' => 'Objects', 'novalidate' => '']) !!}
	{!! Form::hidden('totalFields', '1', array('class' => 'totalFields')) !!}
	<div class='row'>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='objectName'>Name:</label>
				{!! Form::text('objectName', null, array('id' => 'objectName', 'placeholder' => 'Object Name', 'class' => 'form-control', 'maxlength' => '25', 'ng-model' => 'objectName','ng-trim' => 'false', 'required' => '')) !!}
				<span style="color:red" ng-show="Objects.objectName.$invalid">
					<span ng-show="Objects.objectName.$error.required">Object Name is required.
				</span>
			</div>
			<div class='form-group'>
				<label for='objectDescription'>Description:</label>
				{!! Form::text('objectDescription', null, array('id' => 'objectDescription', 'placeholder' => 'Object Description', 'class' => 'form-control', 'maxlength' => '255')) !!}
			</div>
		</div>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='objectItem1'>Field 1:</label>
					{!! Form::hidden('object[name][1]' 		, 'id') !!}
					{!! Form::hidden('object[data][1]'  	, 'int') !!}
					{!! Form::hidden('object[quantity][1]'  , '11') !!}
					{!! Form::hidden('object[default][1]'   , '') !!}
					{!! Form::label('object[name][1]' 		, 'id'       , array('id' => 'object[name][1]'		, 'class' => 'form-control')) !!}
					{!! Form::label('object[data][1]'   	, 'int'      , array('id' => 'object[data][1]'  	, 'class' => 'form-control')) !!}
					{!! Form::label('object[quantity][1]'   , '11'       , array('id' => 'object[quantity][1]'  , 'class' => 'form-control')) !!}	
			</div>
		</div>
		<div class='col-md-4'>
			<br />
			<button type='button' class='btn btn-default addField col-md-12'>+ Add Field</button><br /><br />
			<button type='submit' class='btn btn-primary col-md-12' ng-disabled='Objects.objectName.$invalid'>Submit</button>
		</div>
	</div>
	<div class='row'>
		<div class='extraFields'></div>
	</div>
	{!! Form::close() !!}

	<script>
		var app = angular.module('ObjectsApp', []);
		app.controller('ObjectsController', function($scope) {
			$scope.$watch('objectName', function() {
			    $scope.objectName = $scope.objectName.toLowerCase().replace(/\s+/g,'');
			});
		});
	</script>
@stop