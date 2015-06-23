@extends('superAdmin.master')

@section('content')
	<h2>Edit Workflow Chain</h2>

	{!! Form::model($workflow, ['url' => 'admin/super/workflows/'.$workflow->id, 'method' => 'PATCH']) !!}
		@include('superAdmin.workflows.form')
	{!! Form::close() !!}
@stop