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

echo Site_Decorator::content_full()
   ->set_padded()
   ->add_header('Awards')
   ->add_paragraph('IEEE Intelligent Systems, a top-ranked AI publication, has included a special section in its July/August 2011 issue which will feature ten inaugural AI Hall of Fame winners. Based on his seminal contributions to AI, Professor Judea Pearl has been selected as one of those ten AI pioneers. This recognition is also a celebration of AI as a community and an inspiration for future AI researchers.')
   ->add_paragraph('CS Department students Jong Hoon Ahnn, Uichin Lee and Hyun Jin Moon have received the CCGrid 2011 Best Paper Award for "GeoServ: A Distributed Urban Sensing Platform." When making this award, the selection committee considered innovation, potential impact, and overall presentation. Ahnn, Lee and Moon are working together on the GeoServ project as part of Professor Mario Gerla\'s CS218 class.')
   ->add_paragraph('Professor Jason Cong and his former Ph.D. student Dr. Eugene Ding (now with Xilinx) received this year\'s ACM/IEEE A. Richard Newton Technical Impact Award in Electronic Design Automation at the opening session of the 48th Design Automation Conference. The award was given for "pioneering work on technology mapping for FPGA that has made a significant impact on the FPGA research community and industry," as evidenced by a paper published at least ten years prior to the award. Prof. Cong and Dr. Ding are honored for their paper "FlowMap: An Optimal Technology Mapping Algorithm for Delay Optimization in Lookup-Table Based FPGA Designs" (IEEE Transactions on Computer-Aided Design, vol 13, no. 1, pp. 1-12, January 1994).')
   ->add_paragraph('Todd Millstein and Rupak Majumdar have received the ACM SIGPLAN Most Influential PLDI (Programming Language Design and Implementation) Paper Award for 2011. The award is given each year for a paper that is ten years old and has been highly influential in the area of programming languages. Their 2001 paper, "Automatic Predicate Abstraction of C Programs," was coauthored with Thomas Ball and Sriram Rajamani from Microsoft Research.')
   ->add_paragraph('<b>Student Awards:</b><br>Vladimir Braverman: Google Outstanding Graduate Student Research Award (advisor Rafail Ostrovsky)<br>Dan He: Northrup-Grumman Outstanding Graduate Student Research Award (advisor Eleazar Eskin)<br>Navid Amini: Symantec Outstanding Graduate Student Research Award (advisor Majid Sarrafzadeh)<br>Bin Liu: Cisco Outstanding Graduate Student Research Award (advisor Jason Cong)<br>Manu Jose: Outstanding Masters Graduate (advisor Rupak Majumdar)<br>Vladimir Braverman: Outstanding Ph.D. Graduate (advisor Rafail Ostrovksy)<br>')
   ->add_paragraph('A team from UCLA and UIUC has won a Best Paper Award for the collaborative Multilevel Granularity Parallelism Synthesis on FPGAs. The paper, authored by A. Papakonstantinou, Y. Liang, J. Stratton, K. Gururaj, D. Chen, W. M. Hwu, and J. Cong, was selected out of 120 submissions to the 2011 IEEE International Symposium on Field-Programmable Custom Computing Machines.<br><br>
This work (code-named FCUDA-II) offers an advanced modeling and search engine in the multi-granularity parallelism design space to map CUDA kernels to FPGAs. It combines resource/period/latency modeling with a theoretically optimal yet efficient search algorithm to identify the best combination of various parallelism/design parameters in a short period of time. It offers up to 7x speedup in terms of performance compared to the original FCUDA work (which received the Best Paper Award at SASP 2009). The collaboration between researchers from UCLA and UIUC has been very successful.<br><br>
Link to paper: http://www.icims.csl.uiuc.edu/~dchen/research/FCUDA-II-FCCM11.pdf<br>')
   ->add_paragraph('UCLA\'s CSD research team members Guojie Luo, Bingjun Xiao and Professor Jason Cong, and Purdue\'s Kalliopi Tsota have won second place in the routability-driven placement contest held during the 2011 International Symposium on Physical Design (ISPD). Their second-place win was for the development of the placement algorithm "mPL11."')
   ->add_paragraph('First-year Ph.D. student Beayna Grigorian (advisor Glenn Reinman) has been selected to receive a 2011 NSF Graduate Research Fellowship Program (GRFP) Fellowship. The selection was based on Beayna\'s outstanding abilities and accomplishments, as well as her potential to contribute to strengthening the vitality of the US science and engineering enterprise.')
   ->add_paragraph('Our congratulations to Professor Jennifer Wortman Vaughan. Jennifer is the recipient of a 2010 CAREER Award from the National Science Foundation for her research on Learning- and Incentives-Based Techniques for Aggregating Community-Generated Data.<br><br>
   The CAREER Award is NSF\'s most prestigious award in support of junior faculty who exemplify the role of teacher-scholar through outstanding research, excellent education and the integration of education and research within the context of the mission of their organizations.<br>')
   ->add_paragraph('Graduate student Donnie Kim (advisor, Deborah Estrin) is one of 27 students selected by Intel to receive its Ph.D. Fellowship Award for 2010. This prestigious award recognizes Fellowship recipients as being tops in their areas of research.<br><br>Intel participates in a wide array of education-related programs whose goals are to improve the quality of education and train students to be future technology leaders. Intel\'s Ph.D. Fellowship program focuses on research in Intel\'s technical areas: hardware systems technology and design, software technology and design and semiconductor technology and manufacturing.<br><br>You can read more about this here.<br>')
   ->render();

echo Site_Decorator::button_full()
                ->set_padded()
                ->add_option(Config::get('global', 'back_to_home_text'), Config::get('global', 'site_url'))
                ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();
