<style>
    tr.invoice_footer td {
        background: #2d353c;
        color: white;
        font-size: 12px;
    }
    tr.invoice_footer th {
        background: #2d353c;
        color: white;
        font-size: 18px;
    }

    .gn_table td{
        font-weight:400;
    }
</style>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="">
            <ul class="timeline">
                <?php
                foreach ($user_order_status as $key => $value) {
                    ?>

                    <li>
                        <!--timeline time label-->
                        <div class="timeline-time">
                            <span class="date"><?php echo $value->c_time; ?> </span>
                            <span class="time"><?php echo $value->c_date; ?></span>

                        </div>
                        <!--/.timeline-label-->

                        <!--timeline item-->

                        <div class="timeline-icon">
                            <a href="javascript:;"><i class="fa fa-paper-plane"></i></a>
                        </div>
                        <!-- begin timeline-body -->
                        <div class="timeline-body">

                            <div class="timeline-content">
                                <b><a href="javascript:;"><?php echo $value->status ?></a></b>
                                <p>
                                    <?php echo $value->remark; ?><br />
                                    <?php echo $value->description; ?>
                                </p>
                                <p>
                                    <small>Processed By:  <?php echo $value->process_user; ?></small>
                                </p>
                                <?php if ($key != (count($user_order_status) - 1)) { ?>
                                    <a class="btn btn-danger btn-xs"
                                       href="<?php echo site_url('Order/remove_order_status/' . $value->id . "/" . $order_key); ?>"><i
                                            class="fa fa-trash"></i> Remove</a>
                                    <?php }
                                    ?>
                            </div>

                        </div>
                        <!-- end timeline-body -->

                        <!--END timeline item-->



                        <?php
                    }
                    ?>
            </ul>
        </div>
    </div>
</div>

<div class="invoice" style='margin-top:20px;'>
    <div class="invoice-company">
        <span class="pull-right hidden-print">
            <a class="btn btn-success  btn-sm m-b-10"
               href="<?php echo site_url("order/order_mail_send_direct/" . $ordersdetails['order_data']->id) ?>"><i
                    class="fa fa-envelope"></i> Send Current Status Mail</a>
            <a class="btn btn-success btn-sm m-b-10"
               href="<?php echo site_url("order/order_pdf/" . $ordersdetails['order_data']->id) ?>"><i
                    class="fa fa-download "></i> Order PDF</a>
<!--            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i
                    class="fa fa-print m-r-5"></i> Print</a>-->
        </span>
        Order No:#<?php echo $ordersdetails['order_data']->id; ?>
    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <small>Guest Detail</small>
            <address class="m-t-5 m-b-5">
                <strong style="text-transform: capitalize;margin-top: 10px;">
                    <?php echo $ordersdetails['order_data']->first_name; ?> <?php echo $ordersdetails['order_data']->last_name; ?>
                </strong> <br />
                <div style="    padding: 5px 0px;">


                </div>
                <table class="gn_table">
                    <tr>
                        <th>Email</th>
                        <td>: <?php echo $ordersdetails['order_data']->email; ?> </td>
                    </tr>
                    <tr>
                        <th>Contact No.</th>
                        <td>: <?php echo $ordersdetails['order_data']->contact; ?> </td>
                    </tr>
                </table>
            </address>
        </div>

        <div class="invoice-to">
            <small>Order Information</small>
            <address class="m-t-5 m-b-5">
                <table class="gn_table">
                    <tr>
                        <th>Order No.</th>
                        <td>: <?php echo $ordersdetails['order_data']->id; ?> </td>
                    </tr>
                    <tr>
                        <th>Date Time</th>
                        <td>: <?php echo $ordersdetails['order_data']->datetime; ?>
                    </tr>


                    <tr>
                        <th>Status</th>
                        <td>: <?php
                            if ($ordersdetails['order_status']) {
                                echo $ordersdetails['order_status'][0]->status;
                            } else {
                                echo "Pending";
                            }
                            ?> </td>
                    </tr>
                </table>
            </address>
        </div>
        <div class="invoice-date">

        </div>
    </div>
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-invoice">
                <tr style="font-weight: bold">
                    <td colspan="2"  style="text-align: center;width: 33%;">
                        <div class="thumbnail">
                            <img src="<?php echo base_url(); ?>assets/booking/time.svg" alt="..." style="height: 50px;">
                            <div class="caption">
                                <h3>Date/Time</h3>
                                <p><?php echo $ordersdetails['order_data']->select_date; ?> <?php echo $ordersdetails['order_data']->select_time; ?></p>
                            </div>
                        </div>
                    </td>
                    <td colspan="2"  style="text-align: center;width: 33%;">
                        <div class="thumbnail">
                            <img src="<?php echo base_url(); ?>assets/booking/table.png" alt="..." style="height: 50px;">
                            <div class="caption">
                                <h3>Table</h3>
                                <p><?php echo $ordersdetails['order_data']->select_table; ?></p>
                            </div>
                        </div>
                    </td>
                    <td colspan="2" style="text-align: center;width: 33%;">
                        <div class="thumbnail">
                            <img src="<?php echo base_url(); ?>assets/booking/profile.png" alt="..." style="height: 50px;">
                            <div class="caption">
                                <h3><?php echo $ordersdetails['order_data']->booking_type; ?></h3>
                                <p>Guest(s): <?php echo $ordersdetails['order_data']->people; ?></p>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr style="font-weight: bold">
                    <td colspan="6"  style="text-align: center;width: 33%;">
                        <h2>
                            <i class="fa fa-money"></i>  Total Amount:  <span id="orderPrice" data-type="text" data-pk="<?php echo $ordersdetails['order_data']->id; ?>" data-name="total_amount" data-value="<?php echo $ordersdetails['order_data']->total_amount; ?>" data-url="<?php echo site_url("LocalApi/orderUpdate"); ?>"  data-original-title="Enter Price." class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_contact_no" ><?php echo $ordersdetails['order_data']->total_amount; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>

                        </h2>
                    </td>
                </tr>


            </table>

        </div>

    </div>

</div>




<script>
    $(function () {
        setTimeout(function () {
            $("#orderPrice").editable();
            $('.edit_detail').click(function (e) {
                e.stopPropagation();
                e.preventDefault();

                $($(this).prev()).editable({

                    success: function (response, newValue) {
                        // window.location.reload();
                        if (response.status == 'error')
                            return response.msg; //msg will be shown in editable form
                    }
                }
                );
                $($(this).prev()).editable('toggle');
            });
        }, 1500)

    })
</script>  