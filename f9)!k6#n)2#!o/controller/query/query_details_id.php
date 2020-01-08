<?php
$query = Query::findOrFail($id);
        $app = App::findOrFail(\Auth::user()->active_app_id);
        $commands = ['ReadAll'=>'all', 'Create'=>'new', 'Read'=>'get', 'Update'=>'mod', 'Delete'=>'del', 
        'SignUp' => 'signup', 'SendEmailVerificationCode' => 'sevc', 'VerifyEmail' => 've', 'Login' => 'login', 
        'ConditionalLogin' => 'clogin', 'RefreshToken' => 'refresh', 'FilesUpload' => 'files_upload', 'SendMail' => 'mail'
        , 'PushSubscribe' => 'ps', 'GetAppSecret' => 'secret'];
        $specials = ['pluck', 'count', 'max', 'min', 'avg', 'sum'];
        return view($this->theme.'.q.update_query')->with([
            'query'=> $query,
            'auth_providers' => json_decode($app->auth_providers,true)??[], 
            'tables' => $this->getTables(),
            'commands' => $commands,
            'specials' => $specials,
        ]);
        ?>