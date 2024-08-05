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

xucp_pol_head_logged("far fa-lightbulb",WANTED_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-lightbulb",WANTED_HEADER);

if(isset($_REQUEST['xucp_submit']))
{
    $file_number = strip_tags($_POST['xucp_file_number']);
    $job = strip_tags($_POST['xucp_job']);
    $msg = strip_tags($_POST['xucp_msg']);
    $person = strip_tags($_POST['xucp_person']);
    $phone_number = strip_tags($_POST['xucp_phonenumber']);
    $is_wanted = strip_tags($_POST['xucp_is_wanted']);
    $from_created = strip_tags($_POST['xucp_from_created']);
    $date_time = date("Y-m-d H:i:s");

    if(empty($file_number)){
        $errorMsg[]=WANTED_ENTRY_NOT_WORK;
    }
    else if(empty($person)){
        $errorMsg[]=WANTED_ENTRY_NOT_WORK;
    }
    else if(empty($msg)){
        $errorMsg[]=WANTED_ENTRY_NOT_WORK;
    }
    else
    {
        try
        {
            if(!isset($errorMsg))
            {
                $insert_stmt=$db->prepare("INSERT INTO 
                                                    xucp_police_wanted 
                                                    (
                                                     file_number, 
                                                     job, 
                                                     msg, 
                                                     person,
                                                     phonenumber,
                                                     is_wanted,
                                                     from_created) 
                                                VALUES
																
                                                    (
                                                     :xucp_file_number,
                                                     :xucp_job,
                                                     :xucp_msg,
                                                     :xucp_person,
                                                     :xucp_phonenumber,
                                                     :xucp_is_wanted,
                                                     :xucp_from_created)");

                if($insert_stmt->execute(array(	':xucp_file_number'	=>$file_number,
                    ':xucp_job'	=>$job,
                    ':xucp_msg'=>$msg,
                    ':xucp_person'=>$person,
                    ':xucp_phonenumber'=>$phone_number,
                    ':xucp_is_wanted'=>$is_wanted,
                    ':xucp_from_created'=>$from_created))){

                    $doneMsg=WANTED_ENTRY_WORKING;
                    $Discord = new Discord();
                    $Discord->Send(WANTED_DISCORD_NOTES);
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
										<h4 class='card-title'>".WANTED_HEADER."</h4>
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
										<h4 class='card-title'>".WANTED_HEADER."</h4>
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
                        <div class='col-xl-12'>
                            <div class='card'>
                                <div class='card-body'>
									<form action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>
										<tr>				  
											<td>
												<h6>
													".WANTED_FILE_NUMBER."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_file_number' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".WANTED_JOB."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_job' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".WANTED_PERSON."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>																													
										<tr>				  
											<td>
												<h6>
													".WANTED_PHONENUMBER."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_phonenumber' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".WANTED_MSG."
												</h6>
												<div class='input-group'>";
													xucp_pol_text_bbcode('xucp_msg', htmlspecialchars(stripslashes($_POST["xucp_msg"])));
                                                    echo "
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".WANTED_IS_WANTED."
												</h6>
												<div class='input-group'>
													<select name='xucp_is_wanted' class='form-control show-tick' required>
														<option value=''>-- ".CHANGE_MYPROFILE_LANGUAGENOTE." --</option>
														<option value='yes'>Yes</option>
														<option value='no'>No</option>
													</select>													
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".WANTED_FROM_CREATED."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_from_created' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>																														
										<tr>					  
											<td>
												<br>
												<button type='submit' name='xucp_submit' class='btn btn-primary btn-round'>
													".WANTED_ADD."
												</button>
												</submit>
											</td>							
										</tr>						
									</form>					
                                </div>
                            </div>
                        </div>
                    </div>";
xucp_pol_foot_logged();