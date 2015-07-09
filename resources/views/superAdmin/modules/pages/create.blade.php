@extends('superAdmin.master')

@section('header')
	<script src='/js/pageExample.js'></script>
@stop

@section('content')
	{!! Form::open(['url'=>'admin/super/pages/']) !!}
	@include('superAdmin.modules.pages.form')
	{!! Form::close() !!}
@stop