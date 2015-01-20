@extends('superAdmin.master')

@section('content')
	<div class='col-md-4'>
	<h2>Create Object</h2>
		{!! Form::open() !!}
		{!! Form::hidden('formLocation', 'createObject') !!}
		{!! Form::hidden('totalFields', '1') !!}
		<div class='form-group'>
			<label for='objectName'>Name:</label>
			{!! Form::text('objectName', null, array('id' => 'objectName', 'placeholder' => 'Object Name', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>
		<div class='form-group'>
			<label for='objectDescription'>Description:</label>
			{!! Form::text('objectDescription', null, array('id' => 'objectDescription', 'placeholder' => 'Object Description', 'class' => 'form-control', 'maxlength' => '255')) !!}
		</div>
		<div class='form-group'>
			<label for='objectDescription'>Description:</label>
			{!! Form::text('objectDescription', null, array('id' => 'objectDescription', 'placeholder' => 'Object Description', 'class' => 'form-control', 'maxlength' => '255')) !!}
		</div>
		<div class='form-group'>
			<label for='objectItem1'>Field One:</label>
				{!! Form::label('objectDescription', 'id', array('id' => 'objectItemFieldName1', 'class' => 'form-control')) !!}
				{!! Form::label('objectDescription', 'int', array('id' => 'objectItemDataType1', 'class' => 'form-control')) !!}
				{!! Form::label('objectDescription', '11', array('id' => 'objectItemQuantity1', 'class' => 'form-control')) !!}	
		</div>

		<button type='button' class='btn btn-default'>+ Add Field</button>
		<button type='submit' class='btn btn-primary'>Submit</button>
		{!! Form::close() !!}
	</div>
@stop