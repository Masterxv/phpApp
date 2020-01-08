<?php
$request->validate(['id'=>'required|numeric']);
        $first_app = App::where('user_id', \Auth::user()->id)->first();
        if(empty($first_app)){
            return ['status'=>'warning', 'message'=>'atleast one app is required.'];
        }
        \Auth::user()->active_app_id = $first_app->id;
        \Auth::user()->save();
        App::destroy($request->id);
        $this->deleteTables($request->id);
        $this->deleteQueries($request->id);
        return ['status' => 'success','message'=>'app deleted successfully.'];
        ?>