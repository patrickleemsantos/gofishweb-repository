<?php

class Chat extends CI_Model {

    public function addChat($event_id, $account_id, $message){
        $data = array(
                'event_id' => $event_id,
                'account_id' => $account_id,
                'message' => $message,
                'timestamp' => date('Y-m-d H:i:s')
            );

        $this->db->insert('tbl_chat', $data);
        $affected_rows = $this->db->affected_rows();
        return $affected_rows;
    }
	
	public function deleteChat ($event_id) {
        $this->db->where('event_id', $event_id);
        $this->db->delete('tbl_chat');
        $affected_rows = $this->db->affected_rows();
        return $affected_rows;
    }

    public function getChatList($account_id) {
    	// $sql = "SELECT c.id as chat_id, e.id event_id, e.image_url, e.name, c.message, e.account_id as host_id
    	// 		FROM tbl_chat as c 
    	// 		INNER JOIN tbl_event as e ON e.id = c.event_id 
    	// 		WHERE c.id IN (SELECT MAX(id) FROM tbl_chat WHERE account_id = $account_id OR event_id IN (SELECT event_id FROM tbl_participant WHERE account_id = $account_id) GROUP BY event_id) ORDER BY c.id DESC";

        $sql = "select e.id as event_id, e.image_url, e.name, e.account_id, e.date from tbl_event as e 
                left join tbl_chat as c on c.event_id = e.id
                where 
                e.account_id = 12 or e.id IN (select event_id from tbl_participant where account_id = 12) 
                group by e.id
                order by c.id desc";
        
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function getChatConversation($event_id) {
        $sql = "SELECT c.id as message_id, a.first_name, a.last_name, c.account_id, c.message, c.timestamp, a.image_url
            FROM tbl_chat as c 
            INNER JOIN tbl_account as a ON a.id = c.account_id
            WHERE c.event_id = $event_id ORDER by c.id";
            
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function getChatLatest($event_id, $account_id, $message_id) {
        $sql = "SELECT c.id as message_id, a.first_name, a.last_name, c.account_id, c.message, c.timestamp, a.image_url
            FROM tbl_chat as c 
            INNER JOIN tbl_account as a ON a.id = c.account_id
            WHERE c.event_id = $event_id AND c.id > $message_id AND c.account_id <> $account_id ORDER by c.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

}

?>