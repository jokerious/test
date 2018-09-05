<?php

class employee_model extends CI_Model {
    public function getPositionList() {
        $result = array();

        $sql = "SELECT * FROM positions
                WHERE deleted = 0
                ORDER BY position_title ASC
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            $result = $exe;
        }

        return $result;
    }

    public function getDepartmentList() {
        $result = array();

        $sql = "SELECT * FROM departments
                WHERE deleted = 0
                ORDER BY department_title ASC
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            $result = $exe;
        }

        return $result;
    }

    public function checkRequiredField($data) {
        $result = array("error" => false, "message" => "");

        if(!empty($data)) {
            if(empty($data["first-name"]) && $result["error"] == false) {
                $result = array("error" => true, "message" => "Invalid input of First Name.");
            }

            if(empty($data["middle-name"]) && $result["error"] == false) {
                $result = array("error" => true, "message" => "Invalid input of Middle Name.");
            }

            if(empty($data["last-name"]) && $result["error"] == false) {
                $result = array("error" => true, "message" => "Invalid input of Last Name.");
            }

            if(empty($data["username"]) && $result["error"] == false) {
                $result = array("error" => true, "message" => "Invalid input of Username.");
            }

            if(empty($data["password"]) && $result["error"] == false) {
                $result = array("error" => true, "message" => "Invalid input of Password.");
            }
        } else {
            $result = array("error" => true, "message" => "Please Input required fields.");
        }

        return $result;
    }

    public function checkInput($field_name, $value) {
        $error = false;

        if($field_name == "email_address" || $field_name == "email") { //check if valid email address
            $tmp_email = filter_var($value, FILTER_VALIDATE_EMAIL);

            if($tmp_email <> $value) {
                $error = true;
            }
        }

        if($field_name == "birth_date" || $field_name == "date_hired") {
            $error = $this->checkValidDate($value);
        }

        if($field_name == "salary") {
            $error = !is_numeric($value);
        }

        return $error;
    }

    public function checkValidDate($date) {
        $result = true;

        if(!empty($date)) {
            if(strtotime($date) > 0) {
                $result = false;
            }
        }

        return $result;
    }

    public function getEmployeeInfoFields() {
        return array("user_id",
                     "date_hired",
                     "position",
                     "department",
                     "employment_status",
                     "marital_status",
                     "salary",
                     "position_effectivity_date",
                     "department_effectivity_date",
                     "employment_status_effectivity_date",
                     "marital_status_effectivity_date",
                     "salary_effectivity_date",
                     "level_effectivity_date",
                     "level"
                    );
    }

    public function getUserDataFields() {
        return array("username", "password");
    }

    public function checkUserDuplicate($username) {
        $result = true;

        if(!empty($username)) {
            $sql = "SELECT * FROM users
                    WHERE username = '{$username}'
                    AND deleted = 0
                    LIMIT 1
                   ";

            $exe = $this->db->query($sql)->row_array();

            if(count($exe) == 0) {
                $result = false;
            }
        }

        return $result;
    }

    public function checkEmpDuplicate($last_name, $middle_name, $first_name) {
        $result = true;

        if(!empty($last_name) && !empty($middle_name) && !empty($first_name)) {
            $sql = "SELECT * FROM employee
                    WHERE last_name = '{$last_name}'
                    AND middle_name = '{$middle_name}'
                    AND first_name = '{$first_name}'
                    AND deleted = 0
                    LIMIT 1
                   ";

            $exe = $this->db->query($sql)->row_array();

            if(count($exe) == 0) {
                $result = false;
            }
        }

        return $result;
    }

    public function insertUser($user_data) {
        $result = 0;

        if(!empty($user_data["username"]) && !empty($user_data["password"])) {
            $user_data["password"] = md5($user_data["password"]);

            $this->db->insert('users', $user_data);

            $result = $this->db->insert_id();
        }

        return $result;
    }

    public function insertEmployee($employee_data) {
        $result = 0;

        if(!empty($employee_data)) {
            $this->db->insert('employee', $employee_data);

            $result = $this->db->insert_id();
        }

        return $result;
    }

    public function prepareEmployeeInformation($employment_info, $user_id) {
        $result = array();

        if(!empty($employment_info) && !empty($user_id)) {
            foreach($employment_info as $field => $value) {
                if (strpos($field, '_effectivity_date') === false) {
                    $result[] = array('employee_id'      => $user_id,
                                      'field_name'       => $field,
                                      'field_value'      => $value,
                                      'effectivity_date' => (!empty($employment_info[$field . '_effectivity_date'])) ? date("Y-m-d", strtotime($employment_info[$field . '_effectivity_date'])) : date("Y-m-d")
                                     );
                }
            }
        }

        return $result;
    }

    public function insertEmployeeInformation($employment_info) {
        $result = 0;

        if(!empty($employment_info)) {
            $this->db->insert_batch('employment_information', $employment_info);

            $result = $this->db->insert_id();
        }

        return $result;
    }

    public function getEmployees() {
        $result = array();

        $sql = "SELECT
                    employee_id,
                    username,
                    last_name,
                    first_name,
                    middle_name
                FROM users
                INNER JOIN employee
                ON employee.employee_id = users.user_id
                WHERE users.deleted = 0
                AND employee.deleted = 0
                AND type != 'administrator'
                ORDER BY last_name, first_name ASC
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            $result = $exe;
        }

        return $exe;
    }

    public function getEmployeeDetails($user_id) {
        $result  = array();

        if(!empty($user_id)) {
            $sql = "SELECT * FROM employee
                    INNER JOIN users
                    ON employee.employee_id = users.user_id
                    WHERE employee_id = {$user_id}
                   ";

            $exe = $this->db->query($sql)->row_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function getEmploymentInfo($user_id) {
        $result  = array();
        
        if(!empty($user_id)) {
            $sql = "SELECT
                        empinfo_id,
                        employee_id,
                        field_name,
                        field_value,
                        effectivity_date,
                        date_added
                    FROM employment_information
                    WHERE employee_id = {$user_id}
                    GROUP BY employee_id, field_name
                    ORDER BY empinfo_id DESC
                   ";
            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                foreach ($exe as $key => $value) {
                    $result[$value["field_name"]] = $value["field_value"];
                }
            }
        }

        return $result;
    }

    public function prepareUpdateData($employee_info) {
        $result = array();

        $result["last_name"]           = ucwords($employee_info["last_name"]);
        $result["first_name"]          = ucwords($employee_info["first_name"]);
        $result["middle_name"]         = ucwords($employee_info["middle_name"]);
        $result["birth_date"]          = (!empty($employee_info["birth_date"]) && $employee_info["birth_date"] <> "0000-00-00 00:00:00" && $employee_info["birth_date"] <> null) ?  date("m/d/Y", strtotime($employee_info["birth_date"])) : "";
        $result["gender"]              = $employee_info["gender"];
        $result["address"]             = ucwords($employee_info["address"]);
        $result["phone_number"]        = $employee_info["phone_number"];
        $result["email_address"]       = $employee_info["email_address"];
        $result["bank_account_number"] = $employee_info["bank_account_number"];
        $result["sss_number"]          = $employee_info["sss_number"];
        $result["hdmf_number"]         = $employee_info["hdmf_number"];
        $result["philhealth_number"]   = $employee_info["philhealth_number"];

        return $result;
    }

    public function checkUserCurrentPassword($user_id, $current_password) {
        $result = false;

        if(!empty($user_id) && !empty($current_password)) {
            $sql = "SELECT * FROM users
                    WHERE user_id = {$user_id}
                    AND password = md5('".$current_password."')
                    LIMIT 1
                   ";

            $exe = $this->db->query($sql)->row_array();

            if(count($exe) > 0) {
                $result = true;
            }
        }

        return $result;
    }

    public function updatePassword($user_id, $new_password) {
        $result = false;

        if(!empty($user_id) && !empty($new_password)) {
            $sql = "UPDATE users
                    SET password = md5('".$new_password."')
                    WHERE user_id = {$user_id}
                   ";

            $this->db->query($sql);

            $affected_rows = $this->db->affected_rows();

            if(count($affected_rows) > 0) {
                $result = true;
            }
        }

        return $result;
    }
}