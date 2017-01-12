<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function index() {
		$data['error'] = 0;

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
					$this->session->set_userdata('is_facebook_login', false);
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
		redirect(base_url().'index.php/accounts/');
	}

	function viewAccount ($account_id) {
		$this->load->model('Account');
		$data['account_id'] = $this->session->userdata('account_id');
		$data['username'] = $this->session->userdata('username');
		$data['first_name'] = $this->session->userdata('first_name');
		$data['last_name'] = $this->session->userdata('last_name');
		$data['account_image'] = $this->session->userdata('account_image');

		$accounts = $this->Account->getAccount($account_id);

		if ($accounts <> 0) {
            foreach ($accounts as $account) {
            	$data['profile_id'] = $account['id'];
            	$data['profile_username'] = $account['username'];
                $data['profile_first_name'] = $account['first_name'];
                $data['profile_last_name'] = $account['last_name'];
                $data['profile_image'] = $account['image_url'];
                $data['profile_age'] = $account['age'];
                $data['profile_description'] = $account['description'];
            }     
        }
        
        $this->load->view('header', $data);
        $this->load->view('profile_view', $data);
		$this->load->view('footer');
	}

	public function editAccount() {
        $this->load->model('Account');
        $data['account_id'] = $this->session->userdata('account_id');
		$data['username'] = $this->session->userdata('username');
		$data['first_name'] = $this->session->userdata('first_name');
		$data['last_name'] = $this->session->userdata('last_name');
		$data['account_image'] = $this->session->userdata('account_image');

		$accounts = $this->Account->getAccount($this->session->userdata('account_id'));

		if ($accounts <> 0) {
            foreach ($accounts as $account) {
            	$data['profile_id'] = $account['id'];
            	$data['profile_username'] = $account['username'];
                $data['profile_first_name'] = $account['first_name'];
                $data['profile_last_name'] = $account['last_name'];
                $data['profile_image'] = $account['image_url'];
                $data['profile_age'] = $account['age'];
                $data['profile_description'] = $account['description'];
            }     
        }
        
        $this->load->view('header', $data);
        $this->load->view('profile_edit', $data);
		$this->load->view('footer');
    }

    public function updateAccount() {
    	$status = "";
        $message = "";

        $account_id = $this->input->post('account_id', true);
        $first_name = $this->input->post('first_name', true);
        $last_name = $this->input->post('last_name', true);
        $age = $this->input->post('age', true);
        $description = $this->input->post('description', true);
        $account_image = $this->input->post('account_image', true);
        $file_element_name = 'txt-profile-image';
         
        if ($status != "error") {
            $config['upload_path'] = '/var/www/web/assets/images/profiles';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->load->model('Account');

            if (!$this->upload->do_upload($file_element_name)) {
                $image_url = $account_image;
            }
            else {
                $data = $this->upload->data();
                $image_url = 'http://185.121.173.201/web/assets/images/profiles/'.$data['file_name'];
            }

            $result = $this->Account->updateAccount($first_name, $last_name, $age, $description, $account_id, $image_url);
            
            if($result) {
                $status = "success";
                $message = "Account successfully updated!";
            } else {
                unlink($data['full_path']);
                $status = "error";
                $message = "Something went wrong when saving the file, please try again.";
            }

            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $message));
    } 

    public function getFBDetails($facebook_id) {
    	if ($_POST) {
    		try {
				$first_name = $this->input->post('first_name', true);
				$last_name = $this->input->post('last_name', true);
				$age = $this->input->post('age', true);
				$image_url = $this->input->post('image_url', true);

		    	$this->load->model('Account');

		    	$results = $this->Account->getFBAccount($facebook_id);
		    	if ($results > 0) {
			        foreach ($results as $result) {
						$this->session->set_userdata('account_id', $result['id']);
						$this->session->set_userdata('username', $result['username']);
						$this->session->set_userdata('first_name', $result['first_name']);
						$this->session->set_userdata('last_name', $result['last_name']);
						$this->session->set_userdata('account_image', $result['image_url']);
		        	}     
		    	} else {
		    		$account_id = $this->Account->addFacebookAccount($facebook_id, $first_name, $last_name, $age, $image_url);
			        $this->session->set_userdata('account_id', $account_id);
					$this->session->set_userdata('username', '');
					$this->session->set_userdata('first_name', $first_name);
					$this->session->set_userdata('last_name', $last_name);
					$this->session->set_userdata('account_image', $image_url);
		    	}

		    	$this->session->set_userdata('is_facebook_login', true);

		    	$response = array('status' => '0', 'message' => 'Success');
	            echo json_encode($response);
            } catch (Exception $e) {
			  // log_message('error',$e->getMessage());
			  $response = array('status' => '1', 'message' => $e->getMessage());
	          echo json_encode($response);
			}
    	}
    }

    public function signup() {
    	$this->load->view('signup');
    }

    public function addEmailAccount() {

    	$status = "";
        $message = "";

        $email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		$first_name = $this->input->post('first_name', true);
		$last_name = $this->input->post('last_name', true);
		$age = $this->input->post('age', true);
		$description = $this->input->post('description', true);
        $file_element_name = 'txt-profile-image';
         
        if ($status != "error") {
            $config['upload_path'] = '/var/www/web/assets/images/profiles';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->load->model('Account');

            if (!$this->upload->do_upload($file_element_name)) {
                $image_url = '';
            }
            else {
                $data = $this->upload->data();
                $image_url = 'http://185.121.173.201/web/assets/images/profiles/'.$data['file_name'];
            }

            $account_id = $this->Account->addEmailAccount($email, $password, $first_name, $last_name, $age, $description, $image_url);
            
            if($account_id) {
                $status = "success";
                $message = "Account successfully added!";

                $this->session->set_userdata('account_id', $account_id);
				$this->session->set_userdata('username', $email);
				$this->session->set_userdata('first_name', $first_name);
				$this->session->set_userdata('last_name', $last_name);
				$this->session->set_userdata('account_image', $image_url);
				$this->session->set_userdata('is_facebook_login', false);

            } else {
                unlink($data['full_path']);
                $status = "error";
                $message = "Something went wrong when saving the file, please try again.";

            }

            @unlink($_FILES[$file_element_name]);
        }
        
        echo json_encode(array('status' => $status, 'msg' => $message));
    }
}

?>