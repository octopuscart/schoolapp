<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RequestData extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $session_user = $this->session->userdata('logged_in');
        $this->session_user = $session_user;
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    function classAssignmentData() {
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $data["title"] = "Class Assignments";
        $daterange = $date1 . " to " . $date2;
        $data["tablename"] = "class_assignment";
        $data["fileicon"] = "assignment.svg";
        $data["showclass"] = 1;
        $data["geturl"] = site_url("LocalApi/classData");
        $data['daterange'] = $daterange;
        $this->load->view('requestData/list', $data);
    }

    function classNoticeData() {
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $data["title"] = "Class Notice";
        $daterange = $date1 . " to " . $date2;
        $data["tablename"] = "class_notice";
        $data["fileicon"] = "classnotice.svg";
        $data["showclass"] = 1;
        $data["geturl"] = site_url("LocalApi/classData");
        $data['daterange'] = $daterange;
        $this->load->view('requestData/list', $data);
    }

    function classNoteData() {
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $daterange = $date1 . " to " . $date2;
        $data["title"] = "Class Notes";
        $data["tablename"] = "class_notes";
        $data["fileicon"] = "classnotice.svg";
        $data["showclass"] = 1;
        $data["geturl"] = site_url("LocalApi/classData");
        $data['daterange'] = $daterange;
        $this->load->view('requestData/list', $data);
    }

}

?>