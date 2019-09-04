<div class="panel panel-inverse">
    <div class="panel-heading with-border">
        <h3 class="panel-title">Select Order Status</h3>
    </div>
    <div class="panel-body">

        
         <a class="btn btn btn-social btn-inverse"  href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Confirmed");?>">
            <i class="fa fa-thumbs-o-up"></i> Confirmation
        </a>
        
        <a class="btn btn  btn-inverse" href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Pending");?>">
            <i class="fa fa-clock-o"></i> Pending
        </a>

      

        <a class="btn btn btn-social btn-inverse"  href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Delivered");?>">
            <i class="fa fa-truck"></i> Delivered
        </a>

        <a class="btn btn btn-social btn-inverse"  href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Canceled");?>">
            <i class="fa fa-times"></i> Canceled
        </a>

        <a class="btn btn btn-social btn-inverse"  href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Returned");?>">
            <i class="fa fa-reply"></i> Returned
        </a>
        <a class="btn btn btn-social btn-inverse"  href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Other");?>">
            <i class="fa fa-question"></i> Other
        </a>
    </div>
</div>
