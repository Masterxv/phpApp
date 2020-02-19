<?php
include('env.php');
include($app_key.'/model/Query.php');
Query::validate([
    "name" => "required",
    "auth_providers" => "required",
    "tables" => "required",
    "commands" => "required",
]);
Query::create(null,[
    "app_id" => $_SESSION[$app_key]['active_app_id'],
    'name' => $_POST['name'],
    "auth_providers" => $_POST['auth_providers'],
    "tables" => $_POST['tables'],
    "commands" => $_POST['commands'],
    "fillables" => $_POST['fillables']??null,
    "hiddens" => $_POST['hiddens']??null,
    "mandatory" => $_POST['mandatory']??null,
    "joins" => $_POST['joins']??null,
    "filters" => $_POST['filters']??null,
    "specials" => $_POST['specials']??null,
]);
header("Location:".$app_url."/query/query_list");
?>