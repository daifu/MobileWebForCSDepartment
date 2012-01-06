<?php

/**
 * 
 * @package mwf
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
require_once(dirname(dirname(dirname(__FILE__))).'/assets/lib/decorator.class.php');

echo HTML_Decorator::html_start()->render();

echo Site_Decorator::head()->set_title('Mission Statement')->render();

echo HTML_Decorator::body_start('Mission Statement')->render();

echo Site_Decorator::header()
        ->set_title('Mission Statement')
        ->render();

echo Site_Decorator::content_full()
            ->set_padded()
            ->add_paragraph('The Computer Science Department strives for excellence in creating, applying, and imparting knowledge in computer science and engineering through comprehensive educational programs, research in collaboration with industry and government, dissemination through scholarly publications, and service to professional societies, the community, the state, and the nation.')
            ->render();

$list = "<ul style='padding-left:15px;'><li>For CS&#45;make valuable contributions to design, development, and production in the practice of computer science and related engineering or application areas, particularly in software systems and algorithmic methods. For CS&amp;E&#45;make valuable contributions to design, development and production in the practice of computer science and computer engineering in related engineering areas or application areas, and at the interface of computers and physical systems.</li>
            <li>Demonstrate strong communication skills and the ability to function effectively as part of a team.</li>
            <li>Demonstrate a sense of societal and ethical responsibility in all professional endeavors.</li>
            <li>Engage in professional development or post-graduate education to pursue flexible career paths amid future technological changes.</li></ul>";

echo Site_Decorator::content_full()
            ->set_padded()
            ->add_header('CS and CS&amp;E Educational Objectives')
            ->add_paragraph('The Department offers a bachelor of science degree in both computer science (CS) and computer science and engineering (CS&amp;E).  The key difference between the CS and CS&amp;E degrees is that the latter is designed to accommodate those students who desire a strong foundation in computer science, but who also have a strong interest in computer system hardware.  Both majors are approved by the Accreditation Board for Engineering and Technology (ABET). Educational objectives are as follows:')
            ->add_section($list)
            ->render();

echo Site_Decorator::button_full()
                ->set_padded()
                ->add_option('Go Back', Config::get('global', 'site_url').'/cs/about.php')
                ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();
