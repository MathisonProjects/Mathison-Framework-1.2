@extends('superAdmin.master')

@section ('header')
	<script src='/js/superAdminBlade.js'></script>
@stop

@section('content')
	<h2>
		{{ $objectName }}
	</h2>
	<h4>{{ $description }}</h4>
	<div class='row'>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary addRecord' data-toggle="modal" data-target="#addRecord">
				<i><span class='glyphicon glyphicon-plus'></span></i> Add Record</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary addRelationship' data-toggle="modal" data-target="#addRelationship">
				<i><span class='glyphicon glyphicon-link'></span></i> Add Relationship</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary createAPI' data-toggle="modal" data-target="#createAPI">            
				<i><span class='glyphicon glyphicon-log-out'></span></i> Create API</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary createForm' data-toggle="modal" data-target="#createForm">          
				<i><span class='glyphicon glyphicon-pencil'></span></i> Create Form</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary createReport' data-toggle="modal" data-target="#createReport">      
				<i><span class='glyphicon glyphicon-align-justify'></span></i> Create Report</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary deleteObject' data-toggle="modal" data-target="#deleteObject">      
				<i><span class='glyphicon glyphicon-minus'></span></i> Delete Object</button>
		</div>
	</div>
	<br />
	<table class='table table-hover table-condensed'>
		<tr>
		@foreach ($fields as $field)
			@if ($field->name == 'id')
				<th style='width: 60px;text-align: center;'>View</th>
				<th style='width: 60px;text-align: center;'>Edit</th>
				<th style='width: 60px;text-align: center;'>Delete</th>
			@endif
			<th style='text-align: center;'>{{ $field->name }}</th>
		@endforeach
		</tr>
		@foreach ($records as $record)
			<tr>
				@foreach ($fields as $field)
					@if ($field->name == 'id')
						<td style='width: 60px;text-align: center;'><a href='/admin/super/viewObject/{{ $dbName }}/{{ $record->id }}'><i><span class='glyphicon glyphicon-eye-open'></span></i></a></td>
						<td style='width: 60px;text-align: center;'><a href='#'><i><span class='glyphicon glyphicon-edit'></span></i></a></td>
						<td style='width: 60px;text-align: center;'><a href='#'><i><span class='glyphicon glyphicon-remove'></span></i></a></td>
					@endif
					<td style='text-align: center;'>{{ $record->{$field->name} }}</td>
				@endforeach
			</tr>
		@endforeach
	</table>
@stop

@section('modal')
	@include('modals.addRecord')
	@include('modals.addRelationship')
	@include('modals.createAPI')
	@include('modals.createForm')
	@include('modals.deleteObject')
@stop