<?php
$this->validateAddColumnsRequest($request);
        $this->addColumnsSchema($request, $request->name);
        // $this->createModelClass($request->name);
        return redirect()->route('c.table.list.view');
        ?>