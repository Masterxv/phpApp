<?php
$this->renameTableSchema($request->table, $request->new_name);
        $this->removeUserTypeFromApp($request->table, $request->new_name);
        // $return = $this->deleteModelClass($request->table);
        // $this->createModelClass($request->new_name);
        return redirect()->route('c.table.list.view');
        ?>