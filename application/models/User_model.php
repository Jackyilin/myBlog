
<?php
class User_model extends CI_Model
{

    public function add($user){
        $this->db->insert('t_user',$user);
        return $this->db->affected_rows();
    }

    public function get_user_by_email($email){
        $query = $this->db->get_where('t_user', array('email' => $email));
        return $query->result();
    }

    // public function get_user_by_email_and_pwd($email,$pwd){
    //     $query = $this->db->get_where('t_user', array('email' => $email,'password'=>$pwd));
    //     return $query->row();
    // }
    public function get_user_by_username_and_pwd($username,$pwd){
        //var_dump($username);
        $query = $this->db->get_where('t_user', array('username' => $username,'password'=>$pwd));
        //var_dump($query->row());
        return $query->row();
    }

    public function user_list(){
        $query=$this->db->get('user');
        
        return $query->result();
    }

    public function del_user($id){
        $this->db->delete('user', array('id' => $id));
        return $this->db->affected_rows();
    }

    public function get_name_by_id($id){
        $query=$this->db->get_where('user',array('id'=>$id));
        return $query->row();
    }

    public function update($id,$name){
		
        return $this->db->affected_rows();
    }
}

?>