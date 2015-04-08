@extends('superAdmin.master')

@section('content')
	<a href="/admin/super/pages">Go Back</a>
	<h2>View Page {{ $page->id }}</h2>
	{!! $page->datatext !!}
@stop