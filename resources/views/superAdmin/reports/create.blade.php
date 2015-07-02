@extends('superAdmin.master')

@section('content')
	{!! Form::open(['url'=>'admin/super/reports/']) !!}
	@include('superAdmin.reports.form')
	{!! Form::close() !!}
@stop