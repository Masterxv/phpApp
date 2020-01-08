<?php
$desc = App::findOrFail($id)->description;
        $name = App::findOrFail($id)->name;
        return view($this->theme.'.app.app_description')->with(['name'=>$name, 'desc'=>$desc,'id'=>$id]);
        ?>