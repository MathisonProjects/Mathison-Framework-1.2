@extends('superAdmin.master')

@section('content')
	{!! Form::open(['url'=>'admin/super/relationships/']) !!}
	@include('superAdmin.modules.relationships.form')
	{!! Form::close() !!}
@stop