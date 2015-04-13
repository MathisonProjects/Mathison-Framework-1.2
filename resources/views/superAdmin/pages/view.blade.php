@extends('superAdmin.master')

@section('content')
	<a href="/admin/super/pages">Go Back</a>
	<?php
		try {
			echo '<h2>View Page '.$page->id.'</h2>';
			echo $page->datatext;
		} catch(Exception $e) {
			echo '<h2>View Page '.$page['id'].'</h2>';
			echo $page['datatext'];
		}
	?>
@stop