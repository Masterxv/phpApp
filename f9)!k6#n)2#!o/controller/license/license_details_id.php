<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/model/License.php');
include($app_key.'/model/LicenseDetail.php');

$filter = ['license_id' => $id];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(LicenseDetail::where(null,null,'visibles','count',$filter) / $no_of_records_per_page);

$licenseDetails = LicenseDetail::where($offset, $no_of_records_per_page,'visibles','sort:ORDER BY created_at',$filter);
$license_id = $id;
$license_key = License::find($id,null,'license_key');
?>

<?php 
include($app_key.'/view/license/license_detail.php');
?>