@extends('superAdmin.master')

@section('header')
	<script src='/js/pageExample.js'></script>
@stop

@section('content')
	{!! Form::open(['url'=>'admin/super/template/']) !!}
	@include('superAdmin.modules.templates.form')
	{!! Form::close() !!}
@stop