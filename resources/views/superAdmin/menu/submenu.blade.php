<li class="dropdown-submenu">
	<a tabindex="0" data-toggle="dropdown">
		@yield('section')
	</a>
	<ul class="dropdown-menu">
		<li>
			@yield('create')
		</li>
		<li>
			@yield('view')
		</li>
		<li></li>
		<li class="divider"></li>
		@yield('list')
	</ul>
</li>