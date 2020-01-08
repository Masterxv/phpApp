<?php
$table = $this->gtc($request->table);
        $table::truncate();
        return ['status' => 'success'];
        ?>