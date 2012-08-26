<?php

/**
 * Settings for the nuim theme
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    
    //This is the note box for all the settings pages
    $name = 'theme_nuim/notes';
    $heading = get_string('notes', 'theme_nuim');
    $information = get_string('notesdesc', 'theme_nuim');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);
	
	$name = 'theme_nuim/colorset';
	$title = get_string('colorset','theme_nuim');
	$description = get_string('colorsetdesc', 'theme_nuim');
	$setting = new admin_setting_configselect($name, $title, $description, 3,
             array('0' => 'yellow',
                   '1' => 'blue',
                   '2' => 'red',
                   '3' => 'green'));
	$settings->add($setting);
	
	$name = 'theme_nuim/helplink';
	$title = get_string('helplink','theme_nuim');
	$description = get_string('helplink', 'theme_nuim');
	$setting = new admin_setting_configtext($name, $title, $description, '');
	$settings->add($setting);
	
	$name = 'theme_nuim/frontpagenews';
    $title = get_string('frontpagenews','theme_nuim');
    $description = get_string('frontpagenewsdesc', 'theme_nuim');
    $default = '0';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settings->add($setting);
    
    $name = 'theme_nuim/max_dropdown_courses';
	$title = get_string('max_dropdown_courses','theme_nuim');
	$description = get_string('max_dropdown_coursesdesc', 'theme_nuim');
	$setting = new admin_setting_configselect($name, $title, $description, 0,
             array('0' => '5',
                   '1' => '10',
                   '2' => '15',
                   '3' => '25',
                   '4' => 'unlimited'));
	$settings->add($setting);
	
	$name = 'theme_nuim/login_picture';
	$title = get_string('login_picture','theme_nuim');
	$description = get_string('login_picturedesc', 'theme_nuim');
	$setting = new admin_setting_configselect($name, $title, $description, 1,
             array('1' => 'walking_people',
                   '2' => 'building',
                   '3' => 'graduates',
                   '4' => 'use_custom_url'));
	$settings->add($setting);
	
	$name = 'theme_nuim/logo_url';
    $title = get_string('logo_url','theme_nuim');
    $description = get_string('logo_urldesc', 'theme_nuim');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);
    

    
    $name = 'theme_nuim/login_bgcolor';
    $title = get_string('login_bgcolor','theme_nuim');
    $description = get_string('login_bgcolordesc', 'theme_nuim');
    $default = '#000000';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, NULL);
    $settings->add($setting);
    
	$name = 'theme_nuim/login_box_position';
	$title = get_string('login_box_position','theme_nuim');
	$description = get_string('login_box_positiondesc', 'theme_nuim');
	$setting = new admin_setting_configselect($name, $title, $description, 1,
             array('1' => 'left',
                   '2' => 'center',
                   '3' => 'right'));
	$settings->add($setting);

}