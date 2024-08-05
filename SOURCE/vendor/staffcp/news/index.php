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

xucp_pol_head_logged("far fa-newspaper",NEWS_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-newspaper",NEWS_HEADER);

if(isset($_REQUEST['xucp_submit']))
{
    $title_config_uid 	= 1;
    $title = strip_tags($_REQUEST['xucp_title']);
    $title_de 	= strip_tags($_REQUEST['xucp_title_de']);
    $title_content 	= strip_tags($_REQUEST['xucp_content']);
    $title_content_de 	= strip_tags($_REQUEST['xucp_content_de']);

    if(empty($title)){
        $errorMsg[]=NEWS_INFO;
    }
    else if(empty($title_de)){
        $errorMsg[]=NEWS_INFO;
    }
    else if(empty($title_content)){
        $errorMsg[]=NEWS_INFO;
    }
    else if(empty($title_content_de)){
        $errorMsg[]=NEWS_INFO;
    }
    else
    {
        try
        {
            if(!isset($errorMsg))
            {
                $insert_stmt=$db->prepare("UPDATE `xucp_police_news` SET `title` = :xucp_title, `title_de` = :xucp_title_de, `content` = :xucp_content, `content_de` = :xucp_content_de WHERE `id` = ".$title_config_uid);

                if($insert_stmt->execute(array(	':xucp_title'	=>$title,
                    ':xucp_title_de'=>$title_de,
                    ':xucp_content'=>$title_content,
                    ':xucp_content_de'=>$title_content_de))){

                    $doneMsg=NEWS_DONE;
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
										<h4 class='card-title'>".NEWS_HEADER."</h4>
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
										<h4 class='card-title'>".NEWS_HEADER."</h4>
									</div>
									<div class='card-body'>
										".$doneMsg."
									</div>
								</div>
							</div>
						</div>";
}
$select_stmt = $db->prepare("SELECT title, title_de, content, content_de FROM `xucp_police_news` WHERE id = 1");
$select_stmt->execute();
$news_set=$select_stmt->fetch(PDO::FETCH_ASSOC);
if($select_stmt->rowCount() > 0){
    echo "
                        <div class='row'>
                            <div class='col-12'>
                                <div class='card'>
                                    <div class='card-body p-4'>
										<form class='form-horizontal' method='post' action='".$_SERVER['PHP_SELF']."' enctype='multipart/form-data'>
                                        <div class='row'>
                                            <div class='col-lg-12'>
                                                <div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".NEWS_TITLE_EN."&nbsp;<small class='text-muted'>".NEWS_TITLE_EN_TEXT."</small></label>
														<input type='text' name='xucp_title' size='50' maxlength='100' class='form-control' value='".$news_set["title"]."' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".NEWS_TITLE_DE."&nbsp;<small class='text-muted'>".NEWS_TITLE_DE_TEXT."</small></label>
														<input type='text' name='xucp_title_de' size='50' maxlength='100' class='form-control' value='".$news_set["title_de"]."' required>
                                                    </div>                                                   
                                                </div>
                                            </div>

                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".NEWS_CONTENT_EN."&nbsp;<small class='text-muted'>".NEWS_CONTENT_EN_TEXT."</small></label>";
														xucp_pol_text_bbcode('xucp_content', htmlspecialchars(stripslashes($news_set['content'])));
														echo"
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".NEWS_CONTENT_DE."&nbsp;<small class='text-muted'>".NEWS_CONTENT_DE_TEXT."</small></label>";
                                                        xucp_pol_text_bbcode('xucp_content_de', htmlspecialchars(stripslashes($news_set['content_de'])));
                                                        echo"
                                                    </div>
                                                </div>
                                            </div><hr>                                            
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