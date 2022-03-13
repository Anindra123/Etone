<?php
$id = $_SESSION['id'];

$gdata = null;

if(count($ng_data) > 0){
	for ($j=0; $j < count($ng_data); $j++) { 
		$gid = $ng_data[$j]->id;
		$note_viewers = $ng_data[$j]->note_viewers;
		
		for ($i=0; $i < count($note_viewers); $i++) { 
			$data = $note_viewers[$i];

		//check if user is already a member of group
			if($data->id === $id && $data->role === 'gc'){
				$is_gc = true;
				$is_user = true;
				$_SESSION['g_id'] = $gid;
				$_SESSION['user_type'] = 'gc';
				$gdata = $ng_data[$j];
				break;
			}
			else if($data->id === $id){
				$is_user = true;
				$_SESSION['g_id'] = $gid;
				$_SESSION['user_type'] = 'v';
				$gdata = $ng_data[$j];
				break;
			}

		}
		
		
	}
}

function getData(){
	global $gdata;
	return $gdata;
}