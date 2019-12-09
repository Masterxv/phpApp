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
    <?php if($error['email']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['email']; ?></div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-6">
        Invited Users | for app id: {{$id}} 
      </div>
      <div class="col-md-6">
        <div class="btn-group" style="float:right"> 
          <button class="btn btn-default" data-toggle="modal" data-target="#inviteNewUser">Invite New User</button>
          <a class="btn btn-default" href="/app/app_list">Back</a>
        </div>
      </div>
    </div>
  	<div class="row">
  		<div class="col-md-12 table-responsive">
  			<table class="table">
  				<thead>
  					<tr>
  						<th>Sr</th>
  						<th>Invited User Name</th>
              <th>Invited User Email</th>
  						<th>Actions</th>
  					</tr>
  				</thead>
  				<tbody>
            @foreach($invited_users as $user)
            <tr id="r{{$user->id}}">
              <td>{{ ($loop->index + 1) }}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td><a href="JavaScript:void(0);" onclick="deleteUser('{{$user->id}}')">Delete</a></td>
            </tr>
            <?php endforeach; ?>
  				</tbody>
  			</table>
  		</div>
  	</div>
  </div>
  <script>
    function deleteUser(id){
      $.post("/app/delete_invited_user",{"_method":"delete","_token":"<?php echo $rand; ?>","app_id":"{{$id}}","user_id":id}, function(data, status){
        if(status == 'success'){
          $('#r'+id).remove();
          $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> User was successfully removed.</div>');
        }else{
          $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> User was not removed.</div>');
        }
      });
    }
  </script>


  <!-- Modal -->
  <div id="inviteNewUser" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <form method="post" action="/app/new_invited_user" >
        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter email address of your invitee</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="user@example.com">
              <input type="hidden" name="app_id" value="{{$id}}">
            </div>
            <p id="waiting"></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Invite</button>
        </div>
        </form>
      </div>

    </div>
  </div>

<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>