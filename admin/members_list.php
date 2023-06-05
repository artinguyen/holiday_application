<?php
	function changeText($val) {
		//$val['date'] = date('d/m/Y H:i:s', strtotime($val['date']));
		$val['date'] = date('Y-m-d', strtotime($val['date']));
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

	$startDate = date("Y-m-01", strtotime($_GET['date']));
    $endDate = date("Y-m-t", strtotime($_GET['date']));
	$startDate = new DateTime($startDate);
    $endDate = new DateTime($endDate);
	if(!empty($jsonData)) {
		foreach($jsonData as $key => $val) {
			$startDate = new DateTime( date("Y-m-01", strtotime($_GET['date'])) );
			while($startDate <= $endDate ){
				$date = $startDate->format('Y-m-d');
				if( date('Y-m-d', strtotime($val['date'])) == $date) {
					$temp[] = changeText($val);
				}
				// increase startDate by 1
				$startDate->modify('+1 day');
			}
		
		}
		$recordedList = $temp;
	}
	$startDate = date("Y-m-01", strtotime($_GET['date']));
	$startDate = new DateTime($startDate);
    $resultDays = array('Monday','Tuesday','Wednesday','Thursday','Friday');

	$arrDate = [];
    // iterate over start to end date
    while($startDate <= $endDate ){
        // find the timestamp value of start date
        $timestamp = strtotime($startDate->format('Y-m-d'));
        // find out the day for timestamp and increase particular day
        $weekDay = date('l', $timestamp);
		if(in_array($weekDay, $resultDays)) {
			$arrDate[] = $startDate->format('Y-m-d');
		}
        // increase startDate by 1
        $startDate->modify('+1 day');
    }

	// Get members list
	$jsonData = [];
	$folderName = date('Y');
	if(!empty($_GET['date'])) {
		$fileName = date("Ym", strtotime($_GET['date'])).'.json';
	} else {
		$fileName = date('Ym').'.json';
	}
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
		// Reason
		$jsonData[$key1]['reason'] =  array_combine($arrDate, $arrDate);
		foreach($recordedList as $key2 => $value2) {
			if($value1['text'] == $value2['name'] && !empty($value2['reason'])) {
				$jsonData[$key1]['reason'][date('Y-m-d', strtotime($value2['date']))] =  $value2['reason'];
			}
		}
		$jsonData[$key1]['reason'] = array_values($jsonData[$key1]['reason']);
		$jsonData[$key1]['list_date'] = $arrDate;
		// Content
		$jsonData[$key1]['content_list'] =  array_combine($arrDate, $arrDate);
		if(!empty($value1['content'])) {
			foreach($value1['content'] as $key => $value) {
				$jsonData[$key1]['content_list'][$value] =  'true';
			}
		}
		$jsonData[$key1]['content_list'] = array_values($jsonData[$key1]['content_list']);
		// Evidence
		$jsonData[$key1]['evidence_list'] =  array_combine($arrDate, $arrDate);
		if(!empty($value1['evidence'])) {
			foreach($value1['evidence'] as $key => $value) {
				$key = date('Y-m-d', strtotime($key));
				$jsonData[$key1]['evidence_list'][$key] =  $value;
			}
		}
		$jsonData[$key1]['evidence_list'] = array_values($jsonData[$key1]['evidence_list']);

	}

	header("Content-Type: application/json");
	echo json_encode(['data' => $jsonData, 'summary' => ['total_user' => $total_user, 'total_evidence' => $total_evidence]]);
	exit();
?>