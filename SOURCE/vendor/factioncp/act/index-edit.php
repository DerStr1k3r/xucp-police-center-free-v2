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

$id = $_GET['id'];
$select_stmt = $db->prepare(query: "SELECT * FROM `xucp_police_act` WHERE id = ".$id);
$select_stmt->execute();
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
if($select_stmt->rowCount() > 0){
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
                    $insert_stmt=$db->prepare("UPDATE 
                                                    `xucp_police_act` 
                                                SET
                                                     `act_file_number` = :xucp_file_number, 
                                                     `person_job` = :xucp_person_job, 
                                                     `act_msg` = :xucp_act_msg, 
                                                     `person_name` = :xucp_person_name,
                                                     `person_phonenumber` = :xucp_person_phone_number,
                                                     `person_gender` = :xucp_person_gender,
                                                     `person_birthday` = :xucp_person_birthday,
                                                     `person_size` = :xucp_person_size,
                                                     `person_eye_color` = :xucp_person_eye_color,
                                                     `person_hair_color` = :xucp_person_hair_color,
                                                     `person_motorcycle_license` = :xucp_person_motorcycle_license,
                                                     `person_car_license` = :xucp_person_car_license,
                                                     `person_truck_license` = :xucp_person_truck_license,
                                                     `person_gun_license` = :xucp_person_gun_license,
                                                     `veh_plate` = :xucp_veh_plate,
                                                     `veh_name` = :xucp_veh_name,
                                                     `veh_all_vehicles` = :xucp_veh_all_vehicles,
                                                     `act_testify` = :xucp_act_testify,
                                                     `act_is_finished` = :xucp_act_is_finished,
                                                     `act_others` = :xucp_act_others,
                                                     `act_from_created` = :xucp_act_from_created
                                                WHERE 
                                                    `id` = ".$id);

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
                        header("refresh:2; /vendor/factioncp/act/index.php");
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
                            <div class='col-12'>
                                <div class='card'>
                                    <div class='card-header'>
										<p class='card-title-desc'>".CASES_EDIT.": " . $row["act_file_number"]. "</p>
                                    </div>
                                    <div class='card-body p-4'>
										<form class='form-horizontal' method='post' action='".$_SERVER['PHP_SELF']."' enctype='multipart/form-data'>
                                        <div class='row'>
                                            <div class='col-lg-6'>
                                                <div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_FILE_NUMBER."</label>
														<input type='text' name='xucp_file_number' size='50' maxlength='100' class='form-control' value='" . $row["act_file_number"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_JOB."</label>
														<input type='text' name='xucp_person_job' size='50' maxlength='100' class='form-control' value='" . $row["person_job"]. "' required>
                                                    </div>                                                   
                                                </div>
                                            </div>

                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_NAME."</label>
														<input type='text' name='xucp_person_name' size='50' maxlength='100' class='form-control' value='" . $row["person_name"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_PHONENUMBER."</label>
														<input type='text' name='xucp_person_phone_number' size='50' maxlength='100' class='form-control' value='" . $row["person_phonenumber"]. "' required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_BIRTHDAY."</label>
														<input type='text' name='xucp_person_birthday' size='50' maxlength='100' class='form-control' value='" . $row["person_birthday"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_GENDER."</label>
														<input type='text' name='xucp_person_gender' size='50' maxlength='100' class='form-control' value='" . $row["person_gender"]. "' required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_SIZE."</label>
														<input type='text' name='xucp_person_size' size='50' maxlength='100' class='form-control' value='" . $row["person_size"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_EYE_COLOR."</label>
														<input type='text' name='xucp_person_eye_color' size='50' maxlength='100' class='form-control' value='" . $row["person_eye_color"]. "' required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_HAIR_COLOR."</label>
														<input type='text' name='xucp_person_hair_color' size='50' maxlength='100' class='form-control' value='" . $row["person_hair_color"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_MOTORCYCLE_LICENSE."</label>
														<input type='text' name='xucp_person_motorcycle_license' size='50' maxlength='100' class='form-control' value='" . $row["person_motorcycle_license"]. "' required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_CAR_LICENSE."</label>
														<input type='text' name='xucp_person_car_license' size='50' maxlength='100' class='form-control' value='" . $row["person_car_license"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_TRUCK_LICENSE."</label>
														<input type='text' name='xucp_person_truck_license' size='50' maxlength='100' class='form-control' value='" . $row["person_truck_license"]. "' required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_GUN_LICENSE."</label>
														<input type='text' name='xucp_person_gun_license' size='50' maxlength='100' class='form-control' value='" . $row["person_gun_license"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_VEH_PLATE."</label>
														<input type='text' name='xucp_veh_plate' size='50' maxlength='100' class='form-control' value='" . $row["veh_plate"]. "' required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_VEH_NAME."</label>
														<input type='text' name='xucp_veh_name' size='50' maxlength='100' class='form-control' value='" . $row["veh_name"]. "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_VEH_ALL_VEHICLES."</label>
														<input type='text' name='xucp_veh_all_vehicles' size='50' maxlength='100' class='form-control' value='" . $row["veh_all_vehicles"]. "' required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_MSG."</label>";
                                                        xucp_pol_text_bbcode('xucp_act_msg', htmlspecialchars(stripslashes($row['act_msg'])));
                                                        echo "
                                                    </div>													
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_IS_FINISHED."</label>
														<select name='xucp_act_is_finished' class='form-control show-tick' value='" . $row["act_is_finished"]. "' required>
															<option value=''>-- ".CHANGE_MYPROFILE_LANGUAGENOTE." --</option>
															<option value='yes'>Yes</option>
															<option value='no'>No</option>
														</select>	
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_TESTIFY."</label>
														<input type='text' name='xucp_act_testify' size='50' maxlength='100' class='form-control' value='" . $row["act_testify"]. "' required>	
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_FROM_CREATED."</label>
														<input type='text' name='xucp_act_from_created' size='50' maxlength='100' class='form-control' value='" . $row["act_from_created"]. "' required>
                                                    </div>                                                    													
                                                </div>
                                            </div>                                            									
                                            <div class='col-lg-12'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
														<button type='submit' name='xucp_submit' class='btn btn-primary w-100 waves-effect waves-light'>
															<i class='dripicons-checkmark'></i>&nbsp;".NEWS_SAVE."
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
}
xucp_pol_foot_logged();