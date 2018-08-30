
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    public function index()
    {
        $user_id                  = $_SESSION["user_id"];
        $data                     = array();
        $data["employee_details"] = $this->employee_model->getEmployeeDetails($user_id);
        $data["employment_info"]  = $this->employee_model->getEmploymentInfo($user_id);
        $departments              = $this->employee_model->getDepartmentList();
        $positions                = $this->employee_model->getPositionList();
        $data["departments"]      = (!empty($departments)) ? array_column($departments, "department_title", "department_id") : array();
        $data["positions"]        = (!empty($positions)) ? array_column($positions, "position_title", "position_id") : array();

        $this->loadView("home", $data);
    }
}
