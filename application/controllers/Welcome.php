<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Article_model');
		$this->load->model('User_model');
	}

	public function vue_login(){
		header('Access-Control-Allow-Origin:* ');
		header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
		$username = $this->input->get('username');
		$pwd = $this->input->get('pwd');
		$user = $this->User_model->get_user_by_username_and_pwd($username,$pwd);
		// $this->session->set_userdata(array(
		// 	"user" => $user
		// ));
		echo json_encode($user);
	}
		

	public function index()
	{
		$this->load->library('pagination');

		$total = $this->Article_model->get_count_article();
		// echo base_url();
		// die();

		$config['base_url'] = base_url().'welcome/index';
		$config['total_rows'] = $total;
		$config['per_page'] = 1;
		
		$this->pagination->initialize($config);
		
		$links = $this->pagination->create_links();   

		$results = $this->Article_model->get_article_list($this->uri->segment(3),$config['per_page']);
		// var_dump($results);
		// die();  

		//$user = $this->session->userdata('user');
		$types = $this->Article_model->get_article_type();
		// if(gettype($user) == "object"){
		// 	$types = $this->Article_model->get_article_type($user->user_id);
		// }
		//var_dump($types);
		$this->load->view('index',array('list'=>$results,'types'=>$types,'links'=>$links));
	}

	public function autologin()
	{
		$this->load->library('pagination');
		
		$user = $this->session->userdata('user');
		// var_dump($user->user_id);
		// die();
		$total = $this->Article_model->get_count_article($user->user_id);
		// var_dump($total);
		// die();
		
		$config['base_url'] = base_url().'welcome/autologin';
		$config['total_rows'] = $total;
		$config['per_page'] = 1;
				
		$this->pagination->initialize($config);
				
		$links = $this->pagination->create_links();
		
		//$results = $this->Article_model->get_personal_article_list($this->uri->segment(3),$config['per_page'],$user->user_id);
		$results = $this->Article_model->get_article_list($this->uri->segment(3),$config['per_page']);

		// var_dump($results);
		// die();
				//$user = $this->session->userdata('user');
		$types = $this->Article_model->get_personal_article_type($user->user_id);
				// if(gettype($user) == "object"){
				// 	$types = $this->Article_model->get_article_type($user->user_id);
				// }
				//var_dump($types);
		$this->load->view('index_logined',array('list'=>$results,'types'=>$types,'links'=>$links));
	}
	
	public function adminIndex()
	{
		$user = $this->session->userdata('user');
		$this->load->view('adminIndex',array('user'=>$user));
	}
	
	public function new_blog()
	{
		$user = $this->session->userdata('user');
		$types = $this->Article_model->get_type_by_user_id($user->user_id);
		//var_dump($types);
		$this->load->view('new_blog',array('user'=>$user,'types'=>$types));
	}

	public function pulish_blog()
	{
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$catalog = $this->input->post('catalog');
		$user = $this->session->userdata('user');
		date_default_timezone_set('Asia/Shanghai');
		$rows = $this->Article_model->pulish_blog(array(
			'title'=>$title,
			'content'=>$content,
			'post_date'=>date('Y-m-d h:m:s'),
			'user_id'=>$user->user_id,
			'type_id'=>$catalog
		));
		if($rows > 0){
			redirect('welcome/autologin');
		}
	}

	

	public function blog_catalogs()
	{
		$user = $this->session->userdata('user');
		$types = $this->Article_model->get_logined_article_type($user->user_id);
		$this->load->view('blog_catalogs',array('types'=>$types));
	}

	public function add_type()
	{
		$name = $this->input->get('name');
		$user = $this->session->userdata('user');
		$rows = $this->Article_model->add_type($name,$user->user_id);
		if($rows >0){
			echo 'success';
		}
	}

	public function edit_type()
	{
		$name = $this->input->get('name');
		$type_id = $this->input->get('typeId');
		$rows = $this->Article_model->edit_type($name,$type_id);
		if($rows >0){
			echo 'success';
		}
	}

	public function del_type()
	{
		$type_id = $this->input->get('typeId');
		$user = $this->session->userdata('user');
		$result = $this->Article_model->get_type_by_id_userid($user->user_id,$type_id);
		if($result == 0){
			echo 'fail';
		}else{
			$rows = $this->Article_model->del_type($type_id);
			if($rows >0){
				echo 'success';
			}
		}
	}

	public function blogs()
	{
		$user = $this->session->userdata('user');
		$result = $this->Article_model->get_blogs_by_user($user->user_id);
		// var_dump($result);
		// die();
		$this->load->view('blogs',array('result'=>$result));
	}

	public function del_article()
	{
		$ids = $this->input->get("ids");
		$rows = $this->Article_model->del_article_by_id($ids);
		if($rows > 0){
			echo "success";
		}
	}

	public function blog_detail()   //要获得文章信息和对应的评论内容以及评论人的姓名  
	{
		$id = $this->input->get('id');
		$row = $this->Article_model->get_article_by_id($id);
		// var_dump($row);
		// die();

		$date_str = $this->time_tran($row->post_date);
		$row->post_date = $date_str;  //获得article_id 和 当前时间,只是一个对象
		

		$comments = $this->Article_model->get_comment_by_article_id($id);  //获得评论
		// var_dump($comments);
		// die();
		
		//查询上一篇和下一篇文章

		//全部的文章
		//$user = $this->session->userdata('user');
		$result = $this->Article_model->get_article_list_all();
		// var_dump($result);
		// die();
		$next_article = null;
		$prev_article = null;
		foreach($result as $index=>$article){
			if($article->article_id == $id){
				if($index > 0){
					$prev_article = $result[$index-1];
				}
				if($index < count($result) - 1){
					$next_article = $result[$index+1];
					// var_dump($next_article);
					// die();
				}
			}
		}
		$this->load->view('viewPost_comment',array(
			'article'=>$row,        //文章详细信息
			'comments'=>$comments,   //获得评论和评论人的姓名
			'next'=>$next_article,   
			'prev'=>$prev_article
		));
	}

	function time_tran($the_time)
	{
		date_default_timezone_set('Asia/Shanghai');
		$now_time = date("Y-m-d H:i:s", time() + 8 * 60 * 60);
		$now_time = strtotime($now_time);
		$show_time = strtotime($the_time);
		$dur = $now_time - $show_time;
		if ($dur < 0) {
			return $the_time;
		} else {
			if ($dur < 60) {
				return $dur . '秒前';
			} else {
				if ($dur < 3600) {
					return floor($dur / 60) . '分钟前';
				} else {
					if ($dur < 86400) {
						return floor($dur / 3600) . '小时前';
					} else {
						if ($dur < 259200) {//3天内
							return floor($dur / 86400) . '天前';
						} else {
							return $the_time;
						}
					}
				}
			}
		}
	}

	public function add_comment()
	{
		$content = $this->input->get('content');
		$article_id = $this->input->get('articleId');
		$user = $this->session->userdata('user');
		$rows = $this->Article_model->add_comment(array(
			'content'=>$content,
			'user_id'=>$user->user_id,
			'post_date'=>date("Y-m-d h:m:s"),
			'article_id'=>$article_id
		));
		if($rows > 0){
			echo 'success';
		}
		
	}

	public function blog_comments()
	{
		$user = $this->session->userdata('user');
		$results = $this->Article_model->get_comment_commusername_by_id($user->user_id);
		// var_dump($results);
		// die();
		$this->load->view("blog_comments",array('results'=>$results));
	}

	public function del_comm()
	{
		$comm_id = $this->input->get('commId');
		// var_dump($comm_id);
		// die();
		$row = $this->Article_model->del_comment($comm_id);
		// echo $row;
		// die();
		if($row > 0){
			echo 'success';
		}
	}

	public function inbox()
	{
		$user = $this->session->userdata('user');
		$messages = $this->Article_model->get_message_by_userid($user->user_id);
		// var_dump($messages);
		// die();
		foreach($messages as $message){
			$message->birthday = $this->time_tran($message->post_date);
			//var_dump($message->b);
		}
		//$date_str = $this->time_tran($row->post_date);
		//$this->Article_model->get_send_by_sender()

		$this->load->view("inbox",array(
			'messages'=>$messages
		));
	}

	public function del_message($user_id)
	{
		$user_id = $this->input->get("userid");
		var_dump($user_id);
	}
}
