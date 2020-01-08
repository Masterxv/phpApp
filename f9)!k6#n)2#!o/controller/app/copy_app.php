<?php
$request->validate(['id'=>'required|numeric']);
        $app = App::findOrFail($request->id)->replicate();
        $app->user_id = \Auth::user()->id;
        $app->availability = 'Private';
        $app->secret = bcrypt(uniqid(rand(), true));
        $app->save();
        \Auth::user()->active_app_id = $app->id;
        \Auth::user()->save();
        $this->copyTables($app->id, $request->id);
        $this->copyQueries($app->id, $request->id);
        return ['status' => 'success','message'=>'app copied successfully.'];
        ?>