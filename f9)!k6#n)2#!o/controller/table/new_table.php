<?php
$this->validateCreateTableRequest($request);
        $table_name = strtolower(str_replace(' ','_',$request->name));
        $this->createTableSchema($request, $table_name);
        // $this->createModelClass($table_name, $request->model == "authenticatable");
        if($request->model == "authenticatable"){
            $this->addUserTypeToApp($table_name);
        }
        return redirect()->route('c.table.list.view');
        ?>