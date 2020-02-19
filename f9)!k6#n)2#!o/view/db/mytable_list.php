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
  <?php if($error['table']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['table']; ?></div>
    <?php endif; ?>
  <?php if($error['createCSV']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['createCSV']; ?></div>
    <?php endif; ?>
  <?php if($error['updateCSV']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['updateCSV']; ?></div>
    <?php endif; ?>
  <?php if($error['_token']): ?><div class="alert alert-success"><strong>Success!</strong><?php echo $error['_token']; ?></div>
    <?php endif; ?>
  <div class="row">
    <div class="col-md-6">
      <div class="well well-sm"> Table List | for the app id: <?php echo $_SESSION[$app_key]['active_app_id']; ?>, Space Used: <?php echo $size; ?> MB</div>
    </div>
    <div class="col-md-6">
      <div class="btn-group" style="float:right">
        <a class="btn btn-default" onclick="createTable()">Create New Table</a>
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
  						<th>Table Name</th>
              <th>Size (MB)</th>
              <th colspan="9">Actions</th>
              <th colspan="2">Export</th>
              <th colspan="2">Import - Create</th>
              <th colspan="2">Import - Update</th>
  					</tr>
  				</thead>
  				<tbody>
            <?php foreach ($tables as $key => $table): ?>
            <tr id="r<?php echo ($key + 1); ?>">
              <td><?php echo  ($key + 1) + 10 * ($pageno-1); ?></td>
              <td><?php echo  $table['name'] ; ?></td>
              <td><?php echo  $table['size'] ; ?></td>
              <td><a href="JavaScript:void(0);" onclick="addFields('<?php echo $table['name']; ?>')">Add Fields</a></td>
              <td><a href="JavaScript:void(0);" onclick="renameField('<?php echo $table['name']; ?>')">Rename Field</a></td>
              <td><a href="JavaScript:void(0);" onclick="deleteField('<?php echo $table['name']; ?>')">Delete Field</a></td>
              <td><a href="JavaScript:void(0);" onclick="addIndex('<?php echo $table['name']; ?>')">Add Index</a></td>
              <td><a href="JavaScript:void(0);" onclick="removeIndex('<?php echo $table['name']; ?>')">Remove Index</a></td>
              <td><a href="/table/crud_view?table=<?php echo $table['name']; ?>">CRUD</a></td>
              <td><a href="JavaScript:void(0);" onclick="renameTable('<?php echo $table['name']; ?>', <?php echo $key; ?>)" >Rename Table</a></td>
              <td><a href="JavaScript:void(0);" onclick="truncate('<?php echo $table['name']; ?>', <?php echo $key; ?>)" >Truncate Table</a></td>
              <td><a href="JavaScript:void(0);" onclick="deleteTable('<?php echo $table['name']; ?>', <?php echo $key; ?>)" >Delete Table</a></td>
              <td><a href="/files/csv_export/<?php echo $table['name']; ?>">CSV</a></td>
              <td><a href="/files/json_export/<?php echo $table['name']; ?>">JSON</a></td>

              <td>
                <form id="createCSV<?php echo ($key + 1); ?>" method="post" action="/files/csv_import_create" enctype="multipart/form-data" autocomplete="off" style="display: none;">
                            <input type="hidden" name="_token" value="<?php echo $rand; ?>">
                            <input type="hidden" name="table" value="<?php echo $table['name']; ?>">
                            <input type="file" name="createCSV" id="ccf<?php echo ($key + 1); ?>" onchange="$('#createCSV<?php echo ($key + 1); ?>').submit()">
                        </form>
                <label for="ccf<?php echo ($key + 1); ?>" class="link"><a>CSV</a></label>
              </td>
              <td>
                <form id="createJSON<?php echo ($key + 1); ?>" method="post" action="/files/json_import_create" enctype="multipart/form-data" autocomplete="off" style="display: none;">
                            <input type="hidden" name="_token" value="<?php echo $rand; ?>">
                            <input type="hidden" name="table" value="<?php echo $table['name']; ?>">
                            <input type="file" name="createJSON" id="cjf<?php echo ($key + 1); ?>" onchange="$('#createJSON<?php echo ($key + 1); ?>').submit()">
                        </form>
                <label for="cjf<?php echo ($key + 1); ?>" class="link"><a>JSON</a></label>
              </td>

              <td>
                <form id="updateCSV<?php echo ($key + 1); ?>" method="post" action="/files/csv_import_update" enctype="multipart/form-data" autocomplete="off" style="display: none;">
                            <input type="hidden" name="_token" value="<?php echo $rand; ?>">
                            <input type="hidden" name="table" value="<?php echo $table['name']; ?>">
                            <input type="file" name="updateCSV" id="ucf<?php echo ($key + 1); ?>" onchange="$('#updateCSV<?php echo ($key + 1); ?>').submit()">
                        </form>
                <label for="ucf<?php echo ($key + 1); ?>" class="link"><a>CSV</a></label>
              </td>
              <td>
                <form id="updateJSON<?php echo ($key + 1); ?>" method="post" action="/files/json_import_update" enctype="multipart/form-data" autocomplete="off" style="display: none;">
                            <input type="hidden" name="_token" value="<?php echo $rand; ?>">
                            <input type="hidden" name="table" value="<?php echo $table['name']; ?>">
                            <input type="file" name="updateJSON" id="ujf<?php echo ($key + 1); ?>" onchange="$('#updateJSON<?php echo ($key + 1); ?>').submit()">
                        </form>
                <label for="ujf<?php echo ($key + 1); ?>" class="link"><a>JSON</a></label>
              </td>
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
  var key ="";
  function renameTable(table, key){
    key = key;
    $(".selectedTable").val(table);
    $("#renameTable").modal();
  }
  function renameTableRequest(){
    $.post("/table/rename", $("#renameTableForm").serialize(), function(data){
       if(data.status == "success"){
          $('#renameTable').modal('toggle');
          $("#r"+String(key+1) + " td:nth(1)").html(data.new_name);
          var ht = '<div class="alert alert-success text-center"><strong>Success!</strong> Table name changed successfully!</div>';
            $('#alrt').html(ht);
        }else{
          var ht = '<div class="alert alert-danger text-center"><strong>Failed!</strong> '+data.status+'</div>';
            $('#alrt').html(ht);
        }
    });
  }
  function truncate(table, key){
    var check = confirm("Are you sure you want to truncate this table");
    if(check){
      $.post("/table/truncate", {"table":table,"_token":"<?php echo $rand; ?>"}, function(data){
        if(data.status == "success"){
          var ht = '<div class="alert alert-success text-center"><strong>Success!</strong> Table '+table+' truncated successfully!</div>';
            $('#alrt').html(ht);
        }else{
          var ht = '<div class="alert alert-danger text-center"><strong>Failed!</strong> Table '+table+' truncate was not successfully!</div>';
            $('#alrt').html(ht);
        }
      });
    }
  }
  function deleteTable(table, key){
    var check = confirm("Are you sure you want to delete this table");
    if(check){
      $.post("/table/delete", {"table":table,"_token":"<?php echo $rand; ?>"}, function(data){
        if(data.status == "success"){
          $("#r"+String(key+1)).remove();
          var ht = '<div class="alert alert-success text-center"><strong>Success!</strong> Table '+table+' deleted successfully!</div>';
            $('#alrt').html(ht);
        }else{
          var ht = '<div class="alert alert-danger text-center"><strong>Failed!</strong> Table '+table+' deletion was not successfully!</div>';
            $('#alrt').html(ht);
        }
      });
    }
  }
  function createTable(){
    $("#createTable").modal();
  }
  function addFields(table){
    $(".selectedTable").val(table);
    $("#addFields").modal();
  }
  function renameField(table){
    $(".selectedTable").val(table);
    $.get("/table/get_columns", {"table":table}, function(data){$(".field_names").html(data);});
    $("#renameField").modal();
  }
  function renameFieldRequest(){
    $.post("/table/rename_column", $("#renameFieldForm").serialize(), function(data){
       if(data.status == "success"){
          $('#renameField').modal('toggle');
          var ht = '<div class="alert alert-success text-center"><strong>Success!</strong> Column name changed successfully!</div>';
            $('#alrt').html(ht);
        }else{
          var ht = '<div class="alert alert-danger text-center"><strong>Failed!</strong> '+data.status+'</div>';
            $('#alrt').html(ht);
        }
    });
  }
  function deleteField(table){
    $(".selectedTable").val(table);
    $.get("/table/get_columns", {"table":table}, function(data){$(".field_names").html(data);});
    $("#deleteField").modal();
  }
  function deleteFieldRequest(){
    $.post("/table/delete_column", $("#deleteFieldForm").serialize(), function(data){
       if(data.status == "success"){
          $('#deleteField').modal('toggle');
          var ht = '<div class="alert alert-success text-center"><strong>Success!</strong> Column deleted successfully!</div>';
            $('#alrt').html(ht);
        }else{
          var ht = '<div class="alert alert-danger text-center"><strong>Failed!</strong> '+data.status+'</div>';
            $('#alrt').html(ht);
        }
    });
  }
  function addIndex(table){
    $(".selectedTable").val(table);
    $.get("/table/get_columns", {"table":table}, function(data){$(".field_names").html(data);});
    $("#addIndex").modal();
  }
  function addIndexRequest(){
    $.post("/table/add_index", $("#addIndexForm").serialize(), function(data){
       if(data.status == "success"){
          $('#addIndex').modal('toggle');
          var ht = '<div class="alert alert-success text-center"><strong>Success!</strong> Index added successfully!</div>';
            $('#alrt').html(ht);
        }else{
          var ht = '<div class="alert alert-danger text-center"><strong>Failed!</strong> '+data.status+'</div>';
            $('#alrt').html(ht);
        }
    });
  }
  function removeIndex(table){
    $(".add-index").html("Remove Index");
    $("#addIndexForm").attr('action', '/table/remove_index');
    $("#ais").attr('onclick', 'removeIndexRequest()');
    addIndex(table);
  }
  function removeIndexRequest(){
    $.post("/table/remove_index", $("#addIndexForm").serialize(), function(data){
       if(data.status == "success"){
          $('#addIndex').modal('toggle');
          var ht = '<div class="alert alert-success text-center"><strong>Success!</strong> Index deleted successfully!</div>';
            $('#alrt').html(ht);
        }else{
          var ht = '<div class="alert alert-danger text-center"><strong>Failed!</strong> '+data.status+'</div>';
            $('#alrt').html(ht);
        }
    });
  }
  function importCreate(table){
    $(".selectedTable").val(table);
    $("#importCreate").modal();
  }
</script>

<!-- Modal -->
<div id="importCreate" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form id="renameTableForm" method="post" action="/table/rename">
        <input type="hidden" name="table" class="selectedTable" />
        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Import </h4>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" name="new_name" required autofocus/>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Update</button>
        </div>
      </form>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="renameTable" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form id="renameTableForm" method="post" action="/table/rename">
        <input type="hidden" name="table" class="selectedTable" />
        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Table Name</h4>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" name="new_name" required autofocus/>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Update</button>
        </div>
      </form>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="createTable" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form method="get" action="/table/new_table_view" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Number of fields</h4>
        </div>
        <div class="modal-body">
          <input type="number" class="form-control" name="fn" required autofocus/>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Go</button>
        </div>
      </form>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="addFields" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form method="get" action="/table/add_columns_view" >
        <input type="hidden" name="table" class="selectedTable" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Number of fields</h4>
        </div>
        <div class="modal-body">
          <input type="number" class="form-control" name="fn" required autofocus/>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Go</button>
        </div>
      </form>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="renameField" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form id="renameFieldForm" >
        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
        <input type="hidden" name="table" class="selectedTable" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Rename Field</h4>
        </div>
        <div class="modal-body">
          <label for="field_names">Select the old field</label>
          <select id="field_names" name="old_field_name" class="form-control field_names" autofocus></select>
          <label for="new_field_name">New name of the field</label>
          <input type="text" class="form-control" name="new_field_name" required/>
        </div>
      </form>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" onclick="renameFieldRequest()">Rename</button>
        </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="deleteField" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form id="deleteFieldForm" >
        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
        <input type="hidden" name="table" class="selectedTable" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Field</h4>
        </div>
        <div class="modal-body">
          <label for="field_names">Select the old field</label>
          <select id="field_names" name="field_name" class="form-control field_names" autofocus></select>
        </div>
        </form>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" onclick="deleteFieldRequest()">Delete</button>
        </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="addIndex" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form id="addIndexForm" >
        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
        <input type="hidden" name="table" class="selectedTable" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title add-index">Add Index</h4>
        </div>
        <div class="modal-body">
          <label for="field_names">Select the field</label>
          <select id="field_names" name="field_name" class="form-control field_names" autofocus></select>
          <label for="index_name" class="ri">Select the index</label>
          <select name="index_name" class="form-control ri">
            <option value="unique">UNIQUE</option>
            <option value="index">INDEX</option>
          </select>
        </div>
      </form>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default add-index" id="ais" onclick="addIndexRequest()">Add Index</button>
        </div>
    </div>

  </div>
</div>
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>