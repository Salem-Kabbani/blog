<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArticleController extends CI_Controller {

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


	}

	public function article($id = null)
	{
		if(!isset($id)){
			show_404();
		}

		$this->load->model('Article_model');
		$res_article = $this->Article_model->get_article_by_id($id);
		if (!$res_article) {
			show_404();
		}

		$article['id'] = $res_article[0]->id;
		$article['create_date'] = $res_article[0]->create_date;
		$article['user_id'] = $res_article[0]->user_id;
		$article['img'] = $res_article[0]->img;
		$article['body'] = $res_article[0]->body;
		$article['title'] = $res_article[0]->title;
		$data['article'] = $article;

		$this->load->model('User_model');
		$res_user = $this->User_model->get_user_by_id($article['user_id']);
		$user['id'] = $id;
		$user['username'] = $res_user[0]->username;
		// $user['password'] = $res_user[0]->password;
		$user['img'] = $res_user[0]->img;
		$user['email'] = $res_user[0]->email;
		$data['user'] = $user;
		
		$this->load->model('Comment_model');
		$res_comments = $this->Comment_model->get_article_comments($id);
		$data['comments'] = $res_comments;
		// var_dump($res_comments); die();

		$this->load->model('Like_model');
		$res_likes = $this->Like_model->get_article_likes($id);
		$is_liked = false;
		foreach ($res_likes as $row) {
			if($row->user_id == $this->session->userdata('id'))
			{
				$is_liked =true;
				break;
			}
		}

		// var_dump($is_liked); die();
		$data['likes'] = $res_likes;
		$data['is_liked'] = $is_liked;
		$data['likes_count'] = count($res_likes);

		// var_dump($is_liked); die();
		$title['title'] = $article['title'];

		$this->load->view('master/header', $title);
		$this->load->view('master/nav');
		$this->load->view('article', $data);
		$this->load->view('master/footer');
	}


	public function like()
	{
		$user_id = $this->input->post('u_id');
		$article_id = $this->input->post('a_id');

		$this->load->model('Like_model');
		$ll = $this->Like_model->is_liked($user_id, $article_id);

		if($ll)
			$this->Like_model->delete_like($user_id, $article_id);
		else
			$this->Like_model->insert_like($user_id, $article_id);

		$res_likes = $this->Like_model->get_article_likes($article_id);

		$arr = array('like' => $ll, 'count' => count($res_likes));    
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}


	public function comment()
	{
		$user_id = $this->input->post('u_id');
		$article_id = $this->input->post('a_id');
		$comment = $this->input->post('com');
		$this->load->model('Comment_model');
		$com = $this->Comment_model->insert_comment($user_id, $article_id, $comment);
		$this->load->model('User_model');
		$usr = $this->User_model->get_user_by_id($user_id);
		$arr['user'] = $usr[0];
		$arr['comment'] = $com;
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}

}
