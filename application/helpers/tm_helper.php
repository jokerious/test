<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('tabNavigation')) {
    function tabNavigation($tab, $current_page) {
        $result = "";

        if($tab == $current_page) {
            $result = "active";
        }

        return $result;
    }
}

if (!function_exists('checkPermission')) {
    function checkPermission($tab = "") {
        $CI          =& get_instance();
        $result      = false;
        $user_type   = $_SESSION["type"];
        $permissions = array();

        if($user_type == "admin" || $user_type == "administrator") {
            $permissions = $CI->login_model->getAdminPermission();
        } elseif($user_type == "head") {
            $permissions = $CI->login_model->getHeadPermission();
        } else {
            $permissions = $CI->login_model->getEmployeePermission();
        }

        if(in_array($tab, $permissions)) {
            $result = true;
        }

        return $result;
    }
}

if (!function_exists('getNavIcon')) {
    function getNavIcon($tab) {
        $result = "";

        if($tab == "dashboard") {
            $result = "fa-tachometer-alt";
        }

        if($tab == "employee") {
            $result = "fa-users";
        }

        if($tab == "evaluation") {
            $result = "fa-balance-scale";
        }

        return $result;
    }
}

if (!function_exists('getNavTitle')) {
    function getNavTitle($tab) {
        $result = "";

        if($tab == "employeeProfile") {
            $result = " <span class='navbar-2'> > Employee Profile</span>";
        }

        if($tab == "myEvaluation") {
            $result = " <span class='navbar-2'> > My Evaluation</span>";
        }

        return $result;
    }
}