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
	<div class="row">
		<div class="col-md-12 text-center">
			Create New Query	<div class="input-group" style="float:right;">
				<a class="btn btn-default" href="/query/query_list">Back</a></div>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form method="post" action="/query/new_query" >
		        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
		        <div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="name">Name:</label>
					</div>
					<div class="col-md-6">
						<input id="name" type="text" class="form-control" name="name" placeholder="Query Nick Name" value="<?php echo $old['name']; ?>">
						<?php if($error['name']): ?>
						<p style="color:red"><?php echo $error['name']; ?></p> 
						<?php endif; ?>
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="auth_providers">Auth Providers:</label>
					</div>
					<div class="col-md-6">
						<input id="auth_providers" type="hidden" class="form-control" name="auth_providers">
						<div class="well well-sm" id="auth_providers_selected"></div>
						<?php if($error['auth_providers']): ?>
						<p style="color:red"><?php echo $error['auth_providers']; ?></p> 
						<?php endif; ?>
						<div class="row">
							<div class="col-md-12">
							<?php foreach($auth_providers as $auth_provider): ?>
								<div class="checkbox" style="display: inline-flex; margin-right: 10px"><label><input type="checkbox" onchange="ap('<?php echo $auth_provider; ?>')" <?php if(in_array($auth_provider, explode(', ', $old['auth_providers']))): ?> checked <?php endif; ?>><?php echo $auth_provider; ?></label></div>
							<?php endforeach; ?>
							</div>
						</div>
						<a class="btn btn-info btn-sm" onclick="getAuthUsers()">Get Auth Users</a>
					</div>			
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="tables">Tables:</label>
					</div>
					<div class="col-md-6">
						<input id="tables" type="hidden" class="form-control" name="tables">
						<div class="well well-sm" id="tables_selected"></div>
						<?php if($error['tables']): ?>
						<p style="color:red"><?php echo $error['tables']; ?></p> 
						<?php endif; ?>
						<div class="row">
							<div class="col-md-12">
							<?php foreach($tables as $table): ?>
								<div class="checkbox" style="display: inline-flex; margin-right: 10px"><label><input type="checkbox" onchange="t('<?php echo $table; ?>')" <?php if(in_array($table, explode(', ', $old['tables']))): ?> checked <?php endif; ?>><?php echo $table; ?></label></div>
							<?php endforeach; ?>
							</div>
						</div>
						<a class="btn btn-info btn-sm" onclick="getFiels()">Get Table Fields</a>
					</div>			
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="commands">Commands:</label>
					</div>
					<div class="col-md-6">
						<div class="well well-sm" id="commands_selected"></div>
						<input id="commands" type="hidden" class="form-control" name="commands">
						<?php if($error['commands']): ?>
						<p style="color:red"><?php echo $error['commands']; ?></p> 
						<?php endif; ?>
						<div class="row">
							<div class="col-md-12">
								<?php foreach($commands as $k => $v): ?>
								<div class="checkbox" style="display: inline-flex; margin-right: 10px"><label><input type="checkbox" onchange="c('<?php echo $v; ?>')" <?php if(in_array($v, explode(', ', $old['commands']))): ?> checked <?php endif; ?>><?php echo $k; ?></label></div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="v">Fillables:</label>
					</div>
					<div class="col-md-6">
						<input id="vid" type="hidden" class="form-control" name="fillables">
						<div class="well well-sm" id="vfields">all</div>
						<div class="row">
							<div class="col-md-12" id="vSelects">
							</div>
						</div>
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="u">Auth Users:</label>
					</div>
					<div class="col-md-6">
						<input id="uid" type="hidden" class="form-control" name="auth_users">
						<div class="well well-sm" id="ufields">all</div>
						<div class="row">
							<div class="col-md-12" id="uSelects">
							</div>
						</div>
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label>Filter:</label>
					</div>
					<div class="col-md-6">
						<textarea rows="4" class="form-control" name="filter"><?php echo $old['filter']; ?></textarea>
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label>Special Commands:</label>
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" name="specials" value="<?php echo $old['specials']; ?>" />
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4"></div>
					<div class="col-md-6">
						<button type="submit" class="btn btn-primary">Add New Query</button>
					</div>			
				</div><hr>
		    </form>
		</div>
	</div>
</div>
<script>
	$("#auth_providers_selected").html('<?php echo $old['auth_providers']??'none'; ?>');
	$("#tables_selected").html('<?php echo $old['tables']??'none'; ?>');
	$("#commands_selected").html('<?php echo $old['commands']??'none'; ?>');
	$("#vfields").html('<?php echo $old['fillables']??'all'; ?>');
	$("#ufields").html('<?php echo $old['auth_users']??'all'; ?>');
	$("#auth_providers").val('<?php echo $old['auth_providers']??'none'; ?>');
	$("#tables").val('<?php echo $old['tables']??'none'; ?>');	
	$("#commands").val('<?php echo $old['commands']??'none'; ?>');
	$("#vid").val('<?php echo $old['fillables']??null; ?>');
	$("#uid").val('<?php echo $old['auth_users']??null; ?>');
</script>
<script>
	var auth_providers = JSON.parse('<?php echo json_encode($auth_providers); ?>');
	var tables = JSON.parse('<?php echo json_encode($tables); ?>');
	var fields = [];var ids = []; var commands = JSON.parse('<?php echo json_encode(array_values($commands)); ?>');
	var specials = JSON.parse('<?php echo json_encode(array_values($specials)); ?>');
	var aps=JSON.parse('<?php echo json_encode($old['auth_providers']?explode(', ', $old['auth_providers']):[]); ?>');
	var ts=JSON.parse('<?php echo json_encode($old['tables']?explode(', ', $old['tables']):[]); ?>');
	var cs=JSON.parse('<?php echo json_encode($old['commands']?explode(', ', $old['commands']):[]); ?>');
	var vf=JSON.parse('<?php echo json_encode($old['fillables']?explode(', ', $old['fillables']):[]); ?>');
	var uf=JSON.parse('<?php echo json_encode($old['auth_users']?explode(', ', $old['auth_users']):[]); ?>');
	Array.prototype.diff = function(a) {
	    return this.filter(function(i) {return a.indexOf(i) < 0;});
	};
	function ap(v){
		if(aps.indexOf(v) != -1){
			aps.splice(aps.indexOf(v),1);
		}else{
			aps.push(v);
		}
		let diff = auth_providers.diff(aps);
		diff = auth_providers.diff(diff);
		$("#auth_providers_selected").html(diff.join(", "));
		$("#auth_providers").val(diff.join(", "));
	}
	function t(v){
		if(ts.indexOf(v) != -1){
			ts.splice(ts.indexOf(v),1);
		}else{
			ts.push(v);
		}
		let diff = tables.diff(ts);
		diff = tables.diff(diff);
		$("#tables_selected").html(diff.join(", "));
		$("#tables").val(diff.join(", "));
	}
	function c(v){
		if(cs.indexOf(v) != -1){
			cs.splice(cs.indexOf(v),1);
		}else{
			cs.push(v);
		}
		let diff = commands.diff(cs);
		diff = commands.diff(diff);
		$("#commands_selected").html(diff.join(", "));
		$("#commands").val(diff.join(", "));
	}
	function v(v){
		if(vf.indexOf(v) != -1){
			vf.splice(vf.indexOf(v),1);
		}else{
			vf.push(v);
		}
		let diff = fields.diff(vf);
		diff = fields.diff(diff);
		$("#vfields").html(diff.join(", "));
		$("#vid").val(diff.join(", "));
	}
	function u(v){
		if(uf.indexOf(v) != -1){
			uf.splice(uf.indexOf(v),1);
		}else{
			uf.push(v);
		}
		let diff = ids.diff(uf);
		diff = ids.diff(diff);
		$("#ufields").html(diff.join(", "));
		$("#uid").val(diff.join(", "));
	}
	function getFiels(){
		$.post("/query/get_all_columns", {"_token":"<?php echo $rand; ?>","tables":ts}, function(data){
			fields = data;
			var t = '<div class="checkbox" style="display: inline-flex; margin-right: 10px"><label><input type="checkbox" onchange="v('+"'%field%'"+')" %chkd%>'+'%field%'+'</label></div>';
			var tp = '<option>%field%</option>';
			var ta = ""; var tb = ""; var tc = ""; var tpa = ""; var tmp ="";
			for (var i = 0; i < data.length; i++) {
				tmp = t;
				if(vf.indexOf(data[i])!=-1){
					tmp = tmp.replace('%chkd%', 'checked');
				}
				ta = ta + tmp.replace('%field%', data[i]).replace('%field%', data[i]);
				tpa = tpa + tp.replace('%field%',data[i]);
			};
			$("#vSelects").html(ta);
		});
	}
	getFiels();
	function getAuthUsers(){
		$.post("/query/get_all_auth_users", {"tables":aps}, function(data){
			ids = data;
			var t = '<div class="checkbox" style="display: inline-flex; margin-right: 10px"><label><input type="checkbox" onchange="u('+"'%field%'"+')" %chkd%>'+'%field%'+'</label></div>';
			var tp = '<option>%field%</option>';
			var ta = ""; var tb = ""; var tc = ""; var tpa = ""; var tmp ="";
			for (var i = 0; i < data.length; i++) {
				tmp = t;
				if(uf.indexOf(data[i])!=-1){
					tmp = tmp.replace('%chkd%', 'checked');
				}
				ta = ta + tmp.replace('%field%', data[i]).replace('%field%', data[i]);
				tpa = tpa + tp.replace('%field%',data[i]);
			};
			$("#uSelects").html(ta);
		});
	}
</script>
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>