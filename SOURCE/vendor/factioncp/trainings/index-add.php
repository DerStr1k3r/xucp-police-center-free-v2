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

xucp_pol_secure_deputy_chief();

xucp_pol_head_logged("far fa-life-ring",TRAIN_ADD_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-life-ring",TRAIN_ADD_HEADER);

if(isset($_REQUEST['xucp_submit']))
{
    $title = strip_tags($_POST['xucp_title']);
    $content = strip_tags($_POST['xucp_content']);
    $type = strip_tags($_POST['xucp_type']);
    $persons = strip_tags($_POST['xucp_persons']);
    $when = strip_tags($_POST['xucp_when']);

    if(empty($title)){
        $errorMsg[]=TRAIN_ADD_ERROR;
    }
    else if(empty($content)){
        $errorMsg[]=TRAIN_ADD_ERROR;
    }
    else
    {
        try
        {
            if(!isset($errorMsg))
            {
                $insert_stmt=$db->prepare("INSERT INTO 
                                                    xucp_police_trainings 
                                                    (
                                                     train_title, 
                                                     train_content, 
                                                     train_type, 
                                                     train_persons,
                                                     train_when) 
                                                VALUES		
                                                    (
                                                     :xucp_title,
                                                     :xucp_content,
                                                     :xucp_type,
                                                     :xucp_persons,
                                                     :xucp_when)");

                if($insert_stmt->execute(array(	':xucp_title'	=>$title,
                    ':xucp_content'	=>$content,
                    ':xucp_type'=>$type,
                    ':xucp_persons'=>$persons,
                    ':xucp_when'=>$when))){

                    $doneMsg=TRAIN_ADD_DONE;
                    $Discord = new Discord();
                    $Discord->Send(TRAIN_ADD_DISCORD_NOTES);
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
										<h4 class='card-title'>".TRAIN_ADD_HEADER."</h4>
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
										<h4 class='card-title'>".TRAIN_ADD_HEADER."</h4>
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
                                                        <label for='example-text-input' class='form-label'>".TRAIN_ADD_TITLE."</label>
														<input class='form-control' type='text' name='xucp_title' id='example-text-input'>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".TRAIN_ADD_WHEN."</label>
                                                    <input class='form-control' type='text' name='xucp_when' id='example-text-input'>
                                                    </div>                                                   
                                                </div>
                                            </div>

                                            <div class='col-lg-6'>
                                                <div class='mt-4 mt-lg-0'>
                                                    <div class='mb-6'>
                                                        <label for='example-text-input' class='form-label'>".TRAIN_ADD_PERSON."</label>";
                                                        xucp_pol_text_bbcode('xucp_persons', htmlspecialchars(stripslashes($_POST["xucp_persons"])));
                                                        echo "
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-4 mt-lg-0'>
                                                    <div class='mb-6'>
                                                        <label for='example-text-input' class='form-label'>".TRAIN_ADD_CONTENT."</label>";
                                                        xucp_pol_text_bbcode('xucp_content', htmlspecialchars(stripslashes($_POST["xucp_content"])));
                                                        echo "
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class='col-lg-12'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".TRAIN_ADD_TYPE."</label>
														<input class='form-control' type='text' name='xucp_type' id='example-text-input'>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".TRAIN_ADD_SAVE."</label>
														<button type='submit' name='xucp_submit' class='btn btn-primary w-100 waves-effect waves-light'>
															".TRAIN_ADD_SAVE."
														</button>
                                                    </div>
                                                </div>
                                            </div>											
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>";
xucp_pol_foot_logged();