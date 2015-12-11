@extends('superAdmin.master')

@section('title')
| Edit
@endsection

@section('content')
	<h2>Edit {{ ucfirst($module) }}</h2>
	{!! Form::model($data, ['url' => 'admin/super/'.$module.'/'.$data->id, 'method' => 'PATCH']) !!}
		@if (!isset($form))
			@include('superAdmin.modules.'.$module.'.form')
		@else
			@include('superAdmin.modules.'.$module.'.'.$form)
		@endif
	{!! Form::close() !!}
@stop