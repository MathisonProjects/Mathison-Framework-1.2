@extends('superAdmin.master')

@section('header')
	<script src='/js/pageExample.js'></script>
@stop

@section('content')
	{!! Form::model($templateData, ['url' => 'admin/super/templates/'.$templateData->id, 'method' => 'PATCH']) !!}
	@include('superAdmin.templates.form')
	{!! Form::close() !!}
@stop