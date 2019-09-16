<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->model('Order_model');
        $this->load->library('session');

        //   $apikey = MAILCHIMP_APIKEY;
        //  $apiendpoint = MAILCHIMP_APIENDPOINT;
//
//        $params = array('api_key' => $apikey, 'api_endpoint' => $apiendpoint);
//
//        $this->load->library('mailchimp_library', $params);

        $this->checklogin = $this->session->userdata('logged_in');
        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function index() {
        redirect('/');
    }

    function notifications() {
        if ($this->checklogin) {
            
        } else {
            redirect(site_url("/"));
        }
        $this->load->view('Services/notifications');
    }
    
    function messageInbox(){
        
    }

}

?>
