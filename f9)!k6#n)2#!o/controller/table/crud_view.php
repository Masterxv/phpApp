<?php
$td = $this->getDescriptions($request->table, []);
        $table = $this->gtc($request->table);
        $records = $table::where('id','!=',0);
        foreach ($td as $key => $value) { 
            $records = empty($request->{$value->Field})?$records:$records->where($value->Field,'LIKE','%'.$request->{$value->Field}.'%');
        }
        $records = $this->dateFilter($request, $records);
        $records = $this->whereFilters($records, $request->_f?explode('|', $request->_f):[]);
        $records = $records->paginate(10);
        return view($this->theme.'.db.crud')->with([
            'td'=>$td??[], 
            'table'=>$request->table??'', 
            'records' => $records??[],
            'inpTyp' => $this->getInputTypeArray($td),
            'isTA' => $this->getTextAreaTypes(),
        ]);
        ?>