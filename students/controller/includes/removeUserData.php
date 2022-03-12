<?php 
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/noteGroup.json");
$ng_data = get_AllNoteGroupData(get_fileName());

require_once 'getGroupID.php';

if(count($ng_data) > 0){
	$uid = $_SESSION['uid'];
	$data =(array) getData();
	$new_vdata = [];
	$new_sdata = [];
		if(isset($data['note_viewers'])){
		for ($i=0; $i < count($data['note_viewers']) ; $i++) { 
			$p_data = $data['note_viewers'][$i];

			if($p_data->id !== $uid){
				$new_vdata[]  = $p_data;
			}
		}
		$data['note_viewers'] = $new_vdata;
	}


	if(isset($data['shared_notes'])){
		for ($i=0; $i < count($data['shared_notes']); $i++) { 
			$p_data = $data['shared_notes'][$i];
			if($p_data->uid !== $uid){
				$new_sdata[]  = $p_data;
			}
		}
		$data['shared_notes'] = $new_sdata;
	}
	$id = $_SESSION['g_id'];
	updateNoteGroupData($id,$data,get_fileName());
}

if(isset($_SESSION['ng_data'])){
	unset($_SESSION['ng_data']);
}
