
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

    public function updateEmployeePassword() {
        $result            = array();
        $result["error"]   = TRUE;
        $result["message"] = "Error Occured while updating. Please contact system administrator.";

        $current_password  = $_POST["current_password"];
        $new_password      = $_POST["new_password"];
        $confirm_password  = $_POST["confirm_password"];
        $user_id           = $_SESSION["user_id"];

        if(!empty($current_password) && !empty($new_password) && !empty($confirm_password) && !empty($user_id)) {
            if($new_password == $confirm_password) {
                $check_current_password = $this->employee_model->checkUserCurrentPassword($user_id, $current_password);

                if($check_current_password) {
                    $update_password = $this->employee_model->updatePassword($user_id, $new_password);

                    if($update_password) {
                        $result["error"]   = FALSE;
                        $result["message"] = "You Successfully updated your password.";
                    }
                } else {
                    $result["message"] = "The Current Password Entered is Incorrect.";
                }
            } else {
                $result["message"] = "New password and Confirm password mismatched.";
            }
        }

        echo json_encode($result);
    }
}
