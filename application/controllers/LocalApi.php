<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class LocalApi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->API_ACCESS_KEY = 'AIzaSyDRm78bTofkeeczIxj2ktcBRL5JVxs9Usc';
        // (iOS) Private key's passphrase.
        $this->passphrase = 'joashp';
        // (Windows Phone 8) The name of our push channel.
        $this->channelName = "joashp";
        $this->checklogin = $this->session->userdata('logged_in');
        $this->load->model('Order_model');
    }

    function testGet_get() {
        print_r($this->checklogin['user_type']);
    }

    //function for user settingt
    function updateUserSession_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_users", $data);
            if (isset($this->checklogin[$fieldname])) {

                $this->checklogin[$fieldname] = $value;
                $this->session->set_userdata('logged_in', $this->checklogin);
            }
        }
    }

    function updateUserClient_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_users", $data);
        }
    }

    function updateUser() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');

        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_user", $data);
        }
    }

    function updateAppointment_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('appointment_entry');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("aid", $pk_id);
            $this->db->update('appointment_entry', $data);
        }
    }

    function updateAppointmentTime_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('appointment_entry');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update('appointment_entry', $data);
        }
    }

    //function for curd update
    function updateCurd_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('tablename');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($tablename, $data);
        }
    }

    //function for curd update
    function curd_get($table_name) {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($table_name, $data);
        }
    }

    //function for product list
    function deleteCurd_post($table_name) {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($table_name, $data);
        }
    }

    //function for curd update
    function cartUpdate_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $quantity = $this->post('quantity');
        $totalPrice = (intval($quantity) * intval($value));
        if ($this->checklogin) {
            $data = array($fieldname => $value, "total_price" => "$totalPrice");
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("cart");

            $this->db->where('id', $pk_id);
            $query = $this->db->get('cart');
            $cart_items = $query->row();

            $order_details = $this->Order_model->recalculateOrder($cart_items->order_id);
        }
    }

    //function for order update
    function orderUpdate_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("web_order");
        }
    }

    function notificationUpdate_get() {
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('system_log');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function checkUnseenOrder_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', "0");
        $query = $this->db->get('web_order');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function inboxOrderMail_get() {
        $this->Order_model->orderInboxEmail();
        $this->response();
    }

    function inboxOrderMailIndb_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('seen', "0");
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function inboxOrderMaildb_get() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function sendEmailOrderCancle_get($order_key) {
        $this->Order_model->order_mail($order_key);
    }

    //mobile app api
    function inboxOrderMailIndbMobileUnseen_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('seen', "0");
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($systemlog);
    }

    function checkUnseenOrderMobileUnseen_get() {

        $this->db->order_by('id', 'desc');
        $this->db->where('status', "0");
        $query = $this->db->get('web_order');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $this->response($systemlog);
    }

    function inboxOrderMailIndbMobile_get() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $tamparray = [];
        foreach ($systemlog as $key => $value) {
            $emp = $value['from_email'];
            $tmp = explode("<", $emp);
            $name = $tmp[0];
            $emailf = str_replace(">", "", $tmp[1]);
            $value["femail"] = $emailf;
            $value["name"] = $name;
            array_push($tamparray, $value);
        }
        $this->response($tamparray);
    }

    function checkUnseenOrderMobile_get() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('web_order');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($systemlog);
    }

    function checkClientMobile_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('user_type', "");
        $query = $this->db->get('admin_users');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($systemlog);
    }

    function registerMobileGuest_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $reg_id = $this->post('reg_id');
        $model = $this->post('model');
        $manufacturer = $this->post('manufacturer');
        $uuid = $this->post('uuid');
        $regArray = array(
            "reg_id" => $reg_id,
            "manufacturer" => $manufacturer,
            "uuid" => $uuid,
            "model" => $model,
            "user_id" => "",
            "user_type" => "",
            "datetime" => date("Y-m-d H:i:s a")
        );


        $query = $this->db->get('gcm_registration');
        $regarray = $query->result_array();
        if ($regArray) {
            $this->db->set($regArray);
            $this->db->where('uuid', $uuid);
            $this->db->update("gcm_registration");
        } else {
            $this->db->insert('gcm_registration', $regArray);
        }
        $this->response(array("status" => "done"));
    }

    function registerMobileUser_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $reg_id = $this->post('reg_id');
        $model = $this->post('model');
        $manufacturer = $this->post('manufacturer');
        $uuid = $this->post('uuid');
        $regArray = array(
            "reg_id" => $reg_id,
            "manufacturer" => $manufacturer,
            "uuid" => $uuid,
            "model" => $model,
            "user_id" => "Admin",
            "user_type" => "Admin",
            "datetime" => date("Y-m-d H:i:s a")
        );
        $this->db->where('reg_id', $reg_id);
        $query = $this->db->get('gcm_registration');
        $regarray = $query->result_array();
        if ($regArray) {
            
        } else {
            $this->db->insert('gcm_registration', $regArray);
        }
        $this->response(array("status" => "done"));
    }

    function updateOrderStatus_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $order_id = $this->post('order_id');
        $data = array("status" => "1");
        $this->db->set($data);
        $this->db->where("id", $order_id);
        $this->db->update("web_order");

        $order_status_data = array(
            'c_date' => date('Y-m-d'),
            'c_time' => date('H:i:s'),
            'order_id' => $order_id,
            'status' => "Received",
            'user_id' => "Mobile user",
            'remark' => "Order Received From Mobile App",
            "process_by" => "Mobile App",
            "process_user" => "Admin Mobile App",
        );
        $this->db->insert('user_order_status', $order_status_data);

        $this->response(array("status" => "done"));
    }

    function updateEmailStatus_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $email_id = $this->post('email_id');
        $data = array("seen" => "1");
        $this->db->set($data);
        $this->db->where("id", $email_id);
        $this->db->update("web_order_email");
        $this->response(array("status" => "done"));
    }

    // Curl 
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

    function ganarateNotificationForAdmin_get() {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->db->order_by('id', 'desc');
        $this->db->where('seen', "0");
        $query = $this->db->get('web_order_email');
        $emaillist = $query->result_array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', "0");
        $query = $this->db->get('web_order');
        $orderlist = $query->result_array();

        $ordercount = count($orderlist);
        $emailcount = count($emaillist);

        $totalcount = $ordercount + $emailcount;

        $title = "$totalcount Unseen Notifications";
        $message = "";
        $messageo = "";
        $messagem = "";
        if ($ordercount) {
            $messageo = "Total $ordercount Unseen Order(s)";
        }
        if ($emailcount) {
            $messagem = ($messageo ? " and " : "Total ") . "$emailcount Unseen Email(s)";
        }
        $message = $messageo . $messagem;

        $query = $this->db->get('gcm_registration');
        $gcm_registration = $query->result_array();
        $regid = [];
        foreach ($gcm_registration as $key => $value) {
            array_push($regid, $value['reg_id']);
        }
        $data = array('title' => $title, "message" => $message);
        if ($totalcount) {
            $this->android($data, $regid);
        }
    }

    function newOrderNotification_get($orderid) {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->db->where('id', $orderid);
        $query = $this->db->get('web_order');
        $orderdata = $query->row();
        $name = $orderdata->first_name . " " . $orderdata->last_name;
        $email = $orderdata->email;
        $ordersource = $orderdata->order_source;

        $title = "New booking (#$orderid) From $ordersource";
        $message = "Guest:$name, Email:$email";


        $query = $this->db->get('gcm_registration');
        $gcm_registration = $query->result_array();
        $regid = [];
        foreach ($gcm_registration as $key => $value) {
            array_push($regid, $value['reg_id']);
        }
        $data = array('title' => $title, "message" => $message);
        $this->android($data, $regid);
    }

    //school function 
    //
    //
    //

    function classData_get($tablename) {
        $this->config->load('rest', TRUE);
        $assignmentData = $this->School_model->classDataByClassId($tablename, "0", "");
        foreach ($assignmentData as $key => $value) {
            $teacherid = $value->user_id;
            $value->teacherdata = $this->School_model->userDataFromId($teacherid);
        }
        $this->response($assignmentData);
    }

    function classData_post() {
        $this->config->load('rest', TRUE);
        $post_id = $this->post('post_id');
        $tablename = $this->post('table_name');
        $data = array("status" => "1");
        $this->db->set($data);
        $this->db->where("id", $post_id);
        $this->db->update($tablename);
        $this->School_model->sendNotificationToClassData($post_id, $tablename);
        $this->response(array("status" => "done"));
    }

    function classDataDelete_post() {
        $this->config->load('rest', TRUE);
        $post_id = $this->post('post_id');
        $tablename = $this->post('table_name');
        $this->db->where("id", $post_id);
        $this->db->delete($tablename);
        $this->response(array("status" => "done"));
    }

}

?>