<?php

class Event extends CI_Model {

    public function getEventDetail($event_id) {
        $this->db->select('e.id as event_id, e.name, e.image_url as event_image, e.date, e.location, e.description, e.max_participants, a.first_name, a.last_name, a.image_url as host_image, a.id as host_id, a.description as host_description, a.age as host_age,
                e.latitude, e.longitude, e.min_age, e.max_age, DATE_FORMAT(date, "%Y-%m-%dT%H:%i") AS edit_event_date');
        $this->db->from('tbl_event e');
        $this->db->join('tbl_account a', 'a.id = e.account_id');
        $this->db->where('e.id', $event_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function checkEventMaxParticipant($event_id) {
        $this->db->select('COUNT(id) as max_participants');
        $this->db->from('tbl_event');
        $this->db->where('id', $event_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function getEventParticipants($event_id) {
        $this->db->select('a.id as participant_id, a.first_name, a.image_url');
        $this->db->from('tbl_participant p');
        $this->db->join('tbl_account a', 'a.id = p.account_id');
        $this->db->where('p.event_id', $event_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    
    public function getLatestEvents() {
        $this->db->select('id, name, date, latitude, longitude, image_url, max_participants, description, location');
        $this->db->from('tbl_event');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    
    public function getMyEvents($account_id) {
        $this->db->select('id, name, date, latitude, longitude, image_url, max_participants, description');
        $this->db->from('tbl_event');
        $this->db->where("account_id = $account_id OR id IN (SELECT event_id FROM tbl_participant WHERE account_id = $account_id)");
        $this->db->order_by("date", "ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    
    public function getOtherEvents($account_id) {
        $this->db->select('id, name, date, latitude, longitude, image_url, max_participants, description');
        $this->db->from('tbl_event');
        $this->db->where("account_id <> $account_id AND id NOT IN (SELECT event_id FROM tbl_participant WHERE account_id = $account_id)");
        $this->db->order_by("date", "ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function addEvent($event_name, $event_date, $location, $longitude, $latitude, $description, $min_age, $max_age, $max_participants, $image_url, $account_id) {

        $data = array(
                'name' => $event_name,
                'date' => $event_date,
                'location' => $location,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'description' => $description,
                'min_age' => $min_age,
                'max_age' => $max_age,
                'max_participants' => $max_participants,
                'image_url' => $image_url,
                'timestamp' => date('Y-m-d H:i:s'),
                'account_id' => $account_id
            );

        $this->db->insert('tbl_event', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
        // $affected_rows = $this->db->affected_rows();
        // return $affected_rows;
    }

    public function updateEvent($event_id, $event_name, $event_date, $location, $longitude, $latitude, $description, $min_age, $max_age, $max_participants, $image_url, $account_id) {

        $data = array(
                'name' => $event_name,
                'date' => $event_date,
                'location' => $location,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'description' => $description,
                'min_age' => $min_age,
                'max_age' => $max_age,
                'max_participants' => $max_participants,
                'image_url' => $image_url,
                'account_id' => $account_id,
                'timestamp' => date('Y-m-d H:i:s')
            );

        $this->db->where('id', $event_id);
        $this->db->update('tbl_event', $data);
        $affected_rows = $this->db->affected_rows();
        return $affected_rows;
    }

    public function deleteEvent ($event_id) {
        $this->db->where('id', $event_id);
        $this->db->delete('tbl_event');
        $affected_rows = $this->db->affected_rows();
        return $affected_rows;
    }
    
}

?>