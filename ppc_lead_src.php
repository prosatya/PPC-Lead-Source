<?php
/*
Plugin Name: PPC Lead Source  
Plugin URI:  http://www.matictechnology.com
Description: PPC Lead Source  plugin that will recognize a get variable ($_GET[’lead_src’]) on the URL and store this value in a cookie so that it is available for later use.
Version: 1.0
Author: Satyanarayan Verma  
Author URI: http://www.matictechnology.com
*/

if(!class_exists('PPC_Lead_Src'))
{
    class PPC_Lead_Src
    {
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
           add_action('init', array(&$this, 'plugin_init'));
           add_filter( 'PPC_get_lead_src', array( $this, 'PPC_get_lead_src_callback' ) );
           add_shortcode( 'lead_src', array( $this, 'PPC_get_lead_src_callback' ) );
           // add_action('admin_init', array(&$this, 'admin_init'));
		  //  add_action('admin_menu', array(&$this, 'add_menu'));

        } // END public function __construct
    
        /**
         * Activate the plugin
         */
        public static function activate()
        {
            // TODO:Something here

        } // END public static function activate
    
        /**
         * Deactivate the plugin
         */     
        public static function deactivate()
        {

			// TODO:Something here
			

        } // END  function 

        /**
		 * hook into WP's admin_init action hook
		 */
		public function admin_init()
		{
		   // TODO:Something here
		} // END  function 


        /**
		 * hook into WP's init action hook
		 */
		public function plugin_init()
		{
		   if(isset($_GET['lead_src']) && ($_GET['lead_src'] != "")){
		   		setcookie("lead_src", $_GET['lead_src'],time()+3600, "/" );
            }
		  
		} // END  function 


        /**
		 *  The filter will take a single parameter and return the value stored in the cookie for the ‘lead_src’ get variable.
		 */
		public function PPC_get_lead_src_callback($atts)
        {
            
           if(isset($_GET['lead_src']) && ($_GET['lead_src'] != "")) {
                return $_GET['lead_src'];
            }elseif(isset($_COOKIE['lead_src'])){
                return $_COOKIE['lead_src'];
            }else{
                return "net2"; 
            }

        } // END  function 


    } // END class Sample_Plugin
} // END if(!class_exists('Sample_Plugin'))


if(class_exists('PPC_Lead_Src'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('PPC_Lead_Src', 'activate'));
    register_deactivation_hook(__FILE__, array('PPC_Lead_Src', 'deactivate'));

    // instantiate the plugin class
    $PPC_Lead_Src = new PPC_Lead_Src();

    
}

