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
  <div id="alrt"></div>
  <?php if($error['name']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['name']; ?></div>
    <?php endif; ?>
  <?php if($error['id']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['id']; ?></div>
    <?php endif; ?>
  <div class="row">
    <div class="col-md-8">
      <div class="well well-sm"> My Usage Report | Balance: ₹ {{\Auth::user()->recharge_balance}}, Expiry Date: {{\Auth::user()->recharge_expiry_date}}, Space Used: {{$size}} MB</div>
    </div>
    <div class="col-md-4">
      <div class="btn-group" style="float:right;">
        
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm">
        <table class="table">
          <thead>
            <tr>
              <th>Sr.</th>
              <th>App Id</th>
              <th>Date</th>
              <th>Api Calls</th>
              <th>Emails Sent</th>
              <th>Push Sent</th>
              <th>Chat Messages</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($ur as $r): ?>
            <tr>
              <td>{{ ($loop->index + 1) + 10 * ($page-1)}}</td>
              <td>{{$r->app_id}}</td>
              <td>{{$r->date}}</td>
              <td>{{$r->api_calls}}</td>
              <td>{{$r->emails_sent}}</td>
              <td>{{$r->push_sent}}</td>
              <td>{{$r->chat_messages}}</td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-12">
        <?php include($app_key.'/layouts/pagination.php') ?>
      </div>
    </div>
  </div>
</div>
<script>
  
</script>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>