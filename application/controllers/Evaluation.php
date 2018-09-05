
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends MY_Controller {
    public function index() {
        $this->checkuserPermission("evaluation_home");

        $group         = (!empty($_POST["filter-group"])) ? $_POST["filter-group"] : '';
        $filter_id     = (!empty($_POST["sel-filter-user"])) ? $_POST["sel-filter-user"] : '';
        $filter_status = (!empty($_POST["sel-filter-status"])) ? $_POST["sel-filter-status"] : 'All';

        $data["departments"]          = $this->employee_model->getDepartmentList();
        $temp_data                    = $this->evaluation_model->getEvaluationList($group, $filter_id, $filter_status);
        $data["evaluation_list"]      = (!empty($temp_data["data"])) ? $temp_data["data"] : array();
        $data["employee_names"]       = $this->evaluation_model->getAllEmployeeNames();
        $data["department_id"]        = array_column($data["departments"], "department_title", "department_id");
        $data["evaluation_attribute"] = $this->evaluation_model->getEvaluationAttribute();
        $data["sel_group"]            = $group;
        $data["filter_id"]            = $filter_id;
        $data["filter_status"]        = $filter_status;

        $this->loadView("evaluation/evaluation", $data);
    }

    public function getCreateEvaluationData() {
        $result     = array();
        $department = (!empty($_POST["department"])) ? $_POST["department"] : 0;

        if(!empty($department)) {
            $result["employee_list"] = $this->evaluation_model->getEmployeeByDepartment($department);
        }

        echo json_encode($result);
    }

    public function createEvaluation() {
        $result            = array();
        $result["error"]   = false;
        $result["message"] = "";
        
        $dep_head          = (!empty($_POST["dep_head"])) ? $_POST["dep_head"] : array();
        $dep_emp           = (!empty($_POST["dep_emp"])) ? $_POST["dep_emp"] : array();
        $department        = (!empty($_POST["department"])) ? $_POST["department"] : 0;
        $expiry_date       = (!empty($_POST["expiry_date"])) ? (date("Y-m-d", strtotime($_POST["expiry_date"]))) : null;
        $evaluation_type   = (!empty($_POST["evaluation_type"])) ? $_POST["evaluation_type"] : array();

        if(!empty($dep_head) && !empty($dep_emp) && !empty($department) && !empty($evaluation_type)) {
            if($evaluation_type == "Department Head To Employee") {
                $evaluation_data = $this->prepareEmployeeEvaluation($dep_head, $dep_emp, $department, $expiry_date, $evaluation_type);
            } else {
                $evaluation_data = $this->prepareDepHeadEvaluation($dep_head, $dep_emp, $department, $expiry_date, $evaluation_type);
            }

            $evaluation_id = $this->evaluation_model->insertEvaluationData($evaluation_data);

            if($evaluation_id > 0) {
                $result["message"] = "Evaluation Successfully Created.";
            } else {
                $result["error"]   = true;
                $result["message"] = "Error occured while create an evaluation. Please contact system admin.";
            }

        } else {
            $result["error"]   = true;
            $result["message"] = "Error occured while create an evaluation. Please contact system admin.";
        }

        echo json_encode($result);
    }

    private function prepareEmployeeEvaluation($dep_head, $dep_emp, $department, $expiry_date, $evaluation_type) {
        $result  = array();
        $counter = 0;

        foreach($dep_head as $head_key => $head_id) {
            foreach($dep_emp as $emp_key => $emp_id) {
                $result[$counter]["department"]      = $department;
                $result[$counter]["evaluator"]       = $head_id;
                $result[$counter]["evaluated"]       = $emp_id;
                $result[$counter]["expiry_date"]     = $expiry_date;
                $result[$counter]["evaluation_type"] = $evaluation_type;

                $counter++;
            }
        }

        return $result;
    }

    private function prepareDepHeadEvaluation($dep_head, $dep_emp, $department, $expiry_date, $evaluation_type) {
        $result  = array();
        $counter = 0;

        foreach($dep_head as $head_key => $head_id) {
            foreach($dep_emp as $emp_key => $emp_id) {
                $result[$counter]["department"]      = $department;
                $result[$counter]["evaluator"]       = $emp_id;
                $result[$counter]["evaluated"]       = $head_id;
                $result[$counter]["expiry_date"]     = $expiry_date;
                $result[$counter]["evaluation_type"] = $evaluation_type;

                $counter++;
            }
        }

        return $result;
    }

    public function myEvaluation() {
        $this->checkuserPermission("my_evaluation");

        $data["employee_id"]     = $_SESSION["user_id"];
        $data["departments"]     = $this->employee_model->getDepartmentList();
        $data["department_id"]   = array_column($data["departments"], "department_title", "department_id");
        $data["positions"]       = $this->evaluation_model->getPositions();
        $data["evaluations"]     = $this->evaluation_model->getEmployeeEvalutions($data["employee_id"]);

        $this->loadView("evaluation/my_evaluation", $data);
    }

    public function employeeEvaluation() {
        $this->checkuserPermission("employee_evaluation");

        $evaluation_id        = (!empty($_POST["evaluation-id"])) ? $_POST["evaluation-id"] : '';
        $evaluation_attribute = $this->evaluation_model->getEvaluationAttribute();
        $attribute_ids        = array_column($evaluation_attribute, "attr_title", "attr_id");
        $evaluation_data      = $this->evaluation_model->getEvaluationData(array_keys($attribute_ids));

        if(!empty($evaluation_id)) {
            $data["evaluation_attribute"] = $evaluation_attribute;
            $data["evaluation_data"]      = $evaluation_data;
            $data["evaluation_detail"]    = $this->evaluation_model->getEvaluationDetail($evaluation_id);
            $data["evaluation_id"]        = $evaluation_id;

            $this->load->view("evaluation/employee_evaluation", $data);
        }
    }

    public function processEvaluation() {
        $result             = array();
        $result["error"]    = false;
        $result["message"]  = "Evaluation Successfully Submitted.";
        $comments           = (!empty($_POST["comments"])) ? $_POST["comments"] : array();
        $recommendations    = (!empty($_POST["recommendations"])) ? $_POST["recommendations"] : array();
        $emp_evaluation     = (!empty($_POST["evaluation"])) ? $_POST["evaluation"] : array();
        $evaluation_list_id = (!empty($_POST["evaluation_id"])) ? $_POST["evaluation_id"] : 0;
        $insert_evaluation  = 0;

        if(!empty($emp_evaluation) && !empty($evaluation_list_id)) {
            $comments           = $this->evaluation_model->prepareCommentRecommendations($comments);
            $recommendations    = $this->evaluation_model->prepareCommentRecommendations($recommendations);
            $evaluation_result  = $this->evaluation_model->getEvaluationResult($emp_evaluation);
            $evaluation_result  = $this->evaluation_model->prepareEvaluationResult($evaluation_result, $evaluation_list_id, $comments, $recommendations);
            $remove_evaluation  = $this->evaluation_model->removePreviousEvaluationResult($evaluation_list_id); //remove (if exist) evaluation result
            $insert_evaluation  = $this->evaluation_model->inserEvaluationResult($evaluation_result);
            $update_eval_status = $this->evaluation_model->evaluationUpdateStatus($evaluation_list_id, $insert_evaluation);
        }

        if($insert_evaluation == 0) {
            $result["error"] = true;
            $result["message"] = "Error Occured while submitting evaluation.";
        }

        echo json_encode($result);
    }

    public function getEmployeeEvaluationResult() {
        $data               = array();
        $evaluation_list_id = (!empty($_POST["evaluation_list_id"])) ? $_POST["evaluation_list_id"] : 0;

        if(!empty($evaluation_list_id)) {
            $data = $this->evaluation_model->getEmployeeEvaluationResult($evaluation_list_id);
        }

        echo json_encode($data);
    }
}