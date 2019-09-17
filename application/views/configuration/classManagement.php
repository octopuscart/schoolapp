<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->

    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Class Management <small></small></h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
        <div class="panel-heading">
            <h4 class="panel-title">Add Class</h4>
        </div>
        <div class="panel-body">
            <form class="form-inline" action="#" method="POST">
                <div class="form-group m-r-10">
                    <input type="text" name="class_name" class="form-control" id="exampleInputEmail2" placeholder="Enter Class">
                </div>
                <button type="submit" name="addclass" class="btn btn-sm btn-primary m-r-5">Add Class</button>
                <button type="button" class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>
            </form>
        </div>
    </div>
    <div class="panel panel-inverse">

        <div class="panel-body">

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:100px;">Class</th>
                        <th>Section</th>
                    </tr>
                    <?php
                    foreach ($class_data as $key => $value) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $value["title"]; ?>
                            </td>
                            <td>
                                <?php
                                foreach ($value['section'] as $skey => $svalue) {
                                    ?>
                                    <div class="classsectionblock">
                                        <span  id="<?php echo $skey; ?>" data-type="text" data-pk="<?php echo $svalue['class_id']; ?>" data-name="section_name" data-value="<?php echo $svalue['section']; ?>" data-params ={'tablename':'configuration_class'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-mode="inline" class="m-l-5 editable editable-click" tabindex="-1" > <?php echo $svalue['section']; ?></span>
                                    </div>
                                    <?php
                                }
                                ?>

                                <form class="form-inline pull-right" action="#" method="POST" class="">
                                    <input type="hidden" name="class_name" value="<?php echo $value["title"]; ?>">
                                    <input type="hidden" name="class_id" value="<?php echo $value["id"]; ?>">
                                    <div class="form-group m-r-10">
                                        <input type="text" name="section_name" class="form-control" id="exampleInputEmail2" placeholder="Enter Section">
                                    </div>
                                    <button type="submit" name="addsection" class="btn btn-sm btn-primary m-r-5">Add Section</button>
                                    <button type="button" class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>
                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                </table>

            </div>


        </div>
    </div>
    <!-- end panel -->
</div>
<!-- end #content -->





<?php
$this->load->view('layout/footer');
?>
<script>
    $(function () {


        $('#tags').tagit({
            availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
        });


        $('.edit_detail').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $($(this).prev()).editable('toggle');
        });

        $(".editable").editable();



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