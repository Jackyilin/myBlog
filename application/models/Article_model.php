<?php

/**
 * Created by PhpStorm.
 * User: apple
 * Date: 18/1/13
 * Time: 下午3:20
 */
class Article_model extends CI_Model
{
    public function get_article_list($offset,$page_size){

//        $sql = "select * from t_article a ,t_article_type t where a.type_id = t.type_id";

        $this->db->select('*');
        $this->db->from('t_article a');
        $this->db->join('t_article_type t', 'a.type_id = t.type_id','left');
        $this->db->limit($page_size, $offset);
        $this->db->order_by('a.article_id','desc');
        $query = $this->db->get();

//        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_article_list_all(){
        $query = $this->db->get('t_article');
        return $query->result();
    }

    public function get_article_type(){
        $sql ="select * from
                 (select count(*) num,a.type_id
                 from t_article a 
                GROUP BY a.type_id) nt,
                t_article_type t 
                where t.type_id = nt.type_id";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_count_article(){
        return $this->db->count_all('t_article');
    }

    // public function get_count_personal_article($user_id){
    //     $sql = "select * from t_article a where a.user_id = $user_id";
    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }

    public function get_personal_article_list($offset,$page_size,$user_id){
        $this->db->select('*');
        $this->db->from('t_article a');
        $this->db->join('t_article_type t','a.type_id = t.type_id','left');
        $this->db->where('a.user_id',$user_id);
        $this->db->order_by('a.article_id','desc');
        $this->db->limit($page_size, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_personal_article_type($user_id){
        $sql ="select * from
        (select count(*) num,a.type_id
        from t_article a where a.user_id = $user_id
        GROUP BY a.type_id) nt,
        t_article_type t 
        where t.type_id = nt.type_id";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_type_by_user_id($user_id){
        $query = $this->db->get_where('t_article_type',array('user_id'=>$user_id));
        return $query->result();
    }

    public function pulish_blog($article){
        $this->db->insert('t_article',$article);
        return $this->db->affected_rows();
    }

    public function num_article_type($user_id){
        $sql = "select *,(select count(*) FROM t_article a
        where a.type_id = t.type_id) num 
        from t_article_type t
        where t.user_id = 12";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function add_type($name,$user_id){
        $this->db->insert('t_article_type',array(
            'type_name'=>$name,
            'user_id'=>$user_id
        ));
        return $this->db->affected_rows();
    }

    public function get_logined_article_type($user_id){
        $sql ="select *,(select count(*) from 
            t_article a 
            where a.type_id = t.type_id) num
             from t_article_type t 
            where t.user_id = $user_id";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function edit_type($name,$type_id){
        $this->db->where('type_id', $type_id);
        $this->db->update('t_article_type',array(
            "type_name" => $name,
        ));
        return $this->db->affected_rows();
    }

    public function get_type_by_id_userid($user_id,$type_id){
        $query = $this->db->get_where('t_article_type',array(
            'user_id'=>$user_id,
            'type_id'=>$type_id
        ));
        return $query->result();
    }

    public function del_type($type_id){
        $this->db->delete('t_article_type', array('type_id' => $type_id));
        return $this->db->affected_rows();
    }

    public function get_blogs_by_user($user_id){
        $sql ="select t.title,t.post_date,t.article_id from t_article t
        where t.user_id = $user_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function del_article_by_id($ids){
        $this->db->where_in('article_id',$ids);
        $this->db->delete('t_article');
        return $this->db->affected_rows();
    }

    public function get_article_by_id($id){
        $query = $this->db->get_where('t_article',array(
            'article_id'=>$id,
        ));
        return $query->row();
    }

    public function get_comment_by_article_id($id){
        // $this->db->select('*');
        // $this->db->from('t_comment c');
        // $this->db->join('t_user u','c.user_id = u.user_id');
        // $this->db->where('c.article_id',$id);
        // return $this->db->get()->result();
        $this->db->select('*');
        $this->db->from('t_comment c');
        $this->db->join('t_user u','c.user_id = u.user_id');
        $this->db->where('c.article_id',$id);
        return $this->db->get()->result();
    }

    public function add_comment($comment){
        $row = $this->db->insert("t_comment",$comment);
        return $this->db->affected_rows();
    }

    public function get_comment_commusername_by_id($user_id){
        $sql = "select * from t_user u,
        (select comm_id,c.content,c.post_date,c.user_id,nt.title,nt.article_id from t_comment c,
        (select * from t_article a where a.user_id = $user_id) nt 
        where nt.article_id = c.article_id) bt
        where u.user_id = bt.user_id
        group by bt.post_date desc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function del_comment($comm_id){
        // $sql = "delete * from t_comment where comm_id = $comm_id";
        //$this->db->delete('t_comment', array('comm_id' => $comm_id));
        //return $this->db->affected_rows();
        //return $this->db->query($sql)->row();
        $this->db->where_in('comm_id',$comm_id);
        $this->db->delete('t_comment');
        return $this->db->affected_rows();
    }

    public function get_message_by_userid($user_id){    
        //$query = $this->db->get_where('t_message',array('receiver'=>$user_id));
        // $sql = "select * from t_user u,(select * from t_message m where m.receiver = $user_id) nt
        // where u.user_id = nt.sender";
        $sql = "select u.birthday,u.user_id,u.username,nt.content,nt.post_date,nt.receiver,nt.sender,nt.msg_id 
        from t_user u,
        (select * from t_message m where m.receiver = $user_id or m.sender = $user_id) nt
        where u.user_id = nt.sender";
        $query = $this->db->query($sql);
        return $query->result();      //包含了发送者的姓名和发送的内容
    }

}