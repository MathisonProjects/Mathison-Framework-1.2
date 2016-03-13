@extends('superAdmin.menu.frame')

@section('menu_general')
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
		@include($list.'googledrive')
		@include($list.'workflows')
		@include($list.'requiredfiles')
		@include($list.'unittests')
		{!! $divider !!}
		@include($list.'craigslist')
		@include($list.'marketing')
		{!! $divider !!}
		@include($list.'crons')
		@include($list.'other')
	@endif
@stop

@section('menu_functions')
	@if (isset($menu))
		<?php $divider = '<li></li><li class="divider"></li>'; $function = 'superAdmin.menu.function.' ?>
		@include($function.'listgeneration')
		@include($function.'landingpagecampaigns')
	@endif
@stop