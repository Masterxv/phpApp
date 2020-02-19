<?php
$request=[];
foreach ($_POST as $key => $value) {
	$request[$key] = $value;
}
foreach ($_GET as $key => $value) {
	$request[$key] = $value;
}

if(empty($query_id)){
    if($request['_token']){
    	$session = Session::where(0,1,null,'first',['_token' => $request['_token']]);
        if($session){
            $app_id = $session['app_id'];
            $aid = $session['app_id'];
            $fid = $session['user_id'];
            $fap = $session['auth_provider'];
            $fname = $session['user_name'];
        }
        $this->getAuth($request['_token']);
    }else{
        $aid = $request['app_id'];
        $fap = $request['fap'];
        $fname = $request['fname']??'Guest';
    }
}else{
	$query = Query::find($query_id);
	if(empty($query)){
	    echo json_encode(['message' => 'unknown request']);exit;
	}
	$app = App::find($query['app_id']);

	$authors = explode(', ', $query['auth_providers']);
	if($request['author']){
	    if(!in_array($request['author'], $authors)){
	        echo json_encode(['message' => 'un-authorized']);exit;
	    }
	    $author = $request['author'];
	}else{
	    $author = $authors[0];
	}

	if($request['table']){
	    $tables = explode(', ', $query['tables']);
	    if(!in_array($request['table'], $tables)){
	        echo json_encode(['message' => 'un-authorized']);exit;
	    }
	}

	$commands = explode(', ', $query['commands']);
	if($request['command']){
	    $commands = explode(', ', $query['commands']);
	    if(!in_array($request['command'], $commands)){
	        echo json_encode(['message' => 'un-authorized']);exit;
	    }
	    $command = $request['command'];
	}else{
	    $command = $commands[0];
	}

	if(in_array($command, ['new','signup','ve','sevc','login','clogin','files_upload','mail','ps','prc'])){
	    if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	        echo json_encode(['message' => 'methodNotAllowed']);exit;
	    }
	}elseif($command == 'mod' || $command == 'refresh'){
	    if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	        echo json_encode(['message' => 'methodNotAllowed']);exit;
	    }
	}elseif($command == 'del'){
	    if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	        echo json_encode(['message' => 'methodNotAllowed']);exit;
	    }
	}

	if(in_array($command, ['signup','ve','sevc','login','clogin','mail'])){
	    if($app['secret'] !== $request['secret']){
	        echo json_encode(['message' => 'un-authorized']);exit;
	    }
	}elseif($command == 'secret'){
	    echo $app['secret'];exit;
	}

	// if($request['fillable']){
	//     $fillables = explode(', ', $query['fillables']);
	//     $arr = explode(',', $request['fillable']);
	//     if(array_intersect($arr, $fillables) !== $arr){
	//         return response()->json(['message' => 'un-authorized'], 401);
	//     }
	// }

	// if($request['hidden']){
	//     $hiddens = explode(', ', $query['hiddens']);
	//     $arr = explode(',', $request['hidden']);
	//     if(array_intersect($hiddens, $arr) !== $hiddens){
	//         return response()->json(['message' => 'un-authorized'], 401);
	//     }
	// }

	if($request['special']){
	    $specials = explode(', ', $query['specials']);
	    if(!in_array($request['special'], $specials)){
	        echo json_encode(['message' => 'un-authorized']);exit;
	    }
	}

	$origins = json_decode($app['origins'], true)??[];

	if(!in_array('*', $origins) && !in_array($_SERVER['HTTP_ORIGIN'], $origins) && !in_array($_SERVER['REMOTE_ADDR'], $origins)){
	    echo 'oops! something is wrong';exit;
	}

	if($author !== 'guest'){
		$session = Session::where(0,1,null,'first',['_token' => $request['_token']]);
	    if(empty($session)){
	        echo json_encode(['message' => 'token invalid']);exit;
	    }
	    if($session['expiry'] < time()){
	        echo json_encode(['message' => 'token expired']);exit;
	    }
	    if($command == 'refresh'){
	        $new_token = hash('ripemd128', rand());
	        $expiry = $app['token_lifetime'] + time();
	        Session::update($session['id'],null,['_token' => $new_token, 'expiry' => $expiry]);
	        echo $new_token;
	    }else{
	        $app_id = $session['app_id'];
	        $aid = $session['app_id'];
	        $fid = $session['user_id'];
	        $fap = $session['auth_provider'];
	        $fname = $session['user_name'];
	    }
	}
}

?>