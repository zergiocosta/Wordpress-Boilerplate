<?php

/**
 * @package Project Name
 */


/**
 * Sets up theme default paths
 */

if(!defined('WP_THEME_URL'))  { define('WP_THEME_URL', get_stylesheet_directory_uri()); }
if(!defined('WP_SCRIPT_URL')) { define('WP_SCRIPT_URL', WP_THEME_URL . '/assets/js'); }
if(!defined('WP_STYLE_URL'))  { define('WP_STYLE_URL', WP_THEME_URL . '/assets/css'); }
if(!defined('WP_IMAGE_URL'))  { define('WP_IMAGE_URL', WP_THEME_URL . '/assets/images'); }

$functions_path = get_template_directory() . '/functions/';


/**
 * Require functions partials.
 */

require_once($functions_path . 'general.php');
require_once($functions_path . 'optimize.php');
require_once($functions_path . 'support.php');
require_once($functions_path . 'posttype.php');
require_once($functions_path . 'taxonomies.php');
require_once($functions_path . 'admin.php');
require_once($functions_path . 'google.php');
require_once($functions_path . 'social.php');
