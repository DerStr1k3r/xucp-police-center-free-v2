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

xucp_pol_secure_commander();

if (isset($_GET["xucp_del_all_patrols"])) $xucp_del_all_patrols = trim(htmlentities($_GET["xucp_del_all_patrols"]));
elseif (isset($_POST["xucp_del_all_patrols"])) $xucp_del_all_patrols = trim(htmlentities($_POST["xucp_del_all_patrols"]));
else $xucp_del_all_patrols = "view";

xucp_pol_head_logged("fas fa-car",PDUTY_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-car",PDUTY_HEADER);

echo "
                        <div class='row align-items-center'>
                            <div class='col-md-6'>
                                <div class='mb-3'>
                                    <a href='/vendor/factioncp/patrolduty/index-add.php' class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'><i class='bx bx-plus me-1'></i> ".PDUTY_ADD."</a>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3'>
                                    <div>
                                        <form method='post' action='".$_SERVER['PHP_SELF']."?xucp_del_all_patrols=xucp_del_all' enctype='multipart/form-data'>
                                            <button type='submit' name='xucp_pduty_delete' class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'><i class='bx bx-x me-1'></i> ".PDUTY_ADD_DELETE."</submit>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>";

if ($xucp_del_all_patrols == "xucp_del_all") {
    if(isset($_POST['xucp_pduty_delete'])){
        $select_stmt = $db->prepare("DELETE FROM xucp_police_patrolduty");
        $select_stmt->execute();
        $support=$select_stmt->fetch(PDO::FETCH_ASSOC);

        if($select_stmt->rowCount() > 0){
            echo"
                        <div class='row'>
							<div class='col-xl-12'>
								<div class='card'>
									<div class='card-header'>
										<h4 class='card-title'>".PDUTY_ADD_DELETE."</h4>
									</div>
									<div class='card-body'>
										".PDUTY_ADD_DELETE_NOTES."
									</div>
								</div>
							</div>
						</div>";
        }
    }
}

echo "
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                        $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_patrolduty WHERE id LIKE ?");
                                        $select_stmt->execute(array("%$query%"));
                                        while($pduty_status = $select_stmt->fetch()) {
                                            echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    ".PDUTY_ADD_PERSONS.": ".htmlentities($pduty_status['pduty_number'], ENT_QUOTES, 'UTF-8')."
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($pduty_status['pduty_unit_1'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($pduty_status['pduty_unit_2'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <div class='btn-group' role='group'>
                                                                    <a href='/vendor/factioncp/patrolduty/index-edit.php?id=".$pduty_status['id']."' class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'><i class='uil uil-user me-1'></i> ".PDUTY_ADD_EDIT."</a>
                                                                </div>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                        }
                                        echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>";
xucp_pol_foot_logged();