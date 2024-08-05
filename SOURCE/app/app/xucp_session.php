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
$select_stmt = $db->prepare("SELECT xucp_pol_online, xucp_pol_name, xucp_pol_themes, xucp_pol_lang, xucp_pol_upgrade_note from xucp_police_config WHERE id=1");
$select_stmt->execute();
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

if($select_stmt->rowCount() > 0){
    $_SESSION['xucp_police_secure']['xucp_police_conf_online'] = htmlentities($row["xucp_pol_online"]);
    $_SESSION['xucp_police_secure']['xucp_police_conf_sname'] = htmlentities($row["xucp_pol_name"]);
    $_SESSION['xucp_police_secure']['xucp_police_conf_lang'] = htmlentities($row["xucp_pol_lang"]);
    $_SESSION['xucp_police_secure']['xucp_police_conf_themes'] = htmlentities($row["xucp_pol_themes"]);
    $_SESSION['xucp_police_secure']['xucp_police_conf_upgrade_note'] = htmlentities($row["xucp_pol_upgrade_note"]);
}