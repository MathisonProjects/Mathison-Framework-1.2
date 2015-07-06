<?php
	$modalName = 'addRecord';
?>

@extends('modals.template')

@section('head')
	<h4 class="modal-title" id="myModalLabel">Add Record for {{ $objectName }}</h4>
@endsection

@section('body')
	{!! Form::open() !!}
	{!! Form::hidden('objectName', $dbName) !!}
	<div class="modal-body">
	    @foreach ($fields as $field)
			<div class='form-group'>
		    	@if ($field->name != 'id')
					<label for='{{ $field->name }}'>{{ $field->name }}</label>
					{!! Form::text($field->name, null, array('placeholder' => $field->name, 'class' => 'form-control')) !!}
				@endif
			</div>
	    @endforeach
	</div>
@endsection

@section('footer')
	<div class="modal-footer">
	    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    <button type="submit" class="btn btn-primary">Save changes</button>
	</div>
	{!! Form::close() !!}
@endsection