@extends('superAdmin.master')

@section('title')
| Rename Object
@endsection

@section('content')
	<h2>Rename Object</h2>
	{!! Form::open(['url'=>'admin/super/objects/'.$object->id.'/rename/', 'ng-app' => 'RenameApp', 'ng-controller' => 'RenameController', 'name' => 'Rename', 'novalidate' => '']) !!}

	<div class='row'>
		<div class='col-md-4'>
			<div class='form-group'>
				{!! Form::label('newName', 'New Name') !!}
				{!! Form::text('newName', '', array('id' => 'newName', 'class' => 'form-control', 'ng-model' => 'newName', 'required' => '')) !!}
				<span style="color:red" ng-show="Rename.newName.$invalid">
				  	<span ng-show="Rename.newName.$error.required">Object Name is required.
				</span>
			</div>
			<div class='form-group'>
				{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12', 'ng-disabled' => 'Rename.newName.$invalid']) !!}
			</div>
		</div>
	</div>

	{!! Form::close() !!}

	<script>
		var app = angular.module('RenameApp', []);
		app.controller('RenameController', function($scope) {
			$scope.newName = "{{ $object->name }}";
		});
	</script>
@stop