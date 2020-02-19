<?php
include_once($app_key.'/model/Model.php');
class App22_bus_detail extends Model
{
public static $servername = 'localhost';
public static $dbname = 'phpapp_db';
public static $username = 'root';
public static $password = 'nara';
public static $table = 'app22_bus_details';
public static $fields = ['id', 'bus_name', 'bus_regi_number', 'bus_type', 'maximum_seats', 'start_point', 'end_point', 'start_time', 'end_time'];
}
