<?php
/*
   Plugin Name: Pro Quoter
   Description: Create beautiful pull-quote images for your WordPress blog entries. Highlight text in your blog post, press the ProQuoter button on the toolbar and choose from a variety of beautiful quote images for your blog entry.
   Author:      @ProWritingAid
   Version:     1.0
   Plugin URI:  http://quotes.prowritingaid.com
   Author URI:  http://quotes.prowritingaid.com
*/
function proquoter_addbuttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("tiny_mce_version", "pq_tiny_mce_version" );
     add_filter("mce_external_plugins", "add_proquoter_tinymce_plugin");
     add_filter('mce_buttons', 'register_proquoter_button');
   }
}
 
function register_proquoter_button($buttons) {
   array_push($buttons, "separator", "proquoterLeft", "proquoterRight");
   return $buttons;
}
 
function add_proquoter_tinymce_plugin($plugin_array) {
   $plugin_array['proquoter'] = plugins_url('/proquoter/pq.js');
   return $plugin_array;
}

function pq_tiny_mce_version($version) {
    return $version+2;
}
/* 
 *  The action handler used by admin-ajax.php
 */
function PQ_dialog() {    
	include('pq_dialog.php');
    die();
}
/* 
 *  The action handler used by admin-ajax.php
 */
function PQ_save() {    
	include('pq_save_image.php');
    die();
}

// init process for button control
add_action('init', 'proquoter_addbuttons');
add_action('wp_ajax_PQ_dialog', 'PQ_dialog' );
add_action('wp_ajax_nopriv_PQ_dialog', 'PQ_dialog' );
add_action('wp_ajax_PQ_save', 'PQ_save' );
add_action('wp_ajax_nopriv_PQ_save', 'PQ_save' );
?>