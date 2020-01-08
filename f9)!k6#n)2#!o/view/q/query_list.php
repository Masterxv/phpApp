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
    <div class="col-md-6">
      Query List | for the app id: {{\Auth::user()->active_app_id}}
    </div>
    <div class="col-md-6">
      <div class="btn-group" style="float:right">
        <a class="btn btn-default" href="/query/new_query_view">Create New Query</a>
        <a class="btn btn-default" href="/query/custom_valid_view">Validation</a>
        <a class="btn btn-default" href="/query/custom_valid_msg_view">Customize Validation Messages</a>
      </div>
    </div>
  </div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Sr</th>
						<th>Id</th>
						<th>Name</th>
			            <th>Author</th>
			            <th>Tables</th>
			            <th>Commands</th>
			            <th>Fillables</th>
			            <th>Hiddens</th>
                  <th>Mandatory</th>
			            <th>Joins</th>
			            <th>Filters</th>
			            <th>Special</th>
						<th colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
          <?php foreach($queries as $query): ?>
          <tr id="r{{$query->id}}">
            <td>{{ ($loop->index + 1) + 10 * ($page-1)}}</td>
            <td>{{$query->id}}</td>
            <td>{{$query->name}}</td>
            <td>{{$query->auth_providers}}</td>
            <td>{{$query->tables}}</td>
            <td>{{$query->commands}}</td>
            <td>{{$query->fillables}}</td>
            <td>{{$query->hiddens}}</td>
            <td>{{$query->mandatory}}</td>
            <td>{{$query->joins}}</td>
            <td>{{$query->filters}}</td>
            <td>{{$query->specials}}</td>
            <td><a href="/query/query_details/<?php echo $query->id; ?>">Update</a></td>
            <td><a style="cursor: pointer;" onclick="d('{{$query->id}}')">Delete</a>
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
<script>
  function d(id){
    $.post("/query/delete", {"_token":"<?php echo $rand; ?>", "id":id, "_method":"DELETE"}, function(data) {
      if(data['status'] == 'success'){
        $('#r'+id).remove();
        $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> Query was successfully removed.</div>');
      }else{
        $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> Query was not removed.</div>');
      }
    })
  }
</script>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>