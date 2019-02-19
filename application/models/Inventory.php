<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory Extends CI_Model{

	public function add_item($user_id, $category, $barcode, $name, $serial, $variation)
	{
		$data = array('user_id' => $user_id, 'barcode'=> $barcode, 'category'=> $category, 'name'=> $name, 'serial'=> $serial, 'variation' => $variation);
		$query = $this->db->insert('item', $data);
		if($query){
			return TRUE;
		}else {
			return FALSE;
		}
	}

	public function get_item(){
		$this->db->select('*,c.name AS cat_name,item.name AS item_name, c.id AS ic_id, item.id AS item_id');
		$this->db->from('item');
		$this->db->join('item_category AS c', 'c.id = item.category');
		$query = $this->db->get();

		return $query->result();
	}

	public function inv_delete($id)
	{
		if (!empty($id)) {
	        $this->db->where_in('id', $id);
	        $query = $this->db->delete('item');
	        if($query){
				return TRUE;
			}else {
				return FALSE;
			}
	    }
	}

	public function edit_item($id, $category, $barcode, $name, $serial, $variation)
	{
		$data = array('barcode'=> $barcode, 'category'=> $category, 'name'=> $name, 'serial'=> $serial, 'variation' => $variation);
		$this->db->where('id', $id);
		$query = $this->db->update('item', $data);
		if($query){
			return TRUE;
		}else {
			return FALSE;
		}
	}
}