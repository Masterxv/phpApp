<?php
include('env.php');
include($app_key.'/model/Query.php');

Query::validate([
    "name" => "required",
    "auth_providers" => "required",
    "tables" => "required",
    "commands" => "required",
]);

Query::update($id,null,[
    "name" => $_POST['name'],
    "auth_providers" => $_POST['auth_providers'],
    "tables" => $_POST['tables'],
    "commands" => $_POST['commands'],
    "fillables" => $_POST['fillables'],
    "hiddens" => $_POST['hiddens'],
    "mandatory" => $_POST['mandatory'],
    "joins" => $_POST['joins'],
    "filters" => $_POST['filters'],
    "specials" => $_POST['specials'],
]);
header("Location:".$app_url."/query/query_list");
?>