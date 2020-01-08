<?php
include($app_key.'/model/App.php');
include($app_key.'/model/License.php');
include($app_key.'/model/LicenseDetail.php');
if($_POST['app_secret'] == App::find($_POST['app_id'],null,'secret')){
    $id = License::create(null,[
        'license_key' => hash('ripemd128', uniqid(rand(), true)),
        'total_licenses' => $_POST['total_licenses'],
        'activated_licenses' => 0,
        'created_by' => $_POST['app_id'],
        'expiry_date' => $_POST['expiry_date'],
        'price_id' => 0,
    ]);
    $license = License::find($id);
    for ($i = 0; $i<$_POST['total_licenses']; $i++)
    {
        LicenseDetail::create(null,[
            'license_id' => $license['id'],
            'hardware_code' => "Empty", 
            'computer_name' => "Empty", 
            'computer_user' => "Empty",
        ]);
    }
}
header('Content-Type:application/json');
echo json_encode(["serial_no" => $license['id'], "license_key" => $license['license_key']]);
?>