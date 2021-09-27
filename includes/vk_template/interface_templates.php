<?
/*
*  Interface for Template class.
*/
namespace vk_templates;

//Thought to work in a Wordpress context
if ( ! defined( 'ABSPATH' ) ) die();

interface Templates 
{

    public function load();

}
