<?php
// ************************************************************************************//
// * xUCP Police Center Free
// ************************************************************************************//
// * Author: DerStr1k3r
// ************************************************************************************//
// * Version: 2.4
// *
// * Copyright (c) 2023 - 2024 DerStr1k3r. All rights reserved.
// ************************************************************************************//
// * License Typ: GNU GPLv3
// ************************************************************************************//
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
	header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
	setCookie("PHPSESSID", "", 0x7fffffff,  "/");
  	session_destroy();
	die( header( 'location: /vendor/webcp/404/index.php' ) );
}
/**
 * @return void
 */
function xucp_pol_navi_logged(): void
{
    echo "
        <div class='left-sidenav'>
            <!-- LOGO -->
            <div class='brand'>
                <a href='/vendor/usercp/dashboard/index.php' class='logo'>
                    <span>
                        <img src='/res/themes/default/assets/images/logo-sm.png' alt='logo-small' class='logo-sm'>
                    </span>
                    <span>
                        <img src='/res/themes/default/assets/images/logo.png' alt='logo-large' class='logo-lg logo-light'>
                        <img src='/res/themes/default/assets/images/logo-dark.png' alt='logo-large' class='logo-lg logo-dark'>
                    </span>
                </a>
            </div>
            <!--end logo-->
            <div class='menu-content h-100' data-simplebar>
                <ul class='metismenu left-sidenav-menu'>
                    <li class='menu-label mt-0'>".$_SESSION['xucp_police_secure']['xucp_police_conf_sname']."</li>
                    <li>
                        <a href='javascript: void(0);'> <i data-feather='home' class='align-self-center menu-icon'></i><span>".HOME_NOLOGGED."</span><span class='menu-arrow'><i class='mdi mdi-chevron-right'></i></span></a>
                        <ul class='nav-second-level' aria-expanded='false'>
                            <li class='nav-item'><a class='nav-link' href='/vendor/usercp/dashboard/index.php'><i class='ti-control-record'></i>".DASHBOARD."</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href='javascript: void(0);'><i data-feather='grid' class='align-self-center menu-icon'></i><span>Apps</span><span class='menu-arrow'><i class='mdi mdi-chevron-right'></i></span></a>
                        <ul class='nav-second-level' aria-expanded='false'>";
                        if(intval($_SESSION['xucp_police_secure']['secure_staff']) >= UC_CLASS_COMMANDER) {
                            echo "					
                            <li class='nav-item'><a class='nav-link' href='/vendor/factioncp/patrolduty/index.php'><i class='ti-control-record'></i>".PDUTY_HEADER."</a></li>";
                        }
                        if(intval($_SESSION['xucp_police_secure']['secure_staff']) >= UC_CLASS_DEPUTY_CHIEF) {
                            echo "					
                            <li class='nav-item'><a class='nav-link' href='/vendor/factioncp/trainings/index.php'><i class='ti-control-record'></i>".TRAIN_HEADER."</a></li>";
                        }
                        if(intval($_SESSION['xucp_police_secure']['secure_staff']) >= UC_CLASS_ASSISTANT_CHIEF) {
                            echo "					
                            <li class='nav-item'><a class='nav-link' href='/vendor/staffcp/logbook/index.php'><i class='ti-control-record'></i>".FACTION_LOGBOOK_HEADER."</a></li>
                            <li class='nav-item'><a class='nav-link' href='/vendor/staffcp/users/index-control.php'><i class='ti-control-record'></i>".CHIEF_USERCONTROL."</a></li>
                            <li class='nav-item'><a class='nav-link' href='/vendor/staffcp/news/index.php'><i class='ti-control-record'></i>".NEWS_HEADER." ".CHIEF_CHANGE_USER."</a></li>";
                        }
                        if(intval($_SESSION['xucp_police_secure']['secure_staff']) >= UC_CLASS_CHIEF_OF_POLICE) {
                            echo "					
                            <li class='nav-item'><a class='nav-link' href='/vendor/staffcp/paragraph/index.php'><i class='ti-control-record'></i>".PARAGRAPH_MANAGER_HEADER."</a></li>";
                        }
                        echo "
                            <li class='nav-item'><a class='nav-link' href='/vendor/factioncp/paragraph/index.php'><i class='ti-control-record'></i>".PARAGRAPH_HEADER."</a></li>";
                        if(intval($_SESSION['xucp_police_secure']['secure_staff']) >= UC_CLASS_REKRUT) {
                            echo "
                            <li class='nav-item'><a class='nav-link' href='/vendor/factioncp/act/index.php'><i class='ti-control-record'></i>".CASES_HEADER."</a></li>
                            <li class='nav-item'><a class='nav-link' href='/vendor/factioncp/rodtrafficoffice/index.php'><i class='ti-control-record'></i>".ROAD_TRAFFIC_OFFICE_HEADER."</a></li>
                            <li class='nav-item'><a class='nav-link' href='/vendor/factioncp/resident/index.php'><i class='ti-control-record'></i>".RESIDENT_DATABASE_HEADER."</a></li>
                            <li class='nav-item'><a class='nav-link' href='/vendor/factioncp/wanted/index.php'><i class='ti-control-record'></i>".WANTED_HEADER."</a></li>";
                        }
                        if(intval($_SESSION['xucp_police_secure']['secure_staff']) >= UC_CLASS_DEPUTY_CHIEF) {
                            echo "					
                            <li class='nav-item'><a class='nav-link' href='/vendor/factioncp/fmembers/index.php'><i class='ti-control-record'></i>".TLIST_LEFT_NAVI_HEADER."</a></li>";
                        }
                        echo "
                        </ul>
                    </li>
                    <li>
                        <a href='javascript: void(0);'><i data-feather='user' class='align-self-center menu-icon'></i><span>".USERACCOUNT."</span><span class='menu-arrow'><i class='mdi mdi-progress-wrench'></i></span></a>
                        <ul class='nav-second-level' aria-expanded='false'>
                            <li class='nav-item'><a class='nav-link' href='/vendor/usercp/profile/index.php'><i class='ti-control-record'></i>".USERPROFILECHANGE."</a></li>							
                        </ul>
                    </li>";
                if(intval($_SESSION['xucp_police_secure']['secure_staff']) >= UC_CLASS_WEBMASTER) {
                    echo "					
                    <li>
                        <a href='javascript: void(0);'><i data-feather='sliders' class='align-self-center menu-icon'></i><span>".TLIST_WEBMASTER."</span><span class='menu-arrow'><i class='mdi mdi-shield-check-outline'></i></span></a>
                        <ul class='nav-second-level' aria-expanded='false'>
                            <li class='nav-item'><a class='nav-link' href='/vendor/devcp/siteconfig/index.php'><i class='ti-control-record'></i>".SITECONFIG_HEADER."</a></li>
							<li class='nav-item'><a class='nav-link' href='/vendor/devcp/dbsync/index.php'><i class='ti-control-record'></i>".DBSYNC_HEADER."</a></li>
							<li class='nav-item'><a class='nav-link' href='/vendor/devcp/custom/icons/index.php'><i class='ti-control-record'></i>".CUSTOMS_HEADER_ICONS."</a></li>
                        </ul>
                    </li>";
                }
            if(intval($_SESSION['xucp_police_secure']['xucp_police_conf_upgrade_note']) == 1) {
                    echo "          
                </ul>
    
                <div class='update-msg text-center'>
                    <h5 class='mt-3'>Unlimited Access installed</h5>
                    <p class='mb-3'>You can switch off this message in the site settings!</p>
                    <a href='https://discord.gg/xg5mnYUWch' class='btn btn-outline-warning btn-sm'>Support Discord</a>
                </div>";
            } else {
                // Remember that you can turn off this message!
            }
            echo "
            </div>
        </div>";
}