<?php
	$modalName = 'createForm';
?>

@extends('modals.template')

@section('head')
	<h4 class="modal-title" id="myModalLabel">Create Form for {{ $objectName }}</h4>
@overwrite

@section('body')
	{!! Form::open() !!}
	{!! Form::hidden('objectName', $dbName) !!}
	<div class="modal-body">
	</div>
@overwrite

@section('footer')
	<div class="modal-footer">
	    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    <button type="submit" class="btn btn-primary">Save changes</button>
	</div>
	{!! Form::close() !!}
@overwrite