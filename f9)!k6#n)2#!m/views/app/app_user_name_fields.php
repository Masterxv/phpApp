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
	<div id="alrt"></div>
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="well well-sm">App User Name Fiels | for the app id - {{$id}}</div>
		</div>
		<div class="col-md-6">
			<div class="btn-group" style="float:right;">
				<button class="btn btn-default" onclick="saveUserNameFields()">Save User Name Fields</button>
				<a class="btn btn-default" href="/app/app_list">Back</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Sr.No.</th>
							<th>Auth Providers</th>
							<th>User Name Fields</th>
							<th colspan="2">Toggle Selected User Name Field</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ap as $a)
						<tr id="r{{$a}}">
							<td>{{$loop->index + 1}}</td>
							<td>{{$a}}</td>
							<td>{{implode(',',$aunf[$a])}}</td>
							<td>
								<select class="form-control" id="s{{$a}}">
									@foreach($fields[$a] as $field)
									<option>{{$field}}</option>
									<?php endforeach; ?>
								</select>
							</td>
							<td><button class="btn btn-default" onclick="toggleUserNameField('{{$a}}')">Toggle</button></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script>
		function toggleUserNameField(ap){
			let t = $("#r"+ap + ' > td:nth-child(3)').html();
			let arr = t?t.split(','):[];
			let sf = $("#s"+ap).val();
			if(arr.indexOf(sf)!=-1){
				arr.splice(arr.indexOf(sf),1);
			}else{
				arr.push(sf);
			}
			$("#r"+ap + ' > td:nth-child(3)').html(arr.join(','));
		}
		function saveUserNameFields(){
			const ap = {!! json_encode($ap) !!};
			let unf = {};
			for (var i = 0; i < ap.length; i++) {
				let t = $("#r"+ap[i] + ' > td:nth-child(3)').html();
				let arr = t?t.split(','):[];
				unf[ap[i]] = arr;
			};
			$.post("/app/save_user_name_fields", {'_token':'<?php echo $rand; ?>','id':'<?php echo $id; ?>', 'user_name_fields':JSON.stringify(unf) },function(data,status){
				if(data['status'] == 'success'){
			        $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> User name fields saved successfully.</div>');
			    }else{
			        $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> User name fields not saved.</div>');
			    }
			});
		}
	</script>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>
