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
<form id="form_create_table" method="post" action="/table/new_table">
<input type="hidden" name="_token" value="<?php echo $rand; ?>"/>
<div class="container-fluid">
	<?php if($error['name']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['name']; ?></div>
    <?php endif; ?>
	<div class="row">
		<div class="col-md-3">
			Create New Table
		</div>
		<div class="col-md-9">
			<div class="input-group" style="float:right;position: relative;">
				<input style="width:300px;" type="text" name="name" class="form-control<?php echo  $error['name'] ? ' is-invalid' : '' ; ?>" value="<?php echo  $old['name'] ; ?>" placeholder="Table Name" />
				<?php if($error['name']): ?>
					<p style="color:red;position: absolute;bottom:auto;left:0px;top:30px;right:auto;z-index: 3"> 
					<?php echo $error['name']; ?> </p>
				<?php endif; ?>
				<select name="model" class="form-control" style="width:150px;">
					<option value="model">Model</option>
					<option value="authenticatable">Authenticatable</option>
				</select>
				<button type="submit" class="btn btn-default">Create Table</button>
				<a class="btn btn-default" href="/table/table_list">Back</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive" style="padding-bottom: 100px;">
				<table class="table" id="table_fields">
					<thead>
						<tr>
							<th>Sr</th>
							<th style="min-width: 200px;">Field Name</th>
							<th style="min-width: 200px;">Datatype</th>
							<th style="min-width: 150px;">Length/Value</th>
							<th style="min-width: 150px;">Default Value</th>
							<th style="min-width: 150px;">Index</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>
								id
								<input type="hidden" name="field_name[1]" class="form-control" value="id" placeholder="Id" />
							</td>
							<td>
								<div class="form-group">
									<select name="field_type[1]" class="form-control" >
										<option value="increments">increments</option>
										<option value="tinyIncrements">tinyIncrements</option>
										<option value="smallIncrements">smallIncrements</option>
										<option value="mediumIncrements">mediumIncrements</option>
										<option value="bigIncrements">bigIncrements</option>
									</select>
									<?php if($error['field_type.1']): ?>
									<p style="color:red"><?php echo $error['field_type.1']; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>---</td>
							<td>---</td>
							<td>PRIMARY</td>
						</tr>
						<?php for($i=2; $i<$fn+2; $i++): ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td>
								<div class="form-group">
									<input type="text" name="field_name[<?php echo $i; ?>]" class="form-control<?php echo  $error['field_name.'.$i] ? ' is-invalid' : '' ; ?>" value="<?php echo  $old['field_name.'.$i] ; ?>" placeholder="Field Name" />
								<?php if($error['field_name.'.$i]): ?>
								<p style="color:red"><?php echo $error['field_name.'.$i]; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<select class="form-control" id="field_type_<?php echo $i; ?>" name="field_type[<?php echo $i; ?>]" onchange="ls(<?php echo $i; ?>)" >
    <option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size" value="string">string</option>
    <option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295" value="unsignedInteger">unsignedInteger</option>
    <option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes" value="text">text</option>
    <option title="A TEXT column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) characters, stored with a four-byte prefix indicating the length of the value in bytes" value="longText">longText</option>
    <option title="A timestamp, range is 1970-01-01 00:00:01 UTC to 2038-01-09 03:14:07 UTC, stored as the number of seconds since the epoch (1970-01-01 00:00:00 UTC)" value="timestamp">timestamp</option>
    <optgroup label="Numeric">
    	<option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255" value="tinyInteger">tinyInteger</option>
    	<option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255" value="unsignedTinyInteger">unsignedTinyInteger</option>
    	<option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535" value="smallInteger">smallInteger</option>
    	<option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535" value="unsignedSmallInteger">unsignedSmallInteger</option>
    	<option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215" value="mediumInteger">mediumInteger</option>
    	<option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215" value="unsignedMediumInteger">unsignedMediumInteger</option>
    	<option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295" value="integer">integer</option>
    	<option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295" value="unsignedInteger">unsignedInteger</option>
    	<option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615" value="bigInteger">bigInteger</option>
    	<option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615" value="unsignedBigInteger">unsignedBigInteger</option>
    	<option disabled="disabled">-</option>
    	<option title="A fixed-point number (M, D) - the maximum number of digits (M) is 65 (default 10), the maximum number of decimals (D) is 30 (default 0)" value="decimal">decimal</option>
    	<option title="A fixed-point number (M, D) - the maximum number of digits (M) is 65 (default 10), the maximum number of decimals (D) is 30 (default 0)" value="unsignedDecimal">unsignedDecimal</option>
    	<option title="A small floating-point number, allowable values are -3.402823466E+38 to -1.175494351E-38, 0, and 1.175494351E-38 to 3.402823466E+38" value="float">float</option>
    	<option title="A double-precision floating-point number, allowable values are -1.7976931348623157E+308 to -2.2250738585072014E-308, 0, and 2.2250738585072014E-308 to 1.7976931348623157E+308" value="double">double</option>
    	<option disabled="disabled">-</option>
    	<option title="A synonym for TINYINT(1), a value of zero is considered false, nonzero values are considered true" value="boolean">boolean</option>
    </optgroup>
    <optgroup label="Date and time">
    	<option title="A date, supported range is 1000-01-01 to 9999-12-31" value="date">date</option>
    	<option title="A date and time combination, supported range is 1000-01-01 00:00:00 to 9999-12-31 23:59:59" value="dateTime">dateTime</option>
    	<option>dateTimeTz</option>
    	<option title="A time, range is -838:59:59 to 838:59:59" value="time">time</option>
    	<option title="A time, range is -838:59:59 to 838:59:59" value="timeTz">timeTz</option>
    </optgroup>
    <optgroup label="String">
    	<option title="A fixed-length (0-255, default 1) string that is always right-padded with spaces to the specified length when stored" value="char">char</option>
    	<option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size" value="string">string</option>
    	<option disabled="disabled">-</option>
    	<option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes" value="text">text</option>
    	<option title="A TEXT column with a maximum length of 16,777,215 (2^24 - 1) characters, stored with a three-byte prefix indicating the length of the value in bytes" value="mediumText">mediumText</option>
    	<option title="A TEXT column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) characters, stored with a four-byte prefix indicating the length of the value in bytes" value="longText">longText</option>
    	<option disabled="disabled">-</option>
    	<option title="A BLOB column with a maximum length of 65,535 (2^16 - 1) bytes, stored with a two-byte prefix indicating the length of the value" value="binary">binary(BLOB)</option>
    	<option disabled="disabled">-</option>
    	<option title="An enumeration, chosen from the list of up to 65,535 values or the special '' error value" value="enum">enum</option>
    </optgroup>
    <optgroup label="Geometrical">
    	<option title="A type that can store a geometry of any type">geometry</option>
    	<option title="A point in 2-dimensional space">point</option>
    	<option title="A curve with linear interpolation between points">lineString</option>
    	<option title="A polygon">polygon</option>
    	<option title="A collection of points">multiPoint</option>
    	<option title="A collection of curves with linear interpolation between points">multiLineString</option>
    	<option title="A collection of polygons">multiPolygon</option>
    	<option title="A collection of geometry objects of any type">geometryCollection</option>
    </optgroup>
    <optgroup label="Special">
    	<option title="IP address equivalent.">ipAddress</option>
    	<option title="MAC address equivalent.">macAddress</option>
    	<option title="uuid equivalent.">uuid</option>
    	<option title="year equivalent.">year</option>
    </optgroup>
</select>
<?php if($error['field_type_.'.$i]): ?>
									<p style="color:red"><?php echo $error['field_type_.'.$i]; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<input type="text" id="field_param_<?php echo $i; ?>" name="field_param[<?php echo $i; ?>]" class="form-control<?php echo  $error['field_param.'.$i] ? ' is-invalid' : '' ; ?>" value="<?php echo  $old['field_param.'.$i] ; ?>" placeholder="<?php echo $error['field_param.'.$i] ? $error['field_param.'.$i] : 'Length/Value' ?>" />
									<?php if($error['field_param.'.$i]): ?>
									<p style="color:red"><?php echo $error['field_param.'.$i]; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<input type="text" name="field_default[<?php echo $i; ?>]" class="form-control<?php echo  $error['field_default.'.$i] ? ' is-invalid' : '' ; ?>" value="<?php echo  $old['field_default.'.$i] ; ?>" placeholder="<?php echo $error['field_default.'.$i] ? $error['field_default.'.$i] : 'Default Value' ?>" />
									<?php if($error['field_default.'.$i]): ?>
									<p style="color:red"><?php echo $error['field_default.'.$i]; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>
								<select id="field_key_<?php echo $i; ?>" name="field_key[<?php echo $i; ?>]" class="form-control">
								    <option value="null">---</option>
								    <option value="primary" title="Primary">
								        PRIMARY
								    </option>
								    <option value="unique" title="Unique">
								        UNIQUE
								    </option>
								    <option value="index" title="Index">
								        INDEX
								    </option>
								</select>
								<?php if($error['field_key.'.$i]): ?>
									<p style="color:red"><?php echo $error['field_key.'.$i]; ?></p> <?php endif; ?>
							</td>
						</tr>
						<?php endfor; ?>
						<tr>
							<td><?php echo $fn+2; ?></td>
							<td>
									created_at and updated_at
									<input type="hidden" name="field_name[<?php echo $fn+2; ?>]" value="created_at and updated_at" />
							</td>
							<td>
								<div class="form-group">
									<select name="field_type[<?php echo $fn+2; ?>]" class="form-control" >
										<option value="timestamps">timestamps</option>
										<option value="timestampsTz">timestampsTz</option>
									</select>
									<?php if($error['field_type.'.($fn+2)]): ?>
									<p style="color:red"><?php echo $error['field_type.'.($fn+2)]; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>---</td>
							<td>---</td>
							<td>---</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</form>
<script>
<?php if($old['field_type.2']): ?>
	<?php for($i=2; $i<$fn+2; $i++): ?>
	$("#field_type_<?php echo $i; ?>").val("<?php echo $old['field_type.'.$i]; ?>");
	$("#field_key_<?php echo $i; ?>").val("<?php echo $old['field_key.'.$i]; ?>");
	<?php endfor; ?>
<?php endif; ?>
	var types = {'decimal':'8,2','unsignedDecimal':'8,2','float':'8,2','double':'','char':'1','string':'255','enum':'option1, option2, option3'};
	function ls(i){
		$("#field_param_"+String(i)).attr('disabled', false);
		var type = $("#field_type_"+String(i)).val();
		if(!types[type]){
			$("#field_param_"+String(i)).attr('placeholder','Optional Input Not Required');
			$("#field_param_"+String(i)).attr('disabled', true);
		}else{
			$("#field_param_"+String(i)).attr('placeholder',types[type]);
		}
	}
	for (var i = 2; i < <?php echo $fn+2; ?>; i++) {
		ls(i);
	};
</script>
<?php if(false): ?>
<script>
	var id = 2; var row = ""; var lrow = []; var rows = ""; var db = [];
	lrow.push('<tr id="r%index%">' + $("table#table_fields tbody tr:nth-child(1)").html() + "</tr>");
	lrow.push('<tr id="r%index%">' + $("table#table_fields tbody tr:nth-child(2)").html() + "</tr>");
	row = '<tr id="r%index%">' + $("table#table_fields tbody tr:nth-child(3)").html() + "</tr>";
	function setData(){
		db=[];
		console.log($("#field_name_1").val());
		for(var i=0; i<lrow.length; i++){
			db.push({}={});
			db[i][2] = $("#field_name_"+String(i+1)).val();
			db[i][3] = $("#field_type_"+String(i+1)).val();
			db[i][4] = $("#field_param_"+String(i+1)).val();
			db[i][5] = $("#field_default_"+String(i+1)).val();
			db[i][6] = $("#field_key_"+String(i+1)).val();
		}
		console.log(db);
	}
	function getData(id=0){
		j=0;
		for(var i=0; i<db.length-1; i++){
			if (i+1==id){j=1}
			$("#field_name_"+String(i+1)).val(db[i+j][2]);
			$("#field_type_"+String(i+1)).val(db[i+j][3]);
			$("#field_param_"+String(i+1)).val(db[i+j][4]);
			$("#field_default_"+String(i+1)).val(db[i+j][5]);
			$("#field_key_"+String(i+1)).val(db[i+j][6]);
		}
	}
	function helper(){
		rows="";
		for(var i=0; i<lrow.length; i++){
			rows=rows+lrow[i].replace(/%index%/g,i+1);
		}
		$("table#table_fields tbody").html(rows);
	}
	function addField() {
		id = id + 1;
		setData();
		lrow.splice(1,0,row);
		helper();
		getData();
	}
	id = id + 1;
	lrow.splice(1,0,row);
	helper();
	// addField();
	function removeField(id) {
		setData();
		lrow.splice(id-1,1);
		helper();
		getData(id);
	}
</script>
<?php endif; ?>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>