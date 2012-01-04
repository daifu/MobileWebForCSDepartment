<?php

/**
 * 
 * @package mwf
 *
 * @author ebollens
 * @copyright Copyright (c) 2010-11 UC Regents
 * @license http://mwf.ucla.edu/license
 * @version 20110519
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

echo Site_Decorator::head()->set_title('Chair\'s Welcome')->render();

echo HTML_Decorator::body_start('Chair\'s Welcome')->render();

echo Site_Decorator::header()
        ->set_title('Chair\'s Welcome')
        ->render();

echo Site_Decorator::content_full()
            ->set_padded()
            ->add_paragraph('Our department provides one of the finest centers in the world for graduate and undergraduate education in computer science through its offering of Ph.D. and M.S. degrees, as well as two B.S. degrees, namely computer science and computer science & engineering. Typically, we have 900 students enrolled.')
            ->add_paragraph('Established in 1968, the department also provides one of the strongest centers for computer science research, covering such diverse areas as artificial intelligence, architecture, computational biology, information and data management, networks, software systems, theory, and vision and graphics. It is also host to multidisciplinary research centers on autonomous intelligent networks and systems, domain-specific computing, embedded networked sensing, information security, and wireless health.')
            ->add_paragraph('The achievements and accomplishments of our faculty have been widely acknowledged through high-profile awards and recognitions, including National Academy of Engineering memberships, ACM, IEEE, AAAI, and Sloan fellowships, and frequent, high-profile teaching awards.')
            ->add_paragraph('As I welcome you to our department, I emphasize our commitment to the highest levels of excellence in both teaching and research, and our unyielding mission to further the reach of computer science and engineering as it continues to impact our world in positive and profound ways.')
            ->add_paragraph('Jens Palsberg')
            ->add_paragraph('Professor and Chair, UCLA Computer Science Department')
            ->add_paragraph('University of California, Los Angeles')
            ->render();


echo Site_Decorator::button_full()
                ->set_padded()
                ->add_option(Config::get('global', 'back_to_home_text'), Config::get('global', 'site_url'))
                ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();
