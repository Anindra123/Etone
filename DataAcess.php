<?php
	

	function set_studentData($data,$filename){
		global $json_data,$handle,$data_arr,$path;
		$fr = fread($handle, filesize($path));
		$fc = fclose($handle);
		
		$json_data = json_decode($fr);
		$handle = fopen($path, 'w');
		$data_arr = array();
		if($handle === false){
			die("<h3>Cannot open file</h3>");
		}
		if($json_data === NULL){
			$data['id'] = 1;
			$data_arr[] = $data;
			$data_arr = json_encode($data_arr);
			fwrite($handle, $data_arr);
		}
		else{
			$json_data[] = $data;
			$json_data = json_encode($json_data);
			fwrite($handle, $json_data);
		}
		$fc = fclose($handle);
	}