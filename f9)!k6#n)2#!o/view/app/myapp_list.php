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
    <div id="alrt"></div>
    <?php if($error['name']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['name']; ?></div>
    <?php endif; ?>
    <?php if($error['id']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['id']; ?></div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-9">
        <div class="well well-sm"> My App List | <span id="active_app" style="text-align: center; word-break: break-all;">active app - id: <?php echo $active_app['id']; ?> name: <?php echo $active_app['name']; ?> secret: <?php echo $active_app['secret']; ?></span> </div>
      </div>
      <div class="col-md-3">
        <div class="btn-group" style="float:right;">
          <a class="btn btn-default" href="/app/invited_app_list">Invited Apps</a>
          <a class="btn btn-default" href="/app/public_app_list">Public Apps</a>
          <button class="btn btn-default" data-toggle="modal" data-target="#createNewApp">Create New App</button>
        </div>
      </div>
    </div>
  	<div class="row">
  		<div class="col-md-12">
        <div class="well well-sm table-responsive">
    			<table class="table">
    				<thead>
    					<tr>
    						<th>Sr</th>
    						<th>App Id</th>
                <th>App Name</th>
                <!-- <th>App Secret</th> -->
                <th>Token Lifetime</th>
                <th>Availability</th>
    						<th colspan="5">Actions</th>
    					</tr>
    				</thead>
    				<tbody>
              <?php foreach ($apps as $k => $app): ?>
              <tr id="r<?php echo $app['id']; ?>">
                <td><?php echo  ($k + 1) + 10 * ($pageno-1); ?></td>
                <td><?php echo $app['id']; ?></td>
                <td><?php echo $app['name']; ?></td>
                <!-- <td style="word-break: break-word"><?php echo $app['secret']; ?></td> -->
                <td><?php echo $app['token_lifetime']; ?></td>
                <td><?php echo $app['availability']; ?></td>
                <td><a href="JavaScript:void(0);" onclick="activate(<?php echo $app['id']; ?>)">Activate</a></td>
                <td><a href="JavaScript:void(0);" onclick="updateApp(<?php echo $app['id']; ?>, <?php echo $k; ?>)">Update</a></td>
                <td><a href="/app/app_user_name_fields/<?php echo $app['id']; ?>">User Fields</a></td>
                <td><a href="/app/app_origins/<?php echo $app['id']; ?>">Origins</a></td>
                <td><a href="/app/invited_users/<?php echo $app['id']; ?>">Invited Users</a></td>
                <td><a href="/app/sql/<?php echo $app['id']; ?>">ExportDB</a></td>
                <td><a href="/app/app_description/<?php echo $app['id']; ?>">Description</a></td>
                <td><a href="JavaScript:void(0);" onclick="copyApp(<?php echo $app['id']; ?>)">Copy</a></td>
                <td><a href="JavaScript:void(0);" onclick="deleteApp(<?php echo $app['id']; ?>)">Delete</a></td>
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
  </div>
  <script>
    var app_id = 0; var app_name = ""; var app_secret = "";var holdon = false;
    function activate(id, sr){
      $.post("/app/activate", {"_token":"<?php echo $rand; ?>", "active_app_id":id}, function(data,status){
        if(status == "success"){
          window.location = window.location.href;
        }
      });
    }
    function updateApp(id, sr){
      $(".app_id").val(id);
      $("input[name='new_app_name']").val($("tr:nth-child("+String(sr + 1)+") td:nth-child(3)").html());
      $("input[name='token_lifetime']").val($("tr:nth-child("+String(sr + 1)+") td:nth-child(5)").html());
      $("#updateMyApp").modal();
    }
    function copyApp(id) {
      if(holdon){return;}
      holdon = true;
      $.post("/app/copy_app",{'_token':'<?php echo $rand; ?>','id':id},function(data){
        if(data['status'] == 'success'){
          $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> App was successfully copied.</div>');
        }else{
          $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> App was not copied.</div>');
        }
        document.getElementById("alrt").scrollIntoView();
        location.replace(window.location.href);
      });
    }
    function deleteApp(id){
      if(!confirm("Deleting app will delete all its assosiated tables and queries. Please confirm!")){
        return;
      }
      $.post("/app/delete",{'_token':'<?php echo $rand; ?>','id':id,'_method':'delete'},function(data){
        if(data['status'] == 'success'){
          $('#r'+id).remove();
          $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> App was successfully deleted.</div>');
        }else{
          $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> App was not deleted.</div>');
        }
        document.getElementById("alrt").scrollIntoView();
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

  <!-- Modal -->
  <div id="updateMyApp" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <form method="post" action="/app/update">
          <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
          <input type="hidden" name="id" class="app_id" />
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change My App Details</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>New app name</label>
              <input type="text" name="new_app_name" class="form-control">
            </div>
            <div class="form-group">
              <label>New token liftime (seconds)</label>
              <input type="number" name="token_lifetime" class="form-control">
            </div>
            <div class="form-group">
              <label>Availability</label>
              <select name="availability" class="form-control"><option>Private</option><option>Public</option></select>
            </div>
            <div class="form-group">
              <input type="checkbox" name="request_new_secret" ><label>Request New Secret</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Update</button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <!-- Modal -->
  <div id="deleteMyApp" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirm App Deletion</h4>
        </div>
        <div class="modal-body">
          <p>Note that this action will delete all app database tables and settings permanently.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="deleteMyApp()">Delete</button>
        </div>
      </div>

    </div>
  </div>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>