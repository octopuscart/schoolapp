<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');

function truncate($str, $len) {
    $tail = max(0, $len - 10);
    $trunk = substr($str, 0, $tail);
    $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len - $tail))));
    return $trunk;
}
?>
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->



<div id="content" class="content">
 

    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->

        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-pencil-square"></i></div>
                <div class="stats-info">
                    <h4>Total Orders</h4>
                    <p><?php echo count($orderslist); ?></p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-purple">
                <div class="stats-icon"><i class="fa fa-usd"></i></div>
                <div class="stats-info">
                    <h4>Total Amount</h4>
                    <p><?php echo $total_amount; ?></p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-users"></i></div>
                <div class="stats-info">
                    <h4>Registered User</h4>
                    <p><?php echo $total_users; ?></p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
        <!-- end col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>TOTAL VISITORS</h4>
                    <p>13,203</p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
    </div>
    <!-- end row -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-8 -->
        <div class="col-md-8">
            


            <div class="" data-sortable-id="index-3">
                <div class="panel panel-inverse" data-sortable-id="index-10">
                    <div class="panel-heading">
                          <h4 class="panel-title">Recent Order</h4>
                    </div>
                    <div class="panel-body">
                        <div class="height-sm" data-scrollbar="true">


                            <table id="tableDataOrder" class="table table-bordered  tableDataOrder">
                                <thead>
                                    <tr>
                                        <th style="width: 70px">S. No.</th>
                                        <th style="width:250px">Order Information</th>
                                        <th style="width:200px">Customer Information</th>

                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($orderslist)) {
                                        $count = 1;
                                        foreach ($orderslist as $key => $value) {
                                            ?>
                                            <tr style="border-bottom: 1px solid #000;">
                                                <td>
                                                    <?php echo $count; ?>
                                                </td>
                                                <td>

                                                    <table class="small_table">
                                                        <tr>
                                                            <th>Order No.</th>
                                                            <td>: <?php echo $value->id; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Guest(s)</th>
                                                            <td>: <?php echo $value->people; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Table No.</th>
                                                            <td>: {{<?php echo $value->select_table; ?>}}</td>
                                                        </tr>
                                                    </table>

                                                </td>

                                                <td>

                                                    <b> <?php echo $value->first_name . " " . $value->last_name; ?></b>
                                                    <table class="small_table">
                                                        <tr>
                                                            <th><i class="fa fa-envelope"></i> &nbsp; </th>
                                                            <td class="overtext"> <a href="#" title="<?php echo $value->email; ?>"><?php echo $value->email; ?></a></td>
                                                        </tr>
                                                        <tr>
                                                            <th><i class="fa fa-phone"></i>  &nbsp;</th>
                                                            <td> <?php echo $value->contact; ?></td>
                                                        </tr>

                                                    </table>

                                                </td>



                                                <td>
                                                    <a href="<?php echo site_url("order/orderdetails/" . $value->id); ?>" class="btn btn-primary btn-sm" style="    margin-top: 20%;">Update <i class="fa fa-arrow-circle-right"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    } else {
                                        ?>
                                    <h4><i class="fa fa-warning"></i> No order found</h4>
                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

                <!-- begin col-4 -->
                <div class="col-md-6">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="index-10">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Calendar</h4>
                        </div>
                        <div class="panel-body">
                            <div id="datepicker-inline" class="datepicker-full-width"><div></div></div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <div class="col-md-6">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="index-4">
                        <div class="panel-heading">
                            <h4 class="panel-title">New Registered Users <span class="pull-right label label-success"><?php echo $total_users; ?> users</span></h4>
                        </div>
                        <ul class="registered-users-list clearfix">
                            <?php
                            foreach ($latestusers as $ukey => $uvalue) {
                                ?>
                                <li>
                                    <a href="javascript:;">
                                        <img src = '<?php echo base_url(); ?>assets/profile_image/<?php echo $uvalue['image']; ?>' alt = ""  style = "background: url(<?php echo base_url(); ?>assets/emoji/user.png);  width:60px;  height: 60px;background-size: cover;float: left;" />

                                    </a>
                                    <h4 class="username text-ellipsis" style="float: left;">
                                        <?php echo $uvalue['first_name']; ?> <?php echo $uvalue['last_name']; ?>
                                        <small><?php echo $uvalue['country']; ?></small>
                                    </h4>
                                </li>
                                <?php
                            }
                            ?>



                        </ul>
                        <div class="panel-footer text-center">
                            <a href="<?php echo site_url("UserManager/usersReport"); ?>" class="text-inverse">View All</a>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>

            </div>
            <!-- end col-8 -->
            <!-- begin col-4 -->
            <div class="col-md-4">
           

                <div class="panel panel-inverse" data-sortable-id="index-9">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">World Visitors</h4>
                    </div>
                    <div class="panel-body p-0">
                        <div id="world-map" class="height-sm width-full"></div>
                    </div>
                </div>

                <div class="panel panel-inverse" data-sortable-id="index-8">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Todo List</h4>
                    </div>
                    <div class="panel-body p-0">
                        <ul class="todolist">

                            <?php
                            foreach ($systemlog as $klog => $vlog) {
                                ?>   
                                <li>
                                    <a href="javascript:;" class="todolist-container" data-click="todolist">
                                        <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                                        <div class="todolist-title"><?php echo $vlog['log_detail']; ?> (<?php echo $vlog['log_datetime']; ?>)</div>
                                    </a>
                                </li> 
                                <?php
                            }
                            ?>




                        </ul>
                    </div>
                </div>


            </div>
            <!-- end col-4 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->





    <?php
    $this->load->view('layout/footer');
    ?>
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.time.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dashboard-v2.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function () {

            Dashboard.init();
            DashboardV2.init();
        });
    </script>
    <script>
        $(function () {
<?php
$checklogin = $this->session->flashdata('checklogin');
if ($checklogin['show']) {
    ?>
                $.gritter.add({
                    title: "<?php echo $checklogin['title']; ?>",
                    text: "<?php echo $checklogin['text']; ?>",
                    image: '<?php echo base_url(); ?>assets/emoji/<?php echo $checklogin['icon']; ?>',
                                sticky: true,
                                time: '',
                                class_name: 'my-sticky-class '
                            });
    <?php
}
?>
                    })
    </script>