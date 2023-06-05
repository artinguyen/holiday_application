<?php
$folderName = date('Y');
$fileName = date('Ym').'.json';
//$csvFileName = date('Ym') . '.csv';
define('PRICE', 10000);
if(isset($_GET['date'])) {
    $fileName = date('Ym', strtotime($_GET['date'])).'.json';
    //$csvFileName = date('Ym', strtotime($_GET['date'])).'.csv';
}
$path = '../'. $folderName .'/'. 'recored_list_' . $fileName;
$jsonData = [];
if(file_exists($path)) {
    $jsonString = file_get_contents($path);
    $jsonData = json_decode($jsonString, true);
}
$list = [];
foreach ($jsonData as $row) {
    if(!empty($row['content'])) {
        $list[] = $row;
    }
}

header("Content-Type: application/json");
echo json_encode(['data' => $list]);
exit();
?>