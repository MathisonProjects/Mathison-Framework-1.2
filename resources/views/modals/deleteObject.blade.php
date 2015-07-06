<?php
	$modalName = 'deleteObject';
?>

@extends('modals.template')

@section('head')
	<h4 class="modal-title" id="myModalLabel">Delete Object for {{ $objectName }}</h4>
	<h5>YOU CANNOT REVERSE THIS ACTION</h5>
@overwrite

@section('body')
@overwrite

@section('footer')
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<a href="/admin/super/objects/{{ $fields[0]->oid }}/delete"><button type="submit" class="btn btn-primary">Confirm Deletion</button></a>
	</div>
@overwrite