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
			Edit record for table "<?php echo $table; ?>"
			<div class="input-group" style="float:right;">
				<a class="btn btn-default" href="/table/crud_view?table=<?php echo $table; ?>">Back</a></div>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form method="post" action="/table/edit_record" >
		        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
		        <input type="hidden" name="table" value="<?php echo $table; ?>" />
		        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
		        <?php foreach ($td as $k => $v): ?>
		        	<?php if($v['Key']=='PRI'): ?>
					<div class="form-group row">
						<div class="col-md-1"></div>
						<div class="col-md-4">
							<label><?php echo $v['Field']; ?>:</label>
						</div>
						<div class="col-md-6">
							<?php echo $record[$v['Field']]; ?>
						</div>			
					</div>
					<?php continue; ?>
					<?php endif; ?>
					<?php if(strpos($v['Type'],'enum')!==false): ?>
					<div class="form-group row">
						<div class="col-md-1"></div>
						<div class="col-md-4">
							<label for="<?php echo $v['Field']; ?>"><?php echo $v['Field']; ?>:</label>
						</div>
						<div class="col-md-6">
							<select class="form-control" name="<?php echo $v['Field']; ?>">
							<?php foreach (explode(',', str_replace(['enum(',')',"'",' '],['','','',''],$v['Type'])) as $value): ?>
								<option><?php echo $value; ?></option>
							<?php endforeach; ?>
							</select>
							<?php if($error[$v['Field']]): ?>
									<p style="color:red"><?php echo $error[$v['Field']]; ?></p> <?php endif; ?>
						</div>			
					</div>
					<?php elseif($v['Type']=='text'): ?>
					<div class="form-group row">
						<div class="col-md-1"></div>
						<div class="col-md-4">
							<label for="<?php echo $v['Field']; ?>"><?php echo $v['Field']; ?>:</label>
						</div>
						<div class="col-md-6">
							<textarea rows="4" class="form-control" name="<?php echo $v['Field']; ?>"><?php echo $record[$v['Field']]; ?></textarea>
							<?php if($error[$v['Field']]): ?>
									<p style="color:red"><?php echo $error[$v['Field']]; ?></p> <?php endif; ?>
						</div>			
					</div>
					<?php else: ?>
					<div class="form-group row">
						<div class="col-md-1"></div>
						<div class="col-md-4">
							<label for="<?php echo $v['Field']; ?>"><?php echo $v['Field']; ?>:</label>
						</div>
						<div class="col-md-6">
							<input type="<?php echo $inpTyp[$v['Type']]; ?>" class="form-control" name="<?php echo $v['Field']; ?>" value="<?php echo $record[$v['Field']]; ?>">
							<?php if($error[$v['Field']]): ?>
									<p style="color:red"><?php echo $error[$v['Field']]; ?></p> <?php endif; ?>
						</div>			
					</div>
					<?php endif; ?>
				<?php endforeach; ?>
		        <div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4"></div>
					<div class="col-md-6">
						<button type="submit" class="btn btn-primary">Edit Record</button>
					</div>			
				</div>
		      </form>
		</div>
	</div>
</div>
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>