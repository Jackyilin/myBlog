<?php
class User extends CI_Controller {

	 public function __construct()
	 {
		 parent::__construct();
		 $this->load->model('User_model');
	 }

	public function login()
	{
		$this->load->view('login');
	}

	public function captcha()
	{
		$this->load->helper('captcha');
		$rand = rand(1000,9999);
		$this->session->set_userdata(array(
			"captcha" => $rand
		));
		$vals = array(
			'word'      => $rand,
			'img_path'  => './captcha/',
			'img_url'   => base_url().'captcha/',
			'font_path' => './path/to/fonts/texb.ttf',
			'img_width' => '150',
			'img_height'    => 30,
			'expiration'    => 7200,
			'word_length'   => 8,
			'font_size' => 16,
			'colors'    => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		);
		
		$cap = create_captcha($vals);
		$img = $cap['image'];
		return $img;
	}

	public function reg()
	{
		$img = $this->captcha();
		$this->load->view('reg',array('imgs'=>$img));
	}

	public function change_code()
	{
		$img = $this->captcha();
		echo $img;
	}

	public function add_user()
	{
			$email = $this->input->get('email');
			$name = $this->input->get('name');
			$pwd = $this->input->get('pwd');
			$pwd2 = $this->input->get('pwd2');
			$gender = $this->input->get('gender');
			$province = $this->input->get('province');
			$city = $this->input->get('city');
			$code = $this->input->get('code');

			$captcha = $this->session->userdata('captcha');
			
			if($pwd != $pwd2){
				echo 'pwd-error';
				die();
			}else if($code != $captcha){
				echo 'code-error';
				die();
			}else{
				$rows = $this->User_model->add(array(
					'username'=>$name,
					'email'=>$email,
					'password'=>$pwd,
					'sex'=>$gender,
					'province'=>$province,
					'city'=>$city
				));
				if($rows > 0){
					echo 'success';
				}else{
					echo 'fail';
				}
			}
	}

	public function check_email(){
		$email = $this->input->get('email');
		$result = $this->User_model->get_user_by_email($email);
		if(count($result) > 0){
			echo '1';
		}else{
			echo '0';
		}
	}

	public function check_login(){
		$email = $this->input->get('email');
		$pwd = $this->input->get('pwd');
		$result = $this->User_model->get_user_by_email($email);
		if(count($result) == 0){
			echo 'email not exist';
		}else{
			if($result[0]->password != $pwd){
				echo 'error';
			}else{
				$this->session->set_userdata(array(
					'user'=>$result[0]
				));
				echo 'success';
			}
		}
	}

	public function logout(){
		$this->session->unset_userdata('user');
		$this->load->view('login');
	}

	public function auto_login(){
		$email = $this->input->get('email');
		$result = $this->User_model->get_user_by_email($email);
		$this->session->set_userdata(array(
			'user'=>$result[0]
		));
		redirect("welcome/index");
	}
}