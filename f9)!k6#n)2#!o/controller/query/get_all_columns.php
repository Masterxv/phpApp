<?php
$res = [];
        foreach ($request->tables??[] as $table) {
            $arr = $this->getFields($table, ['password', 'remember_token'], $this->app_id);
            $a = array_intersect($res, $arr);
            $b = array_diff($res, $arr);
            $c = array_diff($arr, $res);
            $res = array_merge($a, $b, $c);
        }
        return $res;
        ?>