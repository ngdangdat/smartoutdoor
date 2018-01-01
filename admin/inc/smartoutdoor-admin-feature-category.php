<?php

function display_cat_setting($idx) {
	$optionName = 'featured_category_' . $idx;
	?>
		<input type="text" name="<?php echo $optionName; ?>" id="<?php echo $optionName; ?>" value="<?= get_option($optionName); ?>" />
	<?php
}

if(!function_exists('display_theme_panel_fields'))
{
	function display_theme_panel_fields()
	{
		add_settings_section("section", "All Settings", null, "smartoutdoor-options");
		
		add_settings_field("featured_category_1", "1st Feature Category", "display_cat_setting", "smartoutdoor-options", "section", 1);
		add_settings_field("featured_category_2", "2nd Feature Category", "display_cat_setting", "smartoutdoor-options", "section", 2);
		add_settings_field("featured_category_3", "3rd Feature Category", "display_cat_setting", "smartoutdoor-options", "section", 3);

		register_setting("section", "featured_category_1");
		register_setting("section", "featured_category_2");
		register_setting("section", "featured_category_3");
	}
}

