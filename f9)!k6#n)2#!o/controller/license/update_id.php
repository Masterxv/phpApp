<?php
include($app_key.'/model/License.php');
include($app_key.'/model/LicenseDetail.php');
$license = License::find($id);
if($_POST['total_licenses'] < $license['total_licenses'] ){
    header("Location: $app_url/license/license_list");
}
if($license['total_licenses'] < $_POST['total_licenses']){
    for ($i = 0; $i<$_POST['total_licenses'] - $license['total_licenses']; $i++)
    {
        LicenseDetail::create(null,[
            'license_id' => $license['id'],
            'hardware_code' => "Empty", 
            'computer_name' => "Empty", 
            'computer_user' => "Empty",
        ]);
    }
}
License::update($license['id'],null,[
    'total_licenses' => $_POST['total_licenses'],
    'expiry_date' => $_POST['expiry_date'],
]);
header("Location: $app_url/license/license_list");
?>