<?php
if(!empty($request->id)){
            $table::destroy($request->id);
        }
        return ['status' => 'success'];
        ?>