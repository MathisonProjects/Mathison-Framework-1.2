@extends('superAdmin.master')

@section('content')
	{!! Form::model($data, ['url' => 'admin/super/'.$module.'/'.$data->id, 'method' => 'PATCH']) !!}
		@include('superAdmin.modules.'.$module.'.form')
	{!! Form::close() !!}
@stop