<?php
/**
 * @since             1.0.0
 * @package           RoistatSubmit
 *
 * @wordpress-plugin
 * Plugin Name:       RoistatSubmit
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       Send request to Roistat on sending email via contact form 7
 * Version:           1.0.1
 * Author:            Michael Belau
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
    die();
}

define('ROISTAS_SUBMIT_VERSION', '1.0.1');

require plugin_dir_path(__FILE__) . 'includes/RoistatSubmit.php';

$plugin = new RoistatSubmit();
$plugin->run();
