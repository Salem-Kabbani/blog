<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->signin();
	}

	public function signin()
	{
		if($this->session->userdata('id'))
			redirect('/usercontroller', 'refresh');
		else
			$this->load->view('signin');
	}

	public function save_user()
	{
		$this->load->model('User_model');
		$id = $this->User_model->insert_user();

		$this->session->set_userdata( 'id', $id );
		$this->session->set_userdata( 'username', $this->input->post('username'));
		$this->session->set_userdata( 'password', md5($this->input->post('password')));
		$this->session->set_userdata( 'email',$this->input->post('email'));
		$this->session->set_userdata( 'img', 'default-user-image.png' );
		redirect('/usercontroller', 'refresh');
	}

	public function login()
	{
		if($this->session->userdata('id'))
			redirect('/usercontroller', 'refresh');
		else
			$this->load->view('login');
	}


	public function login_user()
	{
		$this->load->model('User_model');
		$res = $this->User_model->get_user_by_email($this->input->post('email'));
		if (!$res) {
			echo "User not found";
			show_404();
		}
		$res = $res[0];
		if($res->password != md5($this->input->post('password'))){
			echo "Incorrect password";
			show_404();
		}

		$this->session->set_userdata( 'id', $res->id );
		$this->session->set_userdata( 'username', $res->username);
		$this->session->set_userdata( 'password', md5($res->password));
		$this->session->set_userdata( 'email',$res->email );
		$this->session->set_userdata( 'img', $res->img );
		redirect('/usercontroller', 'refresh');
	}


	public function clear_session()
	{
		$this->session->sess_destroy();
	}
}
