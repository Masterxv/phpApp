<?php
include_once($app_key.'/model/Model.php');
class App6_setting extends Model
{
public static $servername = 'localhost';
public static $dbname = 'phpapp_db';
public static $username = 'root';
public static $password = 'nara';
public static $table = 'app6_settings';
public static $fields = ['id', 'social_media', 'sellable_properties', 'rentable_properties', 'bhk', 'sites', 'commercial_properties', 'pot_bhk', 'pot_sites', 'pot_commercial_properties', 'sell_prices', 'rent_prices', 'price_units', 'land_units', 'land_per_unit', 'member_types', 'member_works', 'messages', 'created_at', 'updated_at'];
}
