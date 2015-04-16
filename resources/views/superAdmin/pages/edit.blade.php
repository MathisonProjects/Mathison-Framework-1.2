@extends('superAdmin.master')

@section('header')
	<script src='/js/pageExample.js'></script>
@stop

@section('content')
	{!! Form::model($pageData, ['url' => 'admin/super/pages/'.$pageData->id, 'method' => 'PATCH']) !!}
		@include('superAdmin.pages.form')
	{!! Form::close() !!}
@stop