<li class="dropdown-submenu">
	<a tabindex="0" data-toggle="dropdown">APIs</a>
	<ul class="dropdown-menu">
		<li>
			<a tabindex="0" href="/admin/super/api/create">Create API</a>
		</li>
		<li>
			<a tabindex="0" href="/admin/super/api">View APIs</a>
		</li>
		<li></li>
		<li class="divider"></li>
		@foreach ($menu['apis'] as $item)
		<li>
			<a tabindex="0" href="/admin/super/api/{{ $item->id }}">
				<?php
				echo ucwords(str_replace('_', ' ',$item->name));
				?></a>
			</li>
			@endforeach
		</ul>
	</li>