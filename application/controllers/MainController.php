<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

	public function index()
	{
		$this->load->model('user_model');
		$this->load->view('tpl/header.php');
		$this->load->view('tpl/navbar.php');
		$this->load->view('main');
		$this->load->view('tpl/footer.php');
	}

//Login parse
	public function login_parse()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$this->load->model('login_model');
		$que = $this->login_model->user_login($username, $password);
		if($que){
			foreach ($que as $row) {
				$info = array('user_id' => $row->user_id, 'username'=> $username, 'logged'=> TRUE);
			}
			
			$this->session->set_userdata($info);
			redirect(base_url());
		}else {
			$arr =array ('pass' => 'Invalid Username and Password');
			$this->session->set_flashdata($arr);
			redirect(base_url());
		}
	}

//Logout
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());		
	}

	public function main()
	{
		$this->load->model('inventory');
		$data['content'] = $this->inventory->get_item();

		$this->load->model('category');
		$data['content_category'] = $this->category->get_category();

		$this->load->model('user_model');
		$this->load->view('tpl/header.php');
		$this->load->view('tpl/navbar.php');
		$this->load->view('inv/main.php', $data);
		$this->load->view('tpl/footer.php');
	}

	public function invAdd()
	{
		$user_id = $this->input->post('userID');
		$category = $this->input->post('category');
		$barcode = $this->input->post('barcode');
		$name = $this->input->post('name');
		$serial = $this->input->post('serial');
		$variation = $this->input->post('variation');

		$this->load->model('inventory');
		$check = $this->inventory->add_item($user_id, $category, $barcode, $name, $serial, $variation);
		if($check){
			$success = array('success'=> 'A item has been added Successfully.');
			$this->session->set_flashdata($success);
			redirect('inventory');
		}
	}

	public function invEdit()
	{
		$id = $this->input->post('id');
		$category = $this->input->post('category');
		$barcode = $this->input->post('barcode');
		$name = $this->input->post('name');
		$serial = $this->input->post('serial');
		$variation = $this->input->post('variation');

		$this->load->model('inventory');
		$check = $this->inventory->edit_item($id, $category, $barcode, $name, $serial, $variation);
		if($check){
			$success = array('success'=> 'A item has been updated Successfully.');
			$this->session->set_flashdata($success);
			redirect('inventory');
		}
	}

	public function invDelete()
	{
		$this->load->model('inventory');
		$data = $this->input->post('delete');
		if(!empty($data)){
			$res = $this->inventory->inv_delete($data);
			if($res){
				$success = array('success'=> 'A item has been deleted Successfully.');
				$this->session->set_flashdata($success);
				redirect('inventory');
			}
		}else{
			redirect('inventory');
		}
	}


	// CATEGORY
		public function catMain()
		{
			$this->load->model('category');
			$data['content'] = $this->category->get_category();

			$this->load->model('user_model');
			$this->load->view('tpl/header.php');
			$this->load->view('tpl/navbar.php');
			$this->load->view('category/main.php', $data);
			$this->load->view('tpl/footer.php');
		}

		public function catAdd()
		{
			$name = $this->input->post('catname');
			$this->load->model('category');
			$check = $this->category->add_category($name);
			if($check){
				$success = array('success'=> 'A category has been added Successfully.');
				$this->session->set_flashdata($success);
				redirect('category');
			}
		}

		public function catEdit()
		{
			$id = $this->input->post('edit_id');
			$catName = $this->input->post('edit_catname');

			$this->load->model('category');
			$check = $this->category->edit_cat($id, $catName);
			if($check){
				$success = array('success'=> 'A category has been edited Successfully.');
				$this->session->set_flashdata($success);
				redirect('category');
			}
		}

		public function catDelete()
		{
			$this->load->model('category');
			$data = $this->input->post('delete');
			if(!empty($data)){
				$res = $this->category->cat_delete($data);
				if($res){
					$success = array('success'=> 'A category has been deleted Successfully.');
					$this->session->set_flashdata($success);
					redirect('category');
				}
			}else{
				redirect('category');
			}
		}

	// PROFILE
		public function profileMain()
		{
			$this->load->model('user_model');
			$this->load->view('tpl/header.php');
			$this->load->view('tpl/navbar.php');
			$this->load->view('profile/main');
			$this->load->view('tpl/footer.php');
		}
}
