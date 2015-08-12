@extends('superAdmin.master')

@section('title')
| Edit
@endsection

@section('content')
	<h2>Edit {{ ucfirst($module) }}</h2>
	{!! Form::model($data, ['url' => 'admin/super/'.$module.'/'.$data->id, 'method' => 'PATCH']) !!}
		@include('superAdmin.modules.'.$module.'.form')
	{!! Form::close() !!}
@stop