<?php
    $request->validate(['id'=>'numeric']);
        ValidationRule::destroy($request->id);
        return ['message' => 'validation rule was successfully deleted'];
        ?>