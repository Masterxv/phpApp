<?php
$rh = RechargeHistory::where(['user_id' => \Auth::user()->id])->paginate(10);
        return view($this->theme.'.user.recharge_history')->with([
            'rh' => $rh, 
            'page' => $request->page??1,
        ]);
        ?>