<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {

		if ($this->session->userdata('account_id') == '') {
			redirect(base_url().'index.php/accounts');
		} else {
			$this->view->load('index');
		}

	}
}
