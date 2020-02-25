<?php
include($app_key.'/model/File.php');
include($app_key.'/model/model/'.$model.'.php');

include('env.php');
$target_dir = $target_dir??$files_folder;
$target_files =[];
foreach ($_FILES['files']['name'] as $key => $fname) {
    $file_name=basename($fname);
    $imageFileType=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $target_file=$target_dir . bin2hex(openssl_random_pseudo_bytes(32)) . '.' . $imageFileType;
    move_uploaded_file($_FILES['files']['tmp_name'][$key], $_SERVER['DOCUMENT_ROOT'].$target_file);
    File::create(null,[
        'app_id' => $query['app_id'],
        'name' => $fname,
        'mime' => $_FILES['files']['type'][$key],
        'size' => $_FILES['files']['size'][$key],
        'path' => $target_file,
    ]);
    $target_files[]=$target_file;
}
echo json_encode($target_files);exit;
?>