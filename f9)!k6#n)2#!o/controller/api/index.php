<?php
include($app_key.'/model/model/'.$model.'.php');

$filter = [
	['id','!=','0']
];

if(!empty($query['filter'])){
	$filter = json_decode($query['filter'],true)??[];
}
if(!empty($query['specials'])){
	$special = $query['specials'];
}else{
	$special = null;
}

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = $_GET['no_of_records_per_page']??10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_records = $model::where(null,null,null,'count',$filter);
$total_pages = ceil($total_records / $no_of_records_per_page);

$result = $model::where($offset, $no_of_records_per_page,null,$special,$filter);

// $query = $model::query();
// $query = $this->dateFilter($_GET, $query);
// $query = $this->whereJoins($query, $joins, $table);
// $query = $this->whereFilters($query, $filters, $joins == []?'':$table);

// if( !empty($_GET['_pluck']) && in_array('pluck', $special) ){
//     $res = $query->pluck($_GET['_pluck']);
// }elseif( !empty($_GET['_count']) && in_array('count', $special) ){
//     $res = $query->count($_GET['_count']);
// }elseif( !empty($_GET['_max']) && in_array('max', $special) ){
//     $res = $query->max($_GET['_max']);
// }elseif( !empty($_GET['_min']) && in_array('min', $special) ){
//     $res = $query->min($_GET['_min']);
// }elseif( !empty($_GET['_avg']) && in_array('avg', $special) ){
//     $res = $query->avg($_GET['_avg']);
// }elseif( !empty($_GET['_sum']) && in_array('sum', $special) ){
//     $res = $query->sum($_GET['_sum']);
// }else{
//     $res = $query->get();
// }
deleteModelClass($table, $query['app_id']);
echo json_encode(["pageno"=>$pageno,"no_of_records_per_page"=>$no_of_records_per_page,"total_records"=>$total_records,"total_pages"=>$total_pages,"data"=>$result]);
?>