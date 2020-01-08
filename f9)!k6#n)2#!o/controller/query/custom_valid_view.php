<?php
$app_tables = $this->getTables();
        $app_fields = $this->getAppFields(['id', 'password', 'remember_token']);
        $date_fields = $this->getAppFieldsOfDataTypes(['date']);
        $rules = ValidationMessage::where('app_id', null)->pluck('rule');
        $frules = ValidationRule::where('app_id',$this->app_id)->paginate(10);
        return view($this->theme.'.q.custom_valid')->with(['tables' => $app_tables, 'fields' => $app_fields, 
            'date_fields'=>$date_fields, 'rules'=>$rules, 'frules'=>$frules, 'page'=>$request->page??1]);
            ?>