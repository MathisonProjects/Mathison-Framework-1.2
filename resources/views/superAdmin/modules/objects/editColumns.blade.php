@extends('superAdmin.master')

@section('title')
| Edit Object Columns
@endsection

@section('header')
	<script src='/js/edit_object.js'></script>
@stop

@section('content')
	<h2>Edit Object Columns</h2>
	{!! Form::open(['ng-app' => 'ColumnsApp', 'ng-controller' => 'ColumnsController', 'name' => 'Columns', 'novalidate' => '']) !!}
	<div class='row'>
		<div class='col-md-4'>
			@foreach ($object as $field)
				@if ($field->name != 'id')
				<div class='form-group'>
					{!! Form::label($field->name, 'Old Name: '.$field->name) !!}
					{!! Form::text($field->name, '', array('id' => $field->name, 'placeholder' => $field->name, 'class' => 'form-control', 'ng-model' => $field->name, 'required' => '')) !!}
					{!! Form::checkbox($field->name.'[Delete]', 'Delete', false) !!} Delete?
					<br />
					<span style="color:red" ng-show="Columns.{{ $field->name }}.$invalid">
						  <span ng-show="Columns.{{ $field->name }}.$error.required">Field Name is required.
					</span>
				</div>
				@endif
			@endforeach
			<div class='form-group'>
				{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12 addField']) !!}
			</div>
		</div>
		<div class='col-md-4'>
			{!! Form::button('Add Field', ['class' => 'btn btn-primary col-md-12']) !!}
			{!! Form::button('Reset Fields', ['class' => 'btn btn-primary col-md-12']) !!}
		</div>
	</div>
	{!! Form::close() !!}

	<script>
		var app = angular.module('ColumnsApp', []);
		app.controller('ColumnsController', function($scope) {
			@foreach ($object as $field)
				$scope.{{ $field->name }} = '{{ $field->name }}';
			@endforeach
		});
	</script>
@stop