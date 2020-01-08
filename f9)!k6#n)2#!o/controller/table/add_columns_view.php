<?php
$fields = $this->getAfterFields($request->table);
        return view($this->theme.'.db.add_columns')->with(['fn' => $request->fn??0, 'table' => $request->table??'', 'fields' => $fields]);
        ?>