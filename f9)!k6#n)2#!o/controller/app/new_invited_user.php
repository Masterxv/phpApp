<?php

try{
            if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                $msg_obj = [
                    'from_name' => 'HoneyWeb.Org',
                    'from_email' => 'no_reply@honeyweb.org',
                    'subject' => 'Congratulations! you have been invited to join HoneyWeb.Org by your friend.',
                    'message' => ['title'=>'Invitation to join HoneyWeb.Org', 
                    'Click this link to signup' => url('register')],
                ];
                $invited_user = ('App\\User')::where('email',$request->email)->first();
                if(!empty($invited_user)){
                    $app = App::findOrFail($request->app_id);
                    $app_name = $app->name;
                    $app_ids = json_decode($invited_user->invited_apps??"[]",true);
                    if(in_array($app->id, $app_ids)){
                        $this->returnValidateError($request, 'email', 'email already in invited users list');
                    }
                    array_push($app_ids, $app->id);
                    $invited_user->invited_apps = json_encode($app_ids);
                    $invited_user->save();

                    $invited_users = json_decode($app->invited_users??'[]',true);
                    array_push($invited_users, $invited_user->id);
                    $app->invited_users = json_encode($invited_users);
                    $app->save();

                    $msg_obj['subject'] = 'Hi! you have been invited to work on app '.$app_name;
                    $msg_obj['message'] = ['title'=>'Invitation to work on app '.$app_name, 
                    'Click this link to login' => url('login')];
                    Mail::to($request->email)->send(new CommonMail($msg_obj));
                    return redirect()->route('c.invited.users.view',['id'=>$app->id]);
                }else{
                    Mail::to($request->email)->send(new CommonMail($msg_obj));
                    $this->returnValidateError($request, 'email', 'this email is not registered with us. invitation has been sent to signup');
                }
            }else{
                $this->returnValidateError($request, 'email', 'invalid email');
            }
        }catch(Exception $e){
            $this->returnValidateError($request, 'email', 'invalid email');
        }
        ?>