@extends('superAdmin.master')

@section('header')
	<script src='/js/create_form.js'></script>
@stop

@section('content')
	<h2>Create Forms</h2>
	{!! Form::open() !!}
	{!! Form::hidden('totalFields', '0', array('class' => 'totalFields')) !!}
	<div class='row'>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='objectName'>Name:</label>
				{!! Form::text('formNam3e', null, array('id' => 'objectName', 'placeholder' => 'Form Name', 'class' => 'form-control', 'maxlength' => '25')) !!}
			</div>
			<div class='form-group'>
				<label for='objectDescription'>Description:</label>
				{!! Form::text('formDescription', null, array('id' => 'formDescription', 'placeholder' => 'Form Description', 'class' => 'form-control', 'maxlength' => '255')) !!}
			</div>
		</div>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='baseObject'>Base Object:</label>
				<select name="baseObject" id="baseObject" class="form-control">
					<option></option>
					@foreach ($menu['objects'] as $item)
						<option value='{{ $item->id }}'>{{ $item->name }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group'>
				<label for='baseObject'>Base Relationship:</label>
				<select name="baseRelationship" id="baseRelationship" class="form-control">
					<option></option>
					@foreach ($menu['relationships'] as $item)
						<option value='{{ $item->id }}'>{{ $item->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class='col-md-4'>
			<br />
			<div class='form-group'>
				<button type='button' class='btn btn-default addField col-md-12'>+ Add Field</button>
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