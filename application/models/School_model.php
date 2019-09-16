<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class School_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function ClassListData() {
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
        return $classData;
    }

    //
    //
    //Class Assignment, class_notice, class_note data list accroding to user id
    function classDataByUserId($tablename, $status, $userid = "") {
        if ($status == '0') {
            $this->db->where('status', '0');
        }
        if ($status == '1') {
            $this->db->where('status', '1');
        }
        if ($userid != "") {
            $this->db->where('user_id', $userid);
        }
        $this->db->order_by('id desc');
        $query = $this->db->get($tablename);
        $classnoteData = $query->result();
        return $classnoteData;
    }

    //
    //
    //Class Assignment, class_notice, class_note data list accroding to class id
    function classDataByClassId($tablename, $status, $class_id = "") {
        if ($status == 'all') {
            
        }
        if ($status == '0') {
            $this->db->where('status', '0');
        }
        if ($status == '1') {
            $this->db->where('status', '1');
        }

        if ($class_id) {
            $this->db->where('class_id', $class_id);
        }


        $this->db->order_by('id desc');
        $query = $this->db->get($tablename);
        $classnoteData = $query->result();
        return $classnoteData;
    }

    //
    //
    //school circular list
    function circularData($usertype = "") {
        //        $this->db->where('status', '1');
        if ($usertype) {
            $this->db->where('user_type', $usertype);
        }
        $this->db->order_by('id desc');
        $query = $this->db->get('school_circular');
        $circularData = $query->result();
        return $circularData;
    }

    //
    //
    //school news data
    function newsData() {
        $this->db->order_by('id desc');
        $query = $this->db->get('school_news');
        $newsData = $query->result();
        return $newsData;
    }

    //
    //
    //Album function
    function galleryAlbum() {
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
        $gallaryData = [];
        for ($i = 0; $i < 15; $i++) {
            array_push($gallaryData, $tempdata);
        }
        return $gallaryData;
    }

    //
    //
    //Gallary by album id
    function GalleryAlbumById($albumid) {
        $tempdata = array(
            "title" => "Test Album",
            "description" => "Description Of Test News.",
            "main_image" => base_url() . "assets/gallary/" . "1.jpg",
            "images1" => [
                array("img" => base_url() . "assets/gallary/" . "1.jpg", "index" => 0),
                array("img" => base_url() . "assets/gallary/" . "2.jpg", "index" => 1),
                array("img" => base_url() . "assets/gallary/" . "3.jpg", "index" => 2),
                array("img" => base_url() . "assets/gallary/" . "4.jpg", "index" => 3),
            ],
            "images2" => [
                array("img" => base_url() . "assets/gallary/" . "5.jpg", "index" => 4),
                array("img" => base_url() . "assets/gallary/" . "6.jpg", "index" => 5),
                array("img" => base_url() . "assets/gallary/" . "7.jpg", "index" => 6),
                array("img" => base_url() . "assets/gallary/" . "8.jpg", "index" => 7),
            ],
            "datetime" => date("Y-m-d H:i:s a"),
        );
        return $tempdata;
    }

    //
    //
    //User data from Id
    function userDataFromId($user_id, $user_type = "") {
        if ($user_type == 'student') {
            $this->db->where('user_type', "student");
        }
        $this->db->where('userid', $user_id);
        $this->db->order_by('name asc');
        $query = $this->db->get('school_user');
        $userData = $query->row();
        return $userData;
    }

    //
    //
    //Student List By Class Id
    function classStudents($classid) {
//        $this->db->where('status', '1');
        $this->db->where('class_id', $classid);
        $this->db->where('user_type', "student");
        $this->db->order_by('name asc');
        $query = $this->db->get('school_user');
        $userData = $query->result();
        return $userData;
    }

    //
    //
    //Get Children by parent id
    function childToParent($parent_id) {
        $this->db->where('parent_id', $parent_id);
        $this->db->where('user_type', "student");
        $this->db->order_by('name asc');
        $query = $this->db->get('school_user');
        $userData = $query->result();
        $userDataF = array();
        foreach ($userData as $key => $value) {
            $userDataF[$value->userid] = $value;
        }
        return $userDataF;
    }

    //end of child to parent
    //
    //Leave request function 
    function leaveRequestData($rltype, $typeid) {
        $this->db->select('slr.*, su.name, su.class_id, su.class, su.section, su.gender');
//        $this->db->where('slr.status', '0');
        if ($rltype == 'all') {
            
        }
        if ($rltype == 'class') {
            $this->db->where('slr.class_id', $typeid);
        }
        if ($rltype == 'parent') {
            $this->db->where('slr.parent_id', $typeid);
        }
        $this->db->order_by('slr.id desc');
        $this->db->from('student_leave_request as slr');
        $this->db->join('school_user as su', 'su.userid = slr.student_id', 'LEFT');
        $query = $this->db->get();
        $userLeaveData = $query->result_array();
        return $userLeaveData;
    }

    //end fo leave request function
    //
    //
    //
    //Attendance Controller 
    function attendanceByDate($class_id, $date) {
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

    //
    //
    //class student attendance
    function classStudentsAttendance($classid, $cdate, $default_status = "P") {
        $userData = $this->classStudents($classid);
        $attendancestatus = "0";
        $attendanceArray = $this->attendanceByDate($classid, $cdate);
        if ($attendanceArray) {
            $attendancestatus = "1";
        }
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
        return array("students" => $studentdata, "attendancestatus" => $attendancestatus);
    }

    //get attendance by student id
    function attendanceByStudent($student_id) {
        $this->db->where('student_id', $student_id);
//        $this->db->where('at_date', $date); //Here sould be year wise attandance
        $query = $this->db->get('student_attendance');
        $attendata = $query->result_array();
        return $attendata;
    }

    //
    //
    //
    //Get Message Data
    function messageConversation($userid) {
        $this->db->where('reply_id', "0");
        $this->db->where('user_id', $userid);
        $this->db->order_by('id desc');
        $query = $this->db->get('school_message');
        $MessageData = $query->result();
        $messageListData = [];
        foreach ($MessageData as $key => $value) {
            $this->db->where('reply_id', $value->id);
            $this->db->order_by('id desc');
            $query = $this->db->get('school_message');
            $replyData = $query->result();
            $value->replydata = $replyData;
        }
        return $MessageData;
    }

    function collectClassDataUsers() {
        try {
            
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function getRegIdById($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('gcm_registration');
        return $regarray = $query->row();
    }

    function sendNotificationToClassData($post_id, $tablename) {
        $this->db->where('id', $post_id);
        $this->db->order_by('id desc');
        $query = $this->db->get($tablename);
        $classData = $query->row();
        $class_id = $classData->class_id;
        $students = $this->classStudents($class_id);
        $collectuserids = [];
        foreach ($students as $key => $value) {
            $regids = $this->getRegIdById($value->userid);
            if ($regids) {
                array_push($collectuserids, $regids->reg_id);
            }
            if ($value->parent_id) {
                $regids2 = $this->getRegIdById($value->parent_id);
                if ($regids2) {
                    array_push($collectuserids, $regids2->reg_id);
                }
            }
        }
        $titleArray = array("class_assignment" => "Assignment", "class_notice" => "Class Notice", "class_notes" => "Study Note");

        $title = isset($titleArray[$tablename]) ? "New " . $titleArray[$tablename] . " Received" : "Notification From School";
        $messageData = array('title' => $title, "message" => $classData->title);
        return array("regids" => $collectuserids, "message" => $messageData);
    }

}

?>