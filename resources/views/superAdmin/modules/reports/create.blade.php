@extends('superAdmin.master')

@section('content')
	<h2>Create Report</h2>
	{!! Form::open(['url'=>'admin/super/reports/']) !!}
	@include('superAdmin.modules.reports.form')
	{!! Form::close() !!}
@stop