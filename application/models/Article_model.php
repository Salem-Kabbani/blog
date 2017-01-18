<?php
class Article_model extends CI_Model {

        public $id;
        public $user_id;
        public $title;
        public $body;
        public $img;
        public $create_date;
        // public $date;

        public function get_all_articles()
        {
                 // $query = $this->db->select('*')->from('articles')->order_by('create_date', 'DESC')->get();
                $this->db->select('articles.id, articles.title, articles.body, articles.img, articles.create_date, articles.user_id, users.username, users.img as user_img');
                $this->db->from('articles');
                $this->db->join('users', 'users.id = articles.user_id');
                $this->db->order_by('articles.create_date', 'DESC');
                $query = $this->db->get();      
                return $query->result();
        }

        public function get_article_by_id($id)
        {
                $query = $this->db->select('*')->from('articles')->where('id', $id)->get();
                return $query->result();
        }


        public function get_user_articles($user_id)
        {
                $query = $this->db->select('*')->from('articles')->where('user_id', $user_id)->get();
                return $query->result();
        }

        public function insert_article($u_id, $t, $b, $c_d, $i)
        {

                $this->user_id = $u_id;
                $this->title = $t;
                $this->body = $b;
                $this->create_date = $c_d;
                $this->img = $i;

                $this->db->insert('articles', $this);
        }

        // public function update_entry()
        // {
        //         $this->title    = $_POST['title'];
        //         $this->content  = $_POST['content'];
        //         $this->date     = time();

        //         $this->db->update('entries', $this, array('id' => $_POST['id']));
        // }

}
