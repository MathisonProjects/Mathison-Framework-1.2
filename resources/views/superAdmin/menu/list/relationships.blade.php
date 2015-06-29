<li class="dropdown-submenu">
	<a tabindex="0" data-toggle="dropdown">Relationships</a>
	<ul class="dropdown-menu">
		<li>
			<a tabindex="0" href="/admin/super/relationships/create">Create Relationship</a>
		</li>
		<li>
			<a tabindex="0" href="/admin/super/relationships">View Relationships</a>
		</li>
		<li></li>
		<li class="divider"></li>
		@foreach ($menu['relationships'] as $item)
			<li>
				<a tabindex="0" href="/admin/super/relationships/{{ $item->id }}">
				<?php
				echo ucwords(str_replace('_', ' ',$item->name));
				?></a>
			</li>
		@endforeach
	</ul>
</li>