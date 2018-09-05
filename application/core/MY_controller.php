<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->checkSession();
        $this->checkEmployeePermission();
    }

    public function checkSession() {//redirect to login page if no session
        if(($this->uri->uri_string() != 'login/index') && empty($_SESSION['username'])) {
            redirect(base_url("login"));
        }
    }

    public function loadView($view, $data) {
        $header_data         = array();
        $data["page"]        = $this->router->fetch_class();
        $header_data["page_data"]   = $this->getPageData($data["page"]);
        $header_data["page"] = $data["page"];

        $this->load->view("templates/header", $header_data);
        $this->load->view($view, $data);
        $this->load->view("templates/footer");
    }

    public function getPageData($page) {
        $result = array();

        if($page == 'evaluation') {
            $result["js"]  = array('evaluation.js');
            $result["css"] = array('evaluation.css');
        }

        if($page == 'employee') {
            $result["js"]  = array('employee.js');
            $result["css"] = array('employee.css');
        }

        if($page == 'dashboard') {
            $result["js"]  = array('dashboard.js');
            $result["css"] = array('dashboard.css');
        }

        return $result;
    }

    public function checkEmployeePermission() {
        $controller = "";
        $this->router->fetch_class();
    }

    public function checkuserPermission($permission) {
        if(!empty($permission)) {
            $permitted = checkPermission($permission);

            if(!$permitted) {
                redirect(base_url("dashboard"));
            }
        } else {
            redirect(base_url("dashboard"));
        }
    }
}