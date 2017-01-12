<?php

    class Participant extends CI_Model {
        
        public function getCurrentParticipants($event_id) {
            $this->db->select('COUNT(id) as curr_participants');
            $this->db->from('tbl_participant');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return 0;
            }
        }

        public function checkIfParticipantExist($event_id, $account_id) {
            $this->db->select('*');
            $this->db->from('tbl_participant');
            $this->db->where('event_id', $event_id);
            $this->db->where('account_id', $account_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function addParticipant($event_id, $account_id) {
            $data = array(
                    'event_id' => $event_id,
                    'account_id' => $account_id,
                    'timestamp' => date('Y-m-d H:i:s')
                );

            $this->db->insert('tbl_participant', $data);
            $affected_rows = $this->db->affected_rows();
            return $affected_rows;
        }

        public function deleteParticipant($event_id, $account_id) {
            $this->db->where('event_id', $event_id);
            $this->db->where('account_id', $account_id);
            $this->db->delete('tbl_participant');
            $affected_rows = $this->db->affected_rows();
            return $affected_rows;
        }

        public function deleteParticipantByEventId($event_id) {
            $this->db->where('event_id', $event_id);
            $this->db->delete('tbl_participant');
            $affected_rows = $this->db->affected_rows();
            return $affected_rows;
        }
    }

?>