<?php
$app = App::findOrFail($id);
        $invited_users = ('App\\User')::select(['id', 'name', 'email'])->whereIn('id',json_decode($app->invited_users??'[]', true))->get();
        \Log::Info(json_decode($app->invited_users??'[]', true));
        return view($this->theme.'.app.invited_users')->with([
            'id' => $id,
            'invited_users' => $invited_users,
        ]);
        ?>