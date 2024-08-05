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
include(dirname(__FILE__) . "/../../../app/system.php");

xucp_pol_secure();
secure_url();

xucp_pol_head_logged("fas fa-home",DASHBOARD);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-home",DASHBOARD);

$select_stmt = $db->prepare("SELECT * FROM xucp_police_accounts WHERE `id` = ".$_SESSION['xucp_police_secure']['secure_first']);
$select_stmt->execute();
$wl_status=$select_stmt->fetch(PDO::FETCH_ASSOC);

if($select_stmt->rowCount() > 0){
    $select_stmt = $db->prepare("SELECT id, date_time FROM xucp_police_wanted ORDER by id DESC LIMIT 1");
    $select_stmt->execute();
    $row_wanted=$select_stmt->fetch(PDO::FETCH_ASSOC);

    if($select_stmt->rowCount() > 0){
        echo "
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='row'>
                                <div class='col-md-8 col-lg-4'>
                                    <div class='card report-card'>
                                        <div class='card-body'>
                                            <div class='row d-flex justify-content-center'>
                                                <div class='col'>
                                                    <p class='text-dark mb-0 fw-semibold'>".DASHBOARDWANTED."</p>
                                                    <h3 class='m-0'>".htmlentities($row_wanted['id'], ENT_QUOTES, 'UTF-8')."</h3>
                                                </div>
                                                <div class='col-auto align-self-center'>
                                                    <div class='report-main-icon bg-light-alt'>
                                                        <i data-feather='slack' class='align-self-center text-muted icon-sm'></i>  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='progress' style='height: 3px'>
											    <div class='progress-bar bg-dash-color-1' role='progressbar' style='width: ".htmlentities($row_wanted['id'], ENT_QUOTES, 'UTF-8')."%' aria-valuenow='".htmlentities($max_users_status['charId'], ENT_QUOTES, 'UTF-8')."' aria-valuemin='0' aria-valuemax='10000'></div>
										    </div>
                                            <hr class='hr-dashed'>
											<div class='text-center'>
                                                ".DASHBOARD_LAST_ENTRY."
                                                <h6 class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'>
                                                    <i data-feather='calendar' class='align-self-center icon-xs me-1'></i>
                                                    ".htmlentities($row_wanted['date_time'], ENT_QUOTES, 'UTF-8')."
                                                </h6>
                                            </div>         
                                        </div> 
                                    </div> 
                                </div>";
    }

    $select_stmt = $db->prepare("SELECT id, date_time FROM xucp_police_patrolduty ORDER by id DESC LIMIT 1");
    $select_stmt->execute();
    $row_pduty=$select_stmt->fetch(PDO::FETCH_ASSOC);

    if($select_stmt->rowCount() > 0){
        echo "
                                <div class='col-md-8 col-lg-4'>
                                    <div class='card report-card'>
                                        <div class='card-body'>
                                            <div class='row d-flex justify-content-center'>
                                                <div class='col'>
                                                    <p class='text-dark mb-0 fw-semibold'>".DASHBOARD_PDUTY_HEADER."</p>
                                                    <h3 class='m-0'>".htmlentities($row_pduty['id'], ENT_QUOTES, 'UTF-8')."</h3>
                                                </div>
                                                <div class='col-auto align-self-center'>
                                                    <div class='report-main-icon bg-light-alt'>
                                                        <i data-feather='sunrise' class='align-self-center text-muted icon-sm'></i>  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='progress' style='height: 3px'>
											    <div class='progress-bar bg-dash-color-1' role='progressbar' style='width: ".htmlentities($row_pduty['id'], ENT_QUOTES, 'UTF-8')."%' aria-valuenow='".htmlentities($max_users_status['charId'], ENT_QUOTES, 'UTF-8')."' aria-valuemin='0' aria-valuemax='10000'></div>
										    </div>                                            
                                            <hr class='hr-dashed'>
											<div class='text-center'>
                                                ".DASHBOARD_LAST_ENTRY."
                                                <h6 class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'>
                                                    <i data-feather='calendar' class='align-self-center icon-xs me-1'></i>
                                                    ".htmlentities($row_pduty['date_time'], ENT_QUOTES, 'UTF-8')."
                                                </h6>
                                            </div>         
                                        </div> 
                                    </div> 
                                </div>";
    }

    $select_stmt = $db->prepare("SELECT id, date_time FROM xucp_police_act ORDER by id DESC LIMIT 1");
    $select_stmt->execute();
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

    if($select_stmt->rowCount() > 0){
        echo "
                                <div class='col-md-8 col-lg-4'>
                                    <div class='card report-card'>
                                        <div class='card-body'>
                                            <div class='row d-flex justify-content-center'>
                                                <div class='col'>
                                                    <p class='text-dark mb-0 fw-semibold'>".DASHBOARDCRIMINALRECORDS."</p>
                                                    <h3 class='m-0'>".htmlentities($row['id'], ENT_QUOTES, 'UTF-8')."</h3>
                                                </div>
                                                <div class='col-auto align-self-center'>
                                                    <div class='report-main-icon bg-light-alt'>
                                                        <i data-feather='sunset' class='align-self-center text-muted icon-sm'></i>  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='progress' style='height: 3px'>
											    <div class='progress-bar bg-dash-color-1' role='progressbar' style='width: ".htmlentities($row['id'], ENT_QUOTES, 'UTF-8')."%' aria-valuenow='".htmlentities($max_users_status['charId'], ENT_QUOTES, 'UTF-8')."' aria-valuemin='0' aria-valuemax='10000'></div>
										    </div>                                            
                                            <hr class='hr-dashed'>
											<div class='text-center'>
                                                ".DASHBOARD_LAST_ENTRY."
                                                <h6 class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'>
                                                    <i data-feather='calendar' class='align-self-center icon-xs me-1'></i>
                                                    ".htmlentities($row['date_time'], ENT_QUOTES, 'UTF-8')."
                                                </h6>
                                            </div>         
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </div>                       
                    </div>";
    }
}

$select_stmt = $db->prepare("SELECT * FROM xucp_police_news");
$select_stmt->execute();
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

echo "
                    <div class='row'>
                        <div class='col-xl-12'>
                            <div class='card'>
                                <div class='card-header'>
                                    <h4 class='card-title'>".NEWS."</h4>";

if($select_stmt->rowCount() > 0){
    $title_field = "title";
    $content_field = "content";
    if(isset($_SESSION['xucp_police_secure']['secure_lang']) && $_SESSION['xucp_police_secure']['secure_lang'] == 'de'){
        $title_field = "title_de";
        $content_field = "content_de";
    }
    $id = $row['id'];
    $title = $row[$title_field];
    $content = $row[$content_field];
    $short_content = substr($content, 0, 600);

    echo "

                                    <p class='card-title-desc'>".$title."</p>
                                </div>
                                <div class='card-body'>
									".xucp_format_comments($short_content)."
                                </div>";
}
echo "
                            </div>
                        </div>
                    </div>";
xucp_pol_foot_logged();	
