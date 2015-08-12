@extends('superAdmin.master')

@section('title')
| Edit Object Columns
@endsection

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
			<span style="color:red" ng-show="Columns.{{ $field->name }}.$invalid">
				  <span ng-show="Columns.{{ $field->name }}.$error.required">Object Name is required.
			</span>
		</div>
		@endif
	@endforeach
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
		</div>
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