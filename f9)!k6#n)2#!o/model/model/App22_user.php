<?php
include_once($app_key.'/model/Model.php');
class App22_user extends Model
{
public static $servername = 'localhost';
public static $dbname = 'phpapp_db';
public static $username = 'root';
public static $password = 'nara';
public static $table = 'app22_users';
public static $fields = ['id', 'name', 'email', 'password'];
}
