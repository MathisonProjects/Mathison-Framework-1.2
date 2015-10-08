@extends('superAdmin.master')

@section('title')
| Sort Object, Page 3
@endsection

@section('header')
	<script src='/js/sortObjects.js'></script>
@stop

@section('content')
	<h2>Select Sorted Object</h2>
	{!! Form::open(['class' => 'form_sortable']) !!}
		{!! Form::hidden('previousInput', $requestInfo) !!}
		{!! Form::hidden('page', '3') !!}
		{!! $table !!}

		<div class='row'>
			<div class='col-md-12'>
				<div class='form-group'>
					{!! Form::submit('Download CSV', ['class' => 'btn btn-primary col-md-12']) !!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@stop