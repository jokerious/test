<?php

class evaluation_model extends CI_Model {
    public function getEmployeeByDepartment($department) {
        $result = array();

        if(!empty($department)) {
            $sql = "SELECT
                        employee_id,
                        last_name,
                        first_name,
                        middle_name,
                        (SELECT field_value
                         FROM employment_information
                         WHERE field_name = 'type'
                         AND employee_id = employee.employee_id
                         ORDER BY empinfo_id DESC
                         LIMIT 1
                        ) as employee_type
                    FROM employee
                    WHERE employee_id IN(SELECT
                                            employee_id
                                         FROM employment_information
                                         WHERE field_name = 'department'
                                         AND field_value = {$department}
                                        )
                    AND employee.deleted = 0
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function insertEvaluationData($data) {
        $result = 0;

        if(!empty($data)) {
            $this->db->insert_batch('evaluation_list', $data);

            $result = $this->db->insert_id();
        }

        return $result;
    }

    public function getEvaluationList($group = "", $filter_id = 0, $filter_status = "") {
        $result            = array();
        $result["data"]    = array();
        $result["emp_ids"] = array();
        $where             = $this->getEvaluationWhere($group, $filter_id, $filter_status);

        $sql = "SELECT
                    id,
                    department,
                    evaluator,
                    evaluated,
                    status,
                    expiry_date,
                    evaluation_type,
                    (SELECT CONCAT(last_name, ', ', first_name)
                     FROM employee
                     WHERE employee_id = evaluation_list.evaluated
                    ) as evaluated_name,
                    (SELECT
                        SUM(rating_value) as score
                    FROM evaluation_result
                    INNER JOIN evaluation
                    ON evaluation.evaluation_id = evaluation_result.evaluation_id
                    WHERE evaluation_list_id = evaluation_list.id
                    AND deleted = 0
                    AND evaluation_result.evaluation_list_id = evaluation_list.id
                    ) as score
                FROM evaluation_list
                WHERE evaluation_list.deleted = 0
                " . $where . "
                ORDER By evaluated_name
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            foreach($exe as $key => $val) {
                $val["status_words"] = "Ongoing";

                if($val["status"] == 0 && (isset($val["expiry_date"]) && date("Y-m-d") > $val["expiry_date"])) {
                    $val["status_words"] = "Expired";
                }

                if($val["status"] == 1) {
                    $val["status_words"] = "Done";
                }

                $result["data"][$val["department"]][$val["evaluated"]][] = $val;

                $result["emp_ids"][] = $val["evaluated"];
                $result["emp_ids"][] = $val["evaluator"];
            }
        }

        return $result;
    }

    public function getEmployeeNames($emp_ids) {
        $result = array();

        if(!empty($emp_ids)) {
            $employee_ids = implode(", ", array_unique($emp_ids));

            $sql = "SELECT
                        employee_id,
                        CONCAT(last_name, ', ', first_name) as name
                    FROM employee
                    WHERE employee_id IN(" . $employee_ids . ")
                    ORDER BY name ASC
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = array_column($exe, "name", "employee_id");
            }
        }

        return $result;
    }

    public function getAllEmployeeNames() {
        $result = array();

        $sql = "SELECT
                    employee_id,
                    CONCAT(last_name, ', ', first_name) as name
                FROM employee
                INNER JOIN users
                ON employee.employee_id = users.user_id
                WHERE users.deleted = 0
                AND employee.deleted = 0
                AND type != 'administrator'
                ORDER BY name ASC
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            $result = array_column($exe, "name", "employee_id");
        }

        return $result;
    }

    public function getPositions() {
        $result = array();

        $sql = "SELECT * FROM positions
                WHERE deleted = 0
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            foreach($exe as $key => $value) {
                $result[$value["position_id"]] = $value;
            }
        }

        return $result;
    }

    public function getEmployeeEvalutions($employee_id) {
        $result             = array();
        $result["on_going"] = array();
        $result["finished"] = array();
        $result["expired"]  = array();
        $current_date       = date("Y-m-d");

        if(!empty($employee_id)) {
            $sql = "SELECT
                        evaluation_list.id as evaluation_list_id,
                        department,
                        evaluator,
                        evaluated,
                        status,
                        expiry_date,
                        CONCAT(last_name, ', ', first_name) as evaluator_name,
                        (SELECT CONCAT(last_name, ', ', first_name)
                         FROM employee
                         WHERE employee.employee_id = evaluation_list.evaluated
                        ) as evaluated_name,
                        (SELECT field_value
                         FROM employment_information
                         WHERE employment_information.employee_id = evaluation_list.evaluated
                         AND field_name = 'position'
                         ORDER BY empinfo_id DESC
                         LIMIT 1
                        ) as evaluated_position,
                        (SELECT
                            SUM(rating_value) as score
                        FROM evaluation_result
                        INNER JOIN evaluation
                        ON evaluation.evaluation_id = evaluation_result.evaluation_id
                        WHERE evaluation_list_id = evaluation_list.id
                        AND deleted = 0
                        AND evaluation_result.evaluation_list_id = evaluation_list.id
                        ) as score
                    FROM evaluation_list
                    INNER JOIN employee
                    ON employee.employee_id = evaluation_list.evaluator
                    WHERE evaluator = {$employee_id}
                    AND evaluation_list.deleted = 0
                    ORDER BY evaluated_name ASC
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                foreach($exe as $key => $value) {
                    if($value["status"] == 1) {
                        $result["finished"][] = $value;
                    } elseif($value["status"] == 0 && !empty($value["expiry_date"]) && strtotime($value["expiry_date"]) < strtotime($current_date)) {
                        $result["expired"][] = $value;
                    } else {
                        $result["on_going"][] = $value;
                    }
                }
            }
        }

        return $result;
    }

    public function getEvaluationDetail($evaluation_id) {
        $result = array();

        if(!empty($evaluation_id)) {
            $sql = "SELECT
                        evaluation_list.id as evaluation_list_id,
                        department,
                        evaluator,
                        evaluated,
                        status,
                        expiry_date,
                        CONCAT(last_name, ', ', first_name) as evaluator_name,
                        (SELECT CONCAT(last_name, ', ', first_name)
                         FROM employee
                         WHERE employee.employee_id = evaluation_list.evaluated
                        ) as evaluated_name,
                        (SELECT field_value
                         FROM employment_information
                         WHERE employment_information.employee_id = evaluation_list.evaluated
                         AND field_name = 'position'
                         ORDER BY empinfo_id DESC
                         LIMIT 1
                        ) as evaluated_position
                    FROM evaluation_list
                    INNER JOIN employee
                    ON employee.employee_id = evaluation_list.evaluator
                    WHERE evaluation_list.id = {$evaluation_id}
                    AND evaluation_list.deleted = 0
                    ORDER BY evaluated_name ASC
                   ";

            $exe = $this->db->query($sql)->row_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function getEvaluationAttribute() {
        $result = array();

        $sql = "SELECT * FROM evaluation_attribute
                ORDER BY attr_id
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            foreach($exe as $key => $value) {
                $result[$value["attr_id"]] = $value;
            }
        }

        return $result;
    }

    public function getEvaluationData($attributes) {
        $result = array();

        if(!empty($attributes)) {
            $sql = "SELECT * FROM evaluation
                    WHERE attribute_id IN(" . implode(",", $attributes) .")
                    ORDER BY attribute_id ASC, position ASC
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                foreach($exe as $key => $value) {
                    $result[$value['attribute_id']][$value['evaluation_id']] = $value;
                }
            }
        }

        return $result;
    }

    public function getEvaluationResult($emp_evaluation) {
        $result = array();

        if(!empty($emp_evaluation)) {
            $sql = "SELECT
                        evaluation_id,
                        attribute_id,
                        rating,
                        rating_value
                    FROM evaluation
                    WHERE evaluation_id IN(" . implode(", ", $emp_evaluation) . ")
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function prepareEvaluationResult($evaluation_result, $evaluation_list_id, $comments, $recommendations) {
        $result = array();

        if(!empty($evaluation_result) && !empty($evaluation_list_id)) {
            foreach($evaluation_result as $key => $value) {
                $result[] = array(
                                "evaluation_list_id"        => $evaluation_list_id,
                                "evaluation_id"             => $value["evaluation_id"],
                                "evaluator_comments"        => (isset($comments[$value["attribute_id"]])) ? $comments[$value["attribute_id"]] : null,
                                "evaluator_recommendations" => (isset($recommendations[$value["attribute_id"]])) ? $recommendations[$value["attribute_id"]] : null
                            );
            }
        }

        return $result;
    }

    public function inserEvaluationResult($data) {
        $result = 0;

        if(!empty($data)) {
            $this->db->insert_batch('evaluation_result', $data);

            $result = $this->db->insert_id();
        }

        return $result;
    }

    public function removePreviousEvaluationResult($evaluation_list_id) {
        if(!empty($evaluation_list_id)) {
            $sql = "UPDATE evaluation_result
                    SET deleted = 1
                    WHERE evaluation_list_id = {$evaluation_list_id}
                   ";

            $exe = $this->db->query($sql);
        }
    }

    public function evaluationUpdateStatus($evaluation_list_id, $insert_evaluation) {
        if(!empty($evaluation_list_id) && !empty($insert_evaluation)) {
            $sql = "UPDATE evaluation_list
                    SET status = 1
                    WHERE id = {$evaluation_list_id}
                   ";

            $this->db->query($sql);
        }
    }

    public function getEmployeeEvaluationResult($evaluation_list_id) {
        $result = array();

        if(!empty($evaluation_list_id)) {
            $sql = "SELECT *
                    FROM evaluation_attribute
                    INNER JOIN evaluation
                    ON evaluation.attribute_id = evaluation_attribute.attr_id
                    INNER JOIN evaluation_result
                    ON evaluation_result.evaluation_id = evaluation.evaluation_id
                    WHERE evaluation_result.evaluation_list_id = {$evaluation_list_id}
                    AND evaluation_result.deleted = 0
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function getEvaluationWhere($group, $filter_id, $filter_status) {
        $result = "";

        if(!empty($group) && !empty($filter_id)) {
            if($group == "By Department") {
                $result .= " AND department = {$filter_id}";
            } else {
                $result .= " AND evaluation_list.evaluated = {$filter_id}";
            }
        }

        if(!empty($filter_status)) {
            if($filter_status == "Done") {
                $result .= " AND status = 1";
            }

            if($filter_status == "Ongoing") {
                $result .= " AND status = 0 AND (expiry_date > '" . date("Y-m-d") . "' OR expiry_date IS NULL)";
            }

            if($filter_status == "Expired") {
                $result .= " AND status = 0 AND expiry_date < '" . date("Y-m-d") . "'";
            }
        }

        return $result;
    }

    public function prepareCommentRecommendations($comments) {
        $result = array();

        if(!empty($comments)) {
            foreach($comments as $key => $value) {
                foreach($value as $attr_id => $text) {
                    $result[$attr_id] = $text;
                }
            }
        }

        return $result;
    }
}