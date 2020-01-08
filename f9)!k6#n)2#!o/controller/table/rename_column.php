<?php
$this->renameSchemaColumn($request->table, $request->old_field_name, $request->new_field_name);
        // $this->createModelClass($request->table);
        return ['status' => 'success'];
        ?>