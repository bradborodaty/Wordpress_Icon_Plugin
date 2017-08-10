<?php
/*
Plugin Name: Home Icons
Plugin URI: http://wordpress.org
Description: Allows the user to upload and icon url link and text to associate with it.
Version: 1.0
Author: Brad Borodaty
Author URI: http://bradborodaty.com
*/
?>
<?php
// hook for adding home icon plugin to admin sidebar
add_action('admin_menu', 'add_home_icon');
// action function above hook is calling
function add_home_icon() {
    add_menu_page(__('Home Icon'), __('Home Icon'), 'manage_options', 'home-icon', 'add_toplevel_page');
}
// what will be displayed in the content section
function add_toplevel_page() {
?>
<div>
    <h2> The Home Page Promotion Icon Row </h2>
    <p> Here is where you can upload your own personal icon with text to display beneath it. These will show up in order as listed below in a row below your picture and text. </p>
    <!-- options.php necessary for wordpress -->
    <form action="options.php" method="post">
        <!-- setting the settings group name, register_setting first arg must match this group name -->
        <?php settings_fields('plugin_options'); ?>
        <!-- slug name of page whose settings sections to be output, match add_settings_section fourth arg -->
        <?php do_settings_sections('plugin'); ?>
        <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
    </form>
</div>
<?php
}
?>
<?php
add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init() {
    // first arg is the group to be stored in, second is the name of the options: if more than one repeat, third is the function name to validate input
    register_setting( 'plugin_options', 'plugin_text', 'plugin_options_validate' );
    register_setting( 'plugin_options', 'plugin_icon', 'plugin_options_validate' );
    register_setting( 'plugin_options', 'contact_icon', 'plugin_options_validate');
    register_setting( 'plugin_options', 'contact_text', 'plugin_options_validate');
    register_setting( 'plugin_options', 'listing_icon', 'plugin_options_validate');
    register_setting( 'plugin_options', 'listing_text', 'plugin_options_validate');
    // create section of settings, first arg is id for section, second arg is title seen on page, third arg is function to display html, fourth arg is page name to match name in do settings sections
    add_settings_section('plugin_about', 'Section 1', 'about_section_text', 'plugin');
    add_settings_section('plugin_contact', 'Section 2', 'contact_section_text', 'plugin');
    add_settings_section('plugin_listing', 'Section 3', 'listing_section_text', 'plugin'); 
    // first arg id, second arg title, thrid arg function to display html, fourth arg page name same as do settings section, fifth arg id of settings section
    add_settings_field('about_icon_string', 'Icon Url', 'about_setting_icon', 'plugin', 'plugin_about');
    add_settings_field('about_text_string', 'Icon Text', 'about_setting_text', 'plugin', 'plugin_about');
    add_settings_field('contact_icon_string', 'Icon Url', 'contact_setting_icon', 'plugin', 'plugin_contact');
    add_settings_field('contact_text_string', 'Icon Text', 'contact_setting_text', 'plugin', 'plugin_contact');
    add_settings_field('listing_icon_string', 'Icon Url', 'listing_setting_icon', 'plugin', 'plugin_listing');
    add_settings_field('listing_text_string', 'Icon Text', 'listing_setting_text', 'plugin', 'plugin_listing');
}
?>
<?php
// section head and input fields for about icon section
function about_section_text() {
    echo '<p style="font-style:italic;"> This section is for putting in the url and text for your first promotion content. </p>';
}
function about_setting_icon() {
    $icons = get_option('plugin_icon');
    echo "<input id='about_icon_string' name='plugin_icon[text_string]' size='100' type='text' value='{$icons['text_string']}' />";
}
function about_setting_text() {
    $options = get_option('plugin_text');
    echo "<input id='about_text_string' name='plugin_text[text_string]' size='100' type='text' value='{$options['text_string']}' />";
}
// END about icon output section
// section head and input fields for contact icon section
function contact_section_text() {
    echo '<p style="font-style:italic;"> This section is for putting in the url and text for your second promotion content. </p>';
}
function contact_setting_icon() {
    $contact = get_option('contact_icon');
    echo "<input id='contact_icon_string' name='contact_icon[text_string]' size='100' type='text' value='{$contact['text_string']}' />";
}
function contact_setting_text() {
    $contacts = get_option('contact_text');
    echo "<input id='contact_text_string' name='contact_text[text_string]' size='100' type='text' value='{$contacts['text_string']}' />";
}
// END contact icon output section
// section head and input fields for listing section
function listing_section_text() {
    echo '<p style="font-style:italic;"> This section is for putting in the url and text for your third promotion content. </p>';
}
function listing_setting_icon() {
    $listing = get_option('listing_icon');
    echo "<input id='listing_icon_string' name='listing_icon[text_string]' size='100' type='text' value='{$listing['text_string']}' />";
}
function listing_setting_text() {
    $listings = get_option('listing_text');
    echo "<input id='listing_text_string' name='listing_text[text_string]' size='100' type='text' value='{$listings['text_string']}' />";
}
// END listing icon output section
?>
