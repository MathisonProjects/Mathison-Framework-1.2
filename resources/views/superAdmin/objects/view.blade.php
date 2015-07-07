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
	{!! $table !!}
@stop

@section('modal')
	@include('modals.addRecord')
	@include('modals.addRelationship')
	@include('modals.createAPI')
	@include('modals.createForm')
	@include('modals.deleteObject')
@stop