<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Messages {
	var $ci;
	
	function Messages($params = array()) {
		$this->ci = & get_instance();
		$this->ci->load->library('session');
		
		$messages = $this->ci->session->userdata('messages');
	}
	
	function clear() {
		$this->ci->session->set_userdata('messages', array());
	}
	
	function add($message, $type = 'message') {
		$messages = $this->ci->session->userdata('messages');
		if (! is_array($messages))
			$messages = array();
		
		if (is_a($message, 'PEAR_Error')) {
			$message = $message->getMessage();
			$type = 'error';
		}
		
		if ((! isset($messages[$type]) || ! in_array($message, $messages[$type])) && is_string($message) && $message)
			$messages[$type][] = $message;
		
		$messages = $this->ci->session->set_userdata('messages', $messages);
	}
	
	function count($type = null) {
		$messages = $this->ci->session->userdata('messages');
		if (! is_array($messages))
			$messages = array();
		
		if (! empty($type)) {
			if (array_key_exists($type, $messages))
				return $messages[$type];
			else
				return 0;
		}
		
		$i = 0;
		foreach ($messages as $type => $m) {
			$i += count($messages[$type]);
		}
		return $i;
	}
	
	function get($type = null) {
		$messages = $this->ci->session->userdata('messages');
		if (! is_array($messages))
			$messages = array();
		
		if (! empty($type)) {
			if (array_key_exists($type, $messages))
				return $messages[$type];
			else
				return array();
		}
		
		$return = $messages;
		
		$this->clear();
		return $return;
	}
}  