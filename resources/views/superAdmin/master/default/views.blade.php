@extends('superAdmin.master')

@section('title')
| Views
@endsection

@section('content')
	<h2>{{ $section_header }}</h2>
	{!! $table !!}
@stop