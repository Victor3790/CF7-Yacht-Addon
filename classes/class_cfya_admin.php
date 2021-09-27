<?php
/*
* Class to handle functions in Wordpress admin.
*/
if ( ! defined( 'ABSPATH' ) ) die();

require_once CF7_YACHT_ADDON_PATH . 'includes/vk_template/class_vk_template.php';

use vk_templates\Template;

class CFYA_Admin
{

    public function register_page()
    {

        add_menu_page(
            'CF7 Yacht Add-on',
            'CF7 Yacht Add-on',
            'manage_options',
            'cfya_plugin',
            [$this, 'load_dashboard'],
            '',
            5
        );

    }

    public function load_dashboard()
    {

        $file = CF7_YACHT_ADDON_PATH . 'views/admin_dashboard.php';
        $template = new Template();

        $view = $template->load( $file );
        echo $view;

    }

    public function register_settings()
    {

        add_settings_section(
            'cfya_settings_section',
            'Opciones de formulario CF7',
            [$this, 'echo_section_header'],
            'cfya_plugin'
        );

        register_setting(
            'cfya_settings_group',
            'cfya_form_id',
            [
                'type' => 'integer',
                'sanitize_callback' => [$this, 'sanitize_form_id'],
                'default' => ''
            ]
        );

        add_settings_field(
            'cfya_form_id',
            'Id del formulario',
            [$this, 'form_id_callback'],
            'cfya_plugin',
            'cfya_settings_section'
        );

    }

    public function echo_section_header()
    {

        return '';

    }

    public function sanitize_form_id( $input )
    {

        if( is_numeric( $input ) )
            $input = sanitize_text_field( $input );
        else
            $input = '';

        return $input;

    }

    public function form_id_callback()
    {

        $form_id = get_option( 'cfya_form_id' );

        if( ! $form_id )
            echo '<input type="number" name="cfya_form_id" placeholder="Identificador">';
        else
            echo '<input type="number" name="cfya_form_id" value="' . $form_id . '">';

    }
    
}

