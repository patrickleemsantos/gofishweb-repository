<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function login() {
		$data['error'] = 0;

		if ($_POST) {
			$this->load->model('account');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('txt_username', 'Username', 'required');
			$this->form_validation->set_rules('txt_password', 'Password', 'required');

			if ($this->form->validation->run() == TRUE) {
				$username = $this->post('txt_username', true);
				$password = $this->post('txt_password', true);
				$account = $this->account->login($username, $lastname);
				if (!$account) {
					$data['error'] = 1;
				} else {
					$this->session->set_userdata('account_id', $account['id']);
					$this->session->set_userdata('first_name', $account['first_name']);
					$this->session->set_userdata('last_name', $account['last_name']);
					$this->session->set_userdata('age', $account['age']);
					$this->session->set_userdata('description', $account['description']);
					redirect(base_url().'index.php/home');
				}
			}			
		}

		$this->load->view('signin', $data);
	}	

	function logout() {
		$this->session->sess_destroy();
		rediret(base_url().'index.php/home');
	}
}

?>