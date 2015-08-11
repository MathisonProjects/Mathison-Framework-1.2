@extends('superAdmin.master')

@section('header')
	<script src='/js/crons.js'></script>
@stop

@section('content')
	<h2>Create Report</h2>
	{!! Form::open(['url'=>'admin/super/crons/']) !!}
	@include('superAdmin.modules.crons.form')
	{!! Form::close() !!}
@stop