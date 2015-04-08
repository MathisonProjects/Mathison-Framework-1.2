	<div class="modal fade" id="createAPI" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Create API for {{ $objectName }}</h4>
	      </div>
		  {!! Form::open() !!}
		  {!! Form::hidden('objectName', $dbName) !!}
	      <div class="modal-body">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
		  {!! Form::close() !!}
	    </div>
	  </div>
	</div>