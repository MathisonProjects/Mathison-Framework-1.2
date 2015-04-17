<li class="dropdown-submenu">
	<a tabindex="0" data-toggle="dropdown">Pages</a>
	<ul class="dropdown-menu">
		<li>
			<a tabindex="0"><a href='/admin/super/pages/create'>Create Page</a>
		</li>
		<li>
			<a tabindex="0"><a href='/admin/super/pages/'>View Pages</a>
		</li>
		<li></li>
		<li class="divider"></li>
		@foreach ($menu['pages'] as $item)
			<li>
				<a tabindex="0" href="/admin/super/pages/{{ $item->id }}">
				<?php
					echo ucwords(str_replace('_', ' ',$item->stringurl));
				?></a>
			</li>
		@endforeach
	</ul>
</li>