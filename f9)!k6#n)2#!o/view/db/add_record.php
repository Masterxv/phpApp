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
	<div class="row">
		<div class="col-md-12 text-center">
			Add new record for table "<?php echo $table; ?>"
			<div class="btn-group" style="float:right;">
				<a class="btn btn-default" href="/table/crud_view?table=<?php echo $table; ?>">Back</a></div>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form method="post" action="/table/add_record" >
		        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
		        <input type="hidden" name="table" value="<?php echo $table; ?>" />
		        <?php foreach ($td as $k => $v): ?>
		        <?php if(!$isTA[$v->Type]): ?>
					<?php if(strpos($v->Type,'enum')!==false): ?>
					<div class="form-group row">
						<div class="col-md-1"></div>
						<div class="col-md-4">
							<label for="<?php echo $v->Field; ?>"><?php echo $v->Field; ?>:</label>
						</div>
						<div class="col-md-6">
							<select id="<?php echo $v->Field; ?>" class="form-control" name="<?php echo $v->Field; ?>">
							<?php foreach (explode(',', str_replace(['enum(',')',"'",' '],['','','',''],$v->Type)) as $value): ?>
								<option><?php echo $value; ?></option>
							<?php endforeach; ?>
							</select>
							<!-- <input id="<?php echo $v->Field; ?>" type="text" class="form-control" name="<?php echo $v->Field; ?>" value="<?php echo  $old[$v->Field] ; ?>" placeholder="<?php echo $v->Field; ?>" > -->
							<?php if($error[$v->Field]): ?>
									<p style="color:red"><?php echo $error[$v->Field]; ?></p> <?php endif; ?>
						</div>			
					</div>
					<script>
		                $("#<?php echo $v->Field; ?>").val('<?php echo  $old[$v->Field] ; ?>');
		            </script>
					<?php else: ?>
						<?php if(!$step[$v->Type]): ?>
							<div class="form-group row">
								<div class="col-md-1"></div>
								<div class="col-md-4">
									<label for="<?php echo $v->Field; ?>"><?php echo $v->Field; ?>:</label>
								</div>
								<div class="col-md-6">
									<input id="<?php echo $v->Field; ?>" type="<?php echo $inpTyp[$v->Type]; ?>" class="form-control" name="<?php echo $v->Field; ?>" value="<?php echo  $old[$v->Field] ; ?>" placeholder="<?php echo $v->Field; ?>" >
									<?php if($error[$v->Field]): ?>
											<p style="color:red"><?php echo $error[$v->Field]; ?></p> <?php endif; ?>
								</div>			
							</div>
							<?php if($v->Field == 'password'): ?>
							<div class="form-group row">
								<div class="col-md-1"></div>
								<div class="col-md-4">
									<label for="confirm_password">confirm_password:</label>
								</div>
								<div class="col-md-6">
									<input id="confirm_password" type="<?php echo $inpTyp[$v->Type]; ?>" class="form-control" name="confirm_password" value="<?php echo  $old[$v->Field] ; ?>" placeholder="confirm_password" >
								</div>			
							</div>
							<?php endif; ?>
						<?php else: ?>
						<div class="form-group row">
							<div class="col-md-1"></div>
							<div class="col-md-4">
								<label for="<?php echo $v->Field; ?>"><?php echo $v->Field; ?>:</label>
							</div>
							<div class="col-md-6">
								<input id="<?php echo $v->Field; ?>" type="<?php echo $inpTyp[$v->Type]; ?>" class="form-control" name="<?php echo $v->Field; ?>" value="<?php echo  $old[$v->Field] ; ?>" placeholder="<?php echo $v->Field; ?>"   step="<?php echo $step[$v->Type]; ?>">
								<?php if($error[$v->Field]): ?>
										<p style="color:red"><?php echo $error[$v->Field]; ?></p> <?php endif; ?>
							</div>			
						</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php else: ?>
					<div class="form-group row">
						<div class="col-md-1"></div>
						<div class="col-md-4">
							<label for="<?php echo $v->Field; ?>"><?php echo $v->Field; ?>:</label>
						</div>
						<div class="col-md-6">
							<textarea id="<?php echo $v->Field; ?>" type="text" rows="<?php echo $isTA[$v->Type]; ?>" class="form-control" name="<?php echo $v->Field; ?>" placeholder="<?php echo $v->Field; ?>"></textarea>
							<?php if($error[$v->Field]): ?>
									<p style="color:red"><?php echo $error[$v->Field]; ?></p> <?php endif; ?>
						</div>			
					</div>
					<script>
		                $("#<?php echo $v->Field; ?>").val('<?php echo  str_replace(array("\r", "\n", '\n\n'), '\n', $old[$v->Field]) ; ?>');
		            </script>
				<?php endif; ?>
				<?php endforeach; ?>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4"></div>
					<div class="col-md-6">
						<button type="submit" class="btn btn-primary">Add New Record</button>
					</div>			
				</div>
		    </form>
		</div>
	</div>
</div>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>