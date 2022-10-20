<?php
/*
Plugin Name: Plugin Name
Plugin URI: https://www.plugin-uri.com/
Description: Plugin Description
Version: 1.0
Author: Author Name
Author URI: https://www.author-uri.com/
License: GPLv2
*/
/*  Copyright 2022  David Fraga Ruso  (email : david.fraga.bcn@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Prefix to rename = dfr_base_

//Verifies minimum WP Version needed to work
register_activation_hook( __FILE__, 'dfr_base_install' );
function dfr_base_install() {
    global $wp_version;
    if ( version_compare( $wp_version, '6.0', '<' ) ) {
        wp_die( 'This plugin requires WordPress version 6.0 or higher.' );
    }
}

// Load text domain and language files for traductions

/**
 * How to create .POT file for make translations (with free version of PoEdit)
 * 
 * In PoEdit:
 * 
 * 1.In the "File" menu select "New"
 * 2.Select the language that you used in your theme (probably English)
 * 3.In the "Catalog" menu select "Properties"
 * 4.Enter the project information in the "Translation properties" tab
 * 5.Go to the 3rd tab "Sources keywords"
 * 6.Click on the "New item" button (2nd button) and enter a keyword and repeat this for each of your keywords (__, _e, esc_attr_e, etc.)
 * 7.Click on the "OK" button at the bottom
 * 8.In the "File" menu select "Save As.."
 * 9.Save the file as "yourthemename.pot" in the "languages" folder in your theme directory (make sure you add the .pot extension to the filename because by default it will save as .po)
 * 10.In the "Catalog" menu select "Properties" again
 * 11.Go to the 2nd tab "Sources paths"
 * 12.Click the "+" button under "Path" textarea and select "Add folders".(this will make it scan your plugin directory and its subdirectories)
 * 13.Select the main folder of your plugin
 * 14.Click on the "OK" button at the bottom
 * 15.In the project window click on "Update" (2nd icon at the top)
 * 16.In the "File" menu click "Save". It creates .POT and .MO files
 * 
 * From the .POT file extension you can create different translation files and save them as .PO files.
 */

function dfr_base_languages() {
    $textdomain = 'dfr_dev';
    load_plugin_textdomain( $textdomain, false, 'WP-BASE-PLUGIN/languages' );
}

//Register css/js files on frontend:
//Comment-uncomment based on plugin needs
function dfr_base_register_scripts(){
    $css_url = plugin_dir_url(__FILE__) . 'css/style.css';
    $js_url = plugin_dir_url(__FILE__) . 'js/main.js';
    wp_enqueue_style( 'ltw_base_style',  $css_url);
    wp_enqueue_script( 'ltw_base_js',  $js_url);
}
add_action('wp_enqueue_scripts', 'dfr_base_register_scripts');

//Register css/js files on admin/backend:
//Comment-uncomment based on plugin needs
function ltw_base_admin_style() {
    $admin_css_url = plugin_dir_url(__FILE__) . 'css/admin_style.css';
  wp_enqueue_style('ltw-admin-styles', $admin_css_url);
}
add_action('admin_enqueue_scripts', 'ltw_base_admin_style');

//Hook to add menu item/page to WP backend example:
add_action( 'admin_menu', 'dfr_base_adminmenu' );
function dfr_base_adminmenu(){
    add_options_page(
        __('DFR Plugin readme', 'dfr_dev'), //HTML title text
        __('DFR Base Plugin Page', 'dfr_dev'), //Text for item name in the Dashboard
        'manage_options', //Minimum user capacity to access the section
        'dfr-plugin-documentation', //slug for page
        'dfr_base_page' //Function to build menu page
        //'img/generic.png', //icon url-rute
        //3 //Position of the item in the menu, by default it is placed at the end.
    );
}
function ltw_base_page() {
    ?>
    <div class="wrap ltw-panel">
        <p>Page content here</p>
    </div>
    <?php
}