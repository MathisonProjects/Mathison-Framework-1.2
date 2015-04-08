@extends('superAdmin.menu.frame')

@section('menu')
	@include('superAdmin.menu.list.objects')
	@include('superAdmin.menu.list.relationships')
	<li></li><li class="divider"></li>
	@include('superAdmin.menu.list.apis')
	@include('superAdmin.menu.list.middleware')
	<li></li><li class="divider"></li>
	@include('superAdmin.menu.list.templates')
	<li></li><li class="divider"></li>
	@include('superAdmin.menu.list.forms')
	@include('superAdmin.menu.list.formprocessing')
	@include('superAdmin.menu.list.customreports')
	<li></li><li class="divider"></li>
	@include('superAdmin.menu.list.workflows')
	@include('superAdmin.menu.list.pdf')
	@include('superAdmin.menu.list.requiredfiles')
	@include('superAdmin.menu.list.unittests')
	<li></li><li class="divider"></li>
	@include('superAdmin.menu.list.marketing')
	<li></li><li class="divider"></li>
	@include('superAdmin.menu.list.other')
@stop