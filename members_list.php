<?php
// function changeText($val) {
//   $val['date'] = date('d/m/Y H:i:s', strtotime($val['date']));
//   if($val['reason'] == 'Nghỉ có phép') {
//     $val['reason'] = 'OFF';
//   }
//   if($val['reason'] == 'Work From Home') {
//     $val['reason'] = 'WFH';
//   }
//   if($val['reason'] == 'Đi trễ') {
//     $val['reason'] = 'LATE';
//   }
//   $val['note'] = htmlentities($val['note']);
//   return $val;
// }
$folderName = date('Y');
$fileName = date('Ym').'.json';
$path = $folderName .'/'. $fileName;
if(empty($_GET['date'])) {
  $_GET['date'] = date('Y-m-d');
}
if(!empty($_GET['date'])) {
  $fileName = date('Ym', strtotime( str_replace("/", "-", $_GET['date']) )).'.json';
  $path = $folderName .'/'. $fileName;
  $jsonData = [];
  $recordedList = [];
  if(file_exists($path)) {
    $jsonString = file_get_contents($path);
    $jsonData = json_decode($jsonString, true);
  }

  $temp = [];
  $date = date('Y-m-d', strtotime( str_replace("/", "-", $_GET['date']) ) );
  // $dateTo = date('Y-m-d', strtotime( str_replace("/", "-", $_GET['date_to']) ) );
  // if($dateFrom > $dateTo) {
  //   $recordedList = [];
  // }
  //if(date('Y-m', strtotime($dateFrom)) == date('Y-m', strtotime($dateTo)) && $dateFrom <= $dateTo) {
    if(!empty($jsonData)) {
      foreach($jsonData as $key => $val) {
        // Option 2
        if( date('Y-m-d', strtotime($val['date'])) == $date) {
          $temp[] = $val;
        }
    
      }
      $recordedList = $temp;
    }
  //}
}
$jsonData = [];
$folderName = date('Y');
$fileName = date('Ym').'.json';
$path = $folderName .'/'. 'recored_list_' . $fileName;
//die($path);
if(file_exists($path)) {
  //die($path);
  $jsonString = file_get_contents($path);
  $jsonData = json_decode($jsonString, true);
} else {
  //die("1");
  $membersList = file_get_contents('members_list.json');
  $jsonData = json_decode($membersList, true);
}
if(empty($jsonData)) {
  $membersList = file_get_contents('members_list.json');
  $jsonData = json_decode($membersList, true);
}

//var_dump($jsonData);

foreach($jsonData as $key1 => $value1) {
  foreach($recordedList as $key2 => $value2) {
    if($value1['text'] == $value2['name'] && !empty($value2['reason'])) {
      $jsonData[$key1]['reason'] = $value2['reason'];
      break;
    }
  }

  if(!empty($value1['content']) && in_array($_GET['date'], $value1['content'])) {
    $jsonData[$key1]['content'] = 'Yes';
  }
}

header("Content-Type: application/json");
echo json_encode($jsonData);
exit();
?>