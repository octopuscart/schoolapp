<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Order No#</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            .carttable{
                border-color: #fff;
            }

            .carttable td{
                padding: 5px 10px;
                border-color: #9E9E9E;
            }
            .carttable tr{
                /*padding: 0 10px;*/
                border-color: #9E9E9E;
                font-size: 12px
            }

            .boooking{
                border-color: #fff;
            }

            .boooking td{
                padding: 5px 10px;
                border: #fff;
            }
            .boooking tr{
                /*padding: 0 10px;*/
                border-color: #fff;
                font-size: 12px
            }




            .detailstable td{
                padding:10px 20px;
            }

            .gn_table td{
                padding:3px 0px;
            }
            .gn_table th{
                padding:3px 0px;
                text-align: left;

            }
            .style_block{
                float: left;
                padding: 1px 1px;
                margin: 2.5px;
                /* background: #000; */
                color: white;
                border: 1px solid #e4e4e4;
                width: 47%;
                font-size: 12px;
            }


            .style_block span {
                background: #fff;
                margin-left: 5px;
                color: #000;
                padding: 0px 5px;
                width: 50%;
            }
            .style_block b {
                width: 46%;
                float: left;
                background: #dedede;
                color: black;
            }
            span.fr_value {
                margin-left: 1px;
                padding: 0;
                font-size: 9px;
                text-align: -webkit-left;
                position: absolute;
                margin-top: 0px;
                width: 20px;
            }

            .icon-circle{
                font-size: 19px; height: 31px;width: 31px;
                background-color: #000;
                float: left; border-radius: 50%; color: #fff;line-height: 28px;text-align: center;
            }
        </style>
    </head>

    <body style="margin: 0;
          padding: 0;
          background: rgb(225, 225, 225);
          font-family: sans-serif;">
        <div class="" style="padding:50px 0px">
            <?php echo EMAIL_HEADER; ?>
            <table class="detailstable" align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff">
                <tr>
                    <td style="font-size: 12px;width: 100%" >

                        <table class="gn_table" style="width: 100%">
                            <tr>
                                <td colspan="2" style="text-align: center;font-size: 16px;">
                                    <b>Guest Informations</b><br/><hr/>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;text-align: right;">Name</th>
                                <td>: <?php echo $order_data->first_name; ?> <?php echo $order_data->last_name; ?> </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;text-align: right;">Email</th>
                                <td>: <?php echo $order_data->email; ?> </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;text-align: right;">Contact No.</th>
                                <td>: <?php echo $order_data->contact; ?> </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;text-align: right;">Order No.</th>
                                <td>: <?php echo $order_data->id; ?> </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;text-align: right;">Date/Time</th>
                                <td>: <?php echo $order_data->datetime; ?>   </td>
                            </tr>

                            <tr>
                                <th style="width: 50%;text-align: right;">Order Source</th>
                                <td>: <?php echo $order_data->order_source; ?>   </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;text-align: right;">Status</th>
                                <td>: <?php
                                    if ($order_status) {
                                        echo end($order_status)->status;
                                    } else {
                                        echo "Pending";
                                    }
                                    ?> </td>
                            </tr>

                        </table>


                    </td>

                </tr>
            </table>


            <table class="carttable"  border-color= "#9E9E9E" align="center"  cellpadding="0" cellspacing="0" width="700" style="background: #fff;">


                <tr>
                    <td>
                        <div class = "" style = "    padding: 5px 5px;
                             border: 1px solid #000;
                             margin-bottom: 18px;
                             border-radius: 5px;">
                            <center>
                                <h3 style="padding: 2px;  margin: -2px;  background-color: #ECECEC; margin-bottom: 10px;  color: #000; font-weight: 300;">Order Status</h3>

                                <table class="orderstatustable" align="center"  cellpadding="0" cellspacing="0" width="600" >

                                    <?php
                                    $count = 0;
                                    $countord = count($order_status);
                                    foreach ($order_status as $oskey => $osvalue) {
                                        ?>
                                        <tr style="border-bottom: 1px solid #000;">
                                            <td style='text-align: right; border-left: 0px solid;padding: 0;'>

                                                <i class='icon-circle'><?php
                                                    echo $countord - $count;
                                                    ?></i>
                                            </td>
                                            <td style=' padding: 10px;'>
                                                <b>
                                                    <?php
                                                    echo $osvalue->status;
                                                    ?>
                                                </b>
                                                <br/>
                                                <small style="font-weight:300;font-size:13px">
                                                    <?php
                                                    if ($osvalue->status == "Shipped") {
                                                        echo $osvalue->description;
                                                    } else {
                                                        echo $osvalue->remark;
                                                    }
                                                    ?>

                                                </small>


                                            </td>

                                            <th style="
                                                text-align: left;">
                                                <span style="font-size: 10px;">
                                                    <?php
                                                    echo $osvalue->c_date . " " . $osvalue->c_time;
                                                    ?>
                                                </span>
                                            </th>

                                        </tr>
                                        <?php
                                        echo "<tr><td colspan=3><hr /></td></tr>";
                                        ?>
                                        <?php
                                        $count++;
                                    }
                                    ?>

                                </table>
                            </center>
                        </div>
                    </td>
                </tr>          

            </table>


            <table class="boooking"   align="center" border="1" cellpadding="0" cellspacing="0" width="700" style="background: #fff;padding:20px">
                <tr style="font-weight: bold">
                    <td colspan="2"  style="text-align: center;width: 33%;">
                        <div class="thumbnail">
                            <img src="<?php echo base_url(); ?>assets/booking/time.svg" alt="..." style="height: 50px;">
                                <div class="caption">
                                    <h3>Date/Time</h3>
                                    <p><?php echo $order_data->select_date; ?> <?php echo $order_data->select_time; ?></p>
                                </div>
                        </div>
                    </td>
                    <td colspan="2"  style="text-align: center;width: 33%;">
                        <div class="thumbnail">
                            <img src="<?php echo base_url(); ?>assets/booking/table.png" alt="..." style="height: 50px;">
                                <div class="caption">
                                    <h3>Table</h3>
                                    <p><?php echo $order_data->select_table; ?></p>
                                </div>
                        </div>
                    </td>
                    <td colspan="2" style="text-align: center;width: 33%;">
                        <div class="thumbnail">
                            <img src="<?php echo base_url(); ?>assets/booking/profile.png" alt="..." style="height: 50px;">
                                <div class="caption">
                                    <h3><?php echo $order_data->booking_type; ?></h3>
                                    <p>Guest(s): <?php echo $order_data->people; ?></p>
                                </div>
                        </div>
                    </td>
                </tr>





                <tr>
                    <td colspan="6" style="font-size: 12px;padding:0px;">



                        <?php
                        echo EMAIL_FOOTER;
                        ?>

                    </td>
                </tr>

            </table>

        </div>
    </body>
</html>