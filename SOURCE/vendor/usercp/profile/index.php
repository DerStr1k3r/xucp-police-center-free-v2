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
require_once(dirname(__FILE__) . "/../../../app/system.php");

xucp_pol_secure();

xucp_pol_head_logged("fas fa-user-plus",USERPROFILECHANGE);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-user-plus",USERPROFILECHANGE);

if(isset($_POST['xucp_submit'])){
        $user_sig = strip_tags($_REQUEST['xucp_user_sig']);
        $user_avatar = filter_input(INPUT_POST, 'xucp_user_avatar', FILTER_SANITIZE_SPECIAL_CHARS);
        $user_hp = filter_input(INPUT_POST, 'xucp_user_hp', FILTER_SANITIZE_SPECIAL_CHARS);
        $user_dctag = filter_input(INPUT_POST, 'xucp_user_dctag', FILTER_SANITIZE_SPECIAL_CHARS);
        $email 	= filter_input(INPUT_POST, 'xucp_email', FILTER_SANITIZE_EMAIL);
        $language 	= filter_input(INPUT_POST, 'xucp_language', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'xucp_password', FILTER_DEFAULT);
        $user_id = $_SESSION['xucp_police_secure']['secure_first'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errorMsg[]=MSG_13;
        }
        else if(empty($password)){
            $errorMsg[]=MSG_15;
        }
        else if(strlen($password) < 6){
            $errorMsg[] = MSG_13;
        }
        else
        {
            try
            {
                if(!isset($errorMsg))
                {
                    $new_password = password_hash($password, PASSWORD_BCRYPT);
                    $insert_stmt=$db->prepare("UPDATE `xucp_police_accounts` SET `user_hp` = :xucp_user_hp, `user_sig` = :xucp_user_sig, `email` = :xucp_email, `language` = :xucp_language, `password` = :xucp_password, `user_avatar` = :xucp_user_avatar, `user_dctag` = :xucp_user_dctag WHERE `id` = :xucp_user_id");

                    if($insert_stmt->execute(array(	':xucp_user_sig'	=>$user_sig,
                        ':xucp_email'=>$email,
                        ':xucp_language'=>$language,
                        ':xucp_password'=>$new_password,
                        ':xucp_user_avatar'=>$user_avatar,
                        ':xucp_user_dctag'=>$user_dctag,
                        ':xucp_user_hp'=>$user_hp,
                        ':xucp_user_id'=>$user_id))){

                        $registerMsg=MSG_8;
                        header("refresh:1; ".$_SERVER['PHP_SELF']);
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
                        <h4 class='card-title'>".USERPROFILECHANGE."</h4>
                    </div>
                    <div class='card-body'>
                        ".$error."
                    </div>
                </div>
            </div>
        </div>";
    }
}
if(isset($registerMsg))
{
    echo"
    <div class='row'>
        <div class='col-xl-12'>
            <div class='card'>
                <div class='card-header'>
                    <h4 class='card-title'>".USERPROFILECHANGE."</h4>
                </div>
                <div class='card-body'>
                    ".$registerMsg."
                </div>
            </div>
        </div>
    </div>";
}
echo "
                    <div class='row'>
                        <div class='col-12'>
                            <div class='card'>                              
                                <div class='card-body'>
                                    <div class='dastone-profile'>
                                        <div class='row'>
                                            <div class='col-lg-4 align-self-center mb-3 mb-lg-0'>
                                                <div class='dastone-profile-main'>
                                                    <div class='dastone-profile-main-pic'>";
                                                $select_stmt = $db->prepare("SELECT * FROM xucp_police_accounts WHERE id = ".$_SESSION['xucp_police_secure']['secure_first']);
                                                $select_stmt->execute();
                                                $avatar=$select_stmt->fetch(PDO::FETCH_ASSOC);

                                                if($select_stmt->rowCount() > 0){
                                                    echo "
														<img src='".htmlentities($avatar['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' height='110' class='rounded-circle'>";
                                                }
                                                echo "
                                                    </div>
                                                    <div class='dastone-profile_user-detail'>";
                                                $select_stmt = $db->prepare("SELECT * FROM xucp_police_accounts WHERE id = ".$_SESSION['xucp_police_secure']['secure_first']);
                                                $select_stmt->execute();
                                                $user_sig=$select_stmt->fetch(PDO::FETCH_ASSOC);

                                                if($select_stmt->rowCount() > 0){
                                                    echo "
                                                        <h5 class='dastone-user-name'>".htmlentities($user_sig['charname'], ENT_QUOTES, 'UTF-8')."</h5>                                                        
                                                        <p class='mb-0 dastone-user-name-post'>".htmlentities($user_sig['user_sig'], ENT_QUOTES, 'UTF-8')."</p>";
                                                }
                                                echo "                                                        
                                                    </div>
                                                </div>                                                
                                            </div>                                            
                                            <div class='col-lg-4 ms-auto align-self-center'>
                                                <ul class='list-unstyled personal-detail mb-0'>";
                                            $select_stmt = $db->prepare("SELECT * FROM xucp_police_accounts WHERE id = ".$_SESSION['xucp_police_secure']['secure_first']);
                                            $select_stmt->execute();
                                            $user_sig=$select_stmt->fetch(PDO::FETCH_ASSOC);

                                            if($select_stmt->rowCount() > 0){
                                                echo "
                                                    <li class='mt-2'><i class='ti ti-email text-secondary font-16 align-middle me-2'></i> <b> ".EMAIL." </b> : ".htmlentities($user_sig['email'], ENT_QUOTES, 'UTF-8')."</li>
                                                    <li class='mt-2'><i class='ti ti-world text-secondary font-16 align-middle me-2'></i> <b> ".PROFILE_PORTFOLIO_WEBSITE." </b> : 
                                                        <a href='".htmlentities($user_sig['user_hp'], ENT_QUOTES, 'UTF-8')."' class='font-14 text-primary'>".htmlentities($user_sig['user_hp'], ENT_QUOTES, 'UTF-8')."</a> 
                                                    </li>                                                   
                                                </ul>";
                                            }
                                            echo "
                                            </div><!--end col-->
                                            <div class='col-lg-4 align-self-center'>
                                                <div class='row'>";
                                            $select_stmt = $db->prepare("SELECT * FROM xucp_police_accounts WHERE id = ".$_SESSION['xucp_police_secure']['secure_first']);
                                            $select_stmt->execute();
                                            $dc_tag=$select_stmt->fetch(PDO::FETCH_ASSOC);

                                            if($select_stmt->rowCount() > 0){
                                                echo "
                                                    <div class='col-auto text-end border-end'>
                                                        <button type='button' class='btn btn-soft-primary btn-icon-circle btn-icon-circle-sm mb-2'>
                                                            <i class='fab fa-discord'></i>
                                                        </button>
                                                        <p class='mb-0 fw-semibold'>".PROFILE_PORTFOLIO_DISCORDTAG."</p>
                                                        <h4 class='m-0 fw-bold'>".htmlentities($dc_tag['user_dctag'], ENT_QUOTES, 'UTF-8')."</h4>
                                                    </div>
                                                    <div class='col-auto'>
                                                        <button type='button' class='btn btn-soft-info btn-icon-circle btn-icon-circle-sm mb-2'>
                                                            <i class='far fa-meh'></i>
                                                        </button>
                                                        <p class='mb-0 fw-semibold'>".FACTION_RANK."</p>
                                                        <h4 class='m-0 fw-bold'>";
                                                            xucp_get_class_name(htmlentities($dc_tag['user_faction_rank'], ENT_QUOTES, 'UTF-8'));
                                                            echo "
                                                        </h4>
                                                    </div>";
                                            }
                                            echo "
                                                </div>                                              
                                            </div>
                                        </div>
                                    </div>                                                                                
                                </div>          
                            </div>    
                        </div>
                    </div>
                    <div class='pb-4'>
                        <ul class='nav-border nav nav-pills mb-0' id='pills-tab' role='tablist'>
                            <li class='nav-item'>
                                <a class='nav-link active' id='Profile_About_tab' data-bs-toggle='pill' href='#Profile_About'>".PROFILE_ABOUT."</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' id='Profile_Settings_tab' data-bs-toggle='pill' href='#Profile_Settings'>".PROFILE_SETTINGS."</a>
                            </li>
                        </ul>        
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                            <div class='tab-content' id='pills-tabContent'>
                                <div class='tab-pane fade show active' id='Profile_About' role='tabpanel' aria-labelledby='Profile_About_tab'>
									<div class='card'>
										<div class='card-header'>
											<h5 class='card-title mb-0'>".PROFILE_ABOUT."</h5>
										</div>
										<div class='card-body'>
											<div>
												<div class='pb-3'>
													<div class='row'>
														<div class='col-xl-2'>
															<div>
																<h5 class='font-size-15'>".SIGNATUR." :</h5>
															</div>
														</div>
														<div class='col-xl'>
															<div class='text-muted'>";
                                                        $select_stmt = $db->prepare("SELECT * FROM xucp_police_accounts WHERE id = ".$_SESSION['xucp_police_secure']['secure_first']);
                                                        $select_stmt->execute();
                                                        $u_sig=$select_stmt->fetch(PDO::FETCH_ASSOC);

                                                        if($select_stmt->rowCount() > 0){
                                                            echo "
																<p class='mb-2'>".xucp_format_comments($u_sig['user_sig'])."</p>";
                                                        }
                                                        echo "
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>                                 
                                </div>
                                <div class='tab-pane fade' id='Profile_Settings' role='tabpanel' aria-labelledby='Profile_Settings_tab'>
                                    <div class='card'>
										<div class='card-header'>
											<h5 class='card-title mb-0'>".PROFILE_SETTINGS."</h5>
										</div>
										<div class='card-body'>
											<div>
												<div class='pb-3'>
													<div class='text-muted'>";
                                                $select_stmt = $db->prepare("SELECT * FROM xucp_police_accounts WHERE id = ".$_SESSION['xucp_police_secure']['secure_first']);
                                                $select_stmt->execute();
                                                $profile=$select_stmt->fetch(PDO::FETCH_ASSOC);

                                                if($select_stmt->rowCount() > 0){
                                                    echo "
														<form class='card' action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>
															<div class='card-body'>
																<div class='row gy-4'>
																	<div class='col-sm-6'>
																		<label class='form-label'>".EMAIL."</label>
																		<input class='form-control' type='text' name='xucp_email' placeholder='".EMAIL."' value='".htmlentities($profile['email'], ENT_QUOTES, 'UTF-8')."' required>
																	</div>
																	<div class='col-sm-6'>
																		<label class='form-label'>".PASSWORD."</label>
																		<input class='form-control' type='password' name='xucp_password' placeholder='".PASSWORD."' required>
																	</div>
																	<div class='col-md-12'>
																		<label class='form-label'>".PROFILE_PORTFOLIO_WEBSITE."</label>
																		<input class='form-control' type='text' name='xucp_user_hp' placeholder='".PROFILE_PORTFOLIO_WEBSITE."' value='".htmlentities($profile['user_hp'], ENT_QUOTES, 'UTF-8')."' required>
																	</div>	
																	<div class='col-md-12'>
																		<label class='form-label'>".PROFILE_PORTFOLIO_DISCORDTAG."</label>
																		<input class='form-control' type='text' name='xucp_user_dctag' placeholder='".PROFILE_PORTFOLIO_DISCORDTAG."' value='".htmlentities($profile['user_dctag'], ENT_QUOTES, 'UTF-8')."' required>
																	</div>																		
																	<div class='col-md-12'>
																		<label class='form-label'>".LANGUAGE."</label>
																		<div class='bootstrap-select form-control show-tick'>
																			<select name='xucp_language' class='form-control show-tick' required>
																				<option value=''>-- ".CHANGE_MYPROFILE_LANGUAGENOTE." --</option>
																				<option value='en'>".CHANGE_MYPROFILE_LANGUAGE_SELECT_EN."</option>
																				<option value='de'>".CHANGE_MYPROFILE_LANGUAGE_SELECT_DE."</option>
																			</select>
																		</div>
																	</div>
																	<div class='col-md-12'>
																		<label class='form-label'>".AVATAR."</label>
																		<input class='form-control' type='text' name='xucp_user_avatar' placeholder='".AVATAR."' value='".htmlentities($profile['user_avatar'], ENT_QUOTES, 'UTF-8')."'>
																	</div>									
																	<div class='col-md-12'>
																		<label class='form-label'>".SIGNATUR."</label>";
                                                                        xucp_pol_text_bbcode('xucp_user_sig', htmlspecialchars(stripslashes($profile['user_sig'])));
                                                }
                                                echo "
																	</div>
																</div>
															</div>
															<div class='card-footer text-end'>
																<input type='submit' name='xucp_submit' class='btn btn-primary w-100 waves-effect waves-light' value='".MYPROFILESAVE."'>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>   
                                </div>
                            </div>
                        </div>
                    </div>";
xucp_pol_foot_logged();