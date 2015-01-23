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