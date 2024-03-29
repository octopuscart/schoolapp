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
    <h1 class="page-header">Teacher Management <small></small></h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
        <div class="panel-heading">
            <h4 class="panel-title">Add Teacher</h4>
        </div>
        <div class="panel-body">
            <form class="form-inline" action="#" method="POST">

                <div class="form-group row" style="width: 250px">
                    <label class="col-md-6 control-label" style="line-height: 32px">Select Class: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="class_id">
                            <?php
                            foreach ($class_data as $key => $value) {
                                echo "<option value=" . $value->id . ">" . $value->class_name . " / " . $value->section_name . "</option>";
                            }
                            ?>
                            <option>Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-group m-r-10">
                    <input type="text" name="name" class="form-control" id="exampleInputEmail2" placeholder="Teacher Name" required="">
                </div>
                <div class="form-group  m-r-10" >
                    <select class="form-control " name="gender">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="form-group m-r-10">
                    <input type="text" name="email" class="form-control" id="exampleInputEmail2" placeholder="Email">
                </div>
                <div class="form-group m-r-10">
                    <input type="text" name="mobile_no" class="form-control" id="exampleInputEmail2" placeholder="Mobile No.">
                </div>
                <button type="submit" name="adduser" class="btn btn-sm btn-primary m-r-5">Add Student</button>
                <button type="button" class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>
            </form>
        </div>
    </div>
    <div class="panel panel-inverse">

        <div class="panel-body">

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:100px;">User ID#</th>
                        <th style="width:100px;">Class</th>
                        <th>Section</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                    </tr>
                    <?php
                    foreach ($class_teachers as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value->userid; ?></td>
                            <td>
                                <?php echo $value->class; ?>
                            </td>
                            <td><?php echo $value->section; ?></td>
                            <td>
                                <span  id="<?php echo $value->userid; ?>" data-type="text" data-pk="<?php echo $value->id; ?>" data-name="name" data-value="<?php echo $value->name; ?>" data-params ={'tablename':'school_user'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-mode="inline" class="m-l-5 editable editable-click" tabindex="-1" > <?php echo $value->name; ?></span>

                            </td>
                            <td>
                                <span  data-type="select" data-pk="<?php echo $value->id; ?>" data-name="gender" data-value="<?php echo $value->gender; ?>" data-params ={'tablename':'school_user'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-mode="inline" class="m-l-5  editable-click gender" tabindex="-1" > <?php echo $value->gender; ?></span>

                            </td>
                            <td>
                                <span  id="<?php echo $value->userid; ?>" data-type="text" data-pk="<?php echo $value->id; ?>" data-name="email" data-value="<?php echo $value->email; ?>" data-params ={'tablename':'school_user'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-mode="inline" class="m-l-5 editable editable-click" tabindex="-1" > <?php echo $value->email; ?></span>

                            </td>
                            <td>
                                <span  id="<?php echo $value->userid; ?>" data-type="text" data-pk="<?php echo $value->id; ?>" data-name="mobile_no" data-value="<?php echo $value->mobile_no; ?>" data-params ={'tablename':'school_user'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-mode="inline" class="m-l-5 editable editable-click" tabindex="-1" > <?php echo $value->mobile_no; ?></span>

                            </td>
                            <td>
                                <form action="#" method="post">
                                    <input type="hidden" name="userid" value="<?php echo $value->userid; ?>">
                                    <button type="submit" name="removeuser" class="btn btn-sm btn-danger m-r-5"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
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

        $('.gender').editable({
            source: {
                'Male': 'Male',
                'Female': 'Female'
            }
        });



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