<?php
try{
    if(filter_var($request->avatar, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)){
        \Auth::user()->avatar = $request->avatar;
        \Auth::user()->save();
        return ['status' => 'success', 'message' => 'Avatar added successfully'];
    }else{
        return ['status' => 'failed', 'message' => 'Avatar url not valid'];
    }
}catch(Exception $e){
    return ['status' => 'failed', 'message' => 'Avatar url not valid'];
}
?>