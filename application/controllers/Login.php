
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		$data = array();

		if(isset($_POST) && !empty($_POST["username"]) && !empty($_POST["password"])) {
			$user = $this->login_model->getUserLoginDetail($_POST["username"], $_POST["password"]);

			if(!empty($user)) {
				$this->login_model->createSession($user);

				redirect(base_url("dashboard"));
			} else {
				$data["error"] = "Invalid Username or Password.";
			}
		}

		$this->load->view('login', $data);
	}

	public function logout() {
		session_destroy();

		redirect(base_url("login"));
	}
}
