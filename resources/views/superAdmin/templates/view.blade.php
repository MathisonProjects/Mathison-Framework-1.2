@extends('superAdmin.master')

@section('content')
	<a href="/admin/super/template">Go Back</a>
	<h2>View Template {{ $template->id }}</h2>
	{!! $template->datatext !!}
@stop