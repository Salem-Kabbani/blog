<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		// $this->load->helper('date');

		if(!$this->session->userdata('id'))
			redirect('/welcome', 'refresh');
	}

	public function index()
	{
		$this->load->model('Article_model');
		$res = $this->Article_model->get_all_articles();
		// var_dump($res); die();
		
		$title['title'] = 'Home';

		$data['articles'] = $res;
		$this->load->view('master/header', $title);
		$this->load->view('master/nav');
		$this->load->view('home', $data);
		$this->load->view('master/footer');

	}
}
