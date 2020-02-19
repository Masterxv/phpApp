<?php
include($app_key.'/model/App.php');
$app = App::find($id);
if($app['user_id'] != $_SESSION[$app_key]['id']){
	header('content-type:application/json');
	echo json_encode(['status' => 'un-authorized']);
}
$database = $app['name'];
$database = str_replace(' ','_',$database);

if (! $database) {
	header('content-type:application/json');
    echo json_encode(['status' => 'failed']);
}

include('env.php');
include($app_key.'/include/SqlQueries.php');
$DBUSER=$username;
$DBPASSWD=$password;
$DATABASE=$dbname2;
$TABLES=implode(' ', getRawTables($app_id));

$filename = "backup-".$database .'-'. date("d-m-Y") . ".sql";
// $mime = "application/x-gzip";

// header( "Content-Type: " . $mime );
header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

$cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE $TABLES";   // | gzip --best

passthru( $cmd );

exit(0);
?>