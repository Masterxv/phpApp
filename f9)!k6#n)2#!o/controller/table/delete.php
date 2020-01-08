<?php
Schema::connection($this->con)->table($this->table($request->table), function (Blueprint $table){
            $table->drop();
        });
        $this->removeUserTypeFromApp($request->table);
        return ['status' => 'success'];
        ?>