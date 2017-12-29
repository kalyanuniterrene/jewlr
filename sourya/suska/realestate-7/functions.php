<?php
/**
 * Functions
 *
 * @package WP Pro Real Estate 7
 * @subpackage Admin
 */

/*-----------------------------------------------------------------------------------*/
/* Define some constant paths */
/*-----------------------------------------------------------------------------------*/

define('ADMIN_PATH', get_template_directory() . '/admin/');
define('INC_PATH', get_template_directory() . '/includes/');

/*-----------------------------------------------------------------------------------*/
/* Load ReduxFramework */
/*-----------------------------------------------------------------------------------*/

require_once(ADMIN_PATH . 'ReduxFramework/redux-extensions-loader/loader.php');
require_once(ADMIN_PATH . 'ReduxFramework/ReduxCore/framework.php');
require_once(ADMIN_PATH . 'ReduxFramework/theme-options/re7-config.php');

/*-----------------------------------------------------------------------------------*/
/* Localization Support */
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain('contempo', get_template_directory() . '/languages');
 
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";

if (is_readable($locale_file)) {
    require_once($locale_file);
}

/*-----------------------------------------------------------------------------------*/
/* Framework Functions
/*-----------------------------------------------------------------------------------*/

function ct_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}

// OAuth
require_once (ADMIN_PATH . 'OAuth.php');

// Child Theme Creator
require_once (ADMIN_PATH . 'ct-child-theme/ct-child-theme.php');

// Custom Profile Fields
require_once (ADMIN_PATH . 'profile-fields.php');

// Plugin Activation
require_once (ADMIN_PATH . 'plugins/class-tgm-plugin-activation.php');
require_once (ADMIN_PATH . 'plugins/register.php');

// Aqua Resizer
require_once (ADMIN_PATH . 'aq-resizer/aq_resizer.php');

// Register Sidebars
require_once (ADMIN_PATH . 'sidebars.php');

// Theme Functions
require_once (ADMIN_PATH . 'theme-functions.php');

// Theme Hooks
require_once (ADMIN_PATH . 'theme-hooks.php');

// CT Social Widget
require_once (ADMIN_PATH . 'ct-social/ct-social.php');

// Widgets
require_once (INC_PATH . 'widgets.php');

?>