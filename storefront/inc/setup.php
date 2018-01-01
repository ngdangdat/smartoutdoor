<?php

if(!function_exists('smartourdoor_setup'))
{
	function smartourdoor_setup(){
		add_image_size( 'smartourdoor_blog_image', 750, 300, true );
		add_image_size( 'smartoutdoor_large_blog_image', 900, 360, true);
	}
}