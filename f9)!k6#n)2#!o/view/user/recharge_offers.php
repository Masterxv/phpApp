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
  <div id="alrt"></div>
  <?php if($error['name']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['name']; ?></div>
    <?php endif; ?>
  <?php if($error['id']): ?><div class="alert alert-warning"><strong>Warning!</strong><?php echo $error['id']; ?></div>
    <?php endif; ?>
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm"> My Recharge Offers | @if(\Auth::user()->recharge_balance == (null||0)) <i>Please recharge your account with one of the below offers to visit the control panel</i> @else <i>Your account balance is ₹ {{\Auth::user()->recharge_balance}}</i> <?php endif; ?> </div>
    </div>
    <div class="col-md-4">
      <div class="btn-group" style="float:right;">

      </div>
    </div>
  </div>
  <form method="post" action="{{ route('c.user.recharge') }}" >
  <input type="hidden" name="_token" value="<?php echo $rand; ?>">
  <div class="row">
    <div class="col-md-4">
      <div class="well well-sm">
        <table class="table">
          <thead>
            <tr><th>Trial ( ₹ 50 )</th></tr>
          </thead>
          <tbody>
            <tr><td>1paisa / api call</td></tr>
            <tr><td>1paisa / email</td>
            <tr><td>1paisa / push message</td>
            <tr><td>1paisa / chat message</td>
            <tr><td>28 days validity</td></tr>
            <tr><td>No refund for trial recharge</td></tr>
            <tr><td><button class="btn btn-default" name="plan" value="Trial">Recharge</button></td></tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <div class="well well-sm">
        <table class="table">
          <thead>
            <tr><th>Monthly ( ₹ 250 )</th></tr>
          </thead>
          <tbody>
            <tr><td>1paisa / api call</td></tr>
            <tr><td>1paisa / email</td>
            <tr><td>1paisa / push message</td>
            <tr><td>1paisa / chat message</td>
            <tr><td>28 days validity</td></tr>
            <tr><td>₹ 200 refund option availabe within 10days</td></tr>
            <tr><td><button class="btn btn-default" name="plan" value="Monthly">Recharge</button></td></tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <div class="well well-sm">
        <table class="table">
          <thead>
            <tr><th>Yearly ( ₹ 2000 )</th></tr>
          </thead>
          <tbody>
            <tr><td>1paisa / api call</td></tr>
            <tr><td>1paisa / email</td>
            <tr><td>1paisa / push message</td>
            <tr><td>1paisa / chat message</td>
            <tr><td>365 days validity</td></tr>
            <tr><td>₹ 1950 refund option availabe within 28days</td></tr>
            <tr><td><button class="btn btn-default" name="plan" value="Yearly">Recharge</button></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </form>
</div>
<script>
  
</script>
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>