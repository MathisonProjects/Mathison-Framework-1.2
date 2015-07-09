@extends('superAdmin.master')

@section('content')
	{!! Form::open(['url'=>'admin/super/'.$module.'/']) !!}
		@include('superAdmin.modules.'.$module.'.form')
	{!! Form::close() !!}
@stop