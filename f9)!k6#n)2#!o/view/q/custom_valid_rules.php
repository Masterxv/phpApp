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
			Validation Rules | for the app id = {{\Auth::user()->active_app_id}}
		</div>
		<div class="col-md-6">
			<div class="btn-group" style="float:right;">
				<a class="btn btn-default" onclick="showDialog()">Add Validation Rule</a>
				<a class="btn btn-default" href="/query/query_list">Back</a></div>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Sr.No.</th>
						<th>Field</th>
						<th>Validation</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($frules as $frule): ?>
					<tr id="r{{$frule->id}}">
						<td>{{ ($loop->index + 1) + 10 * ($page-1)}}</td>
						<td>{{$frule->field}}</td>
						<td>{{$frule->rule}}</td>
						<td><a style="cursor: pointer;" onclick="deleteRule('{{$frule->id}}')">delete</a></td>
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
	function showDialog(){
		$("#addValidationRule").modal();
	}
	function deleteRule(id){
		$.post('/query/custom_valid_delete',{'_method':'delete','id':id,'_token':'<?php echo $rand; ?>'},function (data, status) {
			if(status=='success'){
				$('#r'+id).remove();
				$('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> Validation rule was successfully removed.</div>');
			}else{
				$('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> Validation rule was not removed.</div>');
			}
		})
	}
</script>

<!-- Modal -->
<div id="addValidationRule" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Validation Rule For Field</h4>
      </div>
      <form method="get" action="/query/custom_valid_view" >
      <div class="modal-body">
    	<div class="form-group row">
			<div class="col-md-12">
				<select id="field" class="form-control" name="field">
					<?php foreach($fields as $field): ?>
					<option>{{$field}}</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default modal-close">Go</button>
      </div>
      </form>
    </div>

  </div>
</div>

<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>