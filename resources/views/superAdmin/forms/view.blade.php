@extends('superAdmin.master')

@section('content')
	<h2>{{$formItem[0]['name']}}</h2>
	<h3>{{$formItem[0]['description']}}</h3>
	<form method='POST' action='#'>
		@foreach ($formItem[1] as $key => $item)
			<div class='row'>
				<div class='col-md-4'>
					<label for="">{{$item['name']}}:</label>
					@if ($item['fieldtype'] == 'add_Textbox')
						<input type='textbox' name='{{$item['name']}}' class='form-control' />
					@endif
				</div>
			</div>
		@endforeach
	</form>
@stop