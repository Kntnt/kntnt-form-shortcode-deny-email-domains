<?php

/**
 * Plugin main file.
 *
 * @wordpress-plugin
 * Plugin Name:       Kntnt Form Shortcode (KFS) – Deny Email Domains
 * Plugin URI:        https://www.kntnt.com/
 * GitHub Plugin URI: https://github.com/Kntnt/kntnt-form-shortcode-email-deny-list
 * Description:       Prevents visitors to submit forms built with Kntnt Form Shortcode (KFS) if there is a email field with an email domain listed in a deny list.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */


namespace Kntnt\Form_Shortcode_Deny_Email_Domains;

// Uncomment following line to debug this plugin.
define( 'KNTNT_FORM_SHORTCODE_DENY_EMAIL_DOMAINS_DEBUG', true );

require 'autoload.php';

defined( 'WPINC' ) && new Plugin;