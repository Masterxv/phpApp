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
  <div class="row">
    <div class="col-md-6">
      Files | for the app id: <?php echo $_SESSION[$app_key]['active_app_id']; ?>, Space Used <?php echo $size; ?> MB
    </div>
    <div class="col-md-6">
      <div class="btn-group" style="float:right">
          <form id="uploadFiles" method="post" action="/files/upload_files" enctype="multipart/form-data" style="display: none;">
              <input type="hidden" name="_token" value="<?php echo $rand; ?>">
              <input type="hidden" name="success" />
              <input type="file" name="files[]" id="filesUpload" multiple onchange="$('#uploadFiles').submit()">
          </form><label for="filesUpload"><a class="btn btn-default">Upload Files</a></label></div>
    </div>
  </div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Sr</th>
            <th>Id</th>
						<th>File Name</th>
            <th>File Type</th>
            <th>File Size</th>
            <th>File Path</th>
            <th colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
          <?php foreach($files as $key => $file): ?>
          <tr id="r<?php echo $file['id']; ?>">
            <td><?php echo  ($key + 1) + 10 * ($pageno-1); ?></td>
            <td><?php echo  $file['id']; ?></td>
            <td><?php echo  $file['name']; ?></td>
            <td><?php echo  $file['mime']; ?></td>
            <td><?php echo  $file['size']; ?></td>
            <td><?php echo  str_replace($app_url, '', $file['path']) ; ?></td>
            <td><a href="<?php echo $file['path']; ?>" target="_blank">Preview</a></td>
            <td><a href="/files/<?php echo $file['id']; ?>" target="_blank">Download</a></td>
            <td><a href="JavaScript:void(0);" onclick="deleteFile('<?php echo $file['id']; ?>','<?php echo $file['name']; ?>')">Delete</a></td>
            <?php if(false): ?>
            <td><label for="file" class="link"><a href="JavaScript:void(0);" onclick="replaceFile('<?php echo $file['id']; ?>','<?php echo $file['name']; ?>')">Replace</a></label></td>
            <td><form id="replaceFile<?php echo ($key + 1); ?>" method="post" action="/files/replace_file" enctype="multipart/form-data" style="display: none;">
                          <input type="hidden" name="_token" value="<?php echo $rand; ?>">
                          <input type="hidden" name="id" value="<?php echo $file['id']; ?>">
                          <input type="hidden" name="success" />
                          <input type="file" name="file" id="file<?php echo ($key + 1); ?>" onchange="$('#replaceFile<?php echo ($key + 1); ?>').submit()">
                      </form>
              <label for="file<?php echo ($key + 1); ?>" class="link"><a href="JavaScript:void(0);">Replace</a></label></td>
            <td><form id="delfile<?php echo ($key + 1); ?>" method="post" action="/files/delete_file" style="display: none;">
                          <input type="hidden" name="_token" value="<?php echo $rand; ?>">
                          <input type="hidden" name="id" value="<?php echo $file['id']; ?>">
                          <input type="hidden" name="success" />
                      </form>
              <label class="link"><a href="JavaScript:void(0);" onclick="$('#delfile<?php echo ($key + 1); ?>').submit()">Delete</a></label></td>
            <?php endif; ?>
          </tr>
          <?php endforeach; ?>
				</tbody>
			</table>
      <?php if(false): ?>
      <form id="replaceFile" method="post" action="/files/replace_file" enctype="multipart/form-data" style="display: none;">
          <input type="hidden" name="_token" value="<?php echo $rand; ?>">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="success" />
          <input type="file" name="file" id="file" onchange="$('#replaceFile').submit()">
      </form>
      <?php endif; ?>
		</div>
    <div class="col-md-12">
      <?php include($app_key.'/layouts/pagination.php') ?>
    </div>
	</div>
</div>
<script>
  <?php if(false): ?>
  function replaceFile(id, file_name){
    // var bool = confirm("Are you sure! you want to replace file " + file_name);
    // if(!bool){
    //   return;
    // }
    $('#id').val(id);
  }
  <?php endif; ?>
  function deleteFile(id, file_name){
    var bool = confirm("Are you sure! you want to remove file " + file_name);
    if(!bool){
      return;
    }
    $.post("<?php echo route('c.files.delete'); ?>", {'_token':'<?php echo $rand; ?>', 'id':id}, function(data){
      console.log(data);
      if(data['status'] == 'success'){
        $('#r'+id).remove();
        $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> File '+file_name+' was successfully removed.</div>');
      }else{
        $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> File '+file_name+' was not removed.</div>');
      }
    });
  }
</script>

<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>