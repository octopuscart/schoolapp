<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class MobileApi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->API_ACCESS_KEY = 'AIzaSyDRm78bTofkeeczIxj2ktcBRL5JVxs9Usc';
        // (iOS) Private key's passphrase.
        $this->passphrase = 'joashp';
        // (Windows Phone 8) The name of our push channel.
        $this->channelName = "joashp";
    }

    function testGet_get() {
        print_r($this->checklogin['user_type']);
    }

    function getClassData_get() {
        $this->config->load('rest', TRUE);
        $classData = array(
            "1" =>
            array(
                "id" => "1",
                "title" => "6th",
                "section" => array(
                    "12" => array("class_id" => "12", "section" => "A"),
                    "13" => array("class_id" => "13", "section" => "B")
                ),
            ),
            "2" => array(
                "id" => "2",
                "title" => "7th",
                "section" => [
                    "14" => array("class_id" => "14", "section" => "A"),
                    "15" => array("class_id" => "15", "section" => "B"),
                    "16" => array("class_id" => "16", "section" => "C")
                ],
            )
        );
        $this->response($classData);
    }

    function uploadFile_post() {
        $config['upload_path'] = 'assets/schoolfiles';
        $config['allowed_types'] = '*';
        $tableid = $this->post('file_table_id');
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
            $tableid = $this->post('file_table_id');
            $file_newname = $uploadData['file_name'];
            $tablename = $this->post('file_tablename');
            $filecreate = array(
                'table_name' => $tablename,
                'table_id' => $this->post('file_table_id'),
                "file_name" => $file_newname,
                'file_real_name' => $this->post('name'),
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

    //Class Note Send Note Functions
    function classNotes_post() {
        $this->config->load('rest', TRUE);
        // $tempfilename = rand(100, 1000000);
        $class_notes = array(
            'title' => $this->post('title'),
            'description' => $this->post('description'),
            "attachment" => "",
            "datetime" => date("Y-m-d H:i:s a"),
            'class_id' => $this->post('class_id'),
            'class' => $this->post('class'),
            'section' => $this->post('section'),
            'user_id' => $this->post('user_id'),
            'status' => "0",
        );
        $this->db->insert('class_notes', $class_notes);
        $last_id = $this->db->insert_id();
        $this->response(array("last_id" => $last_id));
    }

    function getClassNoteDataByClass_get($class_id) {
        $this->config->load('rest', TRUE);
//        $this->db->where('status', '1');
        $this->db->where('class_id', $class_id);
        $this->db->order_by('id desc');
        $query = $this->db->get('class_assignment');
        $assignmentData = $query->result();
        $this->response($assignmentData);
    }

    function getClassNoteData_get($userid) {
        $this->config->load('rest', TRUE);
//        $this->db->where('status', '1');
        $this->db->where('user_id', $userid);
        $this->db->order_by('id desc');
        $query = $this->db->get('class_notes');
        $classnoteData = $query->result();
        $this->response($classnoteData);
    }

    // End of Class Note functions
    // 
    //Assignment Functions
    function getAssignmentDataByClass_get($class_id) {
        $this->config->load('rest', TRUE);
//        $this->db->where('status', '1');
        $this->db->where('class_id', $class_id);
        $this->db->order_by('id desc');
        $query = $this->db->get('class_assignment');
        $assignmentData = $query->result();
        $this->response($assignmentData);
    }

    function getAssignmentData_get($userid) {
        $this->config->load('rest', TRUE);
//        $this->db->where('status', '1');
        $this->db->where('user_id', $userid);
        $this->db->order_by('id desc');
        $query = $this->db->get('class_assignment');
        $assignmentData = $query->result();
        $this->response($assignmentData);
    }

    function classAssignment_post() {
        $this->config->load('rest', TRUE);
        $class_assignment = array(
            'title' => $this->post('title'),
            'description' => $this->post('description'),
            "attachment" => "",
            "datetime" => date("Y-m-d H:i:s a"),
            'class_id' => $this->post('class_id'),
            'class' => $this->post('class'),
            'section' => $this->post('section'),
            'user_id' => $this->post('user_id'),
            'status' => "0",
        );
        $this->db->insert('class_assignment', $class_assignment);
        $last_id = $this->db->insert_id();
        $this->response(array("last_id" => $last_id));
    }

    //end of assignment function
    //
    //Class note functions
    function getClassNoticeData_get($userid) {
        $this->config->load('rest', TRUE);
//        $this->db->where('status', '1');
        $this->db->where('user_id', $userid);
        $this->db->order_by('id desc');
        $query = $this->db->get('class_notice');
        $assignmentData = $query->result();
        $this->response($assignmentData);
    }

    function getClassNoticeDataByClass_get($class_id) {
        $this->config->load('rest', TRUE);
//        $this->db->where('status', '1');
        $this->db->where('class_id', $class_id);
        $this->db->order_by('id desc');
        $query = $this->db->get('class_notice');
        $assignmentData = $query->result();
        $this->response($assignmentData);
    }

    function classNotice_post() {
        $this->config->load('rest', TRUE);
        // $tempfilename = rand(100, 1000000);
        $class_notes = array(
            'title' => $this->post('title'),
            'description' => $this->post('description'),
            "attachment" => "",
            "datetime" => date("Y-m-d H:i:s a"),
            'class_id' => $this->post('class_id'),
            'class' => $this->post('class'),
            'section' => $this->post('section'),
            'user_id' => $this->post('user_id'),
            'status' => "0",
        );
        $this->db->insert('class_notice', $class_notes);
        $last_id = $this->db->insert_id();
        $this->response(array("last_id" => $last_id));
    }

    //circular data
    function getCircularData_get($usertype) {
        $this->config->load('rest', TRUE);
//        $this->db->where('status', '1');
        $this->db->where('user_type', $usertype);
        $this->db->order_by('id desc');
        $query = $this->db->get('school_circular');
        $CircularData = $query->result();
        $this->response($CircularData);
    }
   //    end of circular data

    function getNewsData_get() {
        $this->config->load('rest', TRUE);
//        $this->db->where('status', '1');
        $this->db->order_by('id desc');
        $query = $this->db->get('school_news');
        $CircularData = $query->result();
        $this->response($CircularData);
    }

    //end of class note functions


    function getGalleryAlbum_get() {
        $this->config->load('rest', TRUE);
        $tempdata = array(
            "id" => "1",
            "title" => "Test Album",
            "description" => "Description Of Test News.",
            "main_image" => base_url() . "assets/gallary/" . "1.jpg",
            "stackimage" => [
                base_url() . "assets/gallary/" . "1.jpg",
                base_url() . "assets/gallary/" . "2.jpg",
                base_url() . "assets/gallary/" . "3.jpg",
                base_url() . "assets/gallary/" . "4.jpg",
            ],
            "datetime" => date("Y-m-d H:i:s a"),
        );
        $newsData = [];
        for ($i = 0; $i < 15; $i++) {
            array_push($newsData, $tempdata);
        }
        $this->response($newsData);
    }

    function getGalleryAlbumById_get($albumid) {
        $this->config->load('rest', TRUE);
        $tempdata = array(
            "title" => "Test Album",
            "description" => "Description Of Test News.",
            "main_image" => base_url() . "assets/gallary/" . "1.jpg",
            "images1" => [
                base_url() . "assets/gallary/" . "1.jpg",
                base_url() . "assets/gallary/" . "2.jpg",
                base_url() . "assets/gallary/" . "3.jpg",
                base_url() . "assets/gallary/" . "4.jpg",
            ],
            "images2" => [
                base_url() . "assets/gallary/" . "5.jpg",
                base_url() . "assets/gallary/" . "6.jpg",
                base_url() . "assets/gallary/" . "7.jpg",
                base_url() . "assets/gallary/" . "8.jpg",
            ],
            "datetime" => date("Y-m-d H:i:s a"),
        );
        $this->response($tempdata);
    }

    function test_get() {
        $user_array = array(
            "S300001" => array("userid" => "S300001", "name" => "Ayushi Mourya", "mobile_no" => "0000000000", "email" => "", "gender" => "Female", "user_type" => "student", "class" => "6th", "section" => "B", "class_id" => "12"),
            "S200001" => array("userid" => "S200001", "name" => "Piyush Jayshwal", "mobile_no" => "0000000000", "email" => "", "gender" => "Male", "user_type" => "student", "class" => "6th", "section" => "B", "class_id" => "12"),
            "S700001" => array("userid" => "S100001", "name" => "Priyanka Sen", "mobile_no" => "0000000000", "email" => "", "gender" => "Female", "user_type" => "student", "class" => "6th", "section" => "B", "class_id" => "12"),
            "S400001" => array("userid" => "S400001", "name" => "Pooja Sharma", "mobile_no" => "0000000000", "email" => "", "gender" => "Female", "user_type" => "student", "class" => "6th", "section" => "B", "class_id" => "12"),
            "S500001" => array("userid" => "S500001", "name" => "Mohit Shrivastav", "mobile_no" => "0000000000", "email" => "", "gender" => "Male", "user_type" => "student", "class" => "6th", "section" => "B", "class_id" => "12"),
            "S600001" => array("userid" => "S600001", "name" => "Piyush Shukla", "mobile_no" => "0000000000", "email" => "", "gender" => "Male", "user_type" => "student", "class" => "6th", "section" => "B", "class_id" => "12"),);
        foreach ($user_array as $key => $value) {
            #$this->db->insert('school_user', $value);
        }
    }

    function getUserDataFromId_post() {
        $this->config->load('rest', TRUE);
        $user_id = $this->post('user_id');
        $this->db->where('userid', $user_id);
        $this->db->order_by('name asc');
        $query = $this->db->get('school_user');
        $userData = $query->row();
        $returndata = array("status" => "100", "data" => "");
        if ($userData) {
            $tempdata = $userData;
            $returndata["data"] = $tempdata;
            $returndata["status"] = "200";
        }
        $this->response($returndata);
    }

    function getClassStudents_get($classid) {
        $this->config->load('rest', TRUE);
//        $this->db->where('status', '1');
        $this->db->where('class_id', $classid);
        $this->db->where('user_type', "student");
        $this->db->order_by('name asc');
        $query = $this->db->get('school_user');
        $userData = $query->result();
        $this->response($userData);
    }

    function getLeaveRequestByClass_get($classid) {
        $this->config->load('rest', TRUE);
        $user_array = array(
            "S300001" => array(
                "userid" => "S300001",
                "name" => "Ayushi Mourya",
                "gender" => "Female",
                "from_date" => "2019-09-07",
                "to_date" => "2019-09-08",
                "reason" => "Health Issue",
            ),
            "S200001" => array(
                "userid" => "S200001",
                "name" => "Piyush Jayshwal",
                "gender" => "Male",
                "from_date" => "2019-09-10",
                "to_date" => "2019-09-12",
                "reason" => "Health Issue",
            ),
        );
        $this->response($user_array);
    }

}

?>