<?php
$folderName = date('Y');  
$fileName = date('Ym', strtotime( str_replace("/", "-", $_POST['date']))).'.json';
$path = $folderName .'/'. $fileName;

$jsonData = [];
if(file_exists($path)) {
  $jsonString = file_get_contents($path);
  $jsonData = json_decode($jsonString, true);
}
// Check validation
if(!file_exists($path) || empty($jsonData)) {
    header("Content-Type: application/json");
    echo json_encode(['error' => 'Đã xảy ra lỗi']);
    exit();
}

$sendDate = date('Y-m-d', strtotime( str_replace("/", "-", $_POST['date']) ) );
$message = '';
if($_POST['action'] == 'delete' && !empty($jsonData)) {
    foreach($jsonData as $key => $val) {
        if($val['id'] == $_POST['id'] && date('Y-m-d', strtotime($val['date'])) == $sendDate) {
            unset($jsonData[$key]);
            break;
        }   
    }
    $message = 'Đã xóa';
}

if($_POST['action'] == 'update' && !empty($jsonData)) {
    foreach($jsonData as $key => $val) {
        if($val['id'] == $_POST['id'] && date('Y-m-d', strtotime($val['date'])) == $sendDate) {
            $jsonData[$key]['reason'] = $_POST['reason'];
            $jsonData[$key]['note'] = $_POST['note'];
            break;
        }   
    }
    $message = 'Đã cập nhật';
}


$jsonData = array_values($jsonData);
$jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
// Write in the file
$fp = fopen($path, 'w');
fwrite($fp, $jsonString);
fclose($fp);
header("Content-Type: application/json");
echo json_encode(['success' => $message]);
exit();
?>