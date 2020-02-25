<?php
include('env.php');
include($app_key.'/model/Query.php');

Query::validate([
    "name" => "required",
    "auth_providers" => "required",
    "tables" => "required",
    "commands" => "required",
]);

Query::update($id);
header("Location:".$app_url."/query/query_list");
?>