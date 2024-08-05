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

xucp_pol_head_logged("fas fa-car",PDUTY_ADD_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-car",PDUTY_ADD_HEADER);

if(isset($_REQUEST['xucp_submit']))
{
    $pduty_number = strip_tags($_POST['xucp_pduty_number']);
    $pduty_unit_1 = strip_tags($_POST['xucp_pduty_unit_1']);
    $pduty_unit_2 = strip_tags($_POST['xucp_pduty_unit_2']);

    if(empty($pduty_number)){
        $errorMsg[]=PDUTY_ADD_ERROR;
    }
    else if(empty($pduty_unit_1)){
        $errorMsg[]=PDUTY_ADD_ERROR;
    }
    else if(empty($pduty_unit_2)){
        $errorMsg[]=PDUTY_ADD_ERROR;
    }
    else
    {
        try
        {
            if(!isset($errorMsg))
            {
                $insert_stmt=$db->prepare("INSERT INTO 
                                                    xucp_police_patrolduty 
                                                    (
                                                     pduty_number, 
                                                     pduty_unit_1, 
                                                     pduty_unit_2) 
                                                VALUES		
                                                    (
                                                     :xucp_pduty_number,
                                                     :xucp_pduty_unit_1,
                                                     :xucp_pduty_unit_2)");

                if($insert_stmt->execute(array(	':xucp_pduty_number'	=>$pduty_number,
                    ':xucp_pduty_unit_1'	=>$pduty_unit_1,
                    ':xucp_pduty_unit_2'=>$pduty_unit_2))){

                    $doneMsg=PDUTY_ADD_DONE;
                    $Discord = new Discord();
                    $Discord->Send(PDUTY_ADD_DISCORD_NOTES);
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

if(isset($errorMsg))
{
    foreach($errorMsg as $error)
    {
        echo"
                        <div class='row'>
							<div class='col-xl-12'>
								<div class='card'>
									<div class='card-header'>
										<h4 class='card-title'>".PDUTY_ADD_HEADER."</h4>
									</div>
									<div class='card-body'>
										".$error."
									</div>
								</div>
							</div>
						</div>";
    }
}
if(isset($doneMsg))
{
    echo"
                        <div class='row'>
							<div class='col-xl-12'>
								<div class='card'>
									<div class='card-header'>
										<h4 class='card-title'>".PDUTY_ADD_HEADER."</h4>
									</div>
									<div class='card-body'>
										".$doneMsg."
									</div>
								</div>
							</div>
						</div>";
}

echo "
                        <div class='row'>
                            <div class='col-12'>
                                <div class='card'>
                                    <div class='card-body p-4'>
										<form action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>
                                        <div class='row'>
                                            <div class='col-lg-12'>
                                                <div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".PDUTY_ADD_PERSONS."</label>
														<input class='form-control' type='text' name='xucp_pduty_number' id='example-text-input'>
                                                    </div>                                                  
                                                </div>
                                            </div>

                                            <div class='col-lg-12'>
                                                <div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".PDUTY_ADD_PERSONS_UNIT_1."</label>
                                                        <select name='xucp_pduty_unit_1' class='form-control show-tick' required>
															<option value=''>-- ".CHANGE_MYPROFILE_LANGUAGENOTE." --</option>";
                                                    $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE id LIKE ?");
                                                    $select_stmt->execute(array("%$query%"));
                                                    while($pduty_status = $select_stmt->fetch()) {
                                                        echo "

															<option value='".htmlentities($pduty_status['charname'], ENT_QUOTES, 'UTF-8')."'>".htmlentities($pduty_status['charname'], ENT_QUOTES, 'UTF-8')."</option>";
                                                    }
                                                    echo "
														</select> 
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".PDUTY_ADD_PERSONS_UNIT_2."</label>
                                                        <select name='xucp_pduty_unit_2' class='form-control show-tick' required>
                                                            <option value=''>-- ".CHANGE_MYPROFILE_LANGUAGENOTE." --</option>";
                                                    $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE id LIKE ?");
                                                    $select_stmt->execute(array("%$query%"));
                                                    while($pduty_status = $select_stmt->fetch()) {
                                                        echo "

                                                            <option value='".htmlentities($pduty_status['charname'], ENT_QUOTES, 'UTF-8')."'>".htmlentities($pduty_status['charname'], ENT_QUOTES, 'UTF-8')."</option>";
                                                    }
                                                    echo "
														</select>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class='col-lg-12'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
														<button type='submit' name='xucp_submit' class='btn btn-primary w-100 waves-effect waves-light'>
															".PDUTY_ADD_SAVE."
														</button>
                                                    </div>
                                                </div>
                                            </div>											
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>
                        </div>";
xucp_pol_foot_logged();