<!DOCTYPE html>
<html>
<head>
  <?php require($app_key.'/views/layouts/styles.html'); ?>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>
<?php require($app_key.'/views/layouts/nav.php'); ?>
<div class="container-fluid">
    <div id="alrt"></div>
    <div class="row">
        <div class="col-md-12">
            Log | for the app id: <?php echo \Auth::user()->active_app_id; ?><div class="btn-group" style="float:right"></div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Sr</th>
            <th>User Id</th>
            <th>User AP</th>
            <th>Query Id</th>
            <th>Author</th>
            <th>Query Nick Name</th>
            <th>Table</th>
            <th>Command</th>
            <th>IP Address</th>
            <th>DateTime</th>
					</tr>
				</thead>
				<tbody>
          @foreach($logs as $log)
          <tr>
            <td><?php echo  ($loop->index + 1) + 10 * ($page-1); ?></td>
            <td><?php echo $log->fid; ?></td>
            <td><?php echo $log->fap; ?></td>
            <td><?php echo $log->qid; ?></td>
            <td><?php echo $log->auth_provider; ?></td>
            <td><?php echo $log->query_nick_name; ?></td>
            <td><?php echo $log->table_name; ?></td>
            <td><?php echo $log->command; ?></td>
            <td><?php echo $log->ip; ?></td>
            <td><?php echo $log->created_at; ?></td>
          </tr>
          <?php endforeach; ?>
				</tbody>
			</table>
		</div>
    <div class="col-md-12">
      <?php include($app_key.'/layouts/pagination.php') ?>
    </div>
	</div>
</div>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>