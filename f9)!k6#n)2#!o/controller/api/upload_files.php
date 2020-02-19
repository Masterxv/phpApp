<?php
include($app_key.'/model/File.php');
include($app_key.'/model/model/'.$model.'.php');
// $this->validateGenericInputs($request, $author, true);
$files = $model::upload_files();
$files = json_decode($model::find(null,null,'file_paths'),true)??[];
$files = array_merge($files,$new_files);
$model::update(null,null,['file_paths' => json_encode($files)]);

    foreach ($files as $key => $file) {
        $res[] = File::create(null,[
            'app_id' => $query['app_id'],
            'name' => $file->getClientOriginalName(),
            'mime' => $file->getMimeType(),
            'size' => $file->getSize(),
            'path' => env('APP_URL').str_replace('public','/public/storage',$path),
        ]);
    }

return $res;
?>