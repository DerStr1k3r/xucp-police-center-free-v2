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

xucp_pol_head_logged("far fa-keyboard",DBSYNC_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-keyboard",DBSYNC_HEADER);

if(isset($_REQUEST['xucp_db_sync_submit']))
{
    $dbsync_u_id 	= 1;
    $dbsync_hostname 			= strip_tags($_REQUEST['xucp_dbsync_hostname']);
    $dbsync_port 			= strip_tags($_REQUEST['xucp_dbsync_port']);
    $dbsync_dbname  			= strip_tags($_REQUEST['xucp_dbsync_dbname']);
    $dbsync_username 			= strip_tags($_REQUEST['xucp_dbsync_username']);
    $dbsync_password 	= strip_tags($_REQUEST['xucp_dbsync_password']);

    if(empty($dbsync_hostname)){
        $errorMsg[]=DBSYNC_ENTRY_NOT_WORK;
    }
    else if(empty($dbsync_port)){
        $errorMsg[]=DBSYNC_ENTRY_NOT_WORK;
    }
    else if(empty($dbsync_dbname)){
        $errorMsg[]=DBSYNC_ENTRY_NOT_WORK;
    }
    else if(empty($dbsync_username)){
        $errorMsg[]=DBSYNC_ENTRY_NOT_WORK;
    }
    else if(empty($dbsync_password)){
        $errorMsg[]=DBSYNC_ENTRY_NOT_WORK;
    }
    else
    {
        try
        {
            if(!isset($errorMsg))
            {
                $insert_stmt=$db->prepare("
                                                UPDATE 
                                                    `xucp_police_dbsync` 
                                                SET 
                                                    `dbsync_hostname` = :xucp_dbsync_hostname, 
                                                    `dbsync_port` = :xucp_dbsync_port, 
                                                    `dbsync_dbname` = :xucp_dbsync_dbname, 
                                                    `dbsync_username` = :xucp_dbsync_username, 
                                                    `dbsync_password` = :xucp_dbsync_password 
                                                WHERE 
                                                    `id` = ".$dbsync_u_id);

                if($insert_stmt->execute(array(	':xucp_dbsync_hostname'	=>$dbsync_hostname,
                    ':xucp_dbsync_port'=>$dbsync_port,
                    ':xucp_dbsync_dbname'=>$dbsync_dbname,
                    ':xucp_dbsync_username'=>$dbsync_username,
                    ':xucp_dbsync_password'=>$dbsync_password))){

                    $doneMsg=DBSYNC_ENTRY_WORKING;
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
										<h4 class='card-title'>".DBSYNC_HEADER."</h4>
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
										<h4 class='card-title'>".DBSYNC_HEADER."</h4>
									</div>
									<div class='card-body'>
										".$doneMsg."
									</div>
								</div>
							</div>
						</div>";
}
$select_stmt = $db->prepare("SELECT id, dbsync_hostname, dbsync_port, dbsync_dbname, dbsync_username, dbsync_password from xucp_police_dbsync ORDER by id DESC LIMIT 1");
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
                                                        <label for='example-text-input' class='form-label'>".DBSYNC_HOSTNAME."</label>
														<input type='text' name='xucp_dbsync_hostname' size='32' maxlength='32' class='form-control' value='" . $conf_set["dbsync_hostname"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".DBSYNC_PORT."</label>
														<input type='text' name='xucp_dbsync_port' size='32' maxlength='32' class='form-control' value='" . $conf_set["dbsync_port"]. "' required>
                                                    </div>                                                   
                                                </div>
                                            </div>

                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".DBSYNC_DBNAME."</label>
														<input type='text' name='xucp_dbsync_dbname' size='32' maxlength='32' class='form-control' value='" . $conf_set["dbsync_dbname"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".DBSYNC_USERNAME."</label>
														<input type='text' name='xucp_dbsync_username' size='32' maxlength='32' class='form-control' value='" . $conf_set["dbsync_username"]. "' required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-12'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".DBSYNC_PASSWORD."</label>
														<input type='password' name='xucp_dbsync_password' size='32' maxlength='32' class='form-control' value='" . $conf_set["dbsync_password"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".DBSYNC_START_SYNC."</label>
														<input type='submit'  name='xucp_db_sync_submit' class='btn btn-primary w-100 waves-effect waves-light' value='".DBSYNC_START_SYNC."'>
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
