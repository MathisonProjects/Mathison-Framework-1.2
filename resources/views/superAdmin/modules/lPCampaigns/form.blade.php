
<h2>Landing Page Campaign</h2>
{!! Form::open(['url'=>'admin/super/lPCampaigns/']) !!}

<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('name', 'Campaign Name') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('description', 'Description') !!}
			{!! Form::text('description', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>
{!! Form::close() !!}