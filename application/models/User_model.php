<?php
class User_model extends CI_Model {

        public $id;
        public $username;
        public $email;
        public $password;
        public $img;

        public function get_last_ten_entries()
        {
                $query = $this->db->get('articles', 10);
                return $query->result();
        }

        public function get_user_by_id($id)
        {
                $query = $this->db->select('*')->from('users')->where('id', $id)->get();
                return $query->result();
        }

        public function get_user_by_email($email)
        {
                $query = $this->db->select('*')->from('users')->where('email', $email)->get();
                return $query->result();
        }

        public function insert_user()
        {
                $this->username    = $this->input->post('username'); // please read the below note
                $this->email  = $this->input->post('email');
                $this->password  = md5($this->input->post('password'));
                $this->img  = 'default-user-image.png';
                $this->db->insert('users', $this);
                return $this->db->insert_id();
        }

        // public function update_entry()
        // {
        //         $this->title    = $_POST['title'];
        //         $this->content  = $_POST['content'];
        //         $this->date     = time();

        //         $this->db->update('entries', $this, array('id' => $_POST['id']));
        // }

}
