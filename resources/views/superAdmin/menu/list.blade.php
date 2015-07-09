@extends('superAdmin.menu.frame')

@section('menu')
	@if (isset($menu))
		<?php $divider = '<li></li><li class="divider"></li>'; $list = 'superAdmin.menu.list.' ?>
		@include($list.'accounts')
		@include($list.'sessions')
		@include($list.'constants')
		{!! $divider !!}
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
	@endif
@stop