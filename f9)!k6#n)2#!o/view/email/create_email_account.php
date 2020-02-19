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
			Create New Email Account	<div class="input-group" style="float:right;">
				<a id="back" class="btn btn-default" href="/email/mail_list">Back</a></div>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form method="post" action="{{route('c.email.new.user.submit')}}" >
		        <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
		        <input type="hidden" name="email" id="email" />
		        <input type="hidden" name="domain_id" id="did" />
		        <div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="user">User Name:</label>
					</div>
					<div class="col-md-6">
						<input id="user" type="text" class="form-control" name="user" placeholder="User Name" value="{{old('user')}}" onchange="setEmail()">
						@if($errors->has('email'))
						<p style="color:red">{{$errors->first('email')}}</p> <?php endif; ?>
					</div>
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="domain">Domain Name:</label>
					</div>
					<div class="col-md-6">
						<select class="form-control" id="domain" onchange="setEmail()">
						<?php foreach ($domains as $d): ?> <option value="{{$d}}">{{$d->name}}</option> <?php endforeach; ?>
						</select>
					</div>			
				</div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="aid">Alias Emails:</label>
					</div>
					<div class="col-md-6">
						<div class="well well-sm" id="afields">none</div>
						<input id="aid" type="hidden" class="form-control" name="alias">
						@if($errors->has('alias'))
						  <p style="color:red">{{$errors->first('alias')}}</p><?php endif; ?>
						<div class="row">
							<div class="col-md-12">
								<?php foreach ($alias as $a): ?>
								<div class="checkbox" style="display: inline-flex; margin-right: 10px"><label><input type="checkbox" onchange="a('{{$a}}')" @if(in_array($a, explode(' ', old('alias')))) checked <?php endif; ?>>{{$a}}</label></div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div><hr>
	            <div class="form-group row">
	            	<div class="col-md-1"></div>
					<div class="col-md-4">
						<label for="password">Password</label>
					</div>
					<div class="col-md-6">
						<input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" placeholder="Password">
						@if($errors->has('password'))
						  <p style="color:red">{{$errors->first('password')}}</p> 
						<?php endif; ?>
					</div>      
	            </div>
	            <div class="form-group row">
	            	<div class="col-md-1"></div>
	                <div class="col-md-4">
	                    <label for="password-confirm">Confirm Password</label>
	                </div>
	                <div class="col-md-6">
	                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"	/>
	                </div>
	            </div><hr>
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-4"></div>
					<div class="col-md-6">
						<button class="btn btn-primary">Create New Email Account</button>
					</div>			
				</div><hr>
		    </form>
		</div>
	</div>
</div>
<script>
	$("#afields").html('{{old('alias')??'none'}}');
	$("#aid").val('{{old('alias')??null}}');
</script>
<script>
	var alias = {!! json_encode($alias) !!};
	var af={!! json_encode(old('alias')?explode(', ', old('alias')):[]) !!};
	Array.prototype.diff = function(a) {
	    return this.filter(function(i) {return a.indexOf(i) < 0;});
	};
	function a(v){
		if(af.indexOf(v) != -1){
			af.splice(af.indexOf(v),1);
		}else{
			af.push(v);
		}
		let diff = alias.diff(af);
		diff = alias.diff(diff);
		$("#afields").html(diff.join(" "));
		$("#aid").val(diff.join(" "));
	}
	function setEmail(){
		const d = JSON.parse($('#domain').val());
		$("#did").val(d['id']);
		$("#email").val($("#user").val()+"@"+d['name']);
		console.log($("#email").val());
	}
	// function saveUser(){
	// 	let pb = {};
	// 	const d = JSON.parse($('#domain').val());
	// 	pb['email'] = $('#user').val()+'@'+d['name'];
	// 	pb['domain_id'] = d['id'];
	// 	pb['alias'] = $("#aid").val();
	// 	pb['password'] = $("#password").val();
	// 	pb['password_confirmation'] = $("#password-confirm").val();
	// 	pb['_token'] = "<?php echo $rand; ?>";
	// 	$.post('{{route('c.email.new.user.submit')}}', pb, function(data){
	// 		if(data.status == 'success'){
	// 			$("#back")[0].click();
	// 		}else{
	// 			console.log(data);
	// 		}
	// 	});
	// }
</script>
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>