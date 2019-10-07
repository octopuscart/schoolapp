<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class MobileApi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->API_ACCESS_KEY = 'AIzaSyCigBYf5TOMGcIjdYY7UISRq9xlinki9hM';
        // (iOS) Private key's passphrase.
        $this->passphrase = 'joashp';
        // (Windows Phone 8) The name of our push channel.
        $this->channelName = "joashp";
    }

    private function useCurl($url, $headers, $fields = null) {
        // Open connection
        $ch = curl_init();
        if ($url) {
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            if ($fields) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            }

            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);

            return $result;
        }
    }

    public function android($data, $reg_id_array) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $message = array(
            'title' => $data['title'],
            'message' => $data['message'],
            'subtitle' => '',
            'tickerText' => '',
            'msgcnt' => 1,
            'vibrate' => 1
        );

        $headers = array(
            'Authorization: key=' . $this->API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $fields = array(
            'registration_ids' => $reg_id_array,
            'data' => $message,
        );

        return $this->useCurl($url, $headers, json_encode($fields));
    }

    public function iOS($data, $devicetoken) {
        $deviceToken = $devicetoken;
        $ctx = stream_context_create();
        // ck.pem is your certificate file
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $this->passphrase);
        // Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $err,
                $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        // Create the payload body
        $body['aps'] = array(
            'alert' => array(
                'title' => $data['mtitle'],
                'body' => $data['mdesc'],
            ),
            'sound' => 'default'
        );
        // Encode the payload as JSON
        $payload = json_encode($body);
        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        // Close the connection to the server
        fclose($fp);
        if (!$result)
            return 'Message not delivered' . PHP_EOL;
        else
            return 'Message successfully delivered' . PHP_EOL;
    }

    function testGet_get() {
        print_r($this->checklogin['user_type']);
    }

    function getClassData_get() {
        $this->config->load('rest', TRUE);
        $classData = $this->School_model->ClassListData();
        $this->response($classData);
    }

    function deleteTableData_post() {
        $this->config->load('rest', TRUE);
        $tablename = $this->post('tablename');
        $id = $this->post('id');
        $this->db->where('id', $id); //set column_name and value in which row need to update
        $this->db->delete($tablename);
        $this->response(array("status" => "1"));
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

    function uploadFile2_post() {
        $config['upload_path'] = 'assets/schoolfiles';
        $config['allowed_types'] = '*';
        $tableid = $this->post('file_table_id');
        $tempfilename = rand(10000, 1000000);
        $tempfilename = "" . $tempfilename . $tableid;
       
        $file_newname = $tempfilename . '.jpg';
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
            print_r($filecreate);
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
        $classnoteData = $this->School_model->classDataByClassId("class_notes", "1", $class_id);
        $this->response($classnoteData);
    }

    function getClassNoteData_get($userid) {
        $this->config->load('rest', TRUE);
        $classnoteData = $this->School_model->classDataByUserId("class_notes", "all", $userid);
        $this->response($classnoteData);
    }

    // End of Class Note functions
    // 
    // 
    // 
    //Assignment Functions
    function getAssignmentDataByClass_get($class_id) {
        $this->config->load('rest', TRUE);
        $assignmentData = $this->School_model->classDataByClassId("class_assignment", "1", $class_id);
        $this->response($assignmentData);
    }

    function getAssignmentData_get($userid) {
        $this->config->load('rest', TRUE);
        $assignmentData = $this->School_model->classDataByUserId("class_assignment", "all", $userid);
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
    //
    //Class notice functions
    function getClassNoticeData_get($userid) {
        $this->config->load('rest', TRUE);
        $assignmentData = $this->School_model->classDataByUserId("class_notice", "all", $userid);
        $this->response($assignmentData);
    }

    function getClassNoticeDataByClass_get($class_id) {
        $this->config->load('rest', TRUE);
        $assignmentData = $this->School_model->classDataByClassId("class_notice", "1", $class_id);
        $this->response($assignmentData);
    }

    function classNotice_post() {
        $this->config->load('rest', TRUE);
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

    //end of class notice data
    //
    //
    //circular data
    function getCircularData_get($usertype) {
        $this->config->load('rest', TRUE);
        $circularData = $this->School_model->circularData($usertype);
        $this->response($circularData);
    }

    //end of circular data
    //
    //
    // news function
    function getNewsData_get() {
        $this->config->load('rest', TRUE);
        $newsData = $this->School_model->newsData();
        $this->response($newsData);
    }

    //end of news  functions
    //
    //
    //gallary controller
    function getGalleryAlbum_get() {
        $this->config->load('rest', TRUE);
        $gallaryData = $this->School_model->galleryAlbum();
        $this->response($gallaryData);
    }

    function getGalleryAlbumById_get($albumid) {
        $this->config->load('rest', TRUE);
        $gallaryimages = $this->School_model->GalleryAlbumById($albumid);
        $this->response($gallaryimages);
    }

    //gallary function end
    //
    //
    // User Data From Id
    function getUserDataFromId_post($user_type = "") {
        $this->config->load('rest', TRUE);
        $user_id = $this->post('user_id');
        $userData = $this->School_model->userDataFromId($user_id, $user_type);
        $returndata = array("status" => "100", "data" => "");
        if ($userData) {
            $returndata["data"] = $userData;
            $returndata["status"] = "200";
        }
        $this->response($returndata);
    }

    //End of user form id
    //
    //
    //
    //Get class studetn by classid
    function getClassStudents_get($classid) {
        $this->config->load('rest', TRUE);
        $userData = $this->School_model->classStudents($classid);
        $this->response($userData);
    }

    //end of class student by class id
    //
    //
    //Parent contooler
    //set child to parent
    function getChildToParent_get($parent_id) {
        $this->config->load('rest', TRUE);
        $childrendata = $this->School_model->childToParent($parent_id);
        $this->response($childrendata);
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

    // end of parent controller 
    //
    //
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
        $userData = $this->School_model->leaveRequestData("class", $classid);
        $this->response($userData);
    }

    function getLeaveRequestByParent_get($parentid) {
        $this->config->load('rest', TRUE);
        $userData = $this->School_model->leaveRequestData("parent", $parentid);
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

    //end of leave request function 
    //
    //
    //attendance function
    function getAttendanceByStudent_get($student_id) {
        $this->config->load('rest', TRUE);
        $attendata = $this->School_model->attendanceByStudent($student_id);
        $this->response($attendata);
    }

    function getClassStudentsAttendance_get($classid) {
        $this->config->load('rest', TRUE);
        $datetoday = date("Y-m-d");
        $attendancestatus = "0";
        $attendanceArray = $this->School_model->classStudentsAttendance($classid, $datetoday, "P");
        $this->response($attendanceArray);
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
        $attendanceArray = $this->School_model->attendanceByDate($class_id, $datetoday);
        foreach ($studetn_array as $key => $value) {
            $states_student = explode("_", $value);
            $ids = isset($attendanceArray[$states_student[1]]) ? $attendanceArray[$states_student[1]]['id'] : 0;
            $indertArray = array(
                "id" => $ids,
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

    //end of attendance function
    //
    //
    // message  data
    function getMessageData_get($userid) {
        $this->config->load('rest', TRUE);
        $MessageData = $this->School_model->messageConversation($userid);
        $this->response($MessageData);
    }

    function message_post() {
        $this->config->load('rest', TRUE);
        $replyid = $this->post('reply_id');
        $replyid = $replyid ? $replyid : "0";
        $messagepost = array(
            'title' => $this->post('title'),
            'description' => $this->post('description'),
            "datetime" => date("Y-m-d H:i:s a"),
            'user_id' => $this->post('user_id'),
            'status' => "0",
            'reply_id' => $replyid,
        );
        $this->db->insert('school_message', $messagepost);
        $last_id = $this->db->insert_id();
        $this->response(array("last_id" => $last_id));
    }

    //end of post message
    //
    //
    //Update user profile 
    function updateProfile_post() {
        $this->config->load('rest', TRUE);
        // $tempfilename = rand(100, 1000000);
        $user_id = $this->post('user_id');
        $profiledata = array(
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'mobile_no' => $this->post('mobile_no'),
        );
        $this->db->set($profiledata);
        $this->db->where('userid', $user_id); //set column_name and value in which row need to update
        $this->db->update("school_user");
        $this->db->where('userid', $user_id);
        $this->db->order_by('name asc');
        $query = $this->db->get('school_user');
        $userData = $query->row();
        $this->response(array("userdata" => $userData));
    }

    function updateUserMobile_post() {
        $this->config->load('rest', TRUE);
        $uuid = $this->post('uuid');
        $profiledata = array(
            'user_id' => $this->post('user_id'),
            'user_type' => $this->post('user_type'),
        );
        $this->db->set($profiledata);
        $this->db->where('uuid', $uuid); //set column_name and value in which row need to update
        $this->db->update("gcm_registration");
    }

    //end of profile post
}

?>