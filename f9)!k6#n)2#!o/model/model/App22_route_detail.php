<?php
include_once($app_key.'/model/Model.php');
class App22_route_detail extends Model
{
public static $servername = 'localhost';
public static $dbname = 'phpapp_db';
public static $username = 'root';
public static $password = 'nara';
public static $table = 'app22_route_details';
public static $fields = ['id', 'bus_name', 'price', 'from_place', 'to_place', 'start_time', 'arrival_time', 'created_at', 'updated_at'];
}
