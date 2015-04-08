@extends('superAdmin.master')

@section('content')

	<h2>Create Workflow Chain</h2>


	{!! Form::open() !!}

	<div class='row'>
		<div class='col-md-4'>
			<div class='form-group'>
				<label for='workflowitem'>Workflow Item:</label>
				{!! Form::text('workflowitem', null, array('id' => 'workflowitem', 'placeholder' => 'WorkflowItem', 'class' => 'form-control', 'maxlength' => '25')) !!}
			</div>
			<div class='form-group'>
				<label for='originaldestination'>Original Destination:</label>
				{!! Form::text('originaldestination', null, array('id' => 'originaldestination', 'placeholder' => 'Original URL', 'class' => 'form-control', 'maxlength' => '255')) !!}
			</div>
			<div class='form-group'>
				<label for='finaldestination'>Final Destination:</label>
				{!! Form::text('finaldestination', null, array('id' => 'finaldestination', 'placeholder' => 'New URL', 'class' => 'form-control', 'maxlength' => '255')) !!}
			</div>
			<div class='form-group'>
				<label for='default'>Default:</label><br />
				{!! Form::radio('default', '1'); !!} True<br />
				{!! Form::radio('default', '0'); !!} False<br />
			</div>
			<button type='submit' class='btn btn-primary col-md-12'>Submit</button>
		</div>
	</div>

	{!! Form::close() !!}
@stop