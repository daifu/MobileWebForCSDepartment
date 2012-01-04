<?php

/**
 * 
 * @package cs
 *
 * @author daifu
 *
 * @uses Decorator
 * @uses Site_Decorator
 * @uses HTML_Decorator
 * @uses HTML_Start_HTML_Decorator
 * @uses Head_Site_Decorator
 * @uses Body_Start_HTML_Decorator
 * @uses Header_Site_Decorator
 * @uses Content_Full_Site_Decorator
 * @uses Button_Full_Site_Decorator
 * @uses Default_Footer_Site_Decorator
 * @uses Body_End_HTML_Decorator
 * @uses HTML_End_HTML_Decorator
 */

require_once(dirname(dirname(__FILE__)).'/assets/config.php');
require_once(dirname(dirname(__FILE__)).'/assets/lib/decorator.class.php');

echo HTML_Decorator::html_start()->render();

echo Site_Decorator::head()->set_title('UCLA CS About')->render();

echo HTML_Decorator::body_start()->render();

echo Site_Decorator::header()
        ->set_title('UCLA CS About')
        ->render();

$links = array(
   array('name' => 'Chair\'s Welcome',
         'link' => 'about/welcome.php'),
   array('name' => 'Mission Statement',
         'link' => 'about/mission_statement.php'),
   array('name' => 'History',
         'link' => 'about/history.php'),
   array('name' => 'Academic And Staff Positions',
         'link' => 'about/academic_and_staff_positions.php'),
   array('name' => 'Industrial Affiliates Program',
         'link' => 'about/industrial_affiliates_program.php'),
   array('name' => 'Annual Reports',
         'link' => 'about/annual_reports.php'),
   array('name' => 'Annual Reports',
         'link' => 'about/annual_reports.php'),
   array('name' => 'Administration',
         'link' => 'about/administration.php'),
   array('name' => 'Visitor Information',
         'link' => 'about/visitor_information.php')
);

//Create menu for about page
$about_obj = Site_Decorator::menu_full();
foreach ($links as $link) {
   $about_obj->add_item($link['name'], $link['link']);
}
echo $about_obj->set_padded()->set_detailed();

echo Site_Decorator::button_full()
                ->set_padded()
                ->add_option(Config::get('global', 'back_to_home_text'), Config::get('global', 'site_url'))
                ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();
