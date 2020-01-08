<?php
$ur = UsageReport::where(['user_id' => \Auth::user()->id])->orderBy('app_id')->paginate(10);
        return view($this->theme.'.user.usage_report')->with([
            'ur' => $ur, 
            'page' => $request->page??1,
            'size' => $this->getUserStorageFootPrint(),
        ]);
        ?>