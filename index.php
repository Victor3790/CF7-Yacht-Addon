<?php
/*
Plugin Name: CF7 Yacht Add-on.
Description: This plugin adds yacht info to CF7 forms.
Version: 1.0.0
Author: Victor Crespo
Author URI: https://victorcrespo.net
*/

if ( ! defined( 'ABSPATH' ) ) die();

define( 'CF7_YACHT_ADDON_PATH', plugin_dir_path( __FILE__ ) );

require_once 'includes/vk_template/class_vk_template.php';
require_once 'classes/class_cfya_admin.php';
require_once 'classes/class_cfya_public.php';

use vk_templates\Template;

class Cf7_Yacht_Addon
{

    static $instance = false;

    private $plugin_name;
    private $plugin_version;

    private $admin;

    private function __construct()
    {

        $this->plugin_name = 'CF7_Yacht_Add_on';
        $this->plugin_version = '1.0.0';

        $template = new Template();
        $file = CF7_YACHT_ADDON_PATH . 'views/admin_dashboard.php';

        $this->admin = new CFYA_Admin( $template, $file );
        $this->public = new CFYA_Public();

        /* Admin hooks */
        add_action( 'admin_menu', [$this->admin, 'register_page'] );
        add_action( 'admin_init', [$this->admin, 'register_settings'] );

        /* Public hooks */
        add_filter( 'wpcf7_form_elements', [$this->public, 'add_yacht_name'] );

    }

    public static function get_instance()
    {

        if( !self::$instance )
            self::$instance = new self();

        return self::$instance;

    }
    
}

$cf7_yacht_addon = Cf7_Yacht_Addon::get_instance();

