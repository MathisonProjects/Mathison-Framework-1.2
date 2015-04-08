@extends('superAdmin.master')

@section('header')
	<script src='/js/create_object.js'></script>
@stop

@section('content')
	
	<h2>Create Object</h2>
	{!! Form::open() !!}
	{!! Form::hidden('totalFields', '1', array('class' => 'totalFields')) !!}
	<div class='row'>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='objectName'>Name:</label>
				{!! Form::text('objectName', null, array('id' => 'objectName', 'placeholder' => 'Object Name', 'class' => 'form-control', 'maxlength' => '25')) !!}
			</div>
			<div class='form-group'>
				<label for='objectDescription'>Description:</label>
				{!! Form::text('objectDescription', null, array('id' => 'objectDescription', 'placeholder' => 'Object Description', 'class' => 'form-control', 'maxlength' => '255')) !!}
			</div>
		</div>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='objectItem1'>Field 1:</label>
					{!! Form::hidden('objectItemFieldName1' , 'id') !!}
					{!! Form::hidden('objectItemDataType1'  , 'int') !!}
					{!! Form::hidden('objectItemQuantity1'  , '11') !!}
					{!! Form::label('objectItemFieldName1'  , 'id'       , array('id' => 'objectItemFieldName1' , 'class' => 'form-control')) !!}
					{!! Form::label('objectItemDataType1'   , 'int'      , array('id' => 'objectItemDataType1'  , 'class' => 'form-control')) !!}
					{!! Form::label('objectItemQuantity1'   , '11'       , array('id' => 'objectItemQuantity1'  , 'class' => 'form-control')) !!}	
			</div>
		</div>
		<div class='col-md-4'>
			<br />
			<button type='button' class='btn btn-default addField col-md-12'>+ Add Field</button><br /><br />
			<button type='submit' class='btn btn-primary col-md-12'>Submit</button>
		</div>
	</div>
	<div class='row'>
		<div class='extraFields'></div>
	</div>
	{!! Form::close() !!}
@stop