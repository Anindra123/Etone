<?php 
session_start();
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/noteGroup.json");
$_SESSION['ng_data'] = get_AllNoteGroupData(get_fileName());

header(getRouteUrl());
exit();