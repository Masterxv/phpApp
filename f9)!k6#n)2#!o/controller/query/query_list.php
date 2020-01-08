<?php
return view($this->theme.'.q.query_list')->with([
            'queries' => Query::where('app_id', \Auth::user()->active_app_id)->paginate(10), 
            'page' => $request->page??1
        ]);
        ?>