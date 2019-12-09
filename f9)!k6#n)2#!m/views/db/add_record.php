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
			Add new record for table "{{$table}}"
			<div class="btn-group" style="float:right;">
				<a class="btn btn-default" href="/table/crud_view?table={{$table}}">Back</a></div>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form method="post" action="/table/add_record" >
		        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
		        <input type="hidden" name="table" value="{{$table}}" />
		        @foreach($td as $k => $v)
		        @empty($isTA[$v->Type])
					@if(strpos($v->Type,'enum')!==false)
					<div class="form-group row">
						<div class="col-md-1"></div>
						<div class="col-md-4">
							<label for="{{$v->Field}}">{{$v->Field}}:</label>
						</div>
						<div class="col-md-6">
							<select id="{{$v->Field}}" class="form-control" name="{{$v->Field}}">
								@foreach(explode(',', str_replace(['enum(',')',"'",' '],['','','',''],$v->Type)) as $value)
								<option>{{$value}}</option>
								<?php endforeach; ?>
							</select>
							{{-- <input id="{{$v->Field}}" type="text" class="form-control" name="{{$v->Field}}" value="{{ old($v->Field) }}" placeholder="{{$v->Field}}" > --}}
							@if($errors->has($v->Field))
									<p style="color:red">{{$errors->first($v->Field)}}</p> <?php endif; ?>
						</div>			
					</div>
					<script>
		                $("#{{$v->Field}}").val('{{ old($v->Field) }}');
		            </script>
					@else
						@empty($step[$v->Type])
							<div class="form-group row">
								<div class="col-md-1"></div>
								<div class="col-md-4">
									<label for="{{$v->Field}}">{{$v->Field}}:</label>
								</div>
								<div class="col-md-6">
									<input id="{{$v->Field}}" type="{{$inpTyp[$v->Type]}}" class="form-control" name="{{$v->Field}}" value="{{ old($v->Field) }}" placeholder="{{$v->Field}}" >
									@if($errors->has($v->Field))
											<p style="color:red">{{$errors->first($v->Field)}}</p> <?php endif; ?>
								</div>			
							</div>
							@if($v->Field == 'password')
							<div class="form-group row">
								<div class="col-md-1"></div>
								<div class="col-md-4">
									<label for="confirm_password">confirm_password:</label>
								</div>
								<div class="col-md-6">
									<input id="confirm_password" type="{{$inpTyp[$v->Type]}}" class="form-control" name="confirm_password" value="{{ old($v->Field) }}" placeholder="confirm_password" >
								</div>			
							</div>
							<?php endif; ?>
						@else
						<div class="form-group row">
							<div class="col-md-1"></div>
							<div class="col-md-4">
								<label for="{{$v->Field}}">{{$v->Field}}:</label>
							</div>
							<div class="col-md-6">
								<input id="{{$v->Field}}" type="{{$inpTyp[$v->Type]}}" class="form-control" name="{{$v->Field}}" value="{{ old($v->Field) }}" placeholder="{{$v->Field}}"   step="{{$step[$v->Type]}}">
								@if($errors->has($v->Field))
										<p style="color:red">{{$errors->first($v->Field)}}</p> <?php endif; ?>
							</div>			
						</div>
						@endempty
					<?php endif; ?>
				@else
					<div class="form-group row">
						<div class="col-md-1"></div>
						<div class="col-md-4">
							<label for="{{$v->Field}}">{{$v->Field}}:</label>
						</div>
						<div class="col-md-6">
							<textarea id="{{$v->Field}}" type="text" rows="{{$isTA[$v->Type]}}" class="form-control" name="{{$v->Field}}" placeholder="{{$v->Field}}"></textarea>
							@if($errors->has($v->Field))
									<p style="color:red">{{$errors->first($v->Field)}}</p> <?php endif; ?>
						</div>			
					</div>
					<script>
		                $("#{{$v->Field}}").val('{{ str_replace(array("\r", "\n", '\n\n'), '\n', old($v->Field)) }}');
		            </script>
				@endempty
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