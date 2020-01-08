<?php
include($app_key.'/model/License.php');
include($app_key.'/model/LicenseDetail.php');

$status = "License key with this serial number did not match";
$license = License::find($_POST['serial_no']);
$status = ucwords($_POST['hardware_code']) == "Empty" ? "Hardware code cannot be empty" : $status;
$status = $_POST['license_no'] == 0?"License Number Cannot Be Zero":$status;
if($license['license_key'] == $_POST['license_key'] && ucwords($_POST['hardware_code']) !== "Empty" && $_POST['license_no'] >0 ){
    $licenseDetails = LicenseDetail::where(null,null,null,'sort:ORDER BY created_at',['license_id' => $license['id']]);
    if(count($licenseDetails) >  $_POST['license_no'] - 1){
        $licenseDetail = $licenseDetails[$_POST['license_no'] - 1];

        if($licenseDetail['hardware_code'] == $_POST['hardware_code']){
            LicenseDetail::update($licenseDetail['id'],null,[
                "hardware_code" => "Empty",
            ]);
            License::update($license['id'],null,[
                'activated_licenses' => $license['activated_licenses'] - 1,
            ]);
            $license = License::find($_POST['serial_no']);
            $status = "De-Activated";
        }else{
            $status = "Hardware code did not match";
        }
    }else{
        $status = "License number was incorrect.";
    }
}
header('Content-Type:application/json');
echo json_encode([
    "status" => $status,
    "available_licenses" => $license['total_licenses'] - $license['activated_licenses'],
]);
?>