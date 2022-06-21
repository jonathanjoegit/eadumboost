<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme settings.
 *
 * @package    theme_eadumboost
 * @copyright  2022 Jonathan J. - Le Mans Université
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingeadumboost', get_string('configtitle', 'theme_eadumboost'));


    /*
    * ----------------------
    * General settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_eadumboost_general', get_string('general_settings', 'theme_eadumboost'));


    // Set plateform environment (to have extra CSS for test & pre prod).
    $name = 'theme_eadumboost/platform_env';
    $title = get_string('platform_env', 'theme_eadumboost');
    $description = get_string('platform_env_desc', 'theme_eadumboost');
    $default = 'Production';
    $choices = array(
        'Production' => 'Production',
        'Pre-Production' => 'Pre-Production',
        'Test-annualisation' => 'Annualisation',
        'Test' => 'Test'
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Show a block for Angers Université users in the login page.
    $name = 'theme_eadumboost/login_connexion_angers_users';
    $title = get_string('title_angers_users', 'theme_eadumboost');
    $description = get_string('text_angers_user', 'theme_eadumboost');
    $default = 0;
    $choices = array(
        0 => "No",
        1 => "Yes"
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Show "course list" in navbar for everybody or just admin/manager (UMTICE: all, EADUM: manager).
    $name = 'theme_eadumboost/navbar_course_list';
    $title = get_string('navbar_course_list', 'theme_eadumboost');
    $description = get_string('navbar_text_course_list_navbar', 'theme_eadumboost');
    $default = 'manager';
    $choices = array(
        'everybody' => 'Everybody (UMTICE)',
        'manager' => 'Manager (EADUM)'
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Add the page.
    $settings->add($page);


    /*
    * ----------------------
    * Course settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_eadumboost_course', get_string('course_settings', 'theme_eadumboost'));

    // Simplify the nav-drawer in the context "course" (hide that is not connected with the course).
    // For now, it's a scss file : course_simplify_navdrawer.scss.
    $name = 'theme_eadumboost/course_simplify_navdrawer';
    $title = get_string('course_simplify_navdrawer', 'theme_eadumboost');
    $description = get_string('course_text_simplify_navdrawer', 'theme_eadumboost');
    $default = 0;
    $choices = array(
        0 => "No",
        1 => "Yes"
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // Add the page.
    $settings->add($page);
}
