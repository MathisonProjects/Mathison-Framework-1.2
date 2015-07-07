<?php
	$modalName = 'importData';
?>

@extends('modals.template')

@section('head')
	<h4 class="modal-title" id="myModalLabel">Import Data for {{ $objectName }}</h4>
@overwrite

@section('body')
	<form action="/admin/super/objects/{{ $fields[0]->oid }}/import" method="post" enctype="multipart/form-data" class="dropzone" id="dropzone"></form>
@overwrite

@section('footer')
@overwrite