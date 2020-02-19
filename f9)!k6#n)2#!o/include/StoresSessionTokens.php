<?php

public function createSessionToken($request, $app_id, $author, $user_id, $user_name)
{
    \Log::Info($this->fc.'createSessionToken');
    $new_token = bcrypt(rand());
    $expiry = App::findOrFail($this->app_id)->token_lifetime + time();
    Session::create([
        '_token' => $new_token, 
        'expiry' => $expiry,
        'app_id' => $app_id,
        'user_id' => $user_id,
        'auth_provider' => $author,
        'user_name' => $user_name,
        'user_agent' => $request->header('User-Agent'),
        'ip_address' => request()->ip(),
    ]);
    
    return $new_token;
}

public function refreshSessionToken($token, $token_lifetime)
{
    \Log::Info($this->fc.'refreshSessionToken');
    $session = Session::where('_token', $token)->first();
    if(empty($session)){
        return response()->json(['message' => 'token invalid'], 401);
    }
    if($session->expiry < time()){
        return response()->json(['message' => 'token expired'], 401);
    }else{
        $new_token = bcrypt(rand());
        $expiry = $token_lifetime + time();
        $session->update(['_token' => $new_token, 'expiry' => $expiry]);
        $session->save();
        return $new_token;
    }
}

public function checkSessionToken($token)
{
    \Log::Info($this->fc.'checkSessionToken');
    $session = Session::where('_token', $token)->first();
    if(empty($session)){
        return response()->json(['message' => 'token invalid'], 401);
    }
    if($session->expiry < time()){
        return response()->json(['message' => 'token expired'], 401);
    }
    $this->app_id = $session->app_id;
    $this->aid = $session->app_id;
    $this->fid = $session->user_id;
    $this->fap = $session->auth_provider;
    $this->fname = $session->user_name;
    return $session->app_id;
}

public function getAuth($token)
{
    \Log::Info($this->fc.'getAuth');
    $session = Session::where('_token',$token)->first();
    if($session){
        $this->app_id = $session->app_id;
        $this->aid = $session->app_id;
        $this->fid = $session->user_id;
        $this->fap = $session->auth_provider;
        $this->fname = $session->user_name;
    }
}
?>