<?php
$request->validate(['app_id'=>'numeric','user_id'=>'numeric']);
        $invited_user = ('App\\User')::findOrFail($request->user_id);
        $app = App::findOrFail($request->app_id);

        $invited_apps = json_decode($invited_user->invited_apps??'[]', true);
        array_splice($invited_apps, array_search($app->id, $invited_apps),1);
        $invited_user->update(['invited_apps'=>$invited_apps?json_encode($invited_apps):null]);
        $invited_user->save();

        $invited_users = json_decode($app->invited_users??'[]', true);
        array_splice($invited_users, array_search($invited_user->id, $invited_users),1);
        $app->update(['invited_users'=>$invited_users?json_encode($invited_users):null]);
        $app->save();

        return ['message' => 'success'];
        ?>