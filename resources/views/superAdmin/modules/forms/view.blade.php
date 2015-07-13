@extends('superAdmin.master')

@section('content')
	<h2>{{$formItem[0]['name']}}</h2>
	<h3>{{$formItem[0]['description']}}</h3>
	{!! Form::open(['url'=>'admin/super/api/v1/']) !!}
		{!! Form::hidden('apiId', $apiId) !!}
		@foreach ($formItem[1] as $key => $item)
			<div class='row'>
				<div class='col-md-4 form-group'>
					@if ($item['fieldtype'] != 'add_Submit' && $item['fieldtype'] != 'add_Button')
						<label for="{{$item['name']}}">
							{{ucfirst($item['name'])}}:
						</label>
					@endif

					@if ($item['fieldtype'] == 'add_Textbox')
						{!! Form::text($item['name'], null, array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_Password')
						{!! Form::password($item['name'], null, array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_Dropdown')
						<?php $itemsList = explode(',', $item['fieldoptions']); ?>
						{!! Form::select($item['name'], $itemsList, null, array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_Radiobuttons')
						{!! Form::radio($item['name'], array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_Date')
						{!! Form::selectMonth($item['name'], array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_Time')
						{!! Form::text($item['name'], array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_Hidden_Field')
						{!! Form::text($item['name'], array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_Checkboxes')
						{!! Form::checkbox($item['name'], array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_Button')
						{!! Form::button($item['name'], array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_File')
						{!! Form::file($item['name'], array('class' => 'form-control', 'id' => $item['name'])) !!}
					@elseif ($item['fieldtype'] == 'add_Submit')
						{!! Form::submit($item['name'], array('class' => 'form-control btn btn-primary')) !!}
					@endif
				</div>
			</div>
		@endforeach
	{!! Form::close() !!}
@stop