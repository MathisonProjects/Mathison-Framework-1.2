@extends('superAdmin.master')

@section('content')
	{!! Form::model($data, ['url' => 'admin/super/relationships/'.$data->id, 'method' => 'PATCH']) !!}
		@include('superAdmin.modules.relationships.form')
	{!! Form::close() !!}
@stop