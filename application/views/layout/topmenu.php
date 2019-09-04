<?php
$userdata = $this->session->userdata('logged_in');
if ($userdata) {
    
}
?>

<!-- begin #header -->
<div id="header" class="header navbar navbar-fixed-top navbar-inverse">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header" >
            <a href="<?php site_url('Order/index'); ?>" class="navbar-brand" style="padding: 0px 15px;"><img src="<?php echo SITE_LOGO; ?>" style="height: 50px;"></a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- end mobile sidebar expand / collapse button -->

        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
          
            <button class="" id="soundButton" ng-click="playSound()" style="opacity: 0">Click</button>
            <li class="dropdown">
                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                    <i class="fa fa-envelope"></i>
                    <span class="label">{{orderGlobleCheck.unseenemail.length}}</span>
                </a>
                <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                    <li class="dropdown-header">Unseen Emails ({{orderGlobleCheck.unseenemail.length}})</li>



                    <li class="media" ng-repeat="emails in orderGlobleCheck.unseenemail">
                        <a href="javascript:;">
                            <div class="media-left"><i class="fa fa-calendar media-object bg-red"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading textoverflow">{{emails.subject}}</h6>
                                <div class="text-muted f-s-11">{{emails.datetime}}</div>
                            </div>
                        </a>
                    </li>



                    <li class="dropdown-footer text-center">
                        <a href="<?php echo site_url("Order/orderInbox");?>">View more</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                    <i class="fa fa-bell-o"></i>
                    <span class="label">{{orderGlobleCheck.allNotifications.length}}</span>
                </a>
                <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                    <li class="dropdown-header">Notifications ({{orderGlobleCheck.allNotifications.length}})</li>



                    <li class="media" ng-repeat="notify in orderGlobleCheck.allNotifications">
                        <a href="javascript:;">
                            <div class="media-left"><i class="fa fa-calendar media-object bg-red"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading textoverflow">{{notify.title}}</h6>
                                <div class="text-muted f-s-11 textoverflow">{{notify.description}}</div>
                                <div class="text-muted f-s-11">{{notify.data.datetime}}</div>
                            </div>
                        </a>
                    </li>



                    <li class="dropdown-footer text-center">
                        <a href="<?php echo site_url("Messages/notifications");?>">View more</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src='<?php echo base_url(); ?>assets/profile_image/<?php echo $userdata['image'] ?>' alt="" class="media-object rounded-corner" style="    width: 30px;background: url(<?php echo base_url(); ?>assets/emoji/user.png);    height: 30px;background-size: cover;" /> 
                    <span class="hidden-xs"><?php echo $userdata['first_name']; ?> <?php echo $userdata['last_name']; ?></span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li class="arrow"></li>
                    <li><a href="<?php echo site_url("profile") ?>">Edit Profile</a></li>
                    <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                    <li><a href="javascript:;">Calendar</a></li>
                    <li><a href="javascript:;">Setting</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url("Authentication/logout") ?>">Log Out</a></li>
                </ul>
            </li>
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>
<!-- end #header -->
<?php
$this->load->view('layout/sidebar');
?>