<?php
function changeText($val) {
  //$val['date'] = date('H:i:s', strtotime($val['date']));
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
$fileName = date('Ym').'.json';
$path = $folderName .'/'. $fileName;
if(empty($_GET['date_from']) && empty($_GET['date_to'])) {
  $_GET['date_from'] = date('Y-m-d');
  $_GET['date_to'] = date('Y-m-d');
}
if(!empty($_GET['date_from']) && !empty($_GET['date_to'])) {
  $fileName = date('Ym', strtotime( str_replace("/", "-", $_GET['date_from']) )).'.json';
  $path = $folderName .'/'. $fileName;
  $jsonData = [];
  if(file_exists($path)) {
    $jsonString = file_get_contents($path);
    $jsonData = json_decode($jsonString, true);
  }

  $temp = [];
  $dateFrom = date('Y-m-d', strtotime( str_replace("/", "-", $_GET['date_from']) ) );
  $dateTo = date('Y-m-d', strtotime( str_replace("/", "-", $_GET['date_to']) ) );
  if($dateFrom > $dateTo) {
    $jsonData = [];
  }
  if(date('Y-m', strtotime($dateFrom)) == date('Y-m', strtotime($dateTo)) && $dateFrom <= $dateTo) {
    if(!empty($jsonData)) {
      foreach($jsonData as $key => $val) {
        // Option 1
        /*
        if($type == 'day' && date('Ymd', strtotime($_GET['date'])) == date('Ymd', strtotime($val['date']))) {
          $temp[] = changeText($val);
        }
    
        if($type == 'month' && date('Ym', strtotime($_GET['date'])) == date('Ym', strtotime($val['date']))) {
          $temp[] = changeText($val);
        }
    
        if($type == 'week' && date('W', strtotime($_GET['date'])) == date('W', strtotime($val['date']))) {
          $temp[] = changeText($val);
        }
        */
        //var_dump($dateFrom, $dateTo);die();
        // Option 2
        if( date('Y-m-d', strtotime($val['date'])) >= $dateFrom && date('Y-m-d', strtotime($val['date'])) <= $dateTo) {
          $temp[] = changeText($val);
        }
    
      }
      $jsonData = $temp;
    }
  }

  if(date('Y-m', strtotime($dateFrom)) != date('Y-m', strtotime($dateTo)) && $dateFrom <= $dateTo) {
    // Date from
    $fileName = date('Ym', strtotime( str_replace("/", "-", $_GET['date_from']) )).'.json';
    $path = $folderName .'/'. $fileName;
    if(file_exists($path)) {
      $jsonString = file_get_contents($path);
      $jsonData = json_decode($jsonString, true);
    }
    if(!empty($jsonData)) {
      foreach($jsonData as $key => $val) {
        if( date('Y-m-d', strtotime($val['date'])) >= $dateFrom ) {
          $temp[] = changeText($val);
        }
    
      }
    }
    // Date to
    $fileName = date('Ym', strtotime( str_replace("/", "-", $_GET['date_to']) )).'.json';
    $path = $folderName .'/'. $fileName;
    if(file_exists($path)) {
      $jsonString = file_get_contents($path);
      $jsonData = json_decode($jsonString, true);
    }
    if(!empty($jsonData)) {
      foreach($jsonData as $key => $val) {
        if( date('Y-m-d', strtotime($val['date'])) <= $dateTo ) {
          $temp[] = changeText($val);
        }
    
      }
    }
    $jsonData = $temp;
  }
} else {
  $jsonString = file_get_contents($path);
  $jsonData = json_decode($jsonString, true);
  $temp = [];
  $jsonData = $temp;
}
header("Content-Type: application/json");
echo json_encode($jsonData);
exit();
?>