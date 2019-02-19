<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category Extends CI_Model{

	public function add_category($name)
	{
		$data = array('name'=> $name);
		$query = $this->db->insert('item_category', $data);
		if($query){
			return TRUE;
		}else {
			return FALSE;
		}
	}

	public function get_category(){
		$this->db->order_by("id");
		$query = $this->db->get('item_category');

		return $query->result();
	}

	public function cat_delete($id)
	{
		if (!empty($id)) {
	        $this->db->where_in('id', $id);
	        $query = $this->db->delete('item_category');
	        if($query){
				return TRUE;
			}else {
				return FALSE;
			}
	    }
	}

	public function edit_cat($id, $name)
	{
		$data = array('name'=> $name);
		$this->db->where('id', $id);
		$query = $this->db->update('item_category', $data);
		if($query){
			return TRUE;
		}else {
			return FALSE;
		}
	}
}