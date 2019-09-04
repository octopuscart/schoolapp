<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>



<!-- begin #content -->
<div id="content" class="content content-full-width" ng-controller="inboxController">
    <!-- begin vertical-box -->
    <div class="vertical-box">
      <?php
            $this->load->view('Order/inboxside');
            ?>
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column">
            

            <!-- begin wrapper -->
            <div class="wrapper" style="background: #fff">
                <h4 class="m-b-15 m-t-0 p-b-10 underline"><?php echo $emaildetail->subject; ?></h4>
                <ul class="media-list underline m-b-20 p-b-15">
                    <li class="media media-sm clearfix">
                        <a href="javascript:;" class="pull-left">
                            <img class="media-object rounded-corner" alt="" src="assets/img/user-14.jpg" />
                        </a>
                        <div class="media-body">
                            <span class="email-from text-inverse f-w-600">
                                <?php
                                echo str_replace(">", ")", str_replace("<", "(", $emaildetail->from_email));
                                ?>

                            </span>
                            <br/>
                            <span class="text-muted m-l-5"><i class="fa fa-clock-o fa-fw"></i> <?php echo $emaildetail->datetime; ?></span><br />

                        </div>
                    </li>
                </ul>


                <p class="f-s-12 text-inverse" style="white-space: pre-line;">
                    <?php echo $emaildetail->message; ?>
                </p>
                <p class="f-s-12 text-inverse" style="font-weight: 400" >
                   Processed By: <?php echo $emaildetail->process_user; ?>
                </p>
            </div>
            <div style="clear: both"></div>
            <!-- end wrapper -->
            <!-- begin wrapper -->

        </div>
        <!-- end vertical-box-column -->
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