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
	<div id="alrt">
		<?php if($domain): ?>
		<?php if($domain->verified == 'done'): ?>
		<div class="alert alert-success text-center"><strong><?php echo $domain->name; ?></strong> Verified already!</div>
		<?php endif; ?>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			<caption class="">
			<?php if($domain): ?> <?php if($domain->verified == 'done'): ?> Verify ownership of the domain <strong><?php echo $domain->name; ?></strong> <?php endif; ?> <?php else: ?> Add New Domain <?php endif; ?>
			<div class="input-group" style="float:right;">
				<a class="btn btn-default" href="/email/domain_list">Back</a></div></caption>
		</div>
	</div>
	<?php if($domain): ?>
	<?php if($domain->verified == 'done'): ?>
	<div class="row">
		<div class="col-md-12 text-center">
			<h3>Method 1: Add TXT record to your domain DNS</h3>
			<p>add TXT record to your domain with </p>
			<p>name : <strong><?php echo $domain->name; ?></strong>, value : <strong><?php echo $domain->verified; ?></strong></p>
			<p>this method may take one day as TXT value in your domain takes time to reflect.</p>
			<p>when you are ready to verify click verify domain button</p>
			<button class="btn btn-primary" onclick="verifyTXT()">Verify Domain</button>
			<script>
				function verifyTXT(){
					$.post("/email/get_txt", {"id":"<?php echo $domain->id; ?>", "_token":"<?php echo $rand; ?>"}, function(data){
						if(data['status'] == 'success'){
							var ht = '<div class="alert alert-success text-center"><strong>Success!</strong> Domain <?php echo $domain->name; ?> Verified successfully!</div>';
							$('#alrt').html(ht);
						}else{
							console.log(data);
							var ht = '<div class="alert alert-danger text-center"><strong>Failed!</strong> Domain <?php echo $domain->name; ?> Not Verified!</div>';
							$('#alrt').html(ht);
						}
					});
				}
			</script>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			<h3>Method 2: Add page to your website</h3>
			<p>add page to your website with</p>
			<p>route name : <strong>http://<?php echo $domain->name; ?>/honeyweb-domain-verification</strong>, page contents : <strong><?php echo $domain->verified; ?></strong></p>
			<p>this method is instant and quick.</p>
			<p>when you are ready to verify click verify domain button</p>
			<button class="btn btn-primary" onclick="verifyPageContent()">Verify Domain</button>
			<script>
				function verifyPageContent(){
					$.post("/email/get_page", {"id":"<?php echo $domain->id; ?>", "_token":"<?php echo $rand; ?>"}, function(data){
						if(data['status'] == 'success'){
							var ht = '<div class="alert alert-success text-center"><strong>Success!</strong> Domain <?php echo $domain->name; ?> Verified successfully!</div>';
							$('#alrt').html(ht);
						}else{
							console.log(data);
							var ht = '<div class="alert alert-danger text-center"><strong>Failed!</strong> Domain <?php echo $domain->name; ?> Not Verified!</div>';
							$('#alrt').html(ht);
						}
					});
				}
			</script>
		</div>
	</div>
	<?php endif; ?>
	<?php endif; ?>
</div>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>