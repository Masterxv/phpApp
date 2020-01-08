<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="btn btn-primary navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
        </button>
        <a href="/"><svg height="45" width="250">
            <text x="0" y="28" fill="yellow" style="font-size:27px; font-weight:bold;">HoneyWeb.Org</text>
            <text x="0" y="42" fill="pink" style="font-size:9px; font-weight:bold; letter-spacing: .38rem;">Delightful Web Creations</text>
          HoneyWeb.Org
        </svg></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
        <?php if(!$_SESSION[$app_key."_user_id"]): ?>
          <li><a href="/blog"><i class="fa fa-edit"></i> Blog</a></li>
          <li><a href="/docs"><i class="fa fa-book"></i> Docs</a></li>
          <li><a href="/register_view"><i class="fa fa-user"></i> Sign Up</a></li>
          <li><a href="/login_view"><i class="fa fa-sign-in"></i> Login</a></li>
        <?php else: ?>
          <li><a href="/app/app_list"><i class="fa fa-desktop"></i> MyApps</a></li>
          <?php if(!in_array('Licenses', json_decode($_SESSION['hidden_modules'],true)??[])): ?>
            <li><a href="/license/license_list"><i class="fa fa-lock"></i> Licenses</a></li>
          <?php endif; ?>
          <li><a href="/table/table_list"><i class="fa fa-database"></i> Tables</a></li>
          <li><a href="/query/query_list"><i class="fa fa-search"></i> Queries</a></li>
          <li><a href="/files/files_view"><i class="fa fa-file"></i> Files</a></li>
          <li><a href="/email/mail_list"><i class="fa fa-envelope"></i> Email</a></li>
          <li><a href="/push/messages"><i class="fa fa-bullhorn"></i> Push</a></li>
          <li><a href="/chat/messages_view"><i class="fa fa-comments"></i> Chat</a></li>
          <li><a href="/app/log_view"><i class="fa fa-edit"></i> Log</a></li>
          
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> <?php echo $_SESSION[$app_key.'_user_name']; ?>
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if($_SESSION[$app_key."_user_avatar"]): ?>
              <li><a href=""><image class="avatar" src="<?php echo $_SESSION[$app_key."_user_avatar"]; ?>" /></a></li>
              <?php else: ?>
              <li><a href=""><image  src="https://via.placeholder.com/120" /></a></li>
              <?php endif; ?>
              <li data-toggle="modal" data-target="#avatarUrl"><a style="cursor: pointer;"><i class="fa fa-user-circle-o"></i> Avatar Url</a></li>
              <li><a href="/docs"><i class="fa fa-graduation-cap"></i> Docs</a></li>
              <li data-toggle="modal" data-target="#inviteFriend"><a style="cursor: pointer;"><i class="fa fa-handshake-o"></i> Invite Friend</a></li>
              <li><a href="/user/recharge_history"><i class="fa fa-money"></i> Recharge History</a></li>
              <li><a href="/user/usage_report"><i class="fa fa-line-chart"></i> Usage Report</a></li>
              <li><a href="/logout" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"><span class="fa fa-sign-out"></span> Logout</a></li>
              <form id="logout-form" action="/logout" method="POST" style="display: none;">
                  <input type="hidden" name="_token" value="<?php echo $rand; ?>">
              </form>
            </ul>
          </li>
          <?php endif; ?>
      </ul>
    </div>
</nav>