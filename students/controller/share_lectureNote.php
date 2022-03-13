<?php
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';

require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';

//collect note group data and put it in a 
//session
$data = null;
$lpu_data = [];
$ng_data = [];
$lpid = "";
$id = $_SESSION['id'];
if(isset($_GET['lp_id'])){
	$_SESSION['lp_id'] = +$_GET['lp_id'];	 
}
set_type("f","../model/noteGroup.json");
$ng_data = get_AllNoteGroupData(get_fileName());

set_type("f","../model/lecturePlanData.json");
$lpid = $_SESSION['lp_id'];
$lpu_data =(array) getSingleJsonData($id,$lpid,get_fileName());

require_once 'includes/getGroupID.php';
if(count($ng_data) > 0){
	if(isset($_SESSION['g_id'])){
		$flag = false;
		for ($i=0; $i < count($ng_data) ; $i++) { 
			if($ng_data[$i]->id === $_SESSION['g_id']){
				$data =(array)$ng_data[$i];
			}
		}
		for ($i=0; $i < count($data['shared_notes']); $i++) { 
			$sn =(array) $data['shared_notes'][$i];
			if($lpu_data['id'] === $sn['id']
			&& $lpu_data['uid'] === $sn['uid']){
				$flag = true;
			}
		}
		if($flag === false){
			if(!isset($data['shared_notes'])){
				$lpdata = [];
				$lpdata[] = array('id' => $lpu_data['id'], 'uid' =>$lpu_data['uid']);
				$data['shared_notes'] =  $lpdata;
			}
			else{
				$snotes =(array) $data['shared_notes'];
				$snotes[] = array('id' => $lpu_data['id'], 'uid' =>$lpu_data['uid']);
				$data['shared_notes'] = $snotes;
			}
			$id = $_SESSION['g_id'];
			set_type("f","../model/noteGroup.json");
			updateNoteGroupData($id,$data,get_fileName());
			$_SESSION['success'] = get_sucess('Note shared sucessfully ');
		}
		else{
			$_SESSION['m_errors'] = get_failure('Lecture plan already shared in group ');
		}
	}else{
		$_SESSION['m_errors'] = get_failure('No group created ');
	}
}
else{
	$_SESSION['m_errors'] = get_failure('No group created ');
}
if(isset($_SESSION['ng_data'])){
	unset($_SESSION['ng_data']);
}
header(getRouteUrl());
exit();