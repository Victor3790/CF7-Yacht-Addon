<?php
/*
**  Class to load HTML templates for the front end
*/
namespace vk_templates;

//Thought to work in a Wordpress context
if ( ! defined( 'ABSPATH' ) ) die();

require_once 'interface_templates.php';

class Template implements Templates
{

    public function load( $template_file = null, $parameters = null )
    {
        
        $this->validate_template_file( $template_file );

        if( !is_null( $parameters ) ) {

            $this->validate_parameters( $parameters );

            extract( $parameters );
        }

        ob_start();
        
            require( $template_file );

        $buffer = ob_get_clean();

        return $buffer;

    }

    private function validate_template_file( $template_file )
    {

        if( is_null( $template_file ) )
            throw new \Exception("Vk Template: No template file passed", 100);

        if( !is_string( $template_file ) )
            throw new \Exception("Vk Template: Template file must be a string", 101);

        if( !is_file( $template_file ) )
            throw new \Exception("Vk Template: Template is not a valid file", 102);
            
    }

    private function validate_parameters( $parameters )
    {

        if( !is_array( $parameters ) )
            throw new \Exception("Vk Template: Parameters must be in an array", 103);

    }

}
