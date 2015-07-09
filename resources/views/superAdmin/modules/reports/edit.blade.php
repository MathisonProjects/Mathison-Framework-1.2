@extends('superAdmin.master')

@section('content')
	{!! Form::model($data, ['url' => 'admin/super/reports/'.$data->id, 'method' => 'PATCH']) !!}
		@include('superAdmin.modules.reports.form')
	{!! Form::close() !!}
@stop