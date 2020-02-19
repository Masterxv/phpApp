<!-- @extends("cb.layouts.blog")

@if($category == 'github' && $article =='basic-git-usage')

@section("category")
<h4><a href="/blog">Category</a> >> <a href="/blog/<?php echo $category; ?>">Github</a> >> <a href="/blog/<?php echo $category; ?>/<?php echo $article; ?>">Basic Git Usage</a></h4>
@endsection

@section("blog")
@include('cb.blog.basic-git-usage')
@endsection

<?php endif; ?> -->


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
<?php if($category == 'github' && $article =='basic-git-usage'): ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-9">
      <h4><a href="/blog">Category</a> >> <a href="/blog/<?php echo $category; ?>">Github</a> >> <a href="/blog/<?php echo $category; ?>/<?php echo $article; ?>">Basic Git Usage</a></h4>
      <!-- <ul class="breadcrumb">
        <li><a href="/blog">Category</a></li>
        <li><a href="/blog/<?php echo $category; ?>">Github</a></li>
        <li class="active">Basic Git Usage</li>
      </ul> -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-9">
      <?php include($app_key.'/view/blog/basic-git-usage.php') ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>