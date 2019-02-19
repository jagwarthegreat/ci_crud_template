<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model Extends CI_Model{

	public function user_login($username, $password){
		$this->db->where(['username'=> $username, 'password'=> $password]);
		$query = $this->db->get('user');
		if($query){
			return $query->result();
		}else {
			return FALSE;
		}
	}
}