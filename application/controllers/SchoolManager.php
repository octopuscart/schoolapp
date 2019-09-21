<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class SchoolManager extends CI_Controller {

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

    public function addCircular($usertype = 'teacher') {

        $circularArray = array(
            "teacher" => "Teachers",
            "parent" => "Parents",
            "student" => "Students",
        );
        if (isset($circularArray[$usertype])) {
            $data['cir_title'] = $circularArray[$usertype];
        } else {
            redirect("SchoolManager/addCircular/teacher");
        }

        $tablename = "school_circular";

        $get_data = $this->Curd_model->get($tablename, 'desc');
        $data['news_data'] = $get_data;

        $data['tablename'] = $tablename;

        $data["geturl"] = site_url("MobileApi/getCircularData/$usertype");
        if (isset($_POST['submit_data'])) {
            $insertArray = array(
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
                "datetime" => date("Y-m-d H:i:s a"),
                "status" => "1",
                "user_type" => $usertype
            );
            $tableid = $this->Curd_model->insert($tablename, $insertArray);
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
                    $this->db->set('attachment', $file_newname);
                    $this->db->where('id', $tableid); //set column_name and value in which row need to update
                    $this->db->update($tablename); //
                }
            }
            redirect("SchoolManager/addCircular/$usertype");
        }


        if (isset($_POST['update_data'])) {
            $tableid = $this->input->post("table_id");
            $this->db->where('id', $tableid);
            $insertArray = array(
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
                "datetime" => date("Y-m-d H:i:s a"),
                "status" => "1"
            );

            $this->db->update($tablename, $insertArray);
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
                    $this->db->set('attachment', $file_newname);
                    $this->db->where('id', $tableid); //set column_name and value in which row need to update
                    $this->db->update($tablename); //
                }
            }
            redirect("SchoolManager/addCircular/$usertype");
        }


        $this->load->view('CMS/circular/list', $data);
    }

    function newsList() {
        $tablename = "school_news";

        $get_data = $this->Curd_model->get($tablename, 'desc');
        $data['news_data'] = $get_data;

        $data['tablename'] = $tablename;

        $data["geturl"] = site_url("LocalApi/tableData");
        if (isset($_POST['submit_data'])) {
            $insertArray = array(
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
                "datetime" => date("Y-m-d H:i:s a"),
                "status" => "1"
            );
            $tableid = $this->Curd_model->insert($tablename, $insertArray);
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
                    $tablename = "school_news";
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
                    $this->db->set('attachment', $file_newname);
                    $this->db->where('id', $tableid); //set column_name and value in which row need to update
                    $this->db->update($tablename); //
                }
            }
            redirect("CMS/newsList");
        }


        if (isset($_POST['update_data'])) {
            $tableid = $this->input->post("table_id");
            $this->db->where('id', $tableid);
            $insertArray = array(
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
                "datetime" => date("Y-m-d H:i:s a"),
                "status" => "1"
            );

            $this->db->update($tablename, $insertArray);
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
                    $tablename = "school_news";
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
                    $this->db->set('attachment', $file_newname);
                    $this->db->where('id', $tableid); //set column_name and value in which row need to update
                    $this->db->update($tablename); //
                }
            }
            redirect("CMS/newsList");
        }


        $this->load->view('CMS/news/list', $data);
    }

}
