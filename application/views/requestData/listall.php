<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>

<style>
    .order_panel{
        padding: 10px;
        padding-bottom: 11px!important;
        border: 1px solid #c5c5c5;
        background: #fff;

    }
    .order_panel li{
        line-height: 19px!important;
        padding: 7px!important;
        border: none!important;
    }

    .order_panel li i{
        float: left!important;
        line-height: 19px!important;
        margin-right: 13px!important;
    }
    .order_panel h6{
        margin-top: 0px;
        margin-bottom: 5px;
    }

    .blog-posts article {
        margin-bottom: 10px;
    }
</style>


<!-- Main content -->
<section class="content" ng-controller="requestDataController">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">

                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-success btn-xs" ng-click = "getData()">Refresh</button>

                    </div>

                    <h4 class="panel-title" style="    font-size: 22px;">Unseen Class Data</h4>
                </div>
                <div class="panel-body">







                    <ul class="media-list media-list-with-divider listcard"  ng-repeat="data in rootData.classDataNotify">
                        <li class="media media-sm" >
                            <a class="media-left" href="javascript:;">
                                <img src="<?php echo base_url(); ?>assets/svgicon/{{data.icon}}" alt="" class="media-object rounded-corner">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    {{data.title}}
                                </h4>
                            
                                    <p ><span class="profileclass"> CLASS <span class="classtag greenGradiant">{{data.class}}/{{data.section}}</span> </span></p>
                             
                                <div class="teachersection">
                                    <p><i class="fa fa-user"></i> {{data.teacherdata.name}} (#{{data.teacherdata.userid}})</p>
                                </div>

                            </div>
                        </li>
                        <li class="media media-sm" >

                            <div class="media-body">
                                <p>
                                    <i class="fa fa-clock-o"></i>  {{data.datetime}}
                                </p>
                                <p>
                                    {{data.description}}
                                </p>
                                <p>
                                    <a href="<?php echo base_url(); ?>assets/schoolfiles/{{data.attachment}}" target="_blank" class="btn btn-sm btn-inverse m-r-5" ng-if='data.attachment'  >
                                        <i class="icon fa fa-download" style="color: {{resultData.textcolor}};"></i> Download
                                    </a>
                                    <button class="btn btn-sm btn-danger pull-right" ng-click="deleteDataAll(data.id, data.tablename)"><i class="fa fa-trash"></i></button>

                                    <button class="btn btn-sm btn-success pull-right m-r-5" ng-click="approveData(data.id, data.tablename)"><i class="fa fa-check"></i> Approve</button>

                                </p>
                            </div>
                        </li>

                    </ul>



                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?php
$this->load->view('layout/footer');
?> 

<script>
    $(function () {


    })


    $(function () {

        $('#tableDataOrder').DataTable({
            "language": {
                "search": "Search Order By Email, Order No., Order Date Etc."
            }
        })
    })
</script>

<script>
    var gbltablename = "";
    var gblurl = "<?php echo $geturl ?>";
    var deleteurl = "";
</script>

<script src="<?php echo base_url(); ?>assets/angular/requestData.js"></script>