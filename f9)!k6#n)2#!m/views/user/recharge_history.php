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
      <div class="well well-sm"> My Recharge History | Balance: ₹ {{\Auth::user()->recharge_balance}}, Expiry Date: {{\Auth::user()->recharge_expiry_date}}</div>
    </div>
    <div class="col-md-4">
      <div class="btn-group" style="float:right;">
        <a class="btn btn-default" href="{{ route('c.user.recharge_offers.view') }}">New Recharge</a>
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
              <th>Plan</th>
              <th>Status</th>
              <th>Expiry Date</th>
              <th>Recharge Date</th>
              <th>Recharge Amount</th>
              <th>Tax</th>
              <th>Top Up</th>
              <th colspan="3">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rh as $r)
            <tr>
              <td>{{ ($loop->index + 1) + 10 * ($page-1)}}</td>
              <td>{{$r->plan}}</td>
              <td>{{$r->status}}</td>
              <td>{{$r->expiry_date}}</td>
              <td>{{$r->recharge_date}}</td>
              <td>{{$r->recharge_amount}}</td>
              <td>{{$r->tax}}</td>
              <td>{{$r->top_up}}</td>
              <td><a href="{{ route('c.recharge.status', ['id'=> $r->id]) }}">Status</a></td>
              <td><a href="{{ route('c.refund.payment', ['id'=> $r->id]) }}">Refund</a></td>
              <td><a href="{{ route('c.refund.status', ['id'=> $r->id]) }}">Refund Status</a></td>
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