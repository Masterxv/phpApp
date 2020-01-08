<?php
if($request->cmd == 'Add'){
            $request->validate(['field'=>'required|max:255', 'rule'=>'required|max:255']);
            $id = ValidationRule::firstOrCreate(['app_id' => $this->app_id, 'field' => $request->field])->id;
            ValidationRule::findOrFail($id)->update(['rule' => $request->rule]);
        }else if($request->cmd == 'Edit'){
            $request->validate(['rule_id'=>'required|numeric|max:4294967295']);
            ValidationRule::findOrFail($request->rule_id)->update(['rule' => $request->rule]);
        }
        return redirect()->route('c.query.valid.view');
        ?>