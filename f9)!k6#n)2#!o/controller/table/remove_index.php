<?php
$this->removeIndexFromSchemaColumn($request->table, $request->field_name, $request->index_name);
        return ['status' => 'success'];
        ?>