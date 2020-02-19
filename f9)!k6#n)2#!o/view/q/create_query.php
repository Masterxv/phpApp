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
						<label for="h">Hiddens:</label>
					</div>
					<div class="col-md-6">
						<input id="hid" type="hidden" class="form-control" name="hiddens">
						<div class="well well-sm" id="hfields">none</div>
						<div class="row">
							<div class="col-md-12" id="hSelects">
							</div>
						</div>
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="m">Mandatory:</label>
					</div>
					<div class="col-md-6">
						<input id="mid" type="hidden" class="form-control" name="mandatory">
						<div class="well well-sm" id="mfields">none</div>
						<div class="row">
							<div class="col-md-12" id="mSelects">
							</div>
						</div>
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="jtable">Joins:</label>
					</div>
					<div class="col-md-6">
						<input id="jid" type="hidden" class="form-control" name="joins">
						<div class="well well-sm" id="jfields">none</div>
						<div class="row">
							<div class="col-md-8">
								<select id="jt" class="form-control" onchange="joinTableIndexFields()">
									<?php foreach($tables as $table): ?>
									<option><?php echo $table; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-4">
								<a class="btn btn-info btn-sm" onclick="j()" style="width: 100%">Toggle</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<select id="tf" class="toptions form-control"></select>
							</div>
							<div class="col-md-4">
								<select id="jo" class="form-control">
									<option>=</option>
									<option><></option>
									<option><</option>
									<option>></option>
									<option><=</option>
									<option>>=</option>
									<option>LIKE</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<select id="jf" class="toptions form-control"></select>
							</div>
						</div>
					</div>			
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="fid">Filters:</label>
					</div>
					<div class="col-md-6">
						<input id="fid" type="hidden" class="form-control" name="filters">
						<div class="well well-sm" id="ffields">none</div>
						<div class="row">
							<div class="col-md-8">
								<select id="ft" class="form-control">
									<option value="where">where</option>
									<option value="orWhere">orWhere</option>
									<option value="whereBetween">whereBetween</option>
									<option value="whereNotBetween">whereNotBetween</option>
									<option value="whereIn">whereIn</option>
									<option value="whereNotIn">whereNotIn</option>
									<option value="whereNull">whereNull</option>
									<option value="whereNotNull">whereNotNull</option>
									<option value="whereDate">whereDate</option>
									<option value="whereMonth">whereMonth</option>
									<option value="whereDay">whereDay</option>
									<option value="whereYear">whereYear</option>
									<option value="whereTime">whereTime</option>
									<option value="whereColumn">whereColumn</option>
									<option value="orderBy">orderBy</option>
									<option value="distinct">distinct</option>
									<option value="latest">latest</option>
									<option value="oldest">oldest</option>
									<option value="inRandomOrder">inRandomOrder</option>
									<option value="groupBy">groupBy</option>
									<option value="having">having</option>
									<option value="offset">offset</option>
									<option value="limit">limit</option>
								</select>
							</div>
							<div class="col-md-4">
								<a class="btn btn-info btn-sm" onclick="f()" style="width: 100%">Toggle</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<select id="ff" class="toptions form-control"></select>
							</div>
							<div class="col-md-4">
								<select id="fo" class="form-control">
									<option>=</option>
									<option><></option>
									<option><</option>
									<option>></option>
									<option><=</option>
									<option>>=</option>
									<option>LIKE</option>
								</select>
							</div>
							<div class="col-md-12"><input id="fv" type="text" class="form-control" placeholder="value"></div>
						</div><hr>
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="sid">Special Commands:</label>
					</div>
					<div class="col-md-6">
						<div class="well well-sm" id="sqfields">none</div>
						<input id="sid" type="hidden" class="form-control" name="specials">
						<div class="row">
							<div class="col-md-12">
								<?php foreach($specials as $sp): ?>
								<div class="checkbox" style="display: inline-flex; margin-right: 10px"><label><input type="checkbox" onchange="s('<?php echo $sp; ?>')" <?php if(in_array($sp, explode(', ', $old['specials']))): ?> checked <?php endif; ?>><?php echo $sp; ?></label></div>
								<?php endforeach; ?>
							</div>
						</div>
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
	$("#hfields").html('<?php echo $old['hiddens']??'none'; ?>');
	$("#mfields").html('<?php echo $old['mandatory']??'none'; ?>');
	$("#jfields").html('<?php echo $old['joins']??'none'; ?>');
	$("#ffields").html('<?php echo $old['filters']??'none'; ?>');
	$("#sqfields").html('<?php echo $old['specials']??'none'; ?>');
	$("#auth_providers").val('<?php echo $old['auth_providers']??'none'; ?>');
	$("#tables").val('<?php echo $old['tables']??'none'; ?>');	
	$("#commands").val('<?php echo $old['commands']??'none'; ?>');
	$("#vid").val('<?php echo $old['fillables']??null; ?>');
	$("#hid").val('<?php echo $old['hiddens']??null; ?>');
	$("#mid").val('<?php echo $old['mandatory']??null; ?>');
	$("#jid").val('<?php echo $old['joins']??null; ?>');
	$("#fid").val('<?php echo $old['filters']??null; ?>');
	$("#sid").val('<?php echo $old['specials']??null; ?>');
</script>
<script>
	var auth_providers = JSON.parse('<?php echo json_encode($auth_providers); ?>');
	var tables = JSON.parse('<?php echo json_encode($tables); ?>');
	var fields = []; var commands = JSON.parse('<?php echo json_encode(array_values($commands)); ?>');
	var specials = JSON.parse('<?php echo json_encode(array_values($specials)); ?>');
	var aps=JSON.parse('<?php echo json_encode($old['auth_providers']?explode(', ', $old['auth_providers']):[]); ?>');
	var ts=JSON.parse('<?php echo json_encode($old['tables']?explode(', ', $old['tables']):[]); ?>');
	var cs=JSON.parse('<?php echo json_encode($old['commands']?explode(', ', $old['commands']):[]); ?>');
	var vf=JSON.parse('<?php echo json_encode($old['fillables']?explode(', ', $old['fillables']):[]); ?>');
	var hf=JSON.parse('<?php echo json_encode($old['hiddens']?explode(', ', $old['hiddens']):[]); ?>');
	var mf=JSON.parse('<?php echo json_encode($old['mandatory']?explode(', ', $old['mandatory']):[]); ?>');
	var jf=JSON.parse('<?php echo json_encode($old['joins']?explode('|', $old['joins']):[]); ?>');
	var ff=JSON.parse('<?php echo json_encode($old['filters']?explode('|', $old['filters']):[]); ?>');
	var sp=JSON.parse('<?php echo json_encode($old['specials']?explode(', ', $old['specials']):[]); ?>');
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
	function h(v){
		if(hf.indexOf(v) != -1){
			hf.splice(hf.indexOf(v),1);
		}else{
			hf.push(v);
		}
		let diff = fields.diff(hf);
		diff = fields.diff(diff);
		$("#hfields").html(diff.join(", "));
		$("#hid").val(diff.join(", "));
	}
	function m(v){
		if(mf.indexOf(v) != -1){
			mf.splice(mf.indexOf(v),1);
		}else{
			mf.push(v);
		}
		let diff = fields.diff(mf);
		diff = fields.diff(diff);
		$("#mfields").html(diff.join(", "));
		$("#mid").val(diff.join(", "));
	}
	function j(){
		const v = $("#jt").val() + ", " + $("#tf").val() + ", " + $("#jo").val() + ", " + $("#jf").val();
		if(jf.indexOf(v) != -1){
			jf.splice(jf.indexOf(v),1);
		}else{
			jf.push(v);
		}
		// let diff = joins.diff(jf);
		// diff = joins.diff(diff);
		$("#jfields").html(jf.join("|"));
		$("#jid").val(jf.join("|"));
	}
	function f(){
		const v = $("#ft").val() + ", " + $("#ff").val() + ", " + $("#fo").val() + ", " + $("#fv").val();
		if(ff.indexOf(v) != -1){
			ff.splice(ff.indexOf(v),1);
		}else{
			ff.push(v);
		}
		// let diff = filters.diff(ff);
		// diff = filters.diff(diff);
		$("#ffields").html(ff.join("|"));
		$("#fid").val(ff.join("|"));
		console.log($("#fid").val());
	}
	function s(v){
		if(sp.indexOf(v) != -1){
			sp.splice(sp.indexOf(v),1);
		}else{
			sp.push(v);
		}
		let diff = specials.diff(sp);
		diff = specials.diff(diff);
		$("#sqfields").html(diff.join(", "));
		$("#sid").val(diff.join(", "));
	}
	function getFiels(){
		$.get("/query/get_all_columns", {"tables":ts}, function(data){
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
				tmp = t;
				if(hf.indexOf(data[i])!=-1){
					tmp = tmp.replace('%chkd%', 'checked');
				}
				tb = tb + tmp.replace('%field%', data[i]).replace('%field%', data[i]);
				tmp = t;
				if(mf.indexOf(data[i])!=-1){
					tmp = tmp.replace('%chkd%', 'checked');
				}
				tc = tc + tmp.replace('%field%', data[i]).replace('%field%', data[i]);
				tpa = tpa + tp.replace('%field%',data[i]);
			};
			$("#vSelects").html(ta);
			$("#hSelects").html(tb.split('onchange="v').join('onchange="h'));
			$("#mSelects").html(tc.split('onchange="v').join('onchange="m'));
			$(".toptions").html('<option>id</option>' + tpa);
		});
	}
	getFiels()
	function joinTableIndexFields(){
	    $.get("/table/get_columns", {"table":$("#jt").val()}, function(data){$("#jf").html(data);});
	}
</script>
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>