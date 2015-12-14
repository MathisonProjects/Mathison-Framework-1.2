@if (isset($menu))
	<li class="dropdown">
		<a href="#" tabindex="0" data-toggle="dropdown">Menu <i class="glyphicon glyphicon-cog"></i><span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			@yield('menu_general')
		</ul>
	</li>
	<li class="dropdown">
		<a href="#" tabindex="0" data-toggle="dropdown">Functions <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			@yield('menu_functions')
		</ul>
	</li>
	<li class="dropdown">
		<a href="#" tabindex="0" data-toggle="dropdown">Payment Methods <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			<li class="dropdown-submenu">
				<a tabindex="0" data-toggle="dropdown">Authorize.Net</a>
				<ul class="dropdown-menu">
					@yield('menu_authorizenet')
				</ul>
			</li>
			<li class="dropdown-submenu">
				<a tabindex="0" data-toggle="dropdown">Paypal</a>
				<ul class="dropdown-menu">
					@yield('menu_paypal')
				</ul>
			</li>
		</ul>
	</li>
@endif