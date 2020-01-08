<?php
return view('cb.logs')->with([
            'logs' => ('App\\Log')::where('aid', $this->app_id)->latest()->paginate(10), 
            'page'=>$request->page??1
        ]);
        ?>