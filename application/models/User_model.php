<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model Extends CI_Model{

	public function getUser($id){
		$this->db->where(['user_id'=> $id]);
		$query = $this->db->get('user');
		if($query){
			return $query->result();
		}else {
			return FALSE;
		}
	}
}