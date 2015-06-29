@extends('superAdmin.master')

@section('content')
	{!! Form::open(['url'=>'admin/super/relationships/']) !!}
	@include('superAdmin.relationships.form')
	{!! Form::close() !!}
@stop