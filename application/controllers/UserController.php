<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		
		if(!$this->session->userdata('id'))
			redirect('/welcome', 'refresh');
	}

	public function index()
	{
		$this->show_my_profile();
	}

	private function show_my_profile(){
		$data['id'] = $this->session->userdata('id');
		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['img'] = $this->session->userdata('img');

		$this->load->model('Article_model');
		$res = $this->Article_model->get_user_articles($data['id']);
		$data['articles'] = $res;
		$data['your_profile'] = true;

		$title['title'] = 'My profile';

		$this->load->view('master/header', $title);
		$this->load->view('master/nav');
		$this->load->view('profile', $data);
		$this->load->view('master/footer');
	}

	public function new_article()
	{

		$title['title'] = 'New article';
		$this->load->view('master/header', $title);
		$this->load->view('master/nav');
		$this->load->view('new_article');
		$this->load->view('master/footer');
	}

	public function post_new_article()
	{
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100000';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload("fileUpload");
		$upload_data = $this->upload->data(); 

		$user_id = $this->session->userdata('id');
		$title = $this->input->post('blogTitle');
		$body = $this->input->post('blogBody');
		$create_date = date(DATE_ATOM, time());
		$img = $upload_data['file_name'];
		
		$this->load->model('Article_model');
		$this->Article_model->insert_article($user_id, $title, $body, $create_date, $img);

		redirect('/usercontroller', 'refresh');
	}

	public function profile($id = null)
	{
		if (!isset($id)) {
			$this->show_my_profile();
			return;
		} 

		$this->load->model('User_model');
		$res = $this->User_model->get_user_by_id($id);
		if (!$res) {
			show_404();
		}

		$data['id'] = $id;
		$data['username'] = $res[0]->username;
		$data['password'] = $res[0]->password;
		$data['img'] = $res[0]->img;
		$data['email'] = $res[0]->email;

		$this->load->model('Article_model');
		$res = $this->Article_model->get_user_articles($data['id']);
		$data['articles'] = $res;
		$data['your_profile'] = ($id == $this->session->userdata('id'));

		if($data['your_profile'])
			$title['title'] = 'My profile';
		else
			$title['title'] = $data['username'] . '\' profile';

		$this->load->view('master/header', $title);
		$this->load->view('master/nav');
		$this->load->view('profile', $data);
		$this->load->view('master/footer');
	}

	public function edit_profile()
	{
		echo "edit_profile";
	}

	public function log_out()
	{
		$this->session->sess_destroy();
		redirect('/welcome', 'refresh');
	}


}
