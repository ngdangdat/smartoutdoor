<?php

require get_theme_file_path() . '/admin/inc/smartoutdoor-admin-panel.php';
require get_theme_file_path() . '/admin/inc/smartoutdoor-admin-feature-category.php';

if(!function_exists('add_theme_menu_item'))
{
	function add_theme_menu_item()
	{
		add_menu_page("Smart Daily Outdoor", "Smart Daily Outdoor", "manage_options", "smart-outdoor-theme-panel", "smart_outdoor_admin_panel_setup", null, 99);
	}
}


/**
 * Initialize functions used in Admin CP
 */
function init_admin(){
	add_action("admin_menu", "add_theme_menu_item");
	add_action("admin_init", "display_theme_panel_fields");
}