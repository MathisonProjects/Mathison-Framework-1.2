@extends('superAdmin.master')

@section('title')
| Sort Object
@endsection

@section('header')
	<script src='/js/sortObjects.js'></script>
@stop

@section('content')
	<h2>Sort Object</h2>
	{!! Form::open() !!}
		{!! Form::hidden('page', '1') !!}
		<div class='row'>
			<div class='col-md-4'>
				<div class='form-group'>
					{!! Form::label('object', 'Object to Sort Against') !!}
					{!! Form::select('object', $objects, null, array('class' => 'form-control')) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('fields', 'Display Fields') !!}
					{!! Form::select('fields[]', array(), null, array('class' => 'form-control', 'multiple', 'id' => 'fields')) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('calculated', 'Calculated Fields') !!}
					{!! Form::select('calculated[]', array(), null, array('class' => 'form-control', 'multiple', 'id' => 'calculated')) !!}
				</div>

				<div class='form-group'>
					{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@stop