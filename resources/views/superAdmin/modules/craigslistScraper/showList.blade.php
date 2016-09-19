@extends('superAdmin.master')

@section('content')
	<h2>Craigslist Scraper List</h2>
	<ul  class="nav nav-tabs">
		<li class="active">
       		<a  href="#list" data-toggle="tab">List</a>
		</li>
		<li>
			<a href="#favorites" data-toggle="tab">Favorites</a>
		</li>
		<li>
			<a href="#history" data-toggle="tab">History</a>
		</li>
	</ul>
	<br />
	<div class="tab-content clearfix">
		<div class="tab-pane active" id="list">
			{!! $table !!}
		</div>
		<div class="tab-pane" id="favorites">
        	FAVORITES
		</div>
		<div class="tab-pane" id="history">
        	HISTORY
		</div>
	</div>

@stop