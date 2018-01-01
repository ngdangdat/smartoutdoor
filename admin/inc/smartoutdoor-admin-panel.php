<?php

if(!function_exists('smart_outdoor_admin_panel_setup'))
{
	function smart_outdoor_admin_panel_setup()
	{
		?>
			<div class="wrap">
				<h1>Theme Panel</h1>
				<form method="post" action="options.php">
					<?php
						settings_fields("section");
						do_settings_sections("smartoutdoor-options");
						submit_button();
					?>
				</form>
			</div>
		<?php
	}
}
