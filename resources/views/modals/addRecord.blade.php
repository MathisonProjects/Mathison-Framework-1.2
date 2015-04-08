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