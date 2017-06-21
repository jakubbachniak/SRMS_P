
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo site_url('site/home')?>">SRMS Prototype</a>
    </div>
    <?php if ($al == 1) {
      echo '
        <ul class="nav navbar-nav">
                  <!-- staff Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Manage Staff<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header">View &amp; Edit</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/staff/staff">Staff</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Add New</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/staff/staff/add">Staff</a></li>
            </ul>
          </li>
                    <!-- Therapist Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Manage Therapists<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header">View &amp; Edit</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapist/therapist">Therapists</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/room/room/">Therapy Rooms</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapist_qualif/staff_qualif">Therapist &amp; Qualification</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Add New</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapist/therapist/add">Therapist</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/room/room/add">Therapy Room</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapist_qualif/staff_qualif/add">Therapist &amp; Qualification</a></li>
            </ul>
          </li>
                    <!-- Qualifications Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Manage Qualifications<span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li class="dropdown-header">View &amp; Edit</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/qualifications/qualifications">Qualifications</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Add New</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/qualifications/qualifications/add">Qualifications</a></li>
            </ul>
          </li>
                    <!-- Therapy Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Manage Therapies<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header">View &amp; Edit</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/therapy">Therapy List</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy_session/therapy_session">Therapy Sessions</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/equipment/equipment">Equipment List</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Add New</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/therapy/add">Therapy</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy_session/therapy_session/add">Therapy Sessions</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/equipment/equipment/add">Equipment</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy_equipment/therapy_equipment">Link Therapy &amp; Equipment</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/archived_therapy">Archived Therapies</a></li>
            </ul>
          </li>
                    <!-- Custom SQL Report Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Custom SQL Reports<span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li class="dropdown-header">Therapy Reports</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy_popularity/therapy_popularity">Therapy Popularity</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Equipment Reports</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/equipment_pending_review/equipment_pending_review/">Pending Equipment Review</a></li>
            </ul>
          </li>
        </ul>
      ';
    } else if ($al == 2): {
      echo '
        <ul class="nav navbar-nav">
                  <!-- Therapy Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Manage Therapies<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header">View &amp; Edit</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/therapy">Therapy List</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy_session/therapy_session">Therapy Sessions</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Add New</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/therapy/add">Therapies</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy_session/therapy_session/add">Therapy Sessions</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/archived_therapy">Archived Therapies</a></li>
            </ul>
          </li>
                <!-- Equipment Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Manage Equipment<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header">View &amp; Edit</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/equipment/equipment">Equipment List</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Add New</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/equipment/equipment/add">Equipment</a></li>
            </ul>
          </li>
                  <!-- Therapy/Equipment Menu Items -->
          <li class="dropdown">
            <li>
              <a href="http://localhost:8888/uh-team-a/index.php/therapy_equipment/therapy_equipment">Link Therapy &amp; Equipment</a>
            </li>
          </li>
                  <!-- Therapists &amp; Qualifications Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Therapists<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapist/therapistReadOnly">Spa Therapists</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapist_qualif/staff_qualifReadOnly">Therapist Qualifications</a></li>
            </ul>
          </li>
                  <!-- Custom SQL Report Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Custom SQL Reports<span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li class="dropdown-header">Therapy Reports</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy_popularity/therapy_popularity">Therapy Popularity</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Equipment Reports</li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/equipment_pending_review/equipment_pending_review/">Pending Equipment Review</a></li>
            </ul>
          </li>
            </ul>
          </li>
        </ul>
      ';
    } elseif ($al == 3): {
      echo '
        <ul class="nav navbar-nav">
          <li>
            <a href="http://localhost:8888/uh-team-a/index.php/therapist/therapistReadOnly">My Therapist Info</a>
          </li>
          <li>
            <a href="http://localhost:8888/uh-team-a/index.php/therapist_qualif/member_qualifications">My qualifications</a>
          </li>
          <li>
            <a href="http://localhost:8888/uh-team-a/index.php/therapy/read_only_therapy">Therapies</a>
          </li>
          <li>
            <a href="http://localhost:8888/uh-team-a/index.php/equipment/read_only_equipment">Equipment</a>
          </li>
        </ul>
      ';
    } endif;
    ?>
    <ul class="nav navbar-nav navbar-right">
      <?php if ($al == 1): {
                echo '
                  <li class="dropdown">
                    <a class="navbar-link" href="http://localhost:8888/uh-team-a/index.php/staff/staff_member"><span class="glyphicon glyphicon-user"></span> ';
                echo $user;
                echo ' - Access level: Manager </a></li>';
              } elseif ($al == 2): {
                echo '
                  <li class="dropdown">
                    <a class="navbar-link" href="http://localhost:8888/uh-team-a/index.php/staff/staff_member"><span class="glyphicon glyphicon-user"></span> ';
                echo $user;
                echo ' - Access level: Marketing </a></li>';
              } elseif ($al == 3): {
                echo '
                  <li class="dropdown">
                    <a class="navbar-link" href="http://localhost:8888/uh-team-a/index.php/staff/staff_member"><span class="glyphicon glyphicon-user"></span> ';
                echo $user;
                echo ' - Access level: Therapist </a></li>';
              } else: {
                echo '
                  <li class="dropdown">
                    <a class="navbar-link" href="http://localhost:8888/uh-team-a/index.php/site/home"><span class="glyphicon glyphicon-user"></span> ';
                echo $user;
                echo ' Please Log In</a></li>';
              } endif;
            ?>
      <li><a href='<?php echo site_url('site/logout')?>'><span class="glyphicon glyphicon-log-out"></span> Log out</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
