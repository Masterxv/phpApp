<?php
try{
    if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
        if(empty(('App\\User')::where('email',$request->email)->first())){
            $invite_url = url('register');
            Mail::to($request->email)->send(new CommonMail([
                'from_name' => 'HoneyWeb.Org',
                'from_email' => 'no_reply@honeyweb.org',
                'subject' => 'Congratulations! you have been invited to join HoneyWeb.Org by your friend.',
                'message' => ['title'=>'Invitation to join HoneyWeb.Org', 
                'Click this link to signup' => $invite_url],
            ]));
            return ['status' => 'success', 'message' => 'invitation sent to your friend'];
        }else{
            return ['status' => 'warning', 'message' => 'this email is already registered with us'];
        }
    }else{
        return ['status' => 'failed', 'message' => 'invalid email'];
    }
}catch(Exception $e){
    return ['status' => 'failed', 'message' => 'invalid email'];
}
?>