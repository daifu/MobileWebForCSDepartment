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
require_once(dirname(dirname(dirname(__FILE__))).'/auxiliary/feed/feed.class.php');
require_once(dirname(dirname(__FILE__)).'/assets/lib/decorator.class.php');

echo HTML_Decorator::html_start()->render();

echo Site_Decorator::head()->set_title('UCLA CS Awards')->render();

echo HTML_Decorator::body_start()->render();

echo Site_Decorator::header()
        ->set_title('UCLA CS Awards')
        ->render();

$links = array(
   array('name' => 'Seminars',
         'link' => 'events/seminars.php'),
   array('name' => 'Faculty Candidate Talks',
         'link' => 'events/faculty_candidate_talks.php'),
   array('name' => 'Jon Postel Lecturer Series',
         'link' => 'events/jon_postel_lecturer_series.php')
);

//Create menu for about page
$menu = Site_Decorator::menu_full();
foreach ($links as $link) {
   $menu->add_item($link['name'], $link['link']);
}
echo $menu->set_padded()->set_detailed();


echo Site_Decorator::button_full()
                ->set_padded()
                ->add_option(Config::get('global', 'back_to_home_text'), Config::get('global', 'site_url'))
                ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();
