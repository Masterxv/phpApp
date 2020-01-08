<!DOCTYPE html>
<html>
<head>
  <?php require($app_key.'/view/layouts/styles.html'); ?>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>
  <?php require($app_key.'/view/layouts/nav.php'); ?>
  <div class="container-fluid">
    <?php if($error['name']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['name']; ?></div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-8">
        Invited App List | <span id="active_app" style="text-align: center; word-break: break-all;">active app - id: <?php echo $active_app['id']; ?> name: <?php echo $active_app['name']; ?> secret: <?php echo $active_app['secret']; ?></span> </div>
      <div class="col-md-4">
        <div class="btn-group" style="float:right">
          <a class="btn btn-default" href="/app/app_list">My Apps</a>
          <a class="btn btn-default" href="/app/public_app_list">Public Apps</a>
          <button class="btn btn-default" data-toggle="modal" data-target="#createNewApp">Create New App</button>
        </div>
      </div>
    </div>
  	<div class="row">
  		<div class="col-md-12 table-responsive">
  			<table class="table">
  				<thead>
  					<tr>
  						<th>Sr</th>
  						<th>App Id</th>
              <th>App Name</th>
              <th>App Secret</th>
              <th>Token Lifetime</th>
  						<th colspan="2">Actions</th>
  					</tr>
  				</thead>
  				<tbody>
            <?php foreach ($apps as $k=>$app): ?>
            <tr>
              <td><?php echo  ($k + 1) + 10 * ($pageno-1); ?></td>
              <td><?php echo $app['id']; ?></td>
              <td><?php echo $app['name']; ?></td>
              <td><?php echo $app['secret']; ?></td>
              <td><?php echo $app['token_lifetime']; ?></td>
              <td><a href="JavaScript:void(0);" onclick="activate(<?php echo $app['id']; ?>, <?php echo $k; ?>)">Activate</a></td>
              <td><a href="/app/app_origins/<?php echo $app['id']; ?>">Origins</a></td>
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
  <script>
    var app_id = 0; var app_name = ""; var app_secret = "";
    function activate(id, sr){
      $.post("/app/activate", {"_token":"<?php echo $rand; ?>", "active_app_id":id}, function(data){
        if(data['status'] == "success"){
          app_id = $("tr:nth-child("+String(sr + 1)+") td:nth-child(2)").html();
          app_name = $("tr:nth-child("+String(sr + 1)+") td:nth-child(3)").html();
          app_secret = $("tr:nth-child("+String(sr + 1)+") td:nth-child(4)").html();
          $("#active_app").html("active app:- id=" + String(app_id) + " name=" + app_name + " secret=" + app_secret);
        }
      });
    }
  </script>

  <!-- Modal -->
  <div id="createNewApp" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create New App</h4>
        </div>
        <form method="post" action="/app/new_app" >
        <div class="modal-body">
            <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
            <div class="form-group">
              <label>App Name</label>
              <input type="text" name="name" class="form-control" placeholder="App Name">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Create</button>
        </div>
        </form>
      </div>

    </div>
  </div>

<?php require($app_key.'/view/layouts/scripts.html'); ?>
</body>
</html>