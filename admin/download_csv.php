<?php
$folderName = date('Y');
$fileName = date('Ym').'.json';
$csvFileName = date('Ym') . '.csv';
define('PRICE', 10000);
if(isset($_GET['date'])) {
    $fileName = date('Ym', strtotime($_GET['date'])).'.json';
    $csvFileName = date('Ym', strtotime($_GET['date'])).'.csv';
}
$path = '../'. $folderName .'/'. 'recored_list_' . $fileName;
$jsonData = [];
if(file_exists($path)) {
    $jsonString = file_get_contents($path);
    $jsonData = json_decode($jsonString, true);
}

header('Content-Disposition: attachment; filename="'.$csvFileName.'";');
header('Content-Type: application/csv; charset=UTF-8');
//$f = fopen($filename, 'w');
$f = fopen('php://output', 'w');
$line = ['Họ và tên', 'Team', 'Số lần bị phạt', 'Thành tiền'];
fputcsv($f, $line);
if(empty($jsonData)) {
    exit();
}
foreach ($jsonData as $row) {
    if(!empty($row['content'])) {
        $line = [$row['text'], $row['team'], count($row['content']), count($row['content']) * PRICE];
	    fputcsv($f, $line);
    }
}
exit();
//fclose($f);
?>