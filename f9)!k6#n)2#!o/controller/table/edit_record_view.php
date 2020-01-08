<?php
$table = $this->gtc($request->table);
        $td = $this->getDescriptions($request->table, ['created_at', 'updated_at', 'remember_token']);
        return view($this->theme.'.db.edit_record')->with([
            'td'=> $td,  
            'table'=>$request->table??'', 
            'record' => $table::findOrFail($request->id),
            'inpTyp' => $this->getInputTypeArray($td),
            'isTA' => $this->getTextAreaTypes(),
            'step' => $this->getDecimalTypes(),
        ]);
        ?>