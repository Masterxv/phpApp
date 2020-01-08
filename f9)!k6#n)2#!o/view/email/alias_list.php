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
      My Alias List | for the user id: <?php echo \Auth::user()->id; ?>
    </div>
    <div class="col-md-6">
        <div class="btn-group" style="float:right;position: relative;">
          <button class="btn btn-default" data-toggle="modal" data-target="#newAlias">Add New Alias Email</button>
          <a class="btn btn-default" href="/email/mail_list">Back</a>
        </div>
    </div>
  </div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Sr</th>
						<th>Alias Email</th>
            <th>Verification Status</th>
            <th>Delete</th>
					</tr>
				</thead>
				<tbody>
          <?php foreach ($aliases as $key => $alias): ?>
          <tr id="r<?php echo $alias->id; ?>">
            <td><?php echo  ($key + 1) + 10 * ($page-1); ?></td>
            <td><?php echo  $alias->email ; ?></td>
            <?php if($alias->verified == 'done'): ?>
            <td>verified</td>
            <?php else: ?>
            <td id="v<?php echo $alias->id; ?>"><a style="cursor: pointer;" onclick="vc('<?php echo $alias->id; ?>')">verify code</a></td>
            <?php endif; ?>
            <td><a href="JavaScript:void(0);" onclick="d('<?php echo $alias->id; ?>')">Delete</a></td>
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
  function vc(id){
    var code = prompt("Enter the 6 digit varification code");
    $.post("/email/alias_verify", {"_token":"<?php echo $rand; ?>", "id":id, "code":code}, function (data) {
      if(data['status'] == 'success'){
        $('#v'+id).html('verified');
        $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> Alias email address was successfully verified.</div>');
      }else{
        $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> Alias email address was not verified.</div>');
      }
    })
  }
  function d(id) {
    $.post("/email/alias_delete", {'_token':"<?php echo $rand; ?>", "id":id, '_method':"DELETE"}, function (data) {
      if(data['status'] == 'success'){
        $('#r'+id).remove();
        $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> Alias email address was successfully deleted.</div>');
      }else{
        $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> Alias email address was not deleted.</div>');
      }
    })
  }
</script>


<!-- Modal -->
<div id="newAlias" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form method="post" action="/email/alias_new">
      <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter alias name</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="user@gmail.com">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Add</button>
      </div>
      </form>
    </div>

  </div>
</div>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>