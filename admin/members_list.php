<?php
	function changeText($val) {
		$val['date'] = date('d/m/Y H:i:s', strtotime($val['date']));
		if($val['reason'] == 'Nghỉ có phép') {
			$val['reason'] = 'OFF';
		}
		if($val['reason'] == 'Work From Home') {
			$val['reason'] = 'WFH';
		}
		if($val['reason'] == 'Đi trễ') {
			$val['reason'] = 'LATE';
		}
		$val['note'] = htmlentities($val['note']);
		return $val;
	}
	$folderName = date('Y');
	if(empty($_GET['date'])) {
		$_GET['date'] = date('Y-m-d');
	}

	$fileName = date('Ym', strtotime( str_replace("/", "-", $_GET['date']) )).'.json';
	$path = '../'. $folderName .'/'. $fileName;
	$jsonData = [];
	$recordedList = [];
	if(file_exists($path)) {
		$jsonString = file_get_contents($path);
		$jsonData = json_decode($jsonString, true);
	}
	$temp = [];
	$date = date('Y-m-d', strtotime( str_replace("/", "-", $_GET['date']) ) );
	if(!empty($jsonData)) {
		foreach($jsonData as $key => $val) {
			if( date('Y-m-d', strtotime($val['date'])) == $date) {
			$temp[] = changeText($val);
			}
		
		}
		$recordedList = $temp;
	}
	// Get members list
	$jsonData = [];
	$folderName = date('Y');
	$fileName = date('Ym').'.json';
	$path = '../'. $folderName .'/'. 'recored_list_' . $fileName;
	if(file_exists($path)) {
		$jsonString = file_get_contents($path);
		$jsonData = json_decode($jsonString, true);
	} else {
		$membersList = file_get_contents('../members_list.json');
		$jsonData = json_decode($membersList, true);
	}
	if(empty($jsonData)) {
		$membersList = file_get_contents('../members_list.json');
		$jsonData = json_decode($membersList, true);
	}
	
	$total_user = 0;
	$total_evidence = 0;
	foreach($jsonData as $key1 => $value1) {
		foreach($recordedList as $key2 => $value2) {
			if($value1['text'] == $value2['name'] && !empty($value2['reason'])) {
			$jsonData[$key1]['reason'] = $value2['reason'];
			break;
			}
		}
		
		if(!empty($value1['content']) && in_array($_GET['date'], $value1['content'])) {
			$jsonData[$key1]['content'] = 'true';
			$total_user++;
		} else {
			$jsonData[$key1]['content'] = '';
		}

		$keyEvidence = date('Ymd', strtotime($_GET['date']));
		if( !empty($value1['evidence']) && in_array($keyEvidence, array_keys($value1['evidence'])) ) {
			$jsonData[$key1]['evidence'] = $jsonData[$key1]['evidence'][date('Ymd', strtotime($_GET['date']))];
			$total_evidence++;
		} else {
			$jsonData[$key1]['evidence'] = '';
		}
	}

	header("Content-Type: application/json");
	echo json_encode(['data' => $jsonData, 'summary' => ['total_user' => $total_user, 'total_evidence' => $total_evidence]]);
	exit();
?>