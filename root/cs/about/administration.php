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

echo Site_Decorator::head()->set_title('Administration')->render();

echo HTML_Decorator::body_start('Administration')->render();

echo Site_Decorator::header()
        ->set_title('Administration')
        ->render();

echo Site_Decorator::content_full()
            ->set_padded()
            ->add_header('Computer Science Department Faculty Administration')
            ->add_paragraph('
            Department Chairman: Professor Jens Palsberg<br/><br/>
            Vice Chair Graduate Studies: Professor Richard Korf<br/><br/>
            Vice Chair Undergraduate Studies: Professor Richard Muntz
            ')
            ->render();

echo Site_Decorator::content_full()
            ->set_padded()
            ->add_header('Computer Science Department Administrative Personnel')
            ->add_paragraph('Cassandra Franklin, Management Services Officer: is responsible for the day to day operation of the department.  She is responsible directly, or through assisting the department Chairman, for the planning, organizing, staffing, directing, and controlling of the teaching, research, administrative, and public activities of the department.  In addition, she is responsible for processing all NSF proposals, TAs appointments, and serves as a backup person for various positions in the department.<br/><br/>
            Noor Abjani, Fund Manager: is responsible for managing all contract and grant activities including monthly reconciliation and distribution of general ledgers.  She is responsible for all cost transfers, transfer of expenses, and salary transfers.  She also handles C&G student Fellowships.  She is responsible for compiling all proposals (except NSF), including budget preparation, UCLA and department forms.  She’s knowledgeable of agency and university requirements as she advises staff and faculty as needed.   She processes all cash deposits, including all gifts both monetary and non-monetary.  In the handling of these functions, the CS Fund Manager works in close cooperation with OCGA, EFM, general accounting, graduate division, undergraduate financial aid department, and gift processing.<br/><br/>
            Marty Revilla, Purchasing:  is responsible for processing all accounts payable invoices, places purchase orders, travel vouchers reimbursements, airline reservations and processes check requests.  He assists fund manager in processing monthly computing facility recharges, processes monthly telephone charges, and is responsible for PAR reports and records.  He also monitors H&I and open commitment reports, and handles errors and discrepancies as required.<br/><br/>
            Amy Sun, Academic Personnel:  is responsible for all academic personnel actions, merits, promotions, and new appointments.  Maintain and update dossier database (formerly known as SER).  Prepare upon demand reports from these data files.  Arrange visas for visiting scholar and postdoctoral scholar appointments.<br/><br/>
            Steve Arbuckle, Graduate Student Affairs Officer:  is responsible for student academic affairs and is responsible for the administration of all aspects of the graduate degree programs and processing of all relevant forms.  In addition, this office also serves as a liaison between graduate students and industry with respect to recruitment.<br/><br/>
            Open Position, Graduate Student Affairs Officer: is responsible for all aspects of the graduate admissions process. One of two graduate student affairs officers responsible for continuing graduate student issues.<br/><br/>
            Laurie Leyden, Undergraduate Students Affairs Officer:  is responsible for undergraduate students and programs in the Computer Science Dept. The Office is responsible for admissions to our two undergraduate programs, the CS and the CS&E program. She is also responsible for the administration of the various aspects of these degree programs.  In the handling of these functions, the CS Undergraduate Student Affairs Office works in close cooperation with the SEAS Student Affairs Office, headed by the Dean of Student Affairs.  She is also handling department class scheduling.<br/><br/>
            Terry Valai, Chair Assistant:is responsible for assisting Chair with meetings, committees, presentations and correspondence.  She also coordinates recruitment, Jon Postel Lecture series, and conference room reservations.<br/><br/>
            Edna Todd, Administrative Assistant:  is responsible for assisting the fourth floor faculty with class related issues, CS201 seminars, evaluations, reimbursements, travel arrangements, graduate student lockers, audio visual requests and copiers.<br/><br/>
            Osanna Kazarian, Administrative Assistant:  is responsible for assisting the third floor faculty with class related issues, assign technical report numbers, evaluations, seminars, audio visual requests and copiers. Along with processing travel vouchers, check requests, equipment reimbursements for faculty and their students.<br/><br/>')
            ->render();

echo Site_Decorator::button_full()
                ->set_padded()
                ->add_option('Go Back', Config::get('global', 'site_url').'/cs/about.php')
                ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();
