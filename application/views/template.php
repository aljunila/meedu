<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TKI" />
    <meta name="keywords" content="system, paten, maulana, maulana & partner, lawfirm" />
    <meta name="author" content="http://rakoon.id">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Meedu</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>logo.png" type="image/x-icon" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/bootstrap/css/bootstrap.css">
	 
	  <script src="<?php echo base_url(); ?>themesAdmin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/dist/css/font-awesome/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	  <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker2/css/datepicker.css">
	  <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datetimepicker/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/dist/css/skins/_all-skins.css"> 
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/dist/css/skins/skin-green.min.css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- jQuery 2.1.4 -->
  <style type="text/css">
    .slimScrollBar{
       background: rgba(249, 161, 28, 1) !important; width: 10px !important; position: absolute; top: 56px; opacity: 0.9; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 158.02px;
     }

     .loading .bullets {
        margin-top: 25%;
        margin-left: 45%;
        position:absolue;
        animation:anim 3.5s linear 0s infinite;
      }
      .loading .bullet {
          position: absolute;
          animation: animIn 3.5s ease-in 0s infinite
      }
      .loading .bullet span{
        display:block;
        padding: 5px;
        border-radius: 50%;
        background: #17fea9;
        animation: animSize 3.5s ease-out 0s infinite
      }
      .loading .bullet:nth-child(1),
      .loading .bullet:nth-child(1) span{
          -webkit-animation-delay: 0s;
          animation-delay: 0s;
      }
      .loading .bullet:nth-child(2),
      .loading .bullet:nth-child(2) span{
          -webkit-animation-delay: 0.15s;
          animation-delay: 0.15s;
      }
      .loading .bullet:nth-child(3),
      .loading .bullet:nth-child(3) span{
          -webkit-animation-delay: 0.3s;
          animation-delay: 0.3s;
      }
      .loading .bullet:nth-child(4),
      .loading .bullet:nth-child(4) span{
          -webkit-animation-delay: 0.45s;
          animation-delay: 0.45s;
      }
      .loading .bullet:nth-child(5),
      .loading .bullet:nth-child(5) span{
          -webkit-animation-delay: 0.6s;
          animation-delay: 0.6s;
      }
      .loading .bullet:nth-child(6),
      .loading .bullet:nth-child(6) span{
          -webkit-animation-delay: 0.75s;
          animation-delay: 0.75s;
      }
      .loading .bullet:nth-child(7),
      .loading .bullet:nth-child(7) span{
          -webkit-animation-delay: 0.9s;
          animation-delay: 0.9s;
      }
      .loading .bullet:nth-child(8),
      .loading .bullet:nth-child(8) span{
          -webkit-animation-delay: 1.05s;
          animation-delay: 1.05s;
      }
      @keyframes anim{
        0% {
              -webkit-transform: translateX(-120px);
              transform: translateX(-120px);
          }
        100% {
              -webkit-transform: translateX(120px);
              transform: translateX(120px);
          }
      }
      @keyframes animSize{
         0% {
              -webkit-transform:scale(1.2,1.2);
              transform:scale(1.2,1.2);
          }
         25% {
              -webkit-transform:scale(1.2,1.2);
              transform:scale(1.2,1.2);
          }
         55% {
              -webkit-transform:scale(4,4);
              transform:scale(4,4);
          }
        75% {
              -webkit-transform:scale(1.2,1.2);
              transform:scale(1.2,1.2);
          }
        100%{
              -webkit-transform:scale(1.2,1.2);
              transform:scale(1.2,1.2);
        }
      }
      @keyframes animIn {
          0% {
              -webkit-transform: translateX(-200px);
              transform: translateX(-200px);
              opacity: 0;
          }
        10% {
              -webkit-transform: translateX(-200px);
              transform: translateX(-200px);
              opacity: 0;
          }
        25% {
              opacity: 1;
              -webkit-transform: translateX(0);
              transform: translateX(0);
          }
        70% {
              opacity: 0.5;
              -webkit-transform: translateX(20px);
              transform: translateX(20px);
          }
        85% {
              -webkit-transform: translateX(200px);
              transform: translateX(200px);
              opacity: 0;
          }
          100% {
              -webkit-transform: translateX(200px);
              transform: translateX(200px);
              opacity: 0;
          }
      }

      .nav-tabs-custom > .nav-tabs > li.active {
          border-color: #ff851b !important;
          border-bottom-color: transparent !important;
      }
      .nav-tabs {
         /*border-bottom: 1px solid #d45500 !important;*/
      }
  </style>

  </head>
  <body class="hold-transition fixed skin-blue-light sidebar-mini">
    <div class="loading" id="stepa-global-loading" style="position: fixed; z-index: 9999999 !important; top:0; width: 100%; height: 100%; background-color:rgba(0,0,0,0.5); display: none;">
       
      <div class='bullets'>
         <div class='bullet'><span></span></div>
         <div class='bullet'><span></span></div>
         <div class='bullet'><span></span></div>
         <div class='bullet'><span></span></div>
         <div class='bullet'><span></span></div>
         <div class='bullet'><span></span></div>
         <div class='bullet'><span></span></div>
         <div class='bullet'><span></span></div>
      </div>
    </div>
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" class="logo">
          <span class="logo-mini"><b>MD</b></span><!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-lg"><b>Meedu</b></span><!-- logo for regular state and mobile devices -->
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <i class="fas fa-bars"></i>
        
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
          <!-- Tasks: style can be found in dropdown.less --> 
          <?php 
                if($this->session->userdata('user_group_id')!='-1'){

                    $query = "SELECT id,username,email,fullname, created_date,photo_url
                      FROM endusers 
                      WHERE id = '".$this->session->userdata('id')."' AND institution_id='".$this->session->userdata('institution_id')."'";
                      $enduser = $this->db->query($query)->result(); 
              
                }?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php if($this->session->userdata('user_group_id')!='-1'){?>
                   <?php if(isset($enduser)){?>
                     <?php if($enduser[0]->photo_url==''){?>
                      <img src="<?php echo base_url(); ?>themesAdmin/dist/img/user3-128x128.jpg" class="user-image" alt="User Image">
                     <?php }else{ ?>
                      <img src="<?php echo base_url(); ?>data/profile/<?php echo $enduser[0]->photo_url;?>" class="user-image" alt="User Image">
                     <?php } ?>
                    <?php } else{?>
                      <img src="<?php echo base_url(); ?>themesAdmin/dist/img/user3-128x128.jpg" class="user-image" alt="User Image">

                    <?php }?>
                    <?php } else{?>
                      <img src="<?php echo base_url(); ?>themesAdmin/dist/img/user3-128x128.jpg" class="user-image" alt="User Image">
                    <?php } ?>
                  <span class="hidden-xs"><?php echo $this->session->userdata('name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">

                    <div class="text-center" 
                    <?php if(isset($enduser)){?>
                    onmouseover="ajaxChangeBtn(true)" onmouseout="ajaxChangeBtn(false)" <?php } ?>

                    >

                      <?php if(isset($enduser)){?>
                       <?php if($enduser[0]->photo_url==''){?>
                        <img  class="img-circle" src="<?php echo base_url(); ?>themesAdmin/dist/img/user1-128x128.jpg" style="width: 90px;height: 90px;">
                        <?php }else{ ?>
                        <img class="img-circle" src="<?php echo base_url(); ?>data/profile/<?php echo $enduser[0]->photo_url;?>" style="width: 90px;height: 90px;">
                        <?php } ?>
                      <?php } else{?>
                      <img class="img-circle" src="<?php echo base_url(); ?>themesAdmin/dist/img/user3-128x128.jpg" alt="User Image" style="width: 90px;height: 90px;">
                      <?php }?>

                       <div id="btn-change" class="text-center" style="position: absolute; top: 35%; left: 35%; display: none;"><a class="btn btn-default btn-xs" data-toggle="modal" data-backdrop="static" data-target="#changePP">Ubah Photo</a></div>

                    </div>

                    <p>
                      <?php echo $this->session->userdata('name'); ?> 
                      <small> <?php 
                        if($this->session->userdata('user_group_id')=='1') {
                          echo "Superadmin";
                        }else if($this->session->userdata('user_group_id')=='3') {
                          echo "User";
                        }else if($this->session->userdata('user_group_id')=='-1') {
                          echo "Super Administrator";
                        }else if($this->session->userdata('user_group_id')=='5') {
                          echo "Administrator Yayasan";
                        }else if($this->session->userdata('user_group_id')=='2') {
                          echo "Owner";
                        }
                      ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-body">
                    <div class="pull-left">
                      <a href="<?php echo site_url('account_user/view_account'); ?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <?php 
                      if($this->session->userdata('user_group_id')=='1') {?>
                        <a href="#" data-toggle="modal" data-target="#logoutMessage"  id="<?php echo site_url('login/logout'); ?>" onClick="logoutJS(this);" class="btn btn-default btn-flat">Sign out</a>
                      <?php }else if($this->session->userdata('user_group_id')=='3') {?>
                        <a href="#" data-toggle="modal" data-target="#logoutMessage"  id="<?php echo site_url('login/logout'); ?>" onClick="logoutJS(this);" class="btn btn-default btn-flat">Sign out</a>
                      <?php }else if($this->session->userdata('user_group_id')=='-1') {?>
                        <a href="#" data-toggle="modal" data-target="#logoutMessage"  id="<?php echo site_url('admin/logout'); ?>" onClick="logoutJS(this);" class="btn btn-default btn-flat">Sign out</a>
                      <?php }else if($this->session->userdata('user_group_id')=='5') {?>
                        <a href="#" data-toggle="modal" data-target="#logoutMessage"  id="<?php echo site_url('yayasan/logout'); ?>" onClick="logoutJS(this);" class="btn btn-default btn-flat">Sign out</a>
                      <?php }else if($this->session->userdata('user_group_id')=='2') {?>
                        <a href="#" data-toggle="modal" data-target="#logoutMessage"  id="<?php echo site_url('login/logout'); ?>" onClick="logoutJS(this);" class="btn btn-default btn-flat">Sign out</a>
                      <?php } else if($this->session->userdata('user_group_id')=='8') {?>
                        <a href="#" data-toggle="modal" data-target="#logoutMessage"  id="<?php echo site_url('psychology/logout'); ?>" onClick="logoutJS(this);" class="btn btn-default btn-flat">Sign out</a>
                      <?php } ?>

                      
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

            <ul class="sidebar-menu">

            <?php 
               $user_group = $this->session->userdata('user_group_id');

                $main_counter = 0;
                $sub_counter = 0;
                $minisub_counter=0;

              $query_gm = "
              SELECT a.* ,b.menu_id, c.menu_id from menu_groups as a
              INNER JOIN menu as b ON a.id = b.nav_type
              INNER JOIN priviledges as c ON c.menu_id = b.menu_id
              WHERE a.status = 'A' AND c.user_group_id = ".$user_group." 
              group by a.id order by order_id";
              $g_main_menu = $this->db->query($query_gm)->result();

              $query_access_psy = "
              SELECT *
              FROM access_psy_module WHERE status = 'A' AND institution_id = '".$this->session->userdata('institution_id')."'";
              $granted = $this->db->query($query_access_psy)->result();

              foreach($g_main_menu as $grm){

                if($grm->id==3){
                  if(count($granted)>0){
                      echo '<li class="header text-white text-bold text-blue">'.strtoupper($grm->name).'</li>';
                      $query = "SELECT *
                        FROM priviledges AS a
                        JOIN menu AS b ON b.menu_id = a.menu_id
                        WHERE b.parent_id = '0'
                        AND a.user_group_id = '".$user_group."'
                        AND b.nav_type = '".$grm->id."'
                        ORDER BY b.order ASC";
                      $main_menu = $this->db->query($query)->result();
                      

                      foreach($main_menu as $main_row){ ?>
                       <li class="<?php echo $nav[$main_row->menu_id];?>">
                        <?php
                          if($main_row->action_url == '#'){
                            echo '<a href="#">';
                          }else{
                            echo '<a href="'.site_url($main_row->action_url).'">';
                          }
                        ?>  
                          <i class="<?php 
                            if($main_row->icon=='' || $main_row->icon==null){
                            echo 'fa fa-list-ul';
                            }else{
                              echo $main_row->icon; 
                            }
                          
                          ?>"></i>
                          <span><?php echo $main_row->title; ?></span>
                          <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <?php
                            $sub_query = "SELECT *
                                  FROM priviledges AS a
                                  JOIN menu AS b ON b.menu_id = a.menu_id
                                  WHERE b.parent_id = '".$main_row->menu_id."'
                                  AND a.user_group_id = '".$user_group."'
                                  AND b.nav_type ='".$grm->id."'
                                  ORDER BY b.order ASC";
                            $sub_menu = $this->db->query($sub_query)->result();
                            if(count($sub_menu) > 0){
                            echo '<ul class="treeview-menu">';
                              foreach($sub_menu as $sub_row){
                          ?>    
                            <li class="<?php echo $sub_nav[$sub_row->menu_id];?>"><a href="<?php echo site_url($sub_row->action_url)?>"><i class="<?php 
                                  if($sub_row->icon=='' || $sub_row->icon==null){
                                  echo 'fa fa-list';
                                  }else{
                                    echo $sub_row->icon; 
                                  }
                                
                                ?>"></i><?php echo $sub_row->title;?></a></li>

                          <?php 
                                $sub_counter++;
                              }
                            echo '</ul>'; 
                            }
                          ?>


                        </li>
                   

                      <?php 
                        $main_counter++;
                      }
                  }
                }else{
                
                  echo '<li class="header text-white text-bold text-blue">'.strtoupper($grm->name).' </li>';
                  $query = "SELECT a.*, b.parent_id, b.order, b.title, b.action_url, b.icon
                    FROM priviledges AS a
                    JOIN menu AS b ON b.menu_id = a.menu_id
                    WHERE b.parent_id = '0'
                    AND a.user_group_id = '".$user_group."'
                    AND b.nav_type = '".$grm->id."'
                    ORDER BY b.order ASC";
                 
                  $main_menu = $this->db->query($query)->result();
                  

                  foreach($main_menu as $main_row){ ?>
                   <li class="<?php echo $nav[$main_row->menu_id];?>">
                    <?php
                      if($main_row->action_url == '#'){
                        echo '<a href="#">';
                      }else{
                        echo '<a href="'.site_url($main_row->action_url).'">';
                      }
                    ?>  
                      <i class="fa <?php 
                        if($main_row->icon=='' || $main_row->icon==null){
                        echo 'fa-list-ul';
                        }else{
                          echo $main_row->icon; 
                        }
                      
                      ?>"></i>
                      <span><?php echo $main_row->title; ?> </span>
                      <i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <?php
                        $sub_query = "SELECT *
                              FROM priviledges AS a
                              JOIN menu AS b ON b.menu_id = a.menu_id
                              WHERE b.parent_id = '".$main_row->menu_id."'
                              AND a.user_group_id = '".$user_group."'
                              AND b.nav_type ='".$grm->id."'
                              ORDER BY b.order ASC";
                        $sub_menu = $this->db->query($sub_query)->result();
                        if(count($sub_menu) > 0){
                        echo '<ul class="treeview-menu">';
                          foreach($sub_menu as $sub_row){
                      ?>    
                        <li class="<?php echo $sub_nav[$sub_row->menu_id];?>" ><a href="<?php echo site_url($sub_row->action_url)?>"><i class="fa <?php 
                              if($sub_row->icon=='' || $sub_row->icon==null){
                              echo 'fa-list';
                              }else{
                                echo $sub_row->icon; 
                              }
                            
                            ?>"></i><?php echo $sub_row->title;?> </a>
                             <?php
                              $minisub_query = "SELECT *
                                    FROM priviledges AS a
                                    JOIN menu AS b ON b.menu_id = a.menu_id
                                    WHERE b.parent_id = '".$sub_row->menu_id."'
                                    AND a.user_group_id = '".$user_group."'                                    AND b.nav_type ='".$grm->id."'
                                    ORDER BY b.order ASC";
                              $mini_sub = $this->db->query($minisub_query)->result();
                              if(count($mini_sub) > 0){
                              echo '<ul class="treeview-menu">';
                                foreach($mini_sub as $sub_again){ ?>
                                  <li ><a href="<?php echo site_url($sub_again->action_url)?>"><i class="fa <?php 
                                  if($sub_again->icon=='' || $sub_again->icon==null){
                                  echo 'fa-list';
                                  }else{
                                    echo $sub_again->icon; 
                                  }
                                
                                ?>"></i><?php echo $sub_again->title;?> </a> </li>
                                <?php 
                                $minisub_counter++;
                              }
                            echo '</ul>'; 
                                } ?>
                          </li>
                      <?php 
                            $sub_counter++;
                          }
                        echo '</ul>'; 
                        }
                      ?>


                    </li>
               

                  <?php 
                    $main_counter++;
                  }
                }

              }?>
		  
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        {content}
      </div><!-- /.content-wrapper -->


      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.1.1
        </div>
        <strong>Copyright &copy; 2019 <a href="http://rakoon.id">Maulana & Partners</a>.</strong> All rights reserved.
      </footer>

      <div class="modal modal-warning fade" id="logoutMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-key"></i>&nbsp;&nbsp;<?php echo $this->lang->line('alert_logout_title')?></h4>
              </div>
              <div class="modal-body">
                <p class="error-text"><?php echo $this->lang->line('alert_logout_content')?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative')?></button>
                <a id="logoutLink" href="#"><button type="button" class="btn btn-outline"><?php echo $this->lang->line('caption_btn_next')?></button></a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>

      <div class="modal modal-default fade" id="changePP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <?php
            echo form_open_multipart('pendaftaran/change_profile_picture/'.$enduser[0]->id.'','class="form-horizontal" role="form"');
            $hidden_data_user = array(
              'enduser_id' => $this->session->userdata('id'),
              'img'=>$enduser[0]->photo_url
            );
            echo form_hidden($hidden_data_user);
        ?> 
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-photo"></i>&nbsp;Foto Profil</h4>
            </div>
            <div class="modal-body text-center">
              <p class="error-text">
              <?php if($enduser[0]->photo_url==''){?>
              <img src="<?php echo base_url(); ?>themesAdmin/dist/img/user1-128x128.jpg" style="width: 120px; height: 120px;">
              <?php }else{ ?>
              <img src="<?php echo base_url(); ?>data/profile/<?php echo $enduser[0]->photo_url;?>" style="width: 120 px; height: 120px;">
              <?php } ?>
              </p>

              <input type="file" class="form-control" name="image" value="<?php echo $enduser[0]->photo_url; ?>">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success-o pull-left" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success" >Selesai</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
         <?php echo form_close(); ?>  
      </div>

      <div class="modal modal-default fade" id="msgCommingSoon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bullhorn fa-blink"></i>&nbsp;&nbsp;Stepa Asisten</h4>
            </div>
            <div class="modal-body">
              <p class="error-text"><h4>Hi <?php echo $this->session->userdata('name');?></h4>
              Fitur ini belum berfungsi pada saat ini. Fitur akan segera dimutakhirkan.<br>terimakasih</p>
              <div class="pull-right text-center">
              Hormat Kami,<br>
              <label> - STEPA - </label></div>
              <br><br>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative')?></button> -->
              <a id="delData" href="#"><button type="button" class="btn btn-success" data-dismiss="modal">Tutup Dialog</button></a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>



    </div><!-- ./wrapper -->

    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>themesAdmin/bootstrap/js/bootstrap.min.js"></script>
	<!-- moment -->
	<script src="<?php echo base_url(); ?>themesAdmin/plugins/moment/moment.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/datatables/dataTables.bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>themesAdmin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>themesAdmin/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>themesAdmin/dist/js/demo.js"></script>
	<!-- datepicker -->
	<script src="<?php echo base_url(); ?>themesAdmin/plugins/datepicker2/js/bootstrap-datepicker.js"></script>
		<!-- datetimepicker -->
	<script src="<?php echo base_url(); ?>themesAdmin/plugins/datetimepicker/bootstrap-datetimepicker.js"></script>
	<!-- ckeditor -->
	<script src="<?php echo base_url(); ?>themesAdmin/plugins/ckeditor/ckeditor.js"></script>
	 <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/select2/select2.min.css">
  <script src="<?php echo base_url(); ?>themesAdmin/plugins/select2/select2.full.min.js"></script>
	


    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false
            });
            $('#datatable-scroll-x').DataTable({
              
              "scrollX": true
            });

            $('#data-table-1').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false
            });

            $('#data-table-2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false
            });

          //$('.select2').select2();
    </script>

    <script>
    function logoutJS(a){
      // alert(a);
      document.getElementById("logoutLink").href=a.id;
    }

    function ajaxChangeBtn(a){
      if(a){
        $('#btn-change').show();
      }else{
         $('#btn-change').hide();
      }
    }


    function loadingOverlay(a){
      if(a){
        $('#stepa-global-loading').show();
      }else{
        $('#stepa-global-loading').hide();
      }

    }
    </script>
  </body>
</html>

