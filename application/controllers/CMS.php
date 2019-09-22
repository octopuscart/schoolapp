<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CMS extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->curd = $this->load->model('Curd_model');
        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function gallaryCategories() {
        $data = array();
        $tablename = "school_album";
        $get_data = $this->Curd_model->get($tablename, 'desc');
        $data['news_data'] = $get_data;
        $data['tablename'] = $tablename;
        $data["geturl"] = site_url("LocalApi/tableData");
        $data["deleteurl"] = site_url("LocalApi/classDataDelete");
        if (isset($_POST['submit_data'])) {
            $insertArray = array(
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
                "datetime" => date("Y-m-d H:i:s a"),
            );
            $tableid = $this->Curd_model->insert($tablename, $insertArray);
            redirect("CMS/gallaryCategories");
        }
        if (isset($_POST['update_data'])) {
            $tableid = $this->input->post("table_id");
            $this->db->where('id', $tableid);
            $insertArray = array(
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
                "datetime" => date("Y-m-d H:i:s a"),
            );
            $this->db->update($tablename, $insertArray);
            redirect("CMS/gallaryCategories");
        }
        $this->load->view('CMS/gallary/list', $data);
    }

    function galleryImages($galleryid) {
        $tablename = "school_album";
        $get_data = $this->Curd_model->get_single($tablename, $galleryid);
        $data['gallery_data'] = $get_data;
        $data['tablename'] = $tablename;

        $data["geturl"] = site_url("MobileApi/getGalleryAlbumById/$galleryid");
        $data["deleteurl"] = site_url("LocalApi/classDataDelete");


        if (isset($_POST['submit_data'])) {

            $tableid = $galleryid;
            $realfilename = $this->input->post("file_real_name");
            if ($realfilename) {
                $config['upload_path'] = 'assets/schoolfiles';
                $config['allowed_types'] = '*';
                $tempfilename = rand(10000, 1000000);
                $tempfilename = "" . $tempfilename . $tableid;
                $ext2 = explode('.', $_FILES['file']['name']);
                $ext3 = strtolower(end($ext2));
                $ext22 = explode('.', $tempfilename);
                $ext33 = strtolower(end($ext22));
                $filename = $ext22[0];
                $file_newname = $filename . '.' . $ext3;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $tableid = $tableid;
                    $file_newname = $uploadData['file_name'];

                    $filecreate = array(
                        'table_name' => $tablename,
                        'table_id' => $tableid,
                        "file_name" => $file_newname,
                        'file_real_name' => $this->input->post("file_real_name"),
                        'file_type' => $ext3,
                        "date" => date("Y-m-d"),
                        "time" => date("H:i:s a"),
                    );
                    $this->db->insert('school_files', $filecreate);
                }
            }
            redirect("CMS/galleryImages/$galleryid");
        }


        $this->load->view('CMS/gallary/imagelist', $data);
    }

    public function seoPageSetting() {
        $data = array();
        $data['title'] = "Set The Page wise SEO Attributes";
        $data['description'] = "SEO";
        $data['form_title'] = "SEO";
        $data['table_name'] = 'seo_settings';
        $form_attr = array(
            "seo_title" => array("title" => "Title", "required" => true, "place_holder" => "Title", "type" => "text", "default" => ""),
            "seo_description" => array("title" => "Description", "required" => true, "place_holder" => "Description", "type" => "textarea", "default" => ""),
            "seo_keywords" => array("title" => "Keywords", "required" => true, "place_holder" => "Keywords", "type" => "textarea", "default" => ""),
            "seo_url" => array("title" => "Page URL", "required" => false, "place_holder" => "Link", "type" => "text", "default" => ""),
        );

        if (isset($_POST['submitData'])) {
            $postarray = array();
            foreach ($form_attr as $key => $value) {
                $postarray[$key] = $this->input->post($key);
            }
            $this->Curd_model->insert('seo_settings', $postarray);
            redirect("CMS/seoPageSetting");
        }


        $categories_data = $this->Curd_model->get('seo_settings');
        $data['list_data'] = $categories_data;

        $fields = array(
            "id" => array("title" => "ID#", "width" => "100px"),
            "seo_title" => array("title" => "Title", "width" => "200px"),
            "seo_description" => array("title" => "Description", "width" => "200px"),
            "seo_keywords" => array("title" => "Keywords", "width" => "200px"),
            "seo_url" => array("title" => "URL", "width" => "200px"),
        );

        $data['fields'] = $fields;
        $data['form_attr'] = $form_attr;
        $this->load->view('layout/curd', $data);
    }

    public function siteSEOConfigUpdate() {
        $data = array();
        $blog_data = $this->Curd_model->get_single('configuration_site', 2);

        $data['site_data'] = $blog_data;
        if (isset($_POST['update_data'])) {
            $blogArray = array(
                "seo_keywords" => $this->input->post("keyword"),
                "seo_title" => $this->input->post("title"),
                "seo_desc" => $this->input->post("description"),
            );

            $this->db->where('id', 1);
            $this->db->update('configuration_site', $blogArray);
            redirect("CMS/siteConfigUpdate");
        }

        $this->load->view('configuration/site_update', $data);
    }

}

?>
