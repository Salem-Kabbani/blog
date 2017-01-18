<?php
class Comment_model extends CI_Model {

        public $id;
        public $user_id;
        public $article_id;
        public $text;
        public $create_date;

        public function __construct()
        {
                parent::__construct();
                $this->load->helper('date');
        }


        public function get_article_comments($article_id)
        {
                // $query = $this->db->select('*')->from('comments')->where('article_id', $article_id)->get();
                $this->db->select('comments.id, comments.user_id, comments.text, comments.create_date, users.username, users.img');
                $this->db->from('comments');
                $this->db->join('users', 'users.id = comments.user_id');
                $this->db->where('comments.article_id', $article_id);
                $this->db->order_by('create_date', 'ASC');
                $query = $this->db->get();
                return $query->result();
        }

        // public function get_user_by_email($email)
        // {
        //         $query = $this->db->select('*')->from('users')->where('email', $email)->get();
        //         return $query->result();
        // }

        public function insert_comment($u_id,$a_id,$txt)
        {
                $this->user_id = $u_id;
                $this->article_id = $a_id;
                $this->text = $txt;
                // $this->create_date = now();
                $this->create_date = date(DATE_ATOM, time());

                $this->db->insert('comments', $this);
                $this->id = $this->db->insert_id();
                return $this;
        }

        // public function update_entry()
        // {
        //         $this->title    = $_POST['title'];
        //         $this->content  = $_POST['content'];
        //         $this->date     = time();

        //         $this->db->update('entries', $this, array('id' => $_POST['id']));
        // }

}
