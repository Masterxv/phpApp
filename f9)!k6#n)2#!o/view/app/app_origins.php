<!DOCTYPE html>
<html>
<head>
  <?php require($app_key.'/view/layouts/styles.php'); ?>
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
    <div class="row">
      <div class="col-md-6">
        App Origins | for app id: <?php echo $id; ?> 
      </div>
      <div class="col-md-6">
        <div class="btn-group" style="float:right"> 
          <button class="btn btn-default" data-toggle="modal" data-target="#addNewOrigin">Add New Origin</button>
          <a class="btn btn-default" href="/app/app_list">Back</a>
        </div>
      </div>
    </div>
  	<div class="row">
  		<div class="col-md-12 table-responsive">
  			<table class="table">
          <caption>For website application add origin website name / for web servers add ip address / for all applications add * </caption>
  				<thead>
  					<tr>
  						<th>Sr</th>
  						<th>Origin</th>
  						<th colspan="2">Actions</th>
  					</tr>
  				</thead>
  				<tbody>
            <?php foreach ($origins as $k => $origin): ?>
            <tr id="r<?php echo $k+1; ?>">
              <td><?php  echo ($k + 1);  ?></td>
              <td><?php echo $origin; ?></td>
              <td><a href="JavaScript:void(0);" onclick="deleteOrigin('<?php echo $origin; ?>', '<?php echo $k+1; ?>')">Delete</a></td>
            </tr>
            <?php endforeach; ?>
  				</tbody>
  			</table>
  		</div>
  	</div>
  </div>
  <script>
    function deleteOrigin(name, i){
      $.post("/app/delete_origin/<?php echo $id; ?>",{"_token":"<?php echo $rand; ?>","name":name,"_method":"delete"}, function(data,status){
        if(status == 'success'){
          $('#r'+i).remove();
          $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> Origin was successfully removed.</div>');
        }else{
          $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> Origin was not removed.</div>');
        }
      });
    }
  </script>
  <!-- Modal -->
  <div id="addNewOrigin" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Origin</h4>
        </div>
        <form method="post" action="/app/new_origin/<?php echo $id; ?>" >
        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
        <div class="modal-body">
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Website Address / IP Address">
            </div>
        </div>
        <div class="modal-footer">
          <div class="form-group"><button type="submit" class="btn btn-default">Add</button></div>
        </div>
        </form>
      </div>

    </div>
  </div>

<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>