<?php
$request->validate(['description'=>'required|string|max:65536', 'id'=>'numeric']);
        $app = App::findOrFail($request->id)->update([
            'description' => $request->description,
        ]);
        return ['status' => 'success','message'=>'description saved successfully.'];
        ?>