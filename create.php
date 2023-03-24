<?php
date_default_timezone_set("Asia/Bangkok");
// Create folder
$folderName = date('Y');
if (!file_exists($folderName)) {
  mkdir($folderName, 0777, true);
}
// Create file  
$fileName = date('Ym', strtotime( str_replace("/", "-", $_POST['date']))).'.json';
$path = $folderName .'/'. $fileName;
if(!file_exists($path)) {
  fopen($fileName, "w");
}

try {
  $data = [
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'reason' => $_POST['reason'],
    'note' => $_POST['note'],
    'date' => date('Y-m-d H:i:s', strtotime( str_replace("/", "-", $_POST['date']) . date('H:i:s') ) )
  ];
  $jsonData = [];
  if(file_exists($path)) {
    $jsonString = file_get_contents($path);
    $jsonData = json_decode($jsonString, true);
  }

  if(empty($jsonData)) {
    $jsonData[] = $data;
  } else {
    $now = date('Y-m-d');
    foreach($jsonData as $key => $val) {
      if($val['name'] == $_POST['name'] && date('Y-m-d', strtotime($val['date'])) == $now) {
        header("Content-Type: application/json");
        echo json_encode(['error' => 'Đơn xin nghỉ hôm nay đã tạo trước đó rồi']);
        exit();
      }   
    }
    $jsonData[] = $data;
  }

  // Convert JSON data from an array to a string
  $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
  // Write in the file
  $fp = fopen($path, 'w');
  fwrite($fp, $jsonString);
  fclose($fp);

  header("Content-Type: application/json");
  echo json_encode(['success' => 'Application has registered successfully.']);
  exit();
} catch (\Exception $e) {
  header("Content-Type: application/json");
  echo json_encode(['error' => 'Không thể đăng ký']);
  exit();
}

?>