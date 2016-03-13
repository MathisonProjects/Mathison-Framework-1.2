@extends('superAdmin.menu.frame')

<?php $divider = '<li></li><li class="divider"></li>'; ?>
@section('menu_general')
	@if (isset($menu))
		<?php $list = 'superAdmin.menu.list.' ?>
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
		<?php $function = 'superAdmin.menu.function.' ?>
		@include($function.'listgeneration')
		@include($function.'landingpagecampaigns')
	@endif
@stop

@section('menu_authorizenet')
	@if (isset($menu))
		<?php $authorize = 'superAdmin.menu.authorizenet.' ?>
		@include($authorize.'list')
	@endif
@stop

@section('menu_paypal')
	@if (isset($menu))
		<?php $paypal = 'superAdmin.menu.paypal.' ?>
		@include($paypal.'list')
	@endif
@stop