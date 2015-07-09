@extends('superAdmin.master')

@section('header')
	<script src='/js/pageExample.js'></script>
@stop

@section('content')
	{!! Form::model($templateData, ['url' => 'admin/super/template/'.$templateData->id, 'method' => 'PATCH']) !!}
	@include('superAdmin.modules.templates.form')
	{!! Form::close() !!}
@stop