@extends('superAdmin.master')

@section('title')
| {{ $module }} Create
@endsection

@section('content')
	<h2>Create {{ ucfirst($module) }}</h2>
	@if (!isset($extension))
		{!! Form::open(['url'=>'admin/super/'.$module.'/']) !!}
	@else
		{!! Form::open(['url'=>'admin/super/'.$module.'/'.$extension]) !!}
	@endif

		@if (!isset($form))
			@include('superAdmin.modules.'.$module.'.form')
		@else
			@include('superAdmin.modules.'.$module.'.'.$form)
		@endif
	{!! Form::close() !!}
@stop