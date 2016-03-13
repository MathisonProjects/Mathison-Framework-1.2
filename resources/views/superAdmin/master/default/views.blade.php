@extends('superAdmin.master')

@section('title')
| Views
@endsection

@section('content')
	<h2>{{ $section_header }}</h2>
	@if (isset($create) && $create == true)
	<div class='form-group'>
		<a href="{{ URL::to('admin/super/'.$module.'/create') }}" class='btn btn-primary'>Create {{$section_header}}</a>
	</div>
	@endif
	{!! $table !!}
@stop