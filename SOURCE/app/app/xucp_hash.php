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
function sitehash($var,$addtext="",$addsecure="02fb9ff482dfb6d9baf1a56b6d1f17zufr67r45403f643eeb1204b3012391f8ee63bfe4f4e"): string
{
    return hash('sha512','This xUCP Police Center V2".$addtext.$var.$addtext."".$addsecure." is the new user control panel system for all roleplay projects!');
}
