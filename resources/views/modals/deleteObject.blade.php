	<div class="modal fade" id="deleteObject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Delete Object for {{ $objectName }}</h4>
	        <h5>YOU CANNOT REVERSE THIS ACTION</h5>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <a href="/admin/super/objects/{{ $fields[0]->oid }}/delete"><button type="submit" class="btn btn-primary">Confirm Deletion</button></a>
	      </div>
	    </div>
	  </div>
	</div>