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

    function getCircularData_get() {
        $tempdata = array(
            "title" => "Test Circular ",
            "description" => "Test Circular From Admin Panel. Test Circular From Admin Panel.",
            "file" => "testfile.pdf",
            "datetime" => date("Y-m-d H:i:s a"),
            "circular_type" => "Student"
        );
        $circularData = [];
        for ($i = 0; $i < 15; $i++) {
            array_push($circularData, $tempdata);
        }
        $this->response($circularData);
    }
    
    
    function getClassNoteData_get() {
        $tempdata = array(
            "title" => "Test Circular ",
            "description" => "Test Circular From Admin Panel. Test Circular From Admin Panel.",
            "file" => "testfile.pdf",
            "datetime" => date("Y-m-d H:i:s a"),
            "circular_type" => "Student"
        );
        $circularData = [];
        for ($i = 0; $i < 15; $i++) {
            array_push($circularData, $tempdata);
        }
        $this->response($circularData);
    }
    

    function getAssignmentData_get() {
        $tempdata = array(
            "title" => "Test Assignment ",
            "description" => "Test Assignment From Admin Panel. Test Assignment From Admin Panel. Test Assignment From Admin Panel. Test Assignment From Admin Panel. Test Assignment From Admin Panel. Test Assignment From Admin Panel. Test Assignment From Admin Panel. Test Assignment From Admin Panel.",
            "file" => "testfile.pdf",
            "datetime" => date("Y-m-d H:i:s a"),
            "class_id" => "1",
            "class" => "1st",
            "section" => "B"
        );
        $assignmentData = [];
        for ($i = 0; $i < 15; $i++) {
            array_push($assignmentData, $tempdata);
        }
        $this->response($assignmentData);
    }

    function getClassNoticeData_get() {
        $tempdata = array(
            "title" => "Test Class Notice ",
            "description" => "Test Class Notice From Admin Panel. Test Class Notice From Admin Panel.",
            "file" => "testfile.pdf",
            "datetime" => date("Y-m-d H:i:s a"),
            "class_id" => "1",
            "class" => "1st",
            "section" => "B"
        );
        $classNoticeData = [];
        for ($i = 0; $i < 15; $i++) {
            array_push($classNoticeData, $tempdata);
        }
        $this->response($classNoticeData);
    }

    function getNewsData_get() {
        $tempdata = array(
            "title" => "Test News",
            "description" => "Description Of Test News.",
            "file" => "testfile.pdf",
            "datetime" => date("Y-m-d H:i:s a"),
        );
        $newsData = [];
        for ($i = 0; $i < 15; $i++) {
            array_push($newsData, $tempdata);
        }
        $this->response($newsData);
    }
    
    
    function getGalleryAlbum_get() {
        $tempdata = array(
            "title" => "Test Album",
            "description" => "Description Of Test News.",
            "main_image" => base_url()."assets/profile_image/". "38403410.jpg",
            "stackimage"=>[
                base_url()."assets/profile_image/". "38403410.jpg",
                base_url()."assets/profile_image/". "22541910.jpg",
                base_url()."assets/profile_image/". "41015464.jpg",
                base_url()."assets/profile_image/". "52049510.jpg",
            ],
            "datetime" => date("Y-m-d H:i:s a"),
        );
        $newsData = [];
        for ($i = 0; $i < 15; $i++) {
            array_push($newsData, $tempdata);
        }
        $this->response($newsData);
    }
    

}

?>