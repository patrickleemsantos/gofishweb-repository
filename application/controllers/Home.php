<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
            $this->load->view('index', $data);
			$this->load->view('footer');
	   }
    }

    public function getLatestEvents($longitude, $latitude) {
        $this->load->model('Event');
        $this->load->model('Participant');

        $events = $this->Event->getLatestEvents();

        if ($events == 0) {
            $arr_response[] = array("status" => 'empty');
        } else {
            foreach ($events as $event) {
                $col_event_id = $event['id'];
                $col_event_name = $event['name'];
                $col_date = $event['date'];
                $col_latitude = $event['latitude'];
                $col_longitude = $event['longitude'];
                $col_image_url = $event['image_url'];
                $col_max_participants = $event['max_participants'];
                $col_description = $event['description'];
                $col_location = $event['location'];

                $distance = round($this->getDistance($latitude, $longitude, $col_latitude, $col_longitude, 'K'),2);

                $col_date = date("F j, Y h:i A",strtotime($col_date));

                $participants = $this->Participant->getCurrentParticipants($col_event_id);
                foreach($participants as $participant) {
                    $col_curr_participants = $participant['curr_participants'];
                }

                $arr_response[] = array(
                                    "event_id" => $col_event_id, 
                                    "event_name" => $col_event_name, 
                                    "event_date" => $col_date, 
                                    "event_description" => $col_description,
                                    "distance" => $distance, 
                                    "image_url" => $col_image_url, 
                                    "max_participants" => $col_max_participants, 
                                    "current_participants" => $col_curr_participants,
                                    "location" => $col_location
                                 );
            }     
        }
        
        echo json_encode($arr_response);
    }
    
    public function getMyEvents() {
        $this->load->model('Event');
        $this->load->model('Participant');

        $events = $this->Event->getMyEvents($this->session->userdata('account_id'));

        if ($events == 0) {
            $arr_response[] = array("status" => 'empty');
        } else {
            foreach ($events as $event) {
                $latitude = 0;
                $longitude = 0;

                $col_event_id = $event['id'];
                $col_event_name = $event['name'];
                $col_date = $event['date'];
                $col_latitude = $event['latitude'];
                $col_longitude = $event['longitude'];
                $col_image_url = $event['image_url'];
                $col_max_participants = $event['max_participants'];
                $col_description = $event['description'];
                // $distance = round($this->getDistance($latitude, $longitude, $col_latitude, $col_longitude, 'K'),2);
                $distance = 0;

                $col_date = date("F j, Y h:i A",strtotime($col_date));

                $participants = $this->Participant->getCurrentParticipants($col_event_id);
                foreach($participants as $participant) {
                    $col_curr_participants = $participant['curr_participants'];
                }

                $arr_response[] = array(
                                    "event_id" => $col_event_id, 
                                    "event_name" => $col_event_name, 
                                    "event_date" => $col_date, 
                                    "event_description" => $col_description,
                                    "distance" => $distance, 
                                    "image_url" => $col_image_url, 
                                    "max_participants" => $col_max_participants, 
                                    "current_participants" => $col_curr_participants
                                 );
            }     
        }
        
        echo json_encode($arr_response);
    }

    public function getUpcomingEvents($account_id) {
        $this->load->model('Event');
        $this->load->model('Participant');

        $events = $this->Event->getMyEvents($account_id);

        if ($events == 0) {
            $arr_response[] = array("status" => 'empty');
        } else {
            foreach ($events as $event) {
                $latitude = 0;
                $longitude = 0;

                $col_event_id = $event['id'];
                $col_event_name = $event['name'];
                $col_date = $event['date'];
                $col_latitude = $event['latitude'];
                $col_longitude = $event['longitude'];
                $col_image_url = $event['image_url'];
                $col_max_participants = $event['max_participants'];
                $col_description = $event['description'];
                // $distance = round($this->getDistance($latitude, $longitude, $col_latitude, $col_longitude, 'K'),2);
                $distance = 0;

                $col_date = date("F j, Y h:i A",strtotime($col_date));

                $participants = $this->Participant->getCurrentParticipants($col_event_id);
                foreach($participants as $participant) {
                    $col_curr_participants = $participant['curr_participants'];
                }

                $arr_response[] = array(
                                    "event_id" => $col_event_id, 
                                    "event_name" => $col_event_name, 
                                    "event_date" => $col_date, 
                                    "event_description" => $col_description,
                                    "distance" => $distance, 
                                    "image_url" => $col_image_url, 
                                    "max_participants" => $col_max_participants, 
                                    "current_participants" => $col_curr_participants
                                 );
            }     
        }
        
        echo json_encode($arr_response);
    }
    
    public function getOtherEvents() {
        $this->load->model('Event');
        $this->load->model('Participant');

        $events = $this->Event->getOtherEvents($this->session->userdata('account_id'));

        if ($events == 0) {
            $arr_response[] = array("status" => 'empty');
        } else {
            foreach ($events as $event) {
                $latitude = 0;
                $longitude = 0;

                $col_event_id = $event['id'];
                $col_event_name = $event['name'];
                $col_date = $event['date'];
                $col_latitude = $event['latitude'];
                $col_longitude = $event['longitude'];
                $col_image_url = $event['image_url'];
                $col_max_participants = $event['max_participants'];
                $col_description = $event['description'];
                // $distance = round($this->getDistance($latitude, $longitude, $col_latitude, $col_longitude, 'K'),2);
                $distance = 0;

                $col_date = date("F j, Y h:i A",strtotime($col_date));

                $participants = $this->Participant->getCurrentParticipants($col_event_id);
                foreach($participants as $participant) {
                    $col_curr_participants = $participant['curr_participants'];
                }

                $arr_response[] = array(
                                    "event_id" => $col_event_id, 
                                    "event_name" => $col_event_name, 
                                    "event_date" => $col_date, 
                                    "event_description" => $col_description,
                                    "distance" => $distance, 
                                    "image_url" => $col_image_url, 
                                    "max_participants" => $col_max_participants, 
                                    "current_participants" => $col_curr_participants
                                 );
            }     
        }
        
        echo json_encode($arr_response);
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
