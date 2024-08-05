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

xucp_pol_secure_webmaster();

xucp_pol_head_logged("far fa-keyboard",SITECONFIG_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-keyboard",SITECONFIG_HEADER);

if(isset($_REQUEST['xucp_submit']))
{
    $xucp_pol_config_uid 	= 1;
    $xucp_pol_online 			= strip_tags($_REQUEST['xucp_police_xucp_pol_online']);
    $xucp_pol_name 			= strip_tags($_REQUEST['xucp_police_xucp_pol_name']);
    $xucp_pol_lang  			= strip_tags($_REQUEST['xucp_police_xucp_pol_lang']);
    $xucp_pol_themes 			= strip_tags($_REQUEST['xucp_police_xucp_pol_themes']);
    $xucp_pol_upgrade_note 	= strip_tags($_REQUEST['xucp_police_xucp_pol_upgrade_note']);

    if(empty($xucp_pol_online)){
        $errorMsg[]=SITECONFIG_ERROR;
    }
    else if(empty($xucp_pol_name)){
        $errorMsg[]=SITECONFIG_ERROR;
    }
    else if(empty($xucp_pol_themes)){
        $errorMsg[]=SITECONFIG_ERROR;
    }
    else
    {
        try
        {
            if(!isset($errorMsg))
            {
                $insert_stmt=$db->prepare("
                                                UPDATE 
                                                    `xucp_police_config` 
                                                SET 
                                                    `xucp_pol_online` = :xucp_police_xucp_pol_online, 
                                                    `xucp_pol_name` = :xucp_police_xucp_pol_name, 
                                                    `xucp_pol_lang` = :xucp_police_xucp_pol_lang, 
                                                    `xucp_pol_themes` = :xucp_police_xucp_pol_themes, 
                                                    `xucp_pol_upgrade_note` = :xucp_police_xucp_pol_upgrade_note 
                                                WHERE 
                                                    `id` = ".$xucp_pol_config_uid);

                if($insert_stmt->execute(array(	':xucp_police_xucp_pol_online'	=>$xucp_pol_online,
                    ':xucp_police_xucp_pol_name'=>$xucp_pol_name,
                    ':xucp_police_xucp_pol_lang'=>$xucp_pol_lang,
                    ':xucp_police_xucp_pol_themes'=>$xucp_pol_themes,
                    ':xucp_police_xucp_pol_upgrade_note'=>$xucp_pol_upgrade_note))){

                    $doneMsg=SITECONFIG_DONE;
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
										<h4 class='card-title'>".SITECONFIG_HEADER."</h4>
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
										<h4 class='card-title'>".SITECONFIG_HEADER."</h4>
									</div>
									<div class='card-body'>
										".$doneMsg."
									</div>
								</div>
							</div>
						</div>";
}
$select_stmt = $db->prepare("SELECT id, xucp_pol_online, xucp_pol_name, xucp_pol_themes, xucp_pol_lang, xucp_pol_upgrade_note from xucp_police_config ORDER by id DESC LIMIT 1");
$select_stmt->execute();
$conf_set=$select_stmt->fetch(PDO::FETCH_ASSOC);
if($select_stmt->rowCount() > 0){
    echo "
                        <div class='row'>
                            <div class='col-12'>
                                <div class='card'>
                                    <div class='card-body p-4'>
										<form class='form-horizontal' method='post' action='".$_SERVER['PHP_SELF']."' enctype='multipart/form-data'>
                                        <div class='row'>
                                            <div class='col-lg-6'>
                                                <div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".SITECONFIG_ONLINE."</label>
														<select name='xucp_police_xucp_pol_online' class='form-control show-tick' required>
															<option value=''>-- ".SITECONFIG_ONLINE_INFO." --</option>
															<option value='1'>".SITECONFIG_ONLINE_ONLINE."</option>
															<option value='0'>".SITECONFIG_ONLINE_OFFLINE."</option>											
														</select>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".SITECONFIG_THEMES."</label>
														<select name='xucp_police_xucp_pol_themes' class='form-control show-tick' required>
															<option value=''>-- ".SITECONFIG_THEMES_INFO." --</option>
															<option value='dark-sidenav'>".SITECONFIG_THEMES_BLACK."</option>
															<option value='light-sidenav'>".SITECONFIG_THEMES_BLUE."</option>											
														</select>
                                                    </div>                                                   
                                                </div>
                                            </div>

                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".SITECONFIG_NAME."</label>
														<input type='text' name='xucp_police_xucp_pol_name' size='12' maxlength='12' class='form-control' placeholder='".SITECONFIG_NAME."' value='" . $conf_set["xucp_pol_name"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".SITECONFIG_LANG."</label>
														<select name='xucp_police_xucp_pol_lang' class='form-control show-tick' required>
															<option value=''>-- ".CHANGE_MYPROFILE_LANGUAGENOTE." --</option>
															<option value='en'>".CHANGE_MYPROFILE_LANGUAGE_SELECT_EN."</option>
															<option value='de'>".CHANGE_MYPROFILE_LANGUAGE_SELECT_DE."</option>
														</select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-12'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".SITECONFIG_UPGRADE_NOTE."</label>
														<select name='xucp_police_xucp_pol_upgrade_note' class='form-control show-tick' required>
															<option value=''>-- ".SITECONFIG_UPGRADE_NOTE_INFO." --</option>
															<option value='1'>".SITECONFIG_CLIENT_YES."</option>
															<option value='0'>".SITECONFIG_CLIENT_NO."</option>												
														</select>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".SITECONFIG_SAVE."</label>
														<input type='submit'  name='xucp_submit' class='btn btn-primary w-100 waves-effect waves-light' value='".STAFF_USERCONTROLSAVE."'>
                                                    </div>
                                                </div>
                                            </div>											
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>
                        </div>";
}
xucp_pol_foot_logged();
