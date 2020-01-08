<?php
$request->validate(['user_name_fields'=>'json', 'id'=>'numeric']);
        $app = App::findOrFail($request->id)->update([
            'user_name_fields' => $request->user_name_fields,
        ]);
        return ['status' => 'success','message'=>'User name fields saved successfully.'];
        ?>