<?php

class login_model extends CI_Model {
    public function getUserLoginDetail($username, $password) {
        $result = array();

        if(!empty($username) && !empty($password)) {
            $sql = "SELECT
                        user_id,
                        username,
                        type,
                        employee_id,
                        last_name,
                        first_name,
                        middle_name
                    FROM users
                    INNER JOIN employee
                    ON employee.employee_id = users.user_id
                    WHERE username = '{$username}'
                    AND password = MD5('{$password}')
                   ";

            $exe = $this->db->query($sql)->row_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function createSession($user_data) {

        $this->session->set_userdata($user_data);
    }

    public function getEmployeePermission() {
        $perm = array("dashboard",
                      "evaluation",
                      "evaluation_process",
                      "my_evaluation",
                      "employee_evaluation"
                     );

        return $perm;
    }

    public function getAdminPermission() {
        $perm = array("dashboard",
                      "evaluation",
                      "employee",
                      "evaluation_list",
                      "evaluation_home",
                      "employee_home",
                      "employee_profile"
                     );

        return $perm;
    }

    public function getHeadPermission() {
        $perm = array("dashboard",
                      "evaluation",
                      "evaluation_process",
                      "my_evaluation"
                     );

        return $perm;
    }

}