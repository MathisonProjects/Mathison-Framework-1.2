@extends('superAdmin.master')

@section('content')
	<h2>
		{{ $objectName }}
	</h2>
	<h4>{{ $description }}</h4>
	<div class='row'>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary addRecord' data-toggle="modal" data-target="#addRecord">             <i> <span class='glyphicon glyphicon-plus'>          </span></i> Add Record</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary addRelationship' data-toggle="modal" data-target="#addRelationship"> <i> <span class='glyphicon glyphicon-link'>          </span></i> Add Relationship</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary createAPI' data-toggle="modal" data-target="#createAPI">             <i> <span class='glyphicon glyphicon-log-out'>       </span></i> Create API</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary createForm' data-toggle="modal" data-target="#createForm">           <i> <span class='glyphicon glyphicon-pencil'>        </span></i> Create Form</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary createReport' data-toggle="modal" data-target="#createReport">       <i> <span class='glyphicon glyphicon-align-justify'> </span></i> Create Report</button>
		</div>
		<div class='col-md-2' style='text-align: center;'>
			<button type='button' class='btn btn-primary deleteObject' data-toggle="modal" data-target="#deleteObject">       <i> <span class='glyphicon glyphicon-minus'>         </span></i> Delete Object</button>
		</div>
	</div>
	<br />
	<table class='table table-hover table-condensed'>
		<tr>
		@foreach ($fields as $field)
			@if ($field->name == 'id')
				<th style='width: 60px;text-align: center;'>View</th>
				<th style='width: 60px;text-align: center;'>Edit</th>
				<th style='width: 60px;text-align: center;'>Delete</th>
			@endif
			<th style='text-align: center;'>{{ $field->name }}</th>
		@endforeach
		</tr>
		@foreach ($records as $record)
			<tr>
				@foreach ($fields as $field)
					@if ($field->name == 'id')
						<td style='width: 60px;text-align: center;'><a href='#'><i><span class='glyphicon glyphicon-eye-open'></span></i></a></td>
						<td style='width: 60px;text-align: center;'><a href='#'><i><span class='glyphicon glyphicon-edit'></span></i></a></td>
						<td style='width: 60px;text-align: center;'><a href='#'><i><span class='glyphicon glyphicon-remove'></span></i></a></td>
					@endif
					<td style='text-align: center;'>{{ $record->{$field->name} }}</td>
				@endforeach
			</tr>
		@endforeach
	</table>
@stop

@section('modal')

	<div class="modal fade" id="addRecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add Record for {{ $objectName }}</h4>
	      </div>
		  {!! Form::open() !!}
		  {!! Form::hidden('objectName', $dbName) !!}
	      <div class="modal-body">
	        @foreach ($fields as $field)
				<div class='form-group'>
	        	@if ($field->name != 'id')
					<label for='{{ $field->name }}'>{{ $field->name }}</label>
					{!! Form::text($field->name, null, array('placeholder' => $field->name, 'class' => 'form-control')) !!}
				@endif
				</div>
	        @endforeach
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
		  {!! Form::close() !!}
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="addRelationship" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add Relationship for {{ $objectName }}</h4>
	      </div>
		  {!! Form::open() !!}
		  {!! Form::hidden('objectName', $dbName) !!}
	      <div class="modal-body">
	      	<div class='form-group'>
				<label for='relationshipname'>Relationship Name</label>
				{!! Form::text('relationshipname', null, array('class' => 'form-control', 'id' => 'relationshipname', 'placeholder' => 'Relationship Name')) !!}
	      	</div>
			<div class='form-group'>
				<label for='relationshiptype'>Relationship Type</label>
		      	<select name='relationshiptype' class='form-control'>
		      		<option value></option>
					<option value='many-to-many'>Many to Many</option>
					<option value='many-to-one'>Many to One</option>
					<option value='one-to-many'>One to Many</option>
					<option value='one-to-one'>One to One</option>
		      	</select>
	      	</div>
		    <div class='form-group'>
				<label for='fromfield'>From Field</label>
		      	<select name='fromfield' id='totable' class='form-control'>
		      		<option value></option>
					@foreach ($fields as $field)
						<option value='{{ $field->name }}'>{{ $field->name }}</option>
					@endforeach
		      	</select>
		    </div>
			<div class='form-group'>
				<label for='totable'>Related Table</label>
		      	<select name='totable' id='totable' class='form-control'>
		      		<option value></option>
					@foreach ($menu['objects'] as $item)
						<option value='{{ $item->name }}'>{{ $item->name }}</option>
					@endforeach
		      	</select>
		    </div>
		    <div class='form-group'>
				<label for='tofield'>To Field</label>
				<select name='tofield' id='tofield' class='form-control'>
		      		<option value></option>
				</select>
		    </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
		  {!! Form::close() !!}
	    </div>
	  </div>
	</div>

@stop