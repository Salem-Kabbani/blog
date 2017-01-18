<?php
class Like_model extends CI_Model {

        public $id;
        public $user_id;
        public $article_id;

        public function get_article_likes($article_id)
        {
                $query = $this->db->select('*')->from('likes')->where('article_id', $article_id)->get();
                return $query->result();
        }


        public function insert_like($u_id, $a_id)
        {
                $this->user_id = $u_id;
                $this->article_id = $a_id;
                $this->db->insert('likes', $this);
                return $this->db->insert_id();
        }

        public function delete_like($u_id, $a_id)
        {
                $this->db->where('user_id', $u_id);
                $this->db->where('article_id', $a_id);
                $this->db->delete('likes');
        }

        public function is_liked($u_id, $a_id)
        {
                $query = $this->db->select('*')->from('likes')->where('article_id', $a_id)->where('user_id',$u_id)->get();
                return (count($query->result())>0);
        }

}
