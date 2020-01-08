<?php
$td = $this->getDescriptions($request->table, ['id', 'created_at', 'updated_at', 'remember_token']);
        return view($this->theme.'.db.add_record')->with([
            'td'=> $td, 
            'table'=>$request->table??'',
            'inpTyp' => $this->getInputTypeArray($td),
            'isTA' => $this->getTextAreaTypes(),
            'step' => $this->getDecimalTypes(),
        ]);
        ?>