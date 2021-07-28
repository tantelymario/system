<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/system/MSystem.php");
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/system/System.php");

$system_control = new System("system");
$system_model   = new MSystem("system");

$action = $system_control->post_params('action');
if($action != "cli"){
    exit("Error");
}
require_once($_SERVER['DOCUMENT_ROOT']."/includes/cli.php");