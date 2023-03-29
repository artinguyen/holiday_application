<?php
$folderName = date('Y');
$id = $_POST['id'];
$date =  date('Ymd', strtotime( str_replace("/", "-", $_POST['date']) ) );
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
if($_FILES['evidence'])
{
    $img = $_FILES['evidence']['name'];
    $tmp = $_FILES['evidence']['tmp_name'];
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $fileName = $date.'_'.$id.'.'.$ext;
    $message = '';
    if(!in_array($ext, $valid_extensions)) 
    {
        $message = 'Chỉ chấp nhận file ảnh';
    }
    if (($_FILES["evidence"]["size"] > 3000000)) {

        $message = 'Kích thước file quá lớn';
    }
    if(!empty($message))
    {
        header("Content-Type: application/json");
        echo json_encode(['status' => 'error', 'message' => $message]);
        exit();
    }

    try{
        $path = '../uploads/'.$fileName;
        //if(move_uploaded_file($tmp,$path))
        if(compressImage($tmp, $path, 50))
        {
            $folderName = date('Y');
            $info =  date('Ym', strtotime( str_replace("/", "-", $_POST['date']) ) );
            $path = '../'. $folderName .'/'. 'recored_list_' . $info .'.json';
            $jsonString = file_get_contents($path);
            $jsonData = json_decode($jsonString, true);
            foreach($jsonData as $key => $val) {
                if( $id == $val['id'] ) {
                    $val['evidence'][$date] = $fileName;
                    $jsonData[$key] = $val;
                }
            }

            $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
            // Write in the file
            $fp = fopen($path, 'w');
            fwrite($fp, $jsonString);
            fclose($fp);

            header("Content-Type: application/json");
            echo json_encode(['status' => 'success', 'message' => 'Upload file thành công']);
            exit();
        }
    } catch (\Exception $e) {
        header("Content-Type: application/json");
        echo json_encode(['status' => 'error', 'message' => 'An error occurred']);
        exit();
    }
}

// Compress image
function compressImage($source, $destination, $quality) {
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg')  {
        $image = imagecreatefromjpeg($source);
    } elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    }
    imagejpeg($image, $destination, $quality);
    return true;
}
?>