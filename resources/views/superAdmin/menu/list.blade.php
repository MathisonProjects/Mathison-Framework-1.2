@extends('superAdmin.menu.frame')

@section('menu')
	<?php $divider = '<li></li><li class="divider"></li>'; $list = 'superAdmin.menu.list.' ?>
	@include($list.'objects')
	@include($list.'relationships')
	{!! $divider !!}
	@include($list.'apis')
	@include($list.'middleware')
	{!! $divider !!}
	@include($list.'templates')
	@include($list.'pages')
	{!! $divider !!}
	@include($list.'forms')
	@include($list.'formprocessing')
	{!! $divider !!}
	@include($list.'pdf')
	@include($list.'customreports')
	{!! $divider !!}
	@include($list.'workflows')
	@include($list.'requiredfiles')
	@include($list.'unittests')
	{!! $divider !!}
	@include($list.'marketing')
	{!! $divider !!}
	@include($list.'other')
@stop