@extends('page.master')

@section('content')
		<?php
		try {
			echo $page->datatext;
		} catch(Exception $e) {
			echo $page['datatext'];
		}
	?>
@stop