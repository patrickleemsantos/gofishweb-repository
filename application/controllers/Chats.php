<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Chats extends CI_Controller {

	public function getChatList() {

		$this->load->model('Chat');

		$chats = $this->Chat->getChatList($this->session->userdata('account_id'));

		if ($chats == 0) {
            $arr_response[] = array("status" => 'empty');
        } else {
            foreach ($chats as $chat) {
                // $chat_id = $chat['chat_id'];
                $event_id = $chat['event_id'];
                $image_url = $chat['image_url'];
                $name = $chat['name'];
                // $message = $chat['message'];
                $account_id = $chat['account_id'];
                $date = date("F j, Y h:i A",strtotime($chat['date']));

                // $arr_response[] = array(
                //                     "chat_id" => $chat_id, 
                //                     "event_id" => $event_id, 
                //                     "image_url" => $image_url, 
                //                     "name" => $name,
                //                     "message" => $message, 
                //                     "host_id" => $host_id
                //                  );
                $arr_response[] = array(
                                    "event_id" => $event_id, 
                                    "image_url" => $image_url, 
                                    "name" => $name,
                                    "host_id" => $account_id,
                                    "date" => $date
                                 );
            }     
        }

        echo json_encode($arr_response);

	}	

    public function getChatConversation($event_id) {

        $this->load->model('Chat');

        $chats = $this->Chat->getChatConversation($event_id);

        if ($chats == 0) {
            $arr_response[] = array("status" => 'empty');
        } else {
            foreach ($chats as $chat) {
                $message_id = $chat['message_id'];
                $first_name = $chat['first_name'];
                $last_name = $chat['last_name'];
                $account_id = $chat['account_id'];
                $message = $chat['message'];
                $timestamp = $chat['timestamp'];
                $image_url = $chat['image_url'];

                $arr_response[] = array(
                                    "message_id" => $message_id, 
                                    "first_name" => $first_name, 
                                    "last_name" => $last_name, 
                                    "account_id" => $account_id,
                                    "message" => $message, 
                                    "timestamp" => $timestamp,
                                    "image_url" => $image_url
                                 );
            }     
        }

        echo json_encode($arr_response);

    }

    public function addChat() {
        if ($_POST) {
            $event_id = $this->input->post('event_id', true);
            $account_id = $this->input->post('account_id', true);
            $message = $this->input->post('message', true);

            $this->load->model('Chat');

            $result = $this->Chat->addChat($event_id, $account_id, $message);

            if ($result > 0) {
                $response = array('status' => '0', 'message' => 'Success');
            } else {
                $response = array('status' => '1', 'message' => 'Failed! Please try again');
            }

            echo json_encode($response);
        }
    }

    public function getChatLatest($event_id, $message_id, $account_id) {

        $this->load->model('Chat');

        $chats = $this->Chat->getChatLatest($event_id, $account_id, $message_id);

        if ($chats == 0) {
            $arr_response[] = array("status" => 'empty');
        } else {
            foreach ($chats as $chat) {
                $message_id = $chat['message_id'];
                $account_id = $chat['account_id'];
                $full_name = $chat['first_name'].' '.$chat['last_name'];
                $message = $chat['message'];
                $timestamp = $chat['timestamp'];
                $image_url = $chat['image_url'];

                $timestamp = date("F j, Y, g:i a",strtotime($timestamp));

                $arr_response[] = array(
                                    "message_id" => $message_id, 
                                    "account_id" => $account_id, 
                                    "full_name" => $full_name, 
                                    "message" => $message,
                                    "timestamp" => $timestamp, 
                                    "image_url" => $image_url
                                 );
            }     
        }

        echo json_encode($arr_response);
    }

}

?>