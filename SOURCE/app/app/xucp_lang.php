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
if(isset($_GET['secure_lang']) && !empty($_GET['secure_lang'])){
        $_SESSION['xucp_police_secure']['secure_lang'] = $_GET['secure_lang'];
       
        if(isset($_SESSION['xucp_police_secure']['secure_lang']) && $_SESSION['xucp_police_secure']['secure_lang'] != $_GET['secure_lang']){
         echo "<script type='text/javascript'> location.reload(); </script>";
        }
}
// ************************************************************************************//       
// app Language file
// ************************************************************************************//
if(isset($_SESSION['xucp_police_secure']['secure_lang'])){
    $select_stmt=$db->prepare("SELECT language FROM xucp_police_accounts WHERE id = ".$_SESSION['xucp_police_secure']['secure_first']);
    $select_stmt->execute();
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

    if($select_stmt->rowCount() > 0){
		include(dirname(__FILE__) . "/../language/lang_".htmlentities($row['language'], ENT_QUOTES, 'UTF-8').".php");
	}else{
        include(dirname(__FILE__) . "/../language/lang_".$_SESSION['xucp_police_secure']['xucp_police_conf_lang'].".php");
	}
}else{
	include(dirname(__FILE__) . "/../language/lang_".$_SESSION['xucp_police_secure']['xucp_police_conf_lang'].".php");
}
