<?php
$this->validateGenericInputs($request, $request->table);
        $table = $this->gtc($request->table);
        $table::findOrFail($request->id)->update($request->all());
        return redirect()->route('c.db.crud.table', ['table' => $request->table]);
        ?>