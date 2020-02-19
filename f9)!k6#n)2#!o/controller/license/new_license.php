<?php
include($app_key.'/model/License.php');
include($app_key.'/model/LicenseDetail.php');
$id = License::create(null,[
    'license_key' => hash('ripemd128', uniqid(rand(), true)),
    'total_licenses' => $_POST['total_licenses'],
    'activated_licenses' => 0,
    'created_by' => $_SESSION[$app_key]['active_app_id'],
    'expiry_date' => $_POST['expiry_date'],
    'price_id' => 0,
]);
for ($i = 0; $i<$_POST['total_licenses']; $i++)
{
    LicenseDetail::create(null,[
        'license_id' => $id,
        'hardware_code' => "Empty", 
        'computer_name' => "Empty", 
        'computer_user' => "Empty",
    ]);
}
header("Location: $app_url/license/license_list");
?>