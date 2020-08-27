   

  <body class="layout layout-header-fixed  layout-sidebar-sticky">
    <div class="layout-header">
      <div class="navbar navbar-default">
        <div class="navbar-header ">
          <a class="navbar-brand navbar-brand-center" href="<?php echo base_url()?>manage/index"">
           DRAWING CENTER
          </a>
          <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
            <span class="sr-only">Toggle navigation</span>
            <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
            <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
          </button>
          <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="arrow-up"></span>
            <span class="ellipsis ellipsis-vertical">
            </span>
          </button>
        </div>
        <div class="navbar-toggleable">
          <nav id="navbar" class="navbar-collapse collapse">
            <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
            </button>
            <ul class="nav navbar-nav navbar-right">
            <li>        
            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"> 
            <span class="badge "></span>
           <?php echo $this->session->userdata('username') ?>
           <li><a  data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out"></i></a></li>
               
                  </a>
                  </li>
    
<!--              
              <li class="dropdown hidden-xs">
                <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <a href="upgrade.html">
                      <h5 class="navbar-upgrade-heading">
                        Upgrade Now
                        <small class="navbar-upgrade-notification">You have 15 days left in your trial.</small>
                      </h5>
                    </a>
                  </li>
                  <li class="divider"></li>
                  <li class="navbar-upgrade-version">User: <?php echo $this->session->userdata('username') ?></li>
                  <li class="divider"></li>
                  <li><a href="contacts.html">Contacts</a></li>
                  <li><a href="<?php echo base_url()?>/editprofile/manage">Profile</a></li>
                  <li><a href="<?php echo base_url()?>/changepassword/account">Change Password</a></li>
                  <li class="divider"></li>
                  <li><a  data-toggle="modal" data-target="#logoutModal">Sign out</a></li>
                </ul>
              </li>
              <li class="visible-xs-block">
                <a href="contacts.html">
                  <span class="icon icon-users icon-lg icon-fw"></span>
                  Contacts
                </a>
              </li>
              <li class="visible-xs-block">
                <a href="profile.html">
                  <span class="icon icon-user icon-lg icon-fw"></span>
                  Profile
                </a>
              </li>
              <li class="visible-xs-block">
                <a href="login-1.html">
                  <span class="icon icon-power-off icon-lg icon-fw"></span>
                  Sign out
                </a>
              </li> -->
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div class="layout-main">

      <div class="layout-sidebar" style="">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
          <div class="custom-scrollbar">
            <nav id="sidenav" class="sidenav-collapse collapse">
              <ul class="sidenav">
                <li class="sidenav-search hidden-md hidden-lg">
                  <form class="sidenav-form" action="/">
                    <div class="form-group form-group-sm">
                      <div class="input-with-icon">
                        <input class="form-control" type="text" placeholder="Search…">
                        <span class="icon icon-search input-icon"></span>
                      </div>
                    </div>
                  </form>
  
                              <?php         
        
                   
                foreach($menu as $r){ 
                ?>
    
                 <li class="sidenav-item has-subnav <?php echo($r->mg == $mg[0]->mg_id)? " active open":"" ?>" >
                  <a href="#" aria-haspopup="true" >
                    <span class="sidenav-icon fa  <?php echo $r->icon_menu ?>"></span>
                    <span class="sidenav-label"><?php echo $r->g_name ?></span>
                  </a>
        
                     <ul class="sidenav-subnav collapse <?php echo($r->mg == $mg[0]->mg_id)? " ":"" ?>">
                    <li class="sidenav-subheading "><?php echo $r->g_name ?></li>
              
                    <?php foreach($submenu as $s)  { 

                             if($r->mg == $s->mg_id) { ?>
                          <li class="<?php echo($mg[0]->method == $s->method)? " active ":"" ?>"><a  href="<?php echo base_url()?><?php echo $s->method ?>"><?php echo " - ".$s->name ?></a></li>
                             <?php }
                    }
                    ?>
                
                 
                   

        
                </ul>
                
                </li> 
          
                 <?php
                }
                ?>
         
               
                   </div>
                  </div>     
                </div>     
         
  
    <div class="theme  no_print">
      <div class="theme-panel theme-panel-collapsed">
        <div class="theme-panel-controls">
          <button class="theme-panel-toggler" title="Expand theme panel ( ] )" type="button">
            <span class="icon icon-cog icon-spin" aria-hidden="true"></span>
          </button>
        </div>
        <div class="theme-panel-body">
          <div class="custom-scrollbar">
            <div class="custom-scrollbar-inner">
           
              <ul class="theme-settings">
                <li class="theme-settings-heading">
                  <div class="divider">
                    <div class="divider-content">Theme Settings</div>
                  </div>
                </li>
                <li class="theme-settings-item">
                  <div class="theme-settings-label">Header fixed</div>
                  <div class="theme-settings-switch">
                    <label class="switch switch-primary">
                      <input class="switch-input" type="checkbox" name="layout-header-fixed" data-sync="true">
                      <span class="switch-track"></span>
                      <span class="switch-thumb"></span>
                    </label>
                  </div>
                </li>
                <li class="theme-settings-item">
                  <div class="theme-settings-label">Sidebar fixed</div>
                  <div class="theme-settings-switch">
                    <label class="switch switch-primary">
                      <input class="switch-input" type="checkbox" name="layout-sidebar-fixed" data-sync="true" checked>
                      <span class="switch-track"></span>
                      <span class="switch-thumb"></span>
                    </label>
                  </div>
                </li>
                <li class="theme-settings-item">
                  <div class="theme-settings-label">Sidebar sticky*</div>
                  <div class="theme-settings-switch">
                    <label class="switch switch-primary">
                      <input class="switch-input " type="checkbox" name="layout-sidebar-sticky" data-sync="true" >
                      <span class="switch-track"></span>
                      <span class="switch-thumb"></span>
                    </label>
                  </div>
                </li>
                <li class="theme-settings-item">
                  <div class="theme-settings-label">Sidebar collapsed</div>
                  <div class="theme-settings-switch">
                    <label class="switch switch-primary">
                      <input class="switch-input" type="checkbox" name="layout-sidebar-collapsed" data-sync="false">
                      <span class="switch-track"></span>
                      <span class="switch-thumb"></span>
                    </label>
                  </div>
                </li>
                <li class="theme-settings-item">
                  <div class="theme-settings-label">Footer fixed</div>
                  <div class="theme-settings-switch">
                    <label class="switch switch-primary">
                      <input class="switch-input" type="checkbox" name="layout-footer-fixed" data-sync="true">
                      <span class="switch-track"></span>
                      <span class="switch-thumb"></span>
                    </label>
                  </div>
                </li>
               
              </ul>
              <hr class="theme-divider">
              
            </div>
          </div>
        </div>
        <div class="theme-panel-footer">
         
        </div>
      </div>
    </div>


      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <h5 class="modal-title " id="exampleModalLabel">Ready to Destroy this Session?</h5>

        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="<?php echo base_url()?>/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>


  </body>
</html>