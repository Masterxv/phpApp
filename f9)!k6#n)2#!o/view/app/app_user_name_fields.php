<!DOCTYPE html>
<html>
<head>
  <?php require($app_key.'/view/layouts/styles.php'); ?>
</head>
<body>
  <?php require($app_key.'/view/layouts/nav.php'); ?>
	<div id="alrt"></div>
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="well well-sm">App User Name Fiels | for the app id - <?php echo $id; ?> </div>
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
						<?php foreach ($ap as $k=>$a): ?>
						<tr id="r<?php echo $a; ?>">
							<td><?php echo $k + 1; ?></td>
							<td><?php echo $a; ?></td>
							<td><?php echo implode(',',$aunf[$a]); ?></td>
							<td>
								<select class="form-control" id="s<?php echo $a; ?>">
									<?php foreach ($fields[$a] as $field): ?>
									<option><?php echo $field; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
							<td><button class="btn btn-default" onclick="toggleUserNameField('<?php echo $a; ?>')">Toggle</button></td>
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
			const ap = JSON.parse('<?php echo json_encode($ap); ?>');
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
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>
