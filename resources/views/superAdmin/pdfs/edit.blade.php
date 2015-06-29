@extends('superAdmin.master')

@section('content')
	{!! Form::model($pdfData, ['url' => 'admin/super/pdfs/'.$pdfData->id, 'method' => 'PATCH']) !!}
		@include('superAdmin.pdfs.form')
	{!! Form::close() !!}
@stop