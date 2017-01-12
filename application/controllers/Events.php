<?php

class Events extends CI_Controller {
	
	public function index() {
		
		if ($this->session->userdata('account_id') == '') {
			redirect(base_url().'index.php/accounts/');
		} else {
            $data['account_id'] = $this->session->userdata('account_id');
			$data['username'] = $this->session->userdata('username');
			$data['first_name'] = $this->session->userdata('first_name');
			$data['last_name'] = $this->session->userdata('last_name');
			$data['account_image'] = $this->session->userdata('account_image');
            
			$this->load->view('header', $data);
            $this->load->view('event_add');
			$this->load->view('footer');
	   }
	}

	public function addParticipant($event_id, $max_participants) {
		$this->load->model('Event');
		$this->load->model('Participant');

        $participants = $this->Participant->getCurrentParticipants($event_id);
        foreach($participants as $participant) {
            $curr_participants = $participant['curr_participants'];
        }

        if ($curr_participants < $max_participants) {
        	if ($this->Participant->checkIfParticipantExist($event_id, $this->session->userdata('account_id'))) {
        		$response = array('status' => 'You already joined this event');
        	} else {
        		$result = $this->Participant->addParticipant($event_id, $this->session->userdata('account_id'));
        		if ($result > 0) {
        			$response = array('status' => 'Success');
        		} else {
        			$response = array('status' => 'Please try again');
        		}
        	}

        } else {
			$response = array('status' => 'Max participants already reached');
		}

		echo json_encode($response);

	}

    public function deleteEvent($event_id) {
        $this->load->model('Event');
        $this->load->model('Participant');
        $this->load->model('Chat');

        $result = $this->Event->deleteEvent($event_id);
        if ($result > 0) {
            $response = array('status' => '0', 'message' => 'Success');
            $this->Participant->deleteParticipantByEventId($event_id);
            $this->Chat->deleteChat($event_id);
        } else {
            $response = array('status' => '1', 'message' => 'Fail, please try again');
        }

        echo json_encode($response);
    }

    public function deleteParticipant($event_id) {
        $this->load->model('Participant');
        $result = $this->Participant->deleteParticipant($event_id, $this->session->userdata('account_id'));
        if ($result > 0) {
            $response = array('status' => 'Success');
        } else {
            $response = array('status' => 'Please try again');
        }

        echo json_encode($response);
    }

	public function viewEvent($event_id) {
        $data['account_id'] = $this->session->userdata('account_id');
		$data['username'] = $this->session->userdata('username');
		$data['first_name'] = $this->session->userdata('first_name');
		$data['last_name'] = $this->session->userdata('last_name');
		$data['account_image'] = $this->session->userdata('account_image');

		$this->load->model('Event');

		$events = $this->Event->getEventDetail($event_id);

		if ($events <> 0) {
            foreach ($events as $event) {
            	$data['account_id'] = $this->session->userdata('account_id');
            	$data['event_id'] = $event['event_id'];
                $data['event_name'] = $event['name'];
                $data['event_image'] = $event['event_image'];
                $data['event_date'] = date("F j, Y h:i A",strtotime($event['date']));
                $data['event_location'] = $event['location'];
                $data['event_description'] = ($event['description'] == '') ? 'No Description' : $event['description'];
                $data['max_participants'] = $event['max_participants'];
                $data['host_first_name'] = $event['first_name'];
                $data['host_last_name'] = $event['last_name'];
                $data['host_image'] = $event['host_image'];
                $data['host_age'] = $event['host_age'];
                $data['host_description'] = ($event['host_description'] == '') ? 'No Description' : $event['host_description'];
                $data['host_id'] = $event['host_id'];
                $data['latitude'] = $event['latitude'];
                $data['longitude'] = $event['longitude'];
                $data['min_age'] = $event['min_age'];
                $data['max_age'] = $event['max_age'];
                $data['formatted_date'] = $event['edit_event_date'];

                $data['distance'] = round($this->getDistance(0, 0, $data['latitude'], $data['longitude'], 'K'),2);
            }     
        }
        
        $this->load->view('header', $data);
        $this->load->view('event_view', $data);
		$this->load->view('footer');
    }

    public function editEvent($event_id) {
        $data['account_id'] = $this->session->userdata('account_id');
        $data['username'] = $this->session->userdata('username');
        $data['first_name'] = $this->session->userdata('first_name');
        $data['last_name'] = $this->session->userdata('last_name');
        $data['account_image'] = $this->session->userdata('account_image');

        $this->load->model('Event');

        $events = $this->Event->getEventDetail($event_id);

        if ($events <> 0) {
            foreach ($events as $event) {
                $data['event_id'] = $event['event_id'];
                $data['event_name'] = $event['name'];
                $data['event_image'] = $event['event_image'];
                $data['event_date'] = $event['date'];
                $data['event_location'] = $event['location'];
                $data['event_description'] = ($event['description'] == '') ? 'No Description' : $event['description'];
                $data['max_participants'] = $event['max_participants'];
                $data['host_first_name'] = $event['first_name'];
                $data['host_last_name'] = $event['last_name'];
                $data['host_image'] = $event['host_image'];
                $data['host_age'] = $event['host_age'];
                $data['host_description'] = ($event['host_description'] == '') ? 'No Description' : $event['host_description'];
                $data['host_id'] = $event['host_id'];
                $data['latitude'] = $event['latitude'];
                $data['longitude'] = $event['longitude'];
                $data['min_age'] = $event['min_age'];
                $data['max_age'] = $event['max_age'];
                $data['formatted_date'] = $event['edit_event_date'];

                $data['distance'] = round($this->getDistance(0, 0, $data['latitude'], $data['longitude'], 'K'),2);
            }     
        }
        
        $this->load->view('header', $data);
        $this->load->view('event_edit', $data);
        $this->load->view('footer');
    }

    public function getParticipants ($event_id) {
    	$this->load->model('Event');
    	$results = $this->Event->getEventParticipants($event_id);
    	// print_r($results);
    	if ($results == 0) {
    		$arr_response[] = array('status' => 'empty');
    	} else {
    		foreach ($results as $result) {
    			$participant_id = $result['participant_id'];
    			$participant_name = $result['first_name'];
    			$participant_image = $result['image_url'];

    			$arr_response[] = array(
                                    "participant_id" => $participant_id, 
                                    "participant_name" => $participant_name, 
                                    "participant_image" => $participant_image
                                 );
    		}
    	}
    	echo json_encode($arr_response);
    }

	public function addEvent() {

        $status = "";
        $message = "";

        $event_name = $this->input->post('event_name', true);
        $event_date = $this->input->post('event_date', true);
        $location = $this->input->post('location', true);
        $longitude = $this->input->post('longitude', true);
        $latitude = $this->input->post('latitude', true);
        $description = $this->input->post('description', true);
        $min_age = $this->input->post('min_age', true);
        $max_age = $this->input->post('max_age', true);
        $max_participants = $this->input->post('max_participants', true);
        $file_element_name = 'txt-event-image';
         
        if ($status != "error") {
            // $config['upload_path'] = './uploads'; //For local only
            $config['upload_path'] = '/var/www/web/assets/images/events';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->load->model('Event');

            if (!$this->upload->do_upload($file_element_name)) {
                $image_url = '';
            }
            else {
                $data = $this->upload->data();
                $image_url = 'http://185.121.173.201/web/assets/images/events/'.$data['file_name'];
            }

            $event_id = $this->Event->addEvent($event_name, $event_date, $location, $longitude, $latitude, $description, $min_age, $max_age, $max_participants, $image_url, $this->session->userdata('account_id'));
            
            if($event_id) {
                $status = "success";
                $message = "Event successfully added!";
            } else {
                unlink($data['full_path']);
                $status = "error";
                $message = "Something went wrong when saving the file, please try again.";
            }

            @unlink($_FILES[$file_element_name]);
        }
        
        echo json_encode(array('status' => $status, 'msg' => $message));
	}	

    public function updateEvent() {

        $status = "";
        $message = "";

        $event_id = $this->input->post('event_id', true);
        $event_name = $this->input->post('event_name', true);
        $event_date = $this->input->post('event_date', true);
        $location = $this->input->post('location', true);
        $longitude = $this->input->post('longitude', true);
        $latitude = $this->input->post('latitude', true);
        $description = $this->input->post('description', true);
        $min_age = $this->input->post('min_age', true);
        $max_age = $this->input->post('max_age', true);
        $max_participants = $this->input->post('max_participants', true);
        $event_image = $this->input->post('image_url', true);
        $file_element_name = 'txt-event-image';
         
        if ($status != "error") {
            // $config['upload_path'] = './uploads'; //For local only
            $config['upload_path'] = '/var/www/web/assets/images/events';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->load->model('Event');

            if (!$this->upload->do_upload($file_element_name)) {
                $image_url = $event_image;
            }
            else {
                $data = $this->upload->data();
                $image_url = 'http://185.121.173.201/web/assets/images/events/'.$data['file_name'];
            }

            $event_id = $this->Event->updateEvent($event_id, $event_name, $event_date, $location, $longitude, $latitude, $description, $min_age, $max_age, $max_participants, $image_url, $this->session->userdata('account_id'));
            
            if($event_id) {
                $status = "success";
                $message = "Event successfully updated!";
            } else {
                unlink($data['full_path']);
                $status = "error";
                $message = "Something went wrong when saving the file, please try again.";
            }

            @unlink($_FILES[$file_element_name]);
        }
        
        echo json_encode(array('status' => $status, 'msg' => $message));

        // if ($_POST) {
        //     $event_name = $this->input->post('event_name', true);
        //     $event_date = $this->input->post('event_date', true);
        //     $location = $this->input->post('location', true);
        //     $longitude = $this->input->post('longitude', true);
        //     $latitude = $this->input->post('latitude', true);
        //     $description = $this->input->post('description', true);
        //     $min_age = $this->input->post('min_age', true);
        //     $max_age = $this->input->post('max_age', true);
        //     $max_participants = $this->input->post('max_participants', true);
        //     $image_url = $this->input->post('image_url', true);

        //     $this->load->model('Event');

        //     $result = $this->Event->updateEvent($event_id, $event_name, $event_date, $location, $longitude, $latitude, $description, $min_age, $max_age, $max_participants, $image_url, $this->session->userdata('account_id'));

        //     if ($result > 0) {
        //         $response = array('status' => '0', 'message' => 'Success');
        //     } else {
        //         $response = array('status' => '1', 'message' => 'Failed! Please try again');
        //     }

        //     echo json_encode($response);
        // }
    }   

	public function getDistance($lat1, $lon1, $lat2, $lon2, $unit) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
          return ($miles * 1.609344);
        } else if ($unit == "N") {
          return ($miles * 0.8684);
        } else {
          return $miles;
        }
    }
	
}