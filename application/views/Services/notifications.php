<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>



<!-- begin #content -->
<div id="content" class="content content-full-width" ng-controller="inboxController">
    <!-- begin vertical-box -->
    <div class="panel panel-inverse" data-sortable-id="index-10">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-bell-o"></i> Notification(s)</h4>
        </div>
        <div class="panel-body">
            <div class="vertical-box" style="    background: white;">
             
                <!-- begin vertical-box-column -->


                <div class="vertical-box-column">

                    <!-- begin list-email -->
                    <ul class="list-group list-group-lg no-radius list-email">


                        <li class="list-group-item inverse  " ng-repeat="notify in orderGlobleCheck.allNotifications">
                            <a href="{{notify.tag == 'email' ? '<?php echo site_url("Order/orderInboxDetails/"); ?>'+notify.data.id : '<?php echo site_url("Order/orderdetails/"); ?>'+notify.data.id}}">
                                <div class="email-checkbox">
                                    <label>
                                        <i class="fa fa-square-o"></i>
                                        <input type="checkbox" data-checked="email-checkbox" />
                                    </label>
                                </div>
                                <!--                    <a href="email_detail.html" class="email-user">
                                                        <img src="assets/img/user-14.jpg" alt="" />
                                                    </a>-->
                                <div class="email-info">
                                    <span class="email-time"><i class="fa fa-calendar-o"></i> {{notify.data.datetime}}</span>
                                    <h5 class="email-title">
                                        <span ng-if="notify.tag=='order'">
                                            {{notify.title}}
                                        </span>
                                        <span ng-if="notify.tag=='email'">
                                            {{notify.data.subject}}
                                        </span>

                                        <span class="label label-danger f-s-10">{{notify.title}}</span>
                                    </h5>
                                    <p class="email-desc">
                                         <span ng-if="notify.tag=='order'">
                                             {{notify.description}}<br/>
                                             <i class="fa fa-calendar"></i> {{notify.data.select_date}},&nbsp;&nbsp; <i class="fa fa-clock-o"></i>{{notify.data.select_time}},&nbsp;&nbsp; <i class="fa fa-table"></i> {{notify.data.select_table}}
                                        </span>
                                        <span ng-if="notify.tag=='email'">
                                            {{notify.data.from_email}}
                                        </span>
                                        <span class="datetime"></span>
                                    </p>
                                </div>
                            </a>
                        </li>

                    </ul>
                    <!-- end list-email -->
                    <!-- begin wrapper -->
                    <div class="wrapper bg-silver-lighter clearfix">
                        <div class="btn-group pull-right">
                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                        <div class="m-t-5">{{orderGlobleCheck.allNotifications.length}} messages</div>
                    </div>
                    <!-- end wrapper -->
                </div>

                <!-- end vertical-box-column -->
            </div>
        </div>
    </div>
    <!-- end vertical-box -->
</div>
<!-- end #content -->

<?php
$this->load->view('layout/footer');
?> 

<script>
    $(function () {


    })


</script>
<script src="<?php echo base_url(); ?>assets/angular/booking.js"></script>
