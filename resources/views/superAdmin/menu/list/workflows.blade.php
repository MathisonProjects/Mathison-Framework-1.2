<li class="dropdown-submenu">
	<a tabindex="0" data-toggle="dropdown">Workflow</a>
	<ul class="dropdown-menu">
		<li>
			<a tabindex="0" href="/admin/super/createWorkflow">Create Workflow Chain</a>
		</li>
		<li>
			<a tabindex="0" href="/admin/super/workflows">View Workflow Chains</a>
		</li>
		<li></li>
		<li class="divider"></li>
		@foreach ($menu['workflows'] as $item)
		<li>
			<a tabindex="0" href="/admin/super/viewWorkflow/{{ $item->workflowitem }}">
				<?php
				echo ucwords(preg_replace('/(?<!\ )[A-Z]/', ' $0', str_replace('_', ' ',$item->workflowitem)));
				?></a>
			</li>
			@endforeach
		</ul>
	</li>