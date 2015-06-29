@extends('superAdmin.master')

@section('header')
	<script src='/js/create_form.js'></script>
@stop

@section('content')
	<h2>Create Forms</h2>
	{!! Form::open(['url'=>'admin/super/forms/']) !!}
	{!! Form::hidden('totalFields', '0', array('class' => 'totalFields')) !!}
	<div class='row'>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='objectName'>Name:</label>
				{!! Form::text('formName', null, array('id' => 'objectName', 'placeholder' => 'Form Name', 'class' => 'form-control', 'maxlength' => '25')) !!}
			</div>
			<div class='form-group'>
				<label for='objectDescription'>Description:</label>
				{!! Form::text('formDescription', null, array('id' => 'formDescription', 'placeholder' => 'Form Description', 'class' => 'form-control', 'maxlength' => '255')) !!}
			</div>
		</div>
		<div class='col-md-4'>
			@include('modals.addForm')
		</div>
		<div class='col-md-4'>
			<br />
			<div class='form-group'>
				<button type='button' class='btn btn-default col-md-12' data-toggle="modal" data-target="#addForm">+ Add Field</button>
			</div>
			<br /><br /><br />
			<div class='form-group'>
				<button type='submit' class='btn btn-primary col-md-12'>Submit</button>
			</div>
		</div>
	</div>
	<div class='row'>
		<div class='extraFields'></div>
	</div>
	{!! Form::close() !!}
@stop