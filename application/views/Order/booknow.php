<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<style>
    .datepicker-inline {
        /*width: 450px;*/
        display: contents;
    }
    .datepicker table{
        /*width:100%;*/
    }
    .datepicker td, .datepicker th {
        padding: 5px;
        color: black;
    }
    .datepicker table tr td.active:hover, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active:focus, .datepicker table tr td.active:hover:focus, .datepicker table tr td.active.disabled:focus, .datepicker table tr td.active.disabled:hover:focus, .datepicker table tr td.active:active, .datepicker table tr td.active:hover:active, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.active, .datepicker table tr td.active:hover.active, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled:hover.active, .open .dropdown-toggle.datepicker table tr td.active, .open .dropdown-toggle.datepicker table tr td.active:hover, .open .dropdown-toggle.datepicker table tr td.active.disabled, .open .dropdown-toggle.datepicker table tr td.active.disabled:hover {
        color: #ffffff;
        background-color: #000000;
        border-color: #151515;
    }

    .btnbooking{
        background: black!important;
        border-color: black!important;
        border-radius: 15px;
    }
    .button_plus{
        border-radius: 15px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        background: black!important;
        border-color: black!important;
    }

    .button_minus{
        border-radius: 15px;
        border-top-right-radius:  0;
        border-bottom-right-radius: 0;
        background: black!important;
        border-color: black!important;
    }

    span.booking_lable {
        font-size: 16px;
        color: black;
    }

    .form-row{
        /*        border-bottom: 1px solid #000;
                padding-bottom: 15px;*/
        padding: 10px;
        clear: both;
    }

    .stimeslot .btn {
        float: left;
        padding: 5px;
        margin: 5px;
        background: black;
        color: white;
        border-radius: 15px;
        font-size: 12px;
    }

    .tabimage{
        height: 40px!important;
    }

    .tabtitle{
        margin-bottom: 0px;
        font-size: 12px;
        color: black;
        text-align: center;
    }
    .titleblockwix {
        float: left;
        width: 100%;
        background: black;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        margin-top: 20px;
        padding:10px;
    }

    .tableimg{
        height: 40px!important;
    }
    .tabletop {
        padding: 5px;
        background: #ececec;
        display:  inline-block;
        margin: 5px;
        text-align: center;
        border: 3px solid #ececec;
    }

    .tabletop:hover{
        border: 3px solid black;
    }

    .tabletop.active {
        border: 3px solid #000000;
    }

    .nav-tabs {
        border-bottom: 1px solid #000000;
    }
    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        color: #495057;
        background-color: #fff;
        border-color: #000000 #000000 #fff;
    }

    .userloginform{
        padding: 10px 40px;
        background: #f6f6f6;
        border-radius: 32px;
        margin:20px 50px;
    }

</style>

<script>




</script>

<div id="content" class="content">
    <section class="" style="min-height: auto;" ng-controller="bookingController">

        <div class="content-wrap" style="padding: 0px;">

            <div class="panel panel-inverse" data-sortable-id="index-10">
                <div class="panel-heading">
                    <h4 class="panel-title">For Telephonic/Walkin Guests</h4>
                </div>
                <div class="panel-body">

                    <ul class="nav nav-tabs" id="bookingTab">
                        <li class="active">
                            <a href="#nav-datetime-tab" data-toggle="tab">
                                <figure class="thumbnail" style="width: 150px;">
                                    <img src="<?php echo base_url(); ?>assets/booking/time.svg" class="figure-img img-fluid rounded tabimage" alt="...">

                                    <p class="tabtitle">{{bookingArray.select_date}}</p>
                                    <p class="tabtitle">{{bookingArray.select_time}}</p>

                                </figure>
                            </a>
                        </li>
                        <li class="">
                            <a href="#nav-table-tab" data-toggle="tab">
                                <figure class="thumbnail" style="width: 150px;">
                                    <img src="<?php echo base_url(); ?>assets/booking/table.png" class="figure-img img-fluid rounded tabimage" alt="...">

                                    <p class="tabtitle">Table</p>
                                    <p class="tabtitle">{{bookingArray.select_table}}</p>

                                </figure>

                            </a>
                        </li>
                        <li class="">
                            <a href="#nav-profile-tab" data-toggle="tab">
                                <figure class="thumbnail" style="width: 150px;">
                                    <img src="<?php echo base_url(); ?>assets/booking/profile.png" class="figure-img img-fluid rounded tabimage" alt="...">

                                    <p class="tabtitle">{{bookingArray.book_type}}</p>
                                    <p class="tabtitle">{{bookingArray.people}} Guest(s)</p>

                                </figure>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="nav-datetime-tab">
                            <div style="    margin-top: 20px;">
                                <h4 style="    font-size: 12px;">Click here to reserve a booking or make an enquiry.</h4>
                                <div class="btn-group"  role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger {{bookingArray.book_type == 'Reserve'?'active':''}}" ng-click="bookType('Reserve')">Reserve Now</button>
                                    <button type="button" class="btn btn-danger {{bookingArray.book_type == 'Enquiry'?'active':''}}" ng-click="bookType('Enquiry')">Make An Enquiry</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">

                                    <div class="">
                                        <span class="titleblockwix">Select Date</span>
                                        <div id="datepicker-inline"></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <span class="titleblockwix">Select Time</span>
                                    <div class="stimeslot" style="    padding-left: 13px;">

                                        <button class="btn btn-primary btn-inverse btn-sm" ng-repeat="time in initWizard.timeslot" ng-click="selectTime(time)">{{time}}</button>
                                        <div style="clear:both"></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btnbooking btn-lg"    ng-if='bookingArray.select_time != "--:--:--"'    ng-click='changeWizardTble()'  >Select Guest(s) <i class="fa fa-arrow-right"></i></button>
                        </div>


                        <div class="tab-pane fade" id="nav-table-tab">
                            <div style="    margin-top: 20px;">
                                <h4 style="    font-size: 12px;">Click here to reserve a table or make an enquiry.</h4>
                            </div>

                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-6">
                                    <div class="">
                                        <span class="titleblockwix">Ground Floor</span>
                                        <div class="tableview">
                                            <div class="tabletop {{bookingArray.select_table==table?'active':''}}" ng-repeat="table in initWizard.tables.zone_g" ng-click="selectTable(table)">
                                                <figure class="figure">
                                                    <img src="<?php echo base_url(); ?>assets/booking/dining_table.png" class="figure-img img-fluid rounded tableimg" alt="...">
                                                    <figcaption class="figure-caption">{{table}}</figcaption>
                                                </figure>
                                            </div>
                                            <div style="clear:both"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <span class="titleblockwix">First Floor</span>
                                    <div class="tableview">
                                        <center>
                                            <div class="tabletop {{bookingArray.select_table==table?'active':''}}" ng-repeat="table in initWizard.tables.zone_f" ng-click="selectTable(table)">
                                                <figure class="figure">
                                                    <img src="<?php echo base_url(); ?>assets/booking/dining_table.png" class="figure-img img-fluid rounded tableimg" alt="...">
                                                    <figcaption class="figure-caption">{{table}}</figcaption>
                                                </figure>
                                            </div>
                                        </center>
                                        <div style="clear:both"></div>
                                    </div>

                                </div>
                            </div>

                            <button class="btn btn-primary btnbooking btn-lg"    ng-if='bookingArray.select_table == "--"'    ng-click='changeWizardTime()'  ><i class="fa fa-arrow-left"></i> Select Date & Time</button>
                            <div ng-if='bookingArray.select_table != "--"'>
                                <button class="btn btn-primary btn-lg button_minus"  ng-click="changeWizardTime()"><i class="fa fa-arrow-left"></i> Select Date & Time</button>
                                <button class="btn btn-primary btnbooking btn-lg button_plus"     ng-click='changeWizardProfile()'  >Select Guest(s) <i class="fa fa-arrow-right"></i></button>
                            </div>    
                        </div>


                        <div class="tab-pane fade" id="nav-profile-tab">
                            <form action="#" method="post" >
                                <input type="hidden1" name="select_date" value="{{bookingArray.select_date}}"/>
                                <input type="hidden11" name="select_time" value="{{bookingArray.select_time}}"/>
                                <input type="hidden" name="booking_type" value="{{bookingArray.book_type}}"/>
                                <input type="hidden1" name="select_table" value="{{bookingArray.select_table}}"/>
                                <input type="hidden1" name="usertype" value="<?php echo $usertype; ?>"/>

                                <center>
                                    <div class="form-row" style="width:150px; ">
                                        <span class="booking_lable" style="    float: left;
                                              width: 100%;">Select people</span>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-btn ">
                                                <button class="btn btn-primary btn-sm button_minus" type="button" ng-click="changePeople('minus')"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input type="text" name="people" class="form-control" placeholder="" value="{{bookingArray.people}}" style="height: 32px;" id="people" required="">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary  btn-sm  button_plus" type="button" ng-click="changePeople('plus')"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div><!-- /input-group -->
                                    </div>
                                </center>





                                <h4 style="    font-size: 12px;">  Enter Guest Details </h4>

                                <div class="form-row">
                                    <div class="form-holder col-md-6">
                                        <input type="text" name="first_name" placeholder="First Name" class="form-control" required="" ng-model="bookingArray.first_name">
                                    </div>
                                    <div class="form-holder col-md-6">
                                        <input type="text" name="last_name" placeholder="Last Name" class="form-control" required="" ng-model="bookingArray.last_name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder col-md-6">
                                        <input type="text" name="email" placeholder="Your Email" class="form-control" required="" ng-model="bookingArray.email">
                                    </div>
                                    <div class="form-holder col-md-6">
                                        <input type="text" name="contact_no" placeholder="Phone Number" class="form-control" required="" ng-model="bookingArray.contact_no">
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="form-holder col-md-12" style="    width: 100%;">
                                        <input type="text" name="extra_remark" placeholder="Special Request (Optional)" class="form-control" >
                                    </div>
                                </div>
                                <hr/>
                                <button class="btn btn-primary btn-lg button_minus" type="button"  ng-click="changeWizardTble()"><i class="fa fa-arrow-left"></i></button>
                                <button class="btn btn-primary btn-lg button_plus" name="submit" type="submit">Confirm Now <i class="fa fa-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>



        <!-- Modal -->
        <div class="modal fade" id="thanksModal" tabindex="-1" role="dialog" aria-labelledby="thanksModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thanks you for booking.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2>
                            Thank You for giving us the opportunity to serve you.<br/> We will do our best to be sure you enjoy our services.
                        </h2>

                        <figure class="figure" style="    width: 100%;margin-top: 20px;
                                text-align: center;">
                            <img src="<?php echo base_url(); ?>assets/images/logo50.png" class="figure-img img-fluid rounded" alt="Baan Thai" style="height:40px">
                            <figcaption class="figure-caption">The signature flavors of authentic Thai cuisine.</figcaption>
                        </figure>

                    </div>

                </div>
            </div>
        </div>


        <script>

<?php
if ($submitdata == 'yes') {
    ?>
                $(function () {
                let newmail = new Audio("<?php echo base_url(); ?>assets/sound/sendemail.mp3");
                newmail.play();
                $("#thanksModal").modal("show");
                $('#thanksModal').on('hidden.bs.modal', function (e) {
                //            window.location = "<?php echo site_url('booknow'); ?>";
                });
                })
    <?php
}
?>



        </script>



    </section>
</div>





<?php
$this->load->view('layout/footer');
?> 



<script>
    var baseurl = "<?php echo base_url(); ?>index.php/";
    var today = "<?php echo date('Y-m-d'); ?>";</script>
<script src="<?php echo base_url(); ?>assets/angular/booking.js"></script>
