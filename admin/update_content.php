<?php
	$folderName = date('Y');
	if(!empty($_POST['date'])) {
		$fileName = date('Ym', strtotime( str_replace("/", "-", $_POST['date']) )).'.json';
		$path = '../' . $folderName .'/'. 'recored_list_' . $fileName;
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

		$id = $_POST['id'];
		foreach($jsonData as $key => $val) {
			if( $id == $val['id'] ) {
			$val['content'][] = $_POST['date'];
			$jsonData[$key] = $val;
			}
		}
		// Convert JSON data from an array to a string
		$jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
		// Write in the file
		$fp = fopen($path, 'w');
		fwrite($fp, $jsonString);
		fclose($fp);
		header("Content-Type: application/json");
		echo json_encode(['success' => 'Cập nhật thành công']);
		exit();
	}

	header("Content-Type: application/json");
	echo json_encode(['error' => 'An error occurred']);
	exit();
?>