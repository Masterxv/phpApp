<?php
$this->validateGenericInputs($request, $request->table);
        $table = $this->gtc($request->table);
        $table::create($request->all());
        return redirect()->route('c.db.crud.table', ['table' => $request->table]);
        ?>