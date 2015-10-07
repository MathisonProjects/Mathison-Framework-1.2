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
		{!! $table !!}
	{!! Form::close() !!}
@stop