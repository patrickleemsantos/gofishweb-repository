<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function login() {
		$data['error'] = 0;
        echo 'Patrick';

		if ($_POST) {
			$this->load->model('Account');

			$this->form_validation->set_rules('txt_username', 'Username', 'required');
			$this->form_validation->set_rules('txt_password', 'Password', 'required');

			if ($this->form_validation->run() == TRUE) {
				$username = $this->input->post('txt_username', true);
				$password = $this->input->post('txt_password', true);
				$account = $this->Account->login($username, $password);
				if (!$account) {
					$data['error'] = 1;
					echo "<script>
				            alert('Invalid username/password');
				          </script>";
				} else {
					$this->session->set_userdata('account_id', $account['id']);
					$this->session->set_userdata('username', $account['username']);
					$this->session->set_userdata('first_name', $account['first_name']);
					$this->session->set_userdata('last_name', $account['last_name']);
					$this->session->set_userdata('age', $account['age']);
					$this->session->set_userdata('description', $account['description']);
					$this->session->set_userdata('account_image', $account['image_url']);
					redirect(base_url().'index.php/home');
				}
			}			
		}

		$this->load->view('signin', $data);
	}	

	function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'index.php/accounts/login');
	}
}

?>