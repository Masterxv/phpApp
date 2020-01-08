<?php
include($app_key.'/model/License.php');
include($app_key.'/model/LicenseDetail.php');

$status = "License key with this serial number did not match";
$license_no = 0;
$license = License::find($_POST['serial_no']);
if ($license['expiry_date'] < date('Y-m-d')){
    header('Content-Type:application/json');
    echo json_encode(["status" => "License Expired"]);
}
$status = ucwords($_POST['hardware_code']) == "Empty" ? "Hardware code cannot be empty" : $status;
if($license['license_key'] == $_POST['license_key'] && ucwords($_POST['hardware_code']) !== "Empty"){ 
    if(!empty($_POST['license_no'])){
        $license_no = $_POST['license_no'];
        $licenseDetails = LicenseDetail::where(null,null,null,'sort:ORDER BY created_at',['license_id' => $license['id']]);
        if(count($licenseDetails) > $_POST['license_no'] - 1){
            $emptyLicense = $licenseDetails[$_POST['license_no']-1];
            if($emptyLicense['hardware_code'] == 'Empty'){
                LicenseDetail::update($emptyLicense['id'],null,[
                    "hardware_code" => $_POST['hardware_code'],
                    "computer_name" => $_POST['computer_name']??"Empty",
                    "computer_user" => $_POST['computer_user']??"Empty",
                ]);
                License::update($license['id'],null,[
                    'activated_licenses' => $license['activated_licenses'] + 1,
                ]);
                $license = License::find($license['id']);
                $status = "Activated";
            }else{
                header('Content-Type:application/json');
                echo json_encode(["status" => "error"]);
            }
        }else{
            $status = "No license available for this key";
        }
    }else{
        $existsLicense = LicenseDetail::where(0,1,null,'first',[
            'license_id' => $license['id'], 
            'hardware_code' => $_POST['hardware_code']
        ]);
        if(!empty($existsLicense)){
            header('Content-Type:application/json');
            echo json_encode(["status" => "error"]);
            exit;
        }
        $emptyLicense = LicenseDetail::where(0,1,null,'first',['license_id' => $license['id'], 'hardware_code' => 'Empty']);
        if(!empty($emptyLicense)){
            foreach (LicenseDetail::where(null,null,null,null,['license_id' => $license['id']]) as $key => $value) {
                if($emptyLicense['id'] == $value['id']){
                    $license_no = $key + 1;
                    break;
                }
            }
            LicenseDetail::update($emptyLicense['id'],null,[
                "hardware_code" => $_POST['hardware_code'],
                "computer_name" => $_POST['computer_name']??"Empty",
                "computer_user" => $_POST['computer_user']??"Empty",
            ]);
            License::update($license['id'],null,[
                'activated_licenses' => $license['activated_licenses'] + 1,
            ]);
            $license = License::find($license['id']);
            $status = "Activated";
        }else{
            $status = "No license available for this key";
        }
    }
}
header('Content-Type:application/json');
echo json_encode([
    "status" => $status, 
    "expiry_date" => $license['expiry_date'], 
    "license_no" => $license_no,
    "available_licenses" => $license['total_licenses'] - $license['activated_licenses'],
]);
?>