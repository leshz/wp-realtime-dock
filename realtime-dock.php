<?php

/**
 * Plugin Name: Real Time Dock
 * Plugin URI: http://github.com/leshz/
 * Description: Get ready for a nautical adventure with our plugin! It's your one-stop solution to unveil the mysterious dock statuses and ship secrets. Our plugin lets you in on the classified information about your favorite docks and their ship companions. Dive into the deep sea of data and discover the tales of these majestic vessels. Get ship-faced with our plugin, and enjoy the voyage through dock statuses and ship info! 🚢💫
 * Version: 0.2.2
 * Author: Jeffer Barragán
 * Author URI: github.com/leshz
 * License: GPLv2 or later
 */

register_activation_hook(__FILE__, 'dock_install');
register_deactivation_hook(__FILE__, 'dock_uninstall');

require_once(plugin_dir_path(__FILE__) . 'includes/admin-menu.php');
require_once(plugin_dir_path(__FILE__) . 'includes/database.php');
require_once(plugin_dir_path(__FILE__) . 'includes/ajax-handlers.php');
require_once(plugin_dir_path(__FILE__) . 'includes/frontend.php');
require_once(plugin_dir_path(__FILE__) . 'includes/shortcodes.php');
