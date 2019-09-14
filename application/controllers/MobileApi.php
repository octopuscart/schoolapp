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
        $query = $this->db->get('class_notes');
        $classnoteData = $query->result();
        $this->response($classnoteData);
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

    function getUserDataFromId_post($user_type = "") {
        $this->config->load('rest', TRUE);
        $user_id = $this->post('user_id');
        if ($user_type == 'student') {
            $this->db->where('user_type', "student");
        }
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

    function ClassStudents($classid) {
//        $this->db->where('status', '1');
        $this->db->where('class_id', $classid);
        $this->db->where('user_type', "student");
        $this->db->order_by('name asc');
        $query = $this->db->get('school_user');
        $userData = $query->result();
        return $userData;
    }

    function getClassStudents_get($classid) {
        $this->config->load('rest', TRUE);
        $userData = $this->ClassStudents($classid);
        $this->response($userData);
    }

    //set child to parent
    function getChildToParent_get($parent_id) {
        $this->config->load('rest', TRUE);
        $this->db->where('parent_id', $parent_id);
        $this->db->where('user_type', "student");
        $this->db->order_by('name asc');
        $query = $this->db->get('school_user');
        $userData = $query->result();
        $userDataF = array();
        foreach ($userData as $key => $value) {
            $userDataF[$value->userid] = $value;
        }
        $this->response($userDataF);
    }

    function setChildToParent_post() {
        $this->config->load('rest', TRUE);
        $parent_id = $this->post('parent_id');
        $child_id = $this->post('child_id');
        $this->db->set('parent_id', $parent_id);
        $this->db->where('userid', $child_id); //set column_name and value in which row need to update
        $this->db->update("school_user");
        $this->response(array("status" => "1"));
    }

    function unsetChildToParent_post() {
        $this->config->load('rest', TRUE);
        $parent_id = $this->post('parent_id');
        $child_id = $this->post('child_id');
        $this->db->set('parent_id', "");
        $this->db->where('userid', $child_id); //set column_name and value in which row need to update
        $this->db->update("school_user");
        $this->response(array("status" => "1"));
    }

    //Leave Request Functrions  
    function setLeaveRequest_post() {
        $this->config->load('rest', TRUE);
        $lrdata = array(
            "from_date" => $this->post('from_date'),
            "to_date" => $this->post('to_date'),
            "reason" => $this->post('reason'),
            "parent_id" => $this->post('parent_id'),
            "student_id" => $this->post('selectChild'),
            "class_id" => $this->post('class_id'),
            "status" => "0",
            "datetime" => date("Y-m-d H:i:s a"),
        );
        $this->db->insert('student_leave_request', $lrdata);
        $this->response(array("status" => "1"));
    }

    function getLeaveRequestByClass_get($classid) {
        $this->config->load('rest', TRUE);
        $this->db->select('slr.*, su.name, su.class_id, su.class, su.section, su.gender');
//        $this->db->where('slr.status', '0');
        $this->db->where('slr.class_id', $classid);
        $this->db->order_by('slr.id desc');
        $this->db->from('student_leave_request as slr');
        $this->db->join('school_user as su', 'su.userid = slr.student_id', 'LEFT');
        $query = $this->db->get();
        $userData = $query->result_array();
        $this->response($userData);
    }

    function getLeaveRequestByParent_get($parentid) {
        $this->config->load('rest', TRUE);
        $this->db->select('slr.*, su.name, su.class_id, su.class, su.section, su.gender');
        //        $this->db->where('status', '1');
        $this->db->where('slr.parent_id', $parentid);
        $this->db->order_by('slr.id desc');
        $this->db->from('student_leave_request as slr');
        $this->db->join('school_user as su', 'su.userid = slr.student_id', 'LEFT');
        $query = $this->db->get();
        $userData = $query->result_array();
        $this->response($userData);
    }

    function updateLeaveRequest_post() {
        $this->config->load('rest', TRUE);
        $teacher_id = $this->post('user_id');
        $lrid = $this->post('lrid');
        $this->db->set('status', "1");
        $this->db->set('approve_by', $teacher_id);
        $this->db->where('id', $lrid); //set column_name and value in which row need to update
        $this->db->update("student_leave_request");
        $this->response(array("status" => "1"));
    }

    function removeLeaveRequest_post() {
        $this->config->load('rest', TRUE);
        $lrid = $this->post('lrid');
        $this->db->where('id', $lrid); //set column_name and value in which row need to update
        $this->db->delete("student_leave_request");
        $this->response(array("status" => "1"));
    }

    //attendance function
    function getAttendanceByDate($class_id, $date) {
        $this->db->where('class_id', $class_id);
        $this->db->where('at_date', $date);
        $query = $this->db->get('student_attendance');
        $attendata = $query->result_array();
        $attenArray = array();
        foreach ($attendata as $key => $value) {
            $attenArray[$value['student_id']] = $value;
        }
        return $attenArray;
    }

    function getClassStudentsAttendance_get($classid) {
        $this->config->load('rest', TRUE);
        $userData = $this->ClassStudents($classid);
        $datetoday = date("Y-m-d");
        $attendanceArray = $this->getAttendanceByDate($classid, $datetoday);

        $studentdata = [];
        foreach ($userData as $key => $value) {
            if (isset($attendanceArray[$value->userid])) {
                $atnobj = $attendanceArray[$value->userid];
                $value->attendance = $atnobj['status'];
            } else {
                $value->attendance = "P";
            }

            array_push($studentdata, $value);
        }
       
        $this->response($studentdata);
    }

    function classAttendanceTake_post() {
        $this->config->load('rest', TRUE);
        $class_id = $this->post("class_id");
        $class = $this->post("class");
        $section = $this->post("section");
        $taken_by = $this->post("taken_by");
        $students = $this->post("students");
        $studetn_array = explode(",", $students);
        $datetoday = date("Y-m-d");
        $attendanceArray = $this->getAttendanceByDate($class_id, $datetoday);
        foreach ($studetn_array as $key => $value) {
            
            $states_student = explode("_", $value);
            $ids = isset($attendanceArray[ $states_student[1]])? $attendanceArray[ $states_student[1]]['id']:0;
            $indertArray = array(
                "id"=>$ids,
                "class" => $class,
                "class_id" => $class_id,
                "student_id" => $states_student[1],
                "datetime" => date("Y-m-d H:i:s a"),
                "at_date" => $datetoday,
                "status" => $states_student[0],
                "section" => $section,
                "taken_by" => $taken_by,
            );
            
            $this->db->replace('student_attendance', $indertArray);
        }


        $this->response(array("status" => "1"));
    }

}

?>