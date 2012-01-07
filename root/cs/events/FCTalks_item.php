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

require_once(dirname(dirname(dirname(__FILE__))).'/assets/config.php');
require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/auxiliary/feed/feed.class.php');
require_once(dirname(dirname(dirname(__FILE__))).'/assets/lib/decorator.class.php');
require_once(dirname(dirname(__FILE__)).'/utils.php');

echo HTML_Decorator::html_start()->render();

echo Site_Decorator::head()->set_title('UCLA CS Faculty Candidate Talks')->render();

echo HTML_Decorator::body_start()->render();

echo Site_Decorator::header()
        ->set_title('UCLA CS Faculty Candidate Talks')
        ->render();

$salt = 'skljflajiofejlksdfjlakfj';
//uses the set GET param to construct a feed and a feed item object.
$feed = Feed::build_page_from_request();
$feed_item = $feed->build_item_from_request();
//validate page
if(isset($_GET["signature"]) && !$feed_item->verify_page($_GET['signature'], $salt))
{
    die();
}
// ini_set('display_errors', 'On');
if ($feed_item->get_description() == '') {
   $div = '<div class="" id="parent-fieldname-text">';
   $desc = $feed_item->get_page_by_url($div);
   $feed_item->set_description($desc);
}

echo Site_Decorator::content_full()
   ->set_padded()
   ->add_header('When And Where')
   ->add_paragraph($feed_item->getTime())
   ->add_paragraph($feed_item->getLocation())
   ->render();

echo Site_Decorator::content_full()
   ->set_padded()
   ->add_header($feed_item->get_title())
   ->add_paragraph(Utils::htmlallentities(urldecode($feed_item->get_description())))
   ->render();



// echo Site_Decorator::button_full()
//    ->set_padded()
//    ->add_option('Go back to seminars', Config::get('global', 'site_url').'/cs/events/seminars.php')
//    ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();
