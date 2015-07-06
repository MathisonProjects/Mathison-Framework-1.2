<div class="modal fade" id="{{ $modalName }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
			<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        @yield('head')
		    </div>
	    	@yield('body')
	        @yield('footer')
	    </div>
	</div>
</div>