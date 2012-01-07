<?php

/**
 * 
 * @package cs
 Config::get('global', 'back_to_home_text')*
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
require_once(dirname(dirname(dirname(__FILE__))).'/assets/config.php');
require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/auxiliary/feed/feed.class.php');
require_once(dirname(dirname(dirname(__FILE__))).'/assets/lib/decorator.class.php');

echo HTML_Decorator::html_start()->render();

echo Site_Decorator::head()->set_title('UCLA CS Jon Postel Lecturer Series')->render();

echo HTML_Decorator::body_start()->render();

echo Site_Decorator::header()
        ->set_title('UCLA CS Jon Postel Lecturer Series')
        ->render();

// Show a list of seminars and list them
$menu = Site_Decorator::menu_full();
$feed = new Feed('UCLACSJonPostelLecturerSeries', 'http://www.cs.ucla.edu/events/the-jon-postel-distinguished-lecturer-series/the-jon-postel-distinguished-lecturer-series-colleciton/RSS');
$feed_items = $feed->get_items();
foreach ($feed_items as $item) {
   $title = $item->get_title();
   $menu->add_item($title, $item->get_page('seminar_item.php'));
}

echo $menu->set_padded()->set_detailed();

echo Site_Decorator::button_full()
   ->set_padded()
   ->add_option('Go back to events', Config::get('global', 'site_url').'/cs/events.php')
   ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();
