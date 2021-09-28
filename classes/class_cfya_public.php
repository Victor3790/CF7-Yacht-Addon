<?php
/*
* Class to handle public functions.
*/
if ( ! defined( 'ABSPATH' ) ) die();

class CFYA_Public
{

    public function add_yacht_name( $form_html )
    {

        $form = WPCF7_ContactForm::get_current();
        $setting_form_id = get_option( 'cfya_form_id' );

        if ( empty( $setting_form_id ) )
            return $form_html;

        if( $form->id() != $setting_form_id )
            return $form_html;

        $yacht_name = esc_html( get_the_title() );
        $new_form_html = str_replace( 'cfya_yacht_name', $yacht_name, $form_html );

        return $new_form_html;

    }
    
}

