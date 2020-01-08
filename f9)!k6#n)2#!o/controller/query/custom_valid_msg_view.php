<?php
$rules = ValidationMessage::where('app_id', $this->app_id)->pluck('error_message','rule');
        $crules = ValidationMessage::where('app_id', null)->orWhere('app_id',0)->paginate(10);
        // $arr = $this->getValidationMessages('keys');
        // $lookup = $this->getValidationMessages();
        // $crules = Paginator::make($arr, count($arr), 10);
        // $crules = new Paginator($arr, count($arr), 10, $request->page??1, [
        //     'path'  => $request->url(),
        //     'query' => $request->query(),
        // ]);
        // \Log::Info($crules);
        return view($this->theme.'.q.custom_valid_msg')->with([
            'crules'=>$crules, 'rules'=>$rules, 'page'=>$request->page??1]);
            ?>