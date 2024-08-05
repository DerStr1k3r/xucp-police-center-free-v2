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
xucp_pol_secure_assistant_chief();

xucp_pol_head_logged("fas fa-user-edit",CHIEF_USERCAHNEGED);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-user-edit",CHIEF_USERCAHNEGED);

$id = $_GET['id'];
$select_stmt = $db->prepare(query: "SELECT * FROM `xucp_police_accounts` WHERE id = ".$id);
$select_stmt->execute();
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
if($select_stmt->rowCount() > 0){
    if(isset($_REQUEST['xucp_submit']))
    {
        $user_faction_rank 	= strip_tags($_REQUEST['xucp_user_faction_rank']);

        if(empty($user_faction_rank)){
            $errorMsg[]=CHIEF_USERCONTROLQUIT_ERROR;
        }
        else
        {
            try
            {
                if(!isset($errorMsg))
                {
                    $insert_stmt=$db->prepare("UPDATE `xucp_police_accounts` SET `user_faction_rank` = :xucp_user_faction_rank WHERE `id` = ".$id);

                    if($insert_stmt->execute(array(	':xucp_user_faction_rank'	=>$user_faction_rank))){

                        $doneMsg=CHIEF_USERCONTROLQUIT_DONE;
                        header("refresh:2; /vendor/staffcp/users/index-control.php");
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
										<h4 class='card-title'>".CHIEF_USERCAHNEGED.": " .$row['charname']. "</h4>
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
										<h4 class='card-title'>".CHIEF_USERCAHNEGED.": " .$row['charname']. "</h4>
									</div>
									<div class='card-body'>
										".$doneMsg."
									</div>
								</div>
							</div>
						</div>";
    }
    echo "
              <div class='col-lg-12'>
                <div class='card'>
                    <dic class='card-header'>
                        <h4 class='card-title'>".CHIEF_USERCAHNEGED.": " . $row["charname"]. "</h4>
                    </dic>
					<div class='card-body'>
						<form class='forms-sample' name='form' method='post' action='/vendor/staffcp/users/index-change-view.php?id=".$id."'>
                            <input type='hidden' name='new' value='1' />
                            <div class='form-group'>
								<div class='form-line'>
									<label  class='col-sm-3 col-form-label'>".CHIEF_USERCONTROLQUIT."</label>
									<div class='col-sm-12'>
										<select name='xucp_user_faction_rank' class='form-control show-tick' value='" . $row["user_faction_rank"]. "'required>
												<option value=''>-- ".CHIEF_USERCONTROLQUIT_NOTE." --</option>
												<option value='0'>".CHIEF_USERCONTROLQUIT."</option>
												<option value='1'>".TLIST_POLICE_RANK_1."</option>	
												<option value='2'>".TLIST_POLICE_RANK_2."</option>	
												<option value='3'>".TLIST_POLICE_RANK_3."</option>
												<option value='4'>".TLIST_POLICE_RANK_4."</option>
												<option value='5'>".TLIST_POLICE_RANK_5."</option>	
												<option value='6'>".TLIST_POLICE_RANK_6."</option>	
												<option value='7'>".TLIST_POLICE_RANK_7."</option>
												<option value='8'>".TLIST_POLICE_RANK_8."</option>
												<option value='9'>".TLIST_POLICE_RANK_9."</option>	
												<option value='10'>".TLIST_POLICE_RANK_10."</option>	
												<option value='11'>".TLIST_POLICE_RANK_11."</option>
												<option value='12'>".TLIST_POLICE_RANK_12."</option>																																																											
										</select>									
									</div>
								</div>							
                            </div>
                            <div class='form-group'>
								<div class='form-line'>
									<label  class='col-sm-3 col-form-label'>".CHIEF_USERCONTROLOPTION."</label>
									<div class='col-sm-12'>
										<button type='submit' class='btn btn-primary w-100 waves-effect waves-light' name='xucp_submit'>".CHIEF_USERCONTROLSAVE."</button></submit>&nbsp;
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
