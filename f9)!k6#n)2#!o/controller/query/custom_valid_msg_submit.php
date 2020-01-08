<?php
$request->validate([
            'rule'=>'max:255', 
            'error_message'=>'max:255'
        ]);
        $error = ValidationMessage::firstOrCreate(['app_id' => $this->app_id, 'rule' => $request->rule]);
        if(!empty($request->error_message)){
            $error->update(['error_message' => $request->error_message]);
            $error->save();
        }else{
            $error->delete();
        }
        return ['status'=>'success', 'message' => 'custom error message added successfully.'];
        ?>