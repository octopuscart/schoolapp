<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class StudentManager extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function addStudent() {
        $this->db->order_by("id", "desc");
        $this->db->from('admin_users');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['users'] = $query->result();
        } else {
            $data['users'] = [];
        }
        if ($this->user_type != '') {
            redirect('UserManager/not_granted');
        }

        $this->load->view('userManager/usersReport', $data);
    }

}
