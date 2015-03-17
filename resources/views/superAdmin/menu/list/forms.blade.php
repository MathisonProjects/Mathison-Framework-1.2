<li class="dropdown-submenu">
				<a tabindex="0" data-toggle="dropdown">Forms</a>
				<ul class="dropdown-menu">
					<li>
						<a tabindex="0"><a href='/admin/super/createForms'>Create Form</a>
					</li>
					<li>
						<a tabindex="0"><a href='/admin/super/viewForms'>View Forms</a>
					</li>
					<li></li>
					<li class="divider"></li>
					@foreach ($menu['forms'] as $item)
					<li>
						<a tabindex="0" href="/admin/super/viewForm/{{ $item->id }}">
						<?php
							echo ucwords(str_replace('_', ' ',$item->name));
						?></a>
					</li>
					@endforeach
				</ul>
			</li>