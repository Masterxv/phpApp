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
										<option>INCREMENTS</option>
										<option>TINY INCREMENTS</option>
										<option>SMALL INCREMENTS</option>
										<option>MEDIUM INCREMENTS</option>
										<option>BIG INCREMENTS</option>
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
										<option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option><option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size" selected>VARCHAR</option><option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option><option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option><optgroup label="Numeric"><option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255">TINYINT</option><option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535">SMALLINT</option><option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215">MEDIUMINT</option><option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option><option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615">BIGINT</option><option disabled="disabled">-</option><option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255">UNSIGNED TINYINT</option><option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535">UNSIGNED SMALLINT</option><option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215">UNSIGNED MEDIUMINT</option><option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">UNSIGNED INT</option><option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615">UNSIGNED BIGINT</option><option disabled="disabled">-</option><option title="A fixed-point number (M, D) - the maximum number of digits (M) is 65 (default 10), the maximum number of decimals (D) is 30 (default 0)">DECIMAL</option><option title="A small floating-point number, allowable values are -3.402823466E+38 to -1.175494351E-38, 0, and 1.175494351E-38 to 3.402823466E+38">FLOAT</option><option title="A double-precision floating-point number, allowable values are -1.7976931348623157E+308 to -2.2250738585072014E-308, 0, and 2.2250738585072014E-308 to 1.7976931348623157E+308">DOUBLE</option><option title="Synonym for DOUBLE (exception: in REAL_AS_FLOAT SQL mode it is a synonym for FLOAT)">REAL</option><option disabled="disabled">-</option><option title="A bit-field type (M), storing M of bits per value (default is 1, maximum is 64)">BIT</option><option title="A synonym for TINYINT(1), a value of zero is considered false, nonzero values are considered true">BOOLEAN</option><option title="An alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE">SERIAL</option></optgroup><optgroup label="Date and time"><option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option><option title="A date and time combination, supported range is 1000-01-01 00:00:00 to 9999-12-31 23:59:59">DATETIME</option><option title="A timestamp, range is 1970-01-01 00:00:01 UTC to 2038-01-09 03:14:07 UTC, stored as the number of seconds since the epoch (1970-01-01 00:00:00 UTC)">TIMESTAMP</option><option title="A time, range is -838:59:59 to 838:59:59">TIME</option><option title="A year in four-digit (4, default) or two-digit (2) format, the allowable values are 70 (1970) to 69 (2069) or 1901 to 2155 and 0000">YEAR</option></optgroup><optgroup label="String"><option title="A fixed-length (0-255, default 1) string that is always right-padded with spaces to the specified length when stored">CHAR</option><option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option><option disabled="disabled">-</option><option title="A TEXT column with a maximum length of 255 (2^8 - 1) characters, stored with a one-byte prefix indicating the length of the value in bytes">TINYTEXT</option><option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option><option title="A TEXT column with a maximum length of 16,777,215 (2^24 - 1) characters, stored with a three-byte prefix indicating the length of the value in bytes">MEDIUMTEXT</option><option title="A TEXT column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) characters, stored with a four-byte prefix indicating the length of the value in bytes">LONGTEXT</option><option disabled="disabled">-</option><option title="Similar to the CHAR type, but stores binary byte strings rather than non-binary character strings">BINARY</option><option title="Similar to the VARCHAR type, but stores binary byte strings rather than non-binary character strings">VARBINARY</option><option disabled="disabled">-</option><option title="A BLOB column with a maximum length of 255 (2^8 - 1) bytes, stored with a one-byte prefix indicating the length of the value">TINYBLOB</option><option title="A BLOB column with a maximum length of 16,777,215 (2^24 - 1) bytes, stored with a three-byte prefix indicating the length of the value">MEDIUMBLOB</option><option title="A BLOB column with a maximum length of 65,535 (2^16 - 1) bytes, stored with a two-byte prefix indicating the length of the value">BLOB</option><option title="A BLOB column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) bytes, stored with a four-byte prefix indicating the length of the value">LONGBLOB</option><option disabled="disabled">-</option><option title="An enumeration, chosen from the list of up to 65,535 values or the special '' error value">ENUM</option><option title="A single value chosen from a set of up to 64 members">SET</option></optgroup><optgroup label="Spatial"><option title="A type that can store a geometry of any type">GEOMETRY</option><option title="A point in 2-dimensional space">POINT</option><option title="A curve with linear interpolation between points">LINESTRING</option><option title="A polygon">POLYGON</option><option title="A collection of points">MULTIPOINT</option><option title="A collection of curves with linear interpolation between points">MULTILINESTRING</option><option title="A collection of polygons">MULTIPOLYGON</option><option title="A collection of geometry objects of any type">GEOMETRYCOLLECTION</option></optgroup><optgroup label="JSON"><option title="Stores and enables efficient access to data in JSON (JavaScript Object Notation) documents">JSON</option></optgroup>
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
								    <option value="">---</option>
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
								created_at
								<input type="hidden" name="field_name[<?php echo $fn+2; ?>]" value="created_at" />
							</td>
							<td colspan="4">
								TIMESTAMP DEFAULT CURRENT_TIMESTAMP
								<input type="hidden" name="field_type[<?php echo $fn+2; ?>]" value="created_at_timestamp" />
							</td>
						</tr>
						<tr>
							<td><?php echo $fn+3; ?></td>
							<td>
								updated_at
								<input type="hidden" name="field_name[<?php echo $fn+3; ?>]" value="updated_at" />
							</td>
							<td colspan="4">
								TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
								<input type="hidden" name="field_type[<?php echo $fn+3; ?>]" value="updated_at_timestamp" />
							</td>
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
	var types = {'DECIMAL':'8,2','FLOAT':'8,2','CHAR':'0 - 255','VARCHAR':'ex:- 255','ENUM':'option1, option2, option3'};
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
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>