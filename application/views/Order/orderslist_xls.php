<table border="1">
    <thead>
        <tr>
            <th>Order No.</th>
            <th>Source</th>
            <th>Guest(s)</th>
            <th>Select Date</th>
            <th>Select Time</th>
            <th>Table No.</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Contact No.</th>
            <th>Booking Date/Time</th>
             <th>Type</th>
            <th>State</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($orderslist)) {
            foreach ($orderslist as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $value->id; ?></td>
                    <td><?php echo $value->order_source; ?></td>
                    <td><?php echo $value->people; ?></td>
                    <td><?php echo $value->select_date; ?></td>
                    <td><?php echo $value->select_time; ?></td>
                    <td><?php echo $value->select_table; ?></td>
                    <td><?php echo $value->first_name; ?></td>
                    <td><?php echo $value->last_name; ?></td>
                    <td><?php echo $value->email;?></td>
                    <td><?php echo $value->contact; ?></td>
                    <td><?php echo $value->datetime; ?></td>
                    <td><?php echo $value->booking_type; ?></td>
                    <td><?php echo $value->status; ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
        <h4><i class="fa fa-warning"></i> No order found</h4>
        <?php
    }
    ?>

</tbody>
</table>
