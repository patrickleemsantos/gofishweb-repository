<?php

class Account extends CI_Model {
	
	public function login($username, $password) {
		$where = array(
					'username' => $username,
					'password' => $password
				);

		$this->db->select()->from('tbl_account')->where($where);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function getAccount($account_id) {
		$this->db->select('*');
        $this->db->from('tbl_account');
        $this->db->where('id', $account_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
	}

	public function updateAccount($first_name, $last_name, $age, $description, $account_id, $image_url) {
        $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'age' => $age,
                'description' => $description,
                'image_url' => $image_url
            );

        $this->db->where('id', $account_id);
        $this->db->update('tbl_account', $data);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getFBAccount($facebook_id) {
        $this->db->select('id, username, age, description, first_name, last_name, image_url');
        $this->db->from('tbl_account');
        $this->db->where('account_no', $facebook_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function addFacebookAccount($facebook_id, $first_name, $last_name, $age, $image_url) {
        $data = array(
                'account_no' => $facebook_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'age' => $age,
                'image_url' => $image_url,
                'date_joined' => date('Y-m-d H:i:s')
            );

        $this->db->insert('tbl_account', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }

    public function checkIfUsernameExist($username) {
        $this->db->select('*');
        $this->db->from('tbl_account');
        $this->db->where('username', $username);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    } 

    public function addEmailAccount($email, $password, $first_name, $last_name, $age, $description, $image_url) {
        $data = array(
                'username' => $email,
                'password' => $password,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'age' => $age,
                'description' => $description,
                'date_joined' => date('Y-m-d H:i:s'),
                'image_url' => $image_url
            );

        $this->db->insert('tbl_account', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
}

?>