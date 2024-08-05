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
secure_url();

xucp_pol_head_no_logged("fas fa-unlock",LOGIN);
xucp_pol_content_no_logged("fas fa-unlock",LOGIN);

if('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['xucp_login'])){
    $username	=strip_tags($_REQUEST["xucp_username"]);
    $password	=strip_tags($_REQUEST["xucp_password"]);

    if(empty($username)){
        $errorMsg[]=MSG_10;
    }
    else if(empty($password)){
        $errorMsg[]=MSG_11;
    }
    else
    {
        try
        {
            $select_stmt=$db->prepare("SELECT * FROM xucp_police_accounts WHERE username=:xucp_username");
            $select_stmt->execute(array(':xucp_username'=>$username));
            $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

            if($select_stmt->rowCount() > 0)
            {
                if($username==$row["username"])
                {
                    if(password_verify($password, $row["password"]))
                    {
                        $_SESSION['xucp_police_secure'] = [
                            'secure_first' => $row["id"],
                            'secure_char_name' => $row["charname"],
                            'secure_avatar' => $row["user_avatar"],
                            'secure_granted' => "granted",
                            'secure_staff' => $row["user_faction_rank"],
                            'secure_lang' => $row["language"],
                            'secure_key' => hash(SITE_LOGIN_SECURE_ALGO, SITE_LOGIN_SECURE_ALGO_ENCRYPT)
                        ];
                        $loginMsg = MSG_27;
                        $Discord = new Discord();
                        $Discord->Send(DCWEBHOOK_INFO_LOGIN_1 ." ".$row["username"]." ".DCWEBHOOK_INFO_LOGIN_2);
                        header("refresh:1; /vendor/usercp/dashboard/index.php");
                    }
                    else
                    {
                        $errorMsg[]=MSG_11;
                    }
                }
                else
                {
                    $errorMsg[]=MSG_10;
                }
            }
            else
            {
                $errorMsg[]=MSG_11;
            }
        }
        catch(PDOException $e)
        {
            $e->getMessage();
        }
	}	
}

		if(isset($errorMsg))
		{
			foreach($errorMsg as $error)
			{
                echo "
                        <div class='row'>
							<div class='col-xl-12'>
								<div class='card'>
									<div class='card-body text-center'>
				                        <strong>".$error."</strong>
									</div>
								</div>
							</div>
						</div>";
			}
		}
		if(isset($loginMsg))
		{
        echo "
                        <div class='row'>
							<div class='col-xl-12'>
								<div class='card'>
									<div class='card-body text-center'>
				                        <strong>".$loginMsg."</strong>
									</div>
								</div>
							</div>
						</div>";
		}
    echo "
                                <div class='card-body p-0'>
                                    <div class='tab-content'>
                                        <div class='tab-pane active p-3'>                                        
                                            <form class='form-horizontal auth-form' action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data' autocomplete='off'>
                
                                                <div class='form-group mb-2'>
                                                    <label class='form-label' for='username'>".USERNAME." *</label>
                                                    <div class='input-group'>
                                                        <input type='text' name='xucp_username' class='form-control' id='username' placeholder='".INFO1."'>                                                                                         
                                                    </div>                                    
                                                </div><!--end form-group--> 
                    
                                                <div class='form-group mb-2'>
                                                    <label class='form-label' for='userpassword'>".PASSWORD." *</label>                                            
                                                    <div class='input-group'>                                  
                                                        <input type='password' name='xucp_password' class='form-control' placeholder='".INFO2."' aria-label='".PASSWORD."' aria-describedby='password-addon'>
                                                    </div>                               
                                                </div><!--end form-group--> 
                    
                                                <div class='form-group mb-0 row'>
                                                    <div class='col-12'>
														<input type='submit' name='xucp_login' class='btn btn-primary w-100 waves-effect waves-light' value='Login'>
                                                    </div><!--end col--> 
                                                </div> <!--end form-group-->                           
                                            </form><!--end form-->
                                            <div class='m-3 text-center text-muted'>
                                                <p class='mb-0'>".NOTE3."  <a href='/vendor/webcp/register/index.php' class='text-primary ms-2'>".REGISTER."</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
xucp_pol_foot_no_logged();
