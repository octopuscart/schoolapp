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
<!-- ================== BEGIN PAGE CSS STYLE ================== -->

<link href="<?php echo base_url(); ?>assets/plugins/isotope/isotope.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo base_url(); ?>assets/plugins/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />



<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/GridGallery/css/component.css" />
<script src="<?php echo base_url(); ?>assets/GridGallery/js/modernizr.custom.js"></script>

<script src="<?php echo base_url(); ?>assets/GridGallery/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/GridGallery/js/masonry.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/GridGallery/js/classie.js"></script>
<script src="<?php echo base_url(); ?>assets/GridGallery/js/cbpGridGallery.js"></script>


<style>

</style>

<!-- begin #content -->
<div id="content" class="content"  ng-controller="galleryController">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li class="active">Gallery Album</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Gallery Images <small><?php echo $gallery_data->title; ?></small></h1>
    <!-- end page-header -->

    <div id="gallery" class="gallery row">


        <div class="col-md-12 panel  panel-inverse">
            <div class="panel-body">
                <form action="#" method="POST" class="form-inline" enctype="multipart/form-data">
                    <div class="form-group m-r-10">
                        <div class="" style="margin-bottom: 20px;">

                            <div class="btn-group" role="group" aria-label="..." style="float:left;margin-right: 10px;">
                                <span class="btn btn-success col fileinput-button" ">
                                    <i class="fa fa-plus"></i>
                                    <span>Add files...</span>
                                    <input type="file" name="file"  file-model="filemodel" accept="image/*,.pdf">
                                </span>
                            </div>


                            <span style="font-size: 10px;">  Attach File From Here (PDF, JPG, PNG Allowed)</span>

                            <h2 style="    font-size: 12px;">{{filemodel.name}}</h2>
                            <input type="hidden" name="file_real_name" value="{{filemodel.name}}"/>


                           
                        </div>
                    </div>

                    <button type="submit" name="submit_data" class="btn btn btn-primary m-r-5 pull-right"><i class="fa fa-save"></i> Add Now</button>

                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-inverse">

                <div class="panel-body">
                    <div id="gallery" class="grid-gallery" style="    margin-top: 2em;">
                        <section class="grid-wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="thumbnail lookbook_thumb" ng-repeat="img in resultData.list.images1">
                                        <img src="{{img.img}}" alt="img01" style=""/>
                                        <div class="caption">
                                            <button class="btn btn-sm btn-danger" ng-click="deleteDataTable2(img.id, 'school_files')">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="thumbnail lookbook_thumb" ng-repeat="img in resultData.list.images2">
                                        <img src="{{img.img}}" alt="img01" style=""/>
                                        <div class="caption">
                                            <button class="btn btn-sm btn-danger" ng-click="deleteDataTable2(img.id, 'school_files')">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


         
                            <div style="clear:both"></div>
                        </section><!-- // grid-wrap -->
                        <div style="clear: both"></div>





                    </div>

                </div>
            </div>
        </div>
    </div>



</div>
<!-- end #content -->


<?php
$this->load->view('layout/footer');
?>
<script>
    var gbltablename = "<?php echo $tablename; ?>";
    var gblurl = "<?php echo $geturl ?>";
    var gbdeleteurl = "<?php echo $deleteurl; ?>";
</script>

<script src="<?php echo base_url(); ?>assets/angular/requestData.js"></script>