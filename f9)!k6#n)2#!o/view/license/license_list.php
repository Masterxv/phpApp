<!DOCTYPE html>
<html>
<head>
  <?php require($app_key.'/view/layouts/styles.html'); ?>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>
<?php require($app_key.'/view/layouts/nav.php'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      Licenses List | for the app id: <?php echo $_SESSION[$app_key.'_user_active_app_id']; ?>
    </div>
    <div class="col-md-6">
      <div class="btn-group" style="float:right">
        <button class="btn btn-default" data-toggle="modal" data-target="#createNewLicense">Create New License</button>
        <a class="btn btn-default" href="/license/test_bench" target="_blank">Test Bench</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive" style="padding-bottom: 50px;">
      <table class="table">
        <thead>
          <tr>
            <th>Sr.</th>
            <th>Serial No</th>
            <th>License Key</th>
            <th>Total Licenses</th>
            <th>Activated Licenses</th>
            <th>Expiry Date</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($licenses as $k => $license): ?>
          <form id="frm<?php echo $k; ?>" method="post" action="/license/update/<?php echo $license['id']; ?>">
            <input type="hidden" name="_token" value="<?php echo $rand; ?>" />
            <tr>
              <td><?php echo ($k + 1) + 10 * ($pageno-1); ?></td>
              <td><?php echo $license['id']; ?></td>
              <td><?php echo $license['license_key']; ?></td>
              <td id="tl<?php echo $k; ?>"><?php echo $license['total_licenses']; ?></td>
              <td id="tle<?php echo $k; ?>" style="display: none">
                <input type="number" name="total_licenses" class="form-control" value="<?php echo $license['total_licenses']; ?>" />
              </td>
              <td><?php echo $license['activated_licenses']; ?></td>
              <td id="ed<?php echo $k; ?>"><?php echo $license['expiry_date']; ?></td>
              <td id="ede<?php echo $k; ?>" style="display: none">
                <input type="date" name="expiry_date" class="form-control" value="<?php echo $license['expiry_date']; ?>" />
              </td>
              <td>
                <a href="JavaScript:void(0);" id="edb<?php echo $k; ?>" onclick="ri(<?php echo $k; ?>)" data-toggle="modal" data-target="#editLicense">Edit</a>
              </td>
              <td>
                <a href="/license/license_details/<?php echo $license['id']; ?>">License Details</a>
              </td>
            </tr>
            </form>
            <form id="dbf<?php echo $k; ?>" method="post" action="/license/delete/<?php echo $license['id']; ?>" style="display: none;"><input type="hidden" name="_token" value="<?php echo $rand; ?>"></form>
          <?php endforeach; ?>
        </tbody>
      </table>
      </div>
    </div>
    <div class="col-md-12">
      <?php include($app_key.'/layouts/pagination.php') ?>
    </div>
  </div>
</div>
<script>
  var edit = JSON.parse('<?php echo json_encode(array_fill(0, count($licenses), array('display' => 'none'))); ?>');
  function ri(id){
    $("#tl" + String(id)).css(edit[id]);
    $("#ed" + String(id)).css(edit[id]);
    if(edit[id]['display'] == "block"){
      edit[id]['display'] = "none";
      $("#edb" + String(id)).html('Edit');
      $('#frm' + String(id)).submit();
    }else{
      edit[id]['display'] = "block";
      $("#edb" + String(id)).html('Update');
    }
    $("#tle" + String(id)).css(edit[id]);
    $("#ede" + String(id)).css(edit[id]);
  }
  function di(id){
    document.getElementById('dbf' + String(id)).submit();
  }

</script>

<!-- Modal -->
<div id="createNewLicense" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New License</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="/license/new_license">
          <input type="hidden" name="_token" value="<?php echo $rand; ?>" />

          <div class="form-group">
            <label for="total_licenses">Total number of licenses</label>
            <input type="number" name="total_licenses" class="form-control<?php echo $error['total_licenses'] ? ' is-invalid' : ''; ?>" value="<?php echo $row['total_licenses']; ?>" required autofocus>
            <?php if($error['total_licenses']): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo $error['total_licenses']; ?></strong>
                </span>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="expiry_date">Expiry date</label>
            <input type="date" name="expiry_date" class="form-control<?php echo $error['expiry_date'] ? ' is-invalid' : ''; ?>" value="<?php echo $row['expiry_date']; ?>" required autofocus>
            <?php if($error['expiry_date']): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo $error['expiry_date']; ?></strong>
                </span>
            <?php endif; ?>
          </div>
          <div class="form-group"><button type="submit" class="btn btn-primary">Create</button></div>
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div>

  </div>
</div>

<?php require($app_key.'/view/layouts/scripts.html'); ?>
</body>
</html>