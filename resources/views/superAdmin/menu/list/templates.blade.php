<li class="dropdown-submenu">
	<a tabindex="0" data-toggle="dropdown">Templates</a>
	<ul class="dropdown-menu">
		<li>
			<a tabindex="0"><a href='/admin/super/templates/create'>Create Template</a>
		</li>
		<li>
			<a tabindex="0"><a href='/admin/super/templates/'>View Templates</a>
		</li>
		<li></li>
		<li class="divider"></li>
		@foreach ($menu['templates'] as $item)
			<li>
				<a tabindex="0" href="/admin/super/templates/{{ $item->id }}">
				<?php
					echo ucwords(str_replace('_', ' ',$item->templatename));
				?></a>
			</li>
		@endforeach
	</ul>
</li>