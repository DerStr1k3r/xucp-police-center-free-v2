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

xucp_pol_secure_chief_of_police();

xucp_pol_head_logged("fas fa-book",PARAGRAPH_MANAGER_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-book",PARAGRAPH_MANAGER_HEADER);

if(isset($_REQUEST['xucp_submit']))
{
    $title = strip_tags($_POST['xucp_title']);
    $description = strip_tags($_POST['xucp_description']);
    $category = strip_tags($_POST['xucp_category']);

    if(empty($title)){
        $errorMsg[]=PARAGRAPH_MANAGER_ERROR;
    }
    else if(empty($description)){
        $errorMsg[]=PARAGRAPH_MANAGER_ERROR;
    }
    else
    {
        try
        {
            if(!isset($errorMsg))
            {
                $insert_stmt=$db->prepare("INSERT INTO xucp_police_paragraph (title,description,category) VALUES
																(:xucp_title,:xucp_description,:xucp_category)");

                if($insert_stmt->execute(array(	':xucp_title'	=>$title,
                    ':xucp_description'	=>$description,
                    ':xucp_category'	=>$category))){

                    $doneMsg=PARAGRAPH_MANAGER_DONE;
                    $Discord = new Discord();
                    $Discord->Send(PARAGRAPH_MANAGER_DISCORD);
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
										<h4 class='card-title'>".PARAGRAPH_MANAGER_HEADER.": ".PARAGRAPH_MANAGER_ADD."</h4>
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
										<h4 class='card-title'>".PARAGRAPH_MANAGER_HEADER.": ".PARAGRAPH_MANAGER_ADD."</h4>
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
                                <div class='card-header'>
                                    <h4 class='card-title'>".PARAGRAPH_MANAGER_HEADER.": ".PARAGRAPH_MANAGER_ADD."</h4>
                                </div>
                                <div class='card-body'>
									<form action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>
										<tr>				  
											<td>
												<h6>
													".PARAGRAPH_MANAGER_CATEGORY."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_category' size='50' maxlength='100' class='form-control'>
												</div>	
											</td>
										</tr>									
										<tr>				  
											<td>
												<h6>
													".PARAGRAPH_MANAGER_TITLE."
												</h6>
												<div class='input-group'>
													<input type='text' name='xucp_title' size='50' maxlength='100' class='form-control' required>
												</div>	
											</td>
										</tr>
										<tr>				  
											<td>
												<h6>
													".PARAGRAPH_MANAGER_DESC."
												</h6>
												<div class='input-group'>";
													xucp_pol_text_bbcode('xucp_description', htmlspecialchars(stripslashes($_POST["xucp_description"])));
                                                    echo "
												</div>	
											</td>
										</tr>										
										<tr>					  
											<td>
												<br>
												<button type='submit' name='xucp_submit' class='btn btn-primary btn-round'>
													".PARAGRAPH_MANAGER_SEND."
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