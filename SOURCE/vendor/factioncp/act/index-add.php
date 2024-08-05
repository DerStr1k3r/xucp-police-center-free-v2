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

xucp_pol_head_logged("far fa-list-alt",CASES_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-list-alt",CASES_HEADER);

if(isset($_REQUEST['xucp_submit']))
{
    $act_file_number = strip_tags($_POST['xucp_file_number']);
    $person_job = strip_tags($_POST['xucp_person_job']);
    $person_name = strip_tags($_POST['xucp_person_name']);
    $person_phone_number = strip_tags($_POST['xucp_person_phone_number']);
    $person_gender = strip_tags($_POST['xucp_person_gender']);
    $person_birthday = strip_tags($_POST['xucp_person_birthday']);
    $person_size = strip_tags($_POST['xucp_person_size']);
    $person_eye_color = strip_tags($_POST['xucp_person_eye_color']);
    $person_hair_color = strip_tags($_POST['xucp_person_hair_color']);
    $person_motorcycle_license = strip_tags($_POST['xucp_person_motorcycle_license']);
    $person_car_license = strip_tags($_POST['xucp_person_car_license']);
    $person_truck_license = strip_tags($_POST['xucp_person_truck_license']);
    $person_gun_license = strip_tags($_POST['xucp_person_gun_license']);
    $veh_plate = strip_tags($_POST['xucp_veh_plate']);
    $veh_name = strip_tags($_POST['xucp_veh_name']);
    $veh_all_vehicles = strip_tags($_POST['xucp_veh_all_vehicles']);
    $act_testify = strip_tags($_POST['xucp_act_testify']);
    $act_msg = strip_tags($_POST['xucp_act_msg']);
    $act_is_finished = strip_tags($_POST['xucp_act_is_finished']);
    $act_others = strip_tags($_POST['xucp_act_others']);
    $act_from_created = strip_tags($_POST['xucp_act_from_created']);

    if(empty($act_file_number)){
        $errorMsg[]=ACT_ENTRY_NOT_WORK;
    }
    else if(empty($person_name)){
        $errorMsg[]=ACT_ENTRY_NOT_WORK;
    }
    else if(empty($person_gender)){
        $errorMsg[]=ACT_ENTRY_NOT_WORK;
    }
    else
    {
        try
        {
            if(!isset($errorMsg))
            {
                $insert_stmt=$db->prepare("INSERT INTO 
                                                    `xucp_police_act` 
                                                    (
                                                     act_file_number, 
                                                     person_job, 
                                                     act_msg, 
                                                     person_name,
                                                     person_phonenumber,
                                                     person_gender,
                                                     person_birthday,
                                                     person_size,
                                                     person_eye_color,
                                                     person_hair_color,
                                                     person_motorcycle_license,
                                                     person_car_license,
                                                     person_truck_license,
                                                     person_gun_license,
                                                     veh_plate,
                                                     veh_name,
                                                     veh_all_vehicles,
                                                     act_testify,
                                                     act_is_finished,
                                                     act_others,
                                                     act_from_created) 
                                                VALUES
																
                                                    (
                                                     :xucp_file_number,
                                                     :xucp_person_job,
                                                     :xucp_person_name,
                                                     :xucp_person_phone_number,
                                                     :xucp_person_gender,
                                                     :xucp_person_birthday,
                                                     :xucp_person_eye_color,
                                                     :xucp_person_hair_color,
                                                     :xucp_person_motorcycle_license,
                                                     :xucp_person_car_license,
                                                     :xucp_person_truck_license,
                                                     :xucp_person_gun_license,
                                                     :xucp_veh_plate,
                                                     :xucp_veh_name,
                                                     :xucp_veh_all_vehicles,
                                                     :xucp_act_testify,
                                                     :xucp_act_msg,
                                                     :xucp_act_is_finished,
                                                     :xucp_act_others,
                                                     :xucp_person_size,
                                                     :xucp_act_from_created)");

                if($insert_stmt->execute(array(
                    ':xucp_file_number'	=>$act_file_number,
                    ':xucp_person_job'	=>$person_job,
                    ':xucp_person_name'=>$person_name,
                    ':xucp_person_phone_number'=>$person_phone_number,
                    ':xucp_person_gender'=>$person_gender,
                    ':xucp_person_birthday'=>$person_birthday,
                    ':xucp_person_eye_color'=>$person_eye_color,
                    ':xucp_person_hair_color'=>$person_hair_color,
                    ':xucp_person_motorcycle_license'=>$person_motorcycle_license,
                    ':xucp_person_car_license'=>$person_car_license,
                    ':xucp_person_truck_license'=>$person_truck_license,
                    ':xucp_person_gun_license'=>$person_gun_license,
                    ':xucp_veh_plate'=>$veh_plate,
                    ':xucp_veh_name'=>$veh_name,
                    ':xucp_veh_all_vehicles'=>$veh_all_vehicles,
                    ':xucp_act_testify'=>$act_testify,
                    ':xucp_act_msg'=>$act_msg,
                    ':xucp_act_is_finished'=>$act_is_finished,
                    ':xucp_act_others'=>$act_others,
                    ':xucp_person_size'=>$person_size,
                    ':xucp_act_from_created'=>$act_from_created))){

                    $doneMsg=ACT_ENTRY_WORKING;
                    $Discord = new Discord();
                    $Discord->Send(ACT_DISCORD_NOTES);
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
										<h4 class='card-title'>".CASES_HEADER."</h4>
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
										<h4 class='card-title'>".CASES_HEADER."</h4>
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
													".CASES_FILE_NUMBER."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_file_number' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_JOB."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_job' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_NAME."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_name' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>																													
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_PHONENUMBER."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_phone_number' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_BIRTHDAY."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_birthday' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_GENDER."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_gender' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_SIZE."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_size' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_EYE_COLOR."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_eye_color' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_HAIR_COLOR."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_hair_color' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_MOTORCYCLE_LICENSE."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_motorcycle_license' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_CAR_LICENSE."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_car_license' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_TRUCK_LICENSE."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_truck_license' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_GUN_LICENSE."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_person_gun_license' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_PERSON_OTHERS."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_act_others' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_VEH_PLATE."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_veh_plate' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_VEH_NAME."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_veh_name' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_VEH_ALL_VEHICLES."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_veh_all_vehicles' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>																																																																																																																																		
										<tr>				  
											<td>
												<h6>
													".CASES_MSG."
												</h6>
												<div class='input-group'>";
													xucp_pol_text_bbcode('xucp_act_msg', htmlspecialchars(stripslashes($_POST["xucp_act_msg"])));
                                                    echo "
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".CASES_IS_FINISHED."
												</h6>
												<div class='input-group'>
													<select name='xucp_act_is_finished' class='form-control show-tick' required>
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
													".CASES_TESTIFY."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_act_testify' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>																														
										<tr>				  
											<td>
												<h6>
													".CASES_FROM_CREATED."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_act_from_created' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>																														
										<tr>					  
											<td>
												<br>
												<button type='submit' name='xucp_submit' class='btn btn-primary btn-round'>
													".CASES_ADD."
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