@extends('superAdmin.master')

@section('title')
| Sort Object, Page 2
@endsection

@section('header')
	<script src='/js/sortObjects.js'></script>
@stop

@section('content')
	<h2>Sort Object</h2>
	{!! Form::open(['class' => 'form_sortable']) !!}
		{!! $table !!}
		{!! Form::hidden('oid', $oid) !!}
		{!! Form::hidden('page', '2') !!}
		<div class='row'>
			<div class='col-md-4'>
				<div class='form-group'>
					{!! Form::label('groupsof', 'Groups Of') !!}
					{!! Form::text('groupsof', null, array('class' => 'form-control')) !!}
				</div>
				@foreach ($calculated as $field)
				<div class='form-group'>
					{!! Form::label('rule['.$field.']', ucwords($field).' Rule') !!}
					{!! Form::select('rule['.$field.'][variable]', array('>'  => 'Greater Than',
														   			'>=' => 'Greater Than or Equal To',
														   			'==' => 'Equal To',
														   			'<=' => 'Less Than or Equal To',
														   			'<'  => 'Less Than',
														   			'A'  => 'Average'), null, array('class' => 'form-control')) !!}
					{!! Form::text('rule['.$field.'][amount]', '0.00', array('class' => 'form-control')) !!}
				</div>
				@endforeach
				<div class='form-group'>
					{!! Form::button('Dynamic Sort', ['class' => 'btn btn-primary col-md-12 dynamic_sort']) !!}
				</div>
				<br /><br />
				<div class='form-group'>
					{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
				</div>
			</div>
			<div class='col-md-8 testing_combo'>
				
			</div>
		</div>
	{!! Form::close() !!}
@stop