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
    <?php if($error['name']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['name']; ?></div>
    <?php endif; ?>
    <?php if($error['id']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['id']; ?></div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-8">
        Public App List | <span id="active_app" style="text-align: center; word-break: break-all;">active app - id: {{$active_app->id}} name: {{$active_app->name}} secret: {{$active_app->secret}}</span> 
      </div>
      <div class="col-md-4">
        <div class="btn-group" style="float:right">
          <a class="btn btn-default" href="/app/app_list">My Apps</a>
          <a class="btn btn-default" href="/app/invited_app_list">Invited Apps</a>
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
  						<th colspan="5">Actions</th>
  					</tr>
  				</thead>
  				<tbody>
            @foreach($apps as $app)
            <tr>
              <td>{{ ($loop->index + 1) + 10 * ($page-1)}}</td>
              <td>{{$app->id}}</td>
              <td>{{$app->name}}</td>
              <td>{{$app->secret}}</td>
              <td>{{$app->token_lifetime}}</td>
              <td><a href="/app/app_description/<?php echo $app->id; ?>">Description</a></td>
              <td><a href="JavaScript:void(0);" onclick="copyApp({{$app->id}})">Copy</a></td>
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
    var app_id = 0; var app_name = ""; var app_secret = "";var holdon = false;
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

<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>