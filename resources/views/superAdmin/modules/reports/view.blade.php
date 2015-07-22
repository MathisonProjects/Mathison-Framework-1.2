@extends('superAdmin.master')

@section('content')
	<h2>{{ $header }}</h2>
	<h4>{{ $description }}</h4>
	{!! $table1 !!}
	<br /><br />
	<h2>Grand Totals</h2>
	{!! $table2 !!}
@stop