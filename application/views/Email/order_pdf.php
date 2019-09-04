<?php
echo PDF_HEADER;
?>

<table class="detailstable" align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;margin-top:20px;">
    <tr>
        <td style="width: 50%" >
            <div style="float:left;width: 300px;height: 150px">

                <table class="gn_table">
                    <tr>
                        <td colspan="2">
                            <b>Guest Information</b><br/><hr/>
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>: <?php echo $order_data->first_name; ?> <?php echo $order_data->last_name; ?> </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: <?php echo $order_data->email; ?> </td>
                    </tr>
                    <tr>
                        <th>Contact No.</th>
                        <td>: <?php echo $order_data->contact; ?> </td>
                    </tr>

                </table>
            </div>

        </td>
        <td style="width: 30%" >
            <div style="float:right;width: 300px;height: 150px">
                <table class="gn_table">
                    <tr>
                        <td colspan="2">
                            <b>Order Information</b><br/><hr/>
                        </td>
                    </tr>
                    <tr>
                        <th>Order No.</th>
                        <td>: <?php echo $order_data->id; ?> </td>
                    </tr>
                    <tr>
                        <th>Date/Time</th>
                        <td>: <?php echo $order_data->datetime; ?>   </td>
                    </tr>
<tr>
                                <th>Order Source</th>
                                <td>: <?php echo $order_data->order_source; ?>   </td>
                            </tr>

                    <tr>
                        <th>Status</th>
                        <td>: <?php
                            if ($order_status) {
                                echo end($order_status)->status;
                            } else {
                                echo "Pending";
                            }
                            ?> </td>
                    </tr>
                </table>

            </div>
        </td>
    </tr>
</table>
<table class="boooking"   align="center" border="1" cellpadding="0" cellspacing="0" width="700" style="background: #fff;padding:20px">
    <tr style="font-weight: bold">
        <td colspan="2"  style="text-align: center;width: 33%;    padding: 25px;">
            <div class="thumbnail">
                <img src="<?php echo base_url(); ?>assets/booking/time.svg" alt="..." style="height: 50px;">
                <div class="caption">
                    <h3>Date/Time</h3>
                    <p><?php echo $order_data->select_date; ?> <?php echo $order_data->select_time; ?></p>
                </div>
            </div>
        </td>
        <td colspan="2"  style="text-align: center;width: 33%;    padding: 25px;">
            <div class="thumbnail">
                <img src="<?php echo base_url(); ?>assets/booking/table.png" alt="..." style="height: 50px;">
                <div class="caption">
                    <h3>Table</h3>
                    <p><?php echo $order_data->select_table; ?></p>
                </div>
            </div>
        </td>
        <td colspan="2" style="text-align: center;width: 33%;    padding: 25px;">
            <div class="thumbnail">
                <img src="<?php echo base_url(); ?>assets/booking/profile.png" alt="..." style="height: 50px;">
                <div class="caption">
                    <h3><?php echo $order_data->booking_type; ?></h3>
                    <p>Guest(s): <?php echo $order_data->people; ?></p>
                </div>
            </div>
        </td>
    </tr>
    <tr style="" >
        <td colspan="6" style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;font-size: 10px;">
            Note:<br/>
            1. Received the above merchandise in fine condition & correct quantity.<br/>
            2. Goods once sold can not be returned.<br/>
            3. This is computer generated receipt, bear no CHOP.

        </td>

    </tr>



</table>

